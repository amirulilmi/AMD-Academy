<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, OPTIONS");


class Daftar extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -  
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    private $s_id_biaya = 'id_biaya';
    private $s_id_pel = 'id_pel';

  
    public function __construct()
    {
        parent::__construct();
        $params = array('server_key' => 'SB-Mid-server-IPQBVZ7l3XbiYr8CCB07-4S8', 'production' => false);
        $this->load->library('midtrans');
        $this->midtrans->config($params);
        $this->load->helper('c_helper');
        $this->load->model('M_Pelatihan', 'm_pelatihan');
        $this->load->model('M_Pendaftaran', 'm_daftar');
        $this->load->model('M_Harga', 'm_harga');
        $this->load->model('M_Materi', 'm_materi');
        $this->load->model('M_Auth', 'm_auth');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['allKategori'] = $this->m_pelatihan->getKategori()['result'];
        $param = $this->input->post();
        // print_r($param);
        // exit;
        $this->session->set_userdata([$this->s_id_biaya => $param['id_biaya']]);
        $this->session->set_userdata([$this->s_id_pel => $param['id_pel']]);
        if ($this->session->userdata($this->s_id_biaya) == null) {
            redirect(base_url());
        } else {
            $data['data_member'] = [];
            if ($this->session->has_userdata('id_user')) {
                if ($this->m_auth->getCurrentUser()['user_group_id'] == $this->m_auth->getIDRole('Admin')['id']) {
                    $data['data_member'] = [];
                } else {
                    $data['data_member'] = $this->m_daftar->getPesertaByIdUser($this->session->userdata('id_user'));
                    // print_r($data['data_member']);
                }
            }

            $data['title'] = 'Form Pendaftaran';

            $pilihan = $this->session->userdata($this->s_id_biaya);
            $id_pel = $this->session->userdata($this->s_id_pel);


            $getPelatihanHarga = $this->m_harga->getPelatihanHarga(null, $pilihan)->row_array();
            $getPelatihan = $this->m_pelatihan->getPelatihanWithID($getPelatihanHarga['pelatihan_id']);
            // $data['pilihan'] = $pilihan;
            $data['pelPilihan'] = $getPelatihanHarga;
            $data['katPilihan'] = $getPelatihan;
            $data['kontenMateri'] = $this->m_materi->getPelatihanMateri($id_pel)->result_array();
            $data['fasilitas'] = json_decode($getPelatihanHarga['fasilitas']);
            $data['provinsi'] = $this->m_auth->provinsi();
            $data['pendidikan'] = $this->m_auth->pendidikan();
            $data['pekerjaan'] = $this->m_auth->pekerjaan();

            viewUser($this, 'user/form', $data);
        }
    }

    private function totalBiaya($harga_awal, $potongan, $jumlah_beli)
    {
        return ($harga_awal - $potongan) * $jumlah_beli;
    }

    public function coba($param1)
    {
        print_r($this->m_daftar->getPeserta(null, $param1));
    }


    public function token()
    {
        $param = $this->input->post();
        $param['no_hp'] = "62" . $param['no_hp'];


        $this->form_validation->set_rules(rulesForm());

        if ($this->form_validation->run() == FALSE) {
            $result = [
                'success' => false,
                'message' => form_error('nama') . form_error('email') . form_error('no_hp') . form_error('instansi') . form_error('alamat')
            ];

            return strip_tags($result['message']);
        }

        $pilihan = $this->session->userdata($this->s_id_biaya);

        //ambil data pelatihan & kategori yang dipilih 
        $getPelatihanHarga = $this->m_harga->getPelatihanHarga(null, $pilihan)->row_array();
        $getPelatihan = $this->m_pelatihan->getPelatihanWithID($getPelatihanHarga['pelatihan_id']);

        $harga_awal = $getPelatihanHarga['harga'];


        //ambil jumlah orang tambahan
        $jumlah_org_lain = 0;
        $potongan = $getPelatihanHarga['diskon'];
        if (array_key_exists('no_hp_lain', $param)) {
            $jumlah_org_lain = count($param['no_hp_lain']);
        }


        //itung total biaya
        $jumlah_beli = $jumlah_org_lain + 1;
        $total = $this->totalBiaya($harga_awal, $potongan, $jumlah_beli);
        $param['total'] = $total;
        $param['jenis'] = 'Midtrans';

        //setting id order
        $id_order = time() + rand(4, 7);
        if ($this->m_daftar->cekIdOrder($id_order) != 0) {
            $id_order = $id_order + rand(2, 10);
        }



        // Required
        $transaction_details = array(
            'order_id' => $id_order,
            'gross_amount' => (int)$total, // no decimal allowed for creditcard
        );

        // Optional
        $item1_details = array(
            'id' => inisial($getPelatihan['nama_pelatihan']),
            'price' => (int)$harga_awal - (int)$potongan,
            'quantity' => $jumlah_beli,
            'name' => $getPelatihan['nama_pelatihan']
        );


        // Optional
        $item_details = array($item1_details);

        // Optional
        $billing_address = array(
            'first_name'    => $param['nama'],
            // 'last_name'     => "Litani",
            'address'       => $param['alamat'],
            // 'city'          => "Jakarta",
            // 'postal_code'   => "16602",
            'phone'         => (string)$param['no_hp'],
            // 'country_code'  => 'IDN'
        );

        // Optional
        // $shipping_address = array(
        //     'first_name'    => "Obet",
        //     'last_name'     => "Supriadi",
        //     'address'       => "Manggis 90",
        //     'city'          => "Jakarta",
        //     'postal_code'   => "16601",
        //     'phone'         => "08113366345",
        //     'country_code'  => 'IDN'
        // );

        // Optional
        $customer_details = array(
            'first_name'    => $param['nama'],
            // 'last_name'     => "Litani",
            'email'         => $param['email'],
            'phone'         => $param['no_hp'],
            'billing_address'  => $billing_address,
            // 'shipping_address' => $shipping_address
        );

        // Data yang akan dikirim untuk request redirect_url.
        $credit_card['secure'] = true;
        //ser save_card true to enable oneclick or 2click
        //$credit_card['save_card'] = true;

        $time = time();
        $custom_expiry = array(
            'start_time' => date("Y-m-d H:i:s O", $time),
            'unit' => 'minute',
            'duration'  => 15
        );

        $transaction_data = array(
            'transaction_details' => $transaction_details,
            'item_details'       => $item_details,
            'customer_details'   => $customer_details,
            'credit_card'        => $credit_card,
            'expiry'             => $custom_expiry
        );

        error_log(json_encode($transaction_data));
        $snapToken = $this->midtrans->getSnapToken($transaction_data);
        error_log($snapToken);
        echo $snapToken;

        if ($snapToken) {

            //masukin data pendaftar dan id order ke database
            $this->m_daftar->postPendaftaran($param, $id_order, $jumlah_org_lain);
        }
        // }
    }

    public function manual()
    {
        $param = $this->input->post();
        $param['no_hp'] = "62" . $param['no_hp'];
        $this->form_validation->set_rules(rulesForm());

        //ambil data pelatihan & kategori yang dipilih 
        $pilihan = $this->session->userdata($this->s_id_biaya);
        $getPelatihanHarga = $this->m_harga->getPelatihanHarga(null, $pilihan)->row_array();
        $getPelatihan = $this->m_pelatihan->getPelatihanWithID($getPelatihanHarga['pelatihan_id']);
        $harga_awal = $getPelatihanHarga['harga'];

        //ambil jumlah orang tambahan
        $jumlah_org_lain = 0;
        $potongan = $getPelatihanHarga['diskon'];
        if (array_key_exists('no_hp_lain', $param)) {
            $jumlah_org_lain = count($param['no_hp_lain']);
        }

        //itung total biaya
        $jumlah_beli = $jumlah_org_lain + 1;
        $total = $this->totalBiaya($harga_awal, $potongan, $jumlah_beli);
        $param['total'] = $total;
        $param['jenis'] = 'Manual';

        //setting id order
        $id_order = time() + rand(4, 7);
        if ($this->m_daftar->cekIdOrder($id_order) != 0) {
            $id_order = $id_order + rand(2, 10);
        }

        $daftar = $this->m_daftar->postPendaftaran($param, $id_order, $jumlah_org_lain);
        if ($daftar['success']) {

            $result = [
                'success' => true,
                'message' => 'berhasil',
                'id' => $id_order
            ];
        }

        echo json_encode($result);
    }

    // public function coba2()
    // {
    //     print_r($this->m_daftar->lastIDMember()['id'] + 1);
    // }

    // public function finish()
    // {

    //     $result = json_decode($this->input->post('result_data'), TRUE);

    //     $simpan = $this->m_daftar->putOrder($result);
    //     // echo $simpan;


    //     $inisial = $this->m_pelatihan->getInisial($this->session->userdata($this->s_id_pel));
    //     $this->session->set_flashdata('sukses_daftar', 'Berhasil melakukan pendaftaran, tolong segera membayar');
    //     redirect(base_url('AMDA/' . $inisial));



    //     $this->session->unset_userdata($this->s_id_pel);
    //     $this->session->unset_userdata($this->s_id_biaya);


    //     // echo 'RESULT <br><pre>';
    //     // (var_dump($result->status_code));
    //     // var_dump($result['status_code']);
    //     // var_dump($result["status_code"]);
    //     // echo '</pre>';
    // }
}
