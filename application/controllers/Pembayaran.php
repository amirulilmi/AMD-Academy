<?php

class Pembayaran extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->helper('c_helper');
        $this->load->model('M_Sidebar', 'm_sidebar');
        $this->load->model('M_Auth', 'm_auth');
        $this->load->model('M_Peserta', 'm_peserta');
        $this->load->model('M_Pembayaran', 'm_bayar');
        $this->load->model('M_Pendaftaran', 'm_daftar');
        $this->load->model('M_Harga', 'm_harga');

        if ($this->session->userdata('id_user') == null) {
            redirect('auth');
        }

        if ($this->m_auth->cekUserAktif($this->session->userdata('id_user')) == 0) {
            $this->session->unset_userdata('id_user');
            redirect('auth');
        }
    }

    public function index()
    {

        //data sidebar & navbar || start
        $currentUser = $this->m_auth->getCurrentUser();
        $menu = $this->m_sidebar->getSidebarMenu($currentUser['user_group_id']);

        $data['url'] = 'pembayaran';
        $data['title'] = 'Pembayaran';
        $data['sub_title'] = 'Transaksi Pembayaran Pelatihan';
        $data['menu'] = $menu;
        $data['user'] = $currentUser;
        $data['idPeserta'] = $this->m_auth->getIDRole('peserta')['id'];
        $data['idAdmin'] = $this->m_auth->getIDRole('admin')['id'];

        // data sidebar & navbar || end

        viewAdmin($this, 'admin/bayar', $data);
    }

    public function dataBayar()
    {
        // $currentUser = $this->m_auth->getCurrentUser();
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $query = $this->m_bayar->getPembayaran();
        $data = [];

        foreach ($query as $key => $r) {
            // var_dump($r);
            // die;
            $data[] = array(
                'id_order' => $r['id_order'],
                'nama' => $r['name'],
                'jenis' => $r['jenis'] . ' - ' . $r['jenis_order'],
                'nama_kategori' => $r['nama_pelatihan'],
                'nominal' => 'Rp ' . number_format(($r['harga'] - $r['diskon']), 0, '', '.'),
                'waktu' => $r['time'],
                'status' => $this->textStatus($r['status_code']),
                'action' => '  <button ' . $this->terimaBtn($r['jenis_order'], $r['id_order'], 'terima') . ' text-white terima">
                Terima
            </button>  <button ' . $this->terimaBtn($r['jenis_order'], $r['id_order'], 'hapus', $r['time']) . ' text-white hapusByr">
            hapus
        </button> '
            );
        }
        $result = array(
            "draw" => $draw,
            "recordsTotal" => $this->m_bayar->getJumlahBayar(),
            "recordFiltered" => $this->m_bayar->getJumlahBayar(),
            "data" => $data
        );
        // var_dump($result);
        // die;
        echo json_encode($result);
        exit();
    }

    public function dataBayarPeserta()
    {
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $query = $this->m_bayar->getPembayaran($this->session->userdata('id_user'));
        $data = [];

        foreach ($query as $key => $r) {
            // var_dump($r);
            // die;
            $data[] = array(
                'no' => $key + 1,
                'nama_kategori' => '  <div class="row">
                <img src="" alt="">
                <div>
                  <p>' . $r['nama_pelatihan'] . '</p>
                  <small>' . substr($r['deskripsi'], 0, 25) . '...</small>
                </div>
              </div>',
                'tipe' => $r['jenis_harga'],
                'nominal' => 'Rp ' . number_format($r['gross_amount'], 0, '', '.'),
                'waktu' =>  '<b>' . date('j M Y', strtotime($r['time'])) . '</b>' . '</br> at ' . date(' g:i A', strtotime($r['time'])),
                'order_id' => $r['id_order'],
                'status' => $this->textStatus($r['status_code']),
                'action' => $this->tampilBtnKwitansi($r['status_code'], $r['id_order']) . '<form target=_blank action="' . base_url() . 'pembayaran/invoice_pdf" method="post">
                <button type="submit" value="' . $r['id_order'] . '" name="id" class="btn btn-info text-white">
               Invoice
           </button> </form>'
            );
        }
        $result = array(
            "draw" => $draw,
            "recordsTotal" => $this->m_bayar->getJumlahBayar($this->session->userdata('id_user')),
            "recordFiltered" => $this->m_bayar->getJumlahBayar($this->session->userdata('id_user')),
            "data" => $data
        );
        // var_dump($result);
        // die;
        echo json_encode($result);
        exit();
    }


    public function putOrder()
    {
        $this->form_validation->set_rules(rulesBayar());

        $param = $this->input->post();
        if (!array_key_exists('status_code', $param)) {
            $param['status_code'] = 0;
        }
        if ($this->form_validation->run() == FALSE && $param['status_code'] == 200) {
            $result = [
                'success' => false,
                'message' => 'Link bukti pembayaran tidak boleh kosong',
                'icon' => 'error'
            ];
        } elseif (strlen(trim($param['bukti'])) == 0 && $param['status_code'] == 200) {
            $result = [
                'success' => false,
                'message' => 'Link bukti pembayaran tidak boleh hanya diisi spasi',
                'icon' => 'error'
            ];
        } elseif (valid_url($param['bukti']) == false && $param['status_code'] == 200) {
            $result = [
                'success' => false,
                'message' => 'Link invalid',
                'icon' => 'error'
            ];
        } elseif (trim($param['bukti']) == '' && $param['status_code'] == 200) {
            $result = [
                'success' => false,
                'message' => 'Status disetujui, tapi bukti pembayaran kosong',
                'icon' => 'info'
            ];
        } elseif (trim($param['bukti']) != "" && $param['status_code'] != 200) {
            $result = [
                'success' => false,
                'message' => 'Bukti bayar terisi, namun status belum disetujui',
                'icon' => 'info'
            ];
        } else {
            $param['order_id'] = $param['i'];
            $proses = $this->m_daftar->putOrder($param, 'manual');
            if ($proses['success'] == true) {
                $id_users = $this->m_daftar->getIdUserOrder($param['order_id']);
                foreach ($id_users as $id_user) {
                    $this->m_peserta->putStatusPeserta($id_user['user_id'], $param);
                }
                $result =  [
                    'code' => 200,
                    'success' => true,
                    'message' => 'Data berhasil diperbarui'
                ];
            }
        }

        echo json_encode($result);
    }

    public function getDetailOrder()
    {
        $id_order = $this->input->post('id');
        if ($id_order == null) {
            $data = array(
                'success' => false,
                'message' => 'Tidak diizinkan mengubah data !'
            );
        } else {
            $data = [
                'success' => true,
                'data' => $this->m_bayar->getOrderTable($id_order)
            ];
        }
        echo json_encode($data);
    }


    public function kwitansi_pdf()
    {
        $param = $this->input->post();


        $order = $this->m_bayar->getOrderTable($param['id']);
        $user = $this->m_daftar->getPendaftaran($order['id_user_pj'], $param['id'])['result'][0];
        $peserta = $this->m_peserta->getPeserta($user['member_id'])[0];

        $data = [
            'order' => $order,
            'user' => $user,
            'peserta' => $peserta,
            'terbilang' => $this->terbilang($order['gross_amount'])
        ];


        $this->load->library('pdf');

        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->set_option('isRemoteEnabled', true);
        $this->pdf->filename = "kwitansi-" . $param['id'] . ".pdf";
        $this->pdf->load_view('kwitansi', $data);
    }

    public function invoice_pdf()
    {
        $param = $this->input->post();

        $order = $this->m_bayar->getOrderTable($param['id']);
        $user = $this->m_daftar->getPendaftaran($order['id_user_pj'], $param['id'])['result'][0];
        $biaya = $this->m_harga->getPelatihanHarga(null, $user['pelatihan_harga_id'])->row_array();
        // print_r($biaya);
        // die;
        $jmlhOrder = count($this->m_daftar->getPendaftaran(null, $param['id'])['result']);
        $peserta = $this->m_peserta->getPeserta($user['member_id'])[0];

        $data = [
            'order' => $order,
            'user' => $user,
            'biaya' => $biaya,
            'peserta' => $peserta,
            'jmlhOrder' => $jmlhOrder,
            'terbilang' => $this->terbilang($order['gross_amount'])
        ];


        $this->load->library('pdf');


        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->set_option('isRemoteEnabled', true);
        $this->pdf->setBasePath(FCPATH . '/assets/css');
        $this->pdf->filename = "invoice-" . $param['id'] . ".pdf";
        $this->pdf->load_view('invoice', $data);
    }

    public function deleteOrder()
    {
        $param = $this->input->post();
        if (array_key_exists('id', $param)) {
            $id_order = $this->input->post()['id'];
        } else {
            $id_order = null;
        }

        if ($id_order === null) {
            if ($this->m_bayar->numDelete() == 0) {
                $array = [
                    'success' => null,
                    'message' => 'Tidak ada pembayaran yang dihapus'
                ];
            } else {
                $result = $this->m_bayar->deletePembayaranMitrans();
                if ($result['success']) {
                    $array = [
                        'success' => true,
                        'message' => 'Berhasil menghapus pembayaran yang tidak diketahui'
                    ];
                } else {
                    $array = [
                        'success' => false,
                        'message' => $result['message']
                    ];
                }
            }
        } else {
            $result = $this->m_bayar->deletePembayaranMitrans($id_order);
            if ($result['success']) {
                $array = [
                    'success' => true,
                    'message' => 'Berhasil menghapus pembayaran yang tidak diketahui dengan id order <b>' . $id_order . '</b>'
                ];
            } else {
                $array = [
                    'success' => false,
                    'message' => $result['message'],
                    'text' => $result['text'],
                ];
            }
        }



        echo json_encode($array);
    }


    private function tampilBtnKwitansi($status_code, $id_order)
    {
        switch ($status_code) {
            case 200:
                return '<form action="' . base_url() . 'pembayaran/kwitansi_pdf" method="post">
                 <button type="submit" value="' . $id_order . '" name="id" class="btn btn-success text-white">
                view
            </button> </form>';
                break;

            default:
                return '<button type="button"  class="btn btn-secondary  noView"> View</button>';
                break;
        }
    }


    private function textStatus($status_code)
    {
        switch ($status_code) {
            case 200:
                return '<p class="fw-bolder text-success">Success</p>';
                break;
            case 201:
                return '<p class="fw-bolder text-warning">Pending</p>';
                break;
            case 000:
                return '<p class="fw-bolder text-secondary">Tidak diketahui</p>';
                break;

            default:
                return '<p class="fw-bolder text-danger">Denied</p>';
                break;
        }
    }

    private function terimaBtn($tipe, $id, $jenis, $time = null)
    {
        if ($jenis == 'terima') {
            if ($tipe != 'Midtrans') {
                return 'id="' . $id . '" class="btn btn-warning';
            } else {
                return 'class="btn btn-primary';
            }
        } elseif ($jenis == 'hapus') {

            if (strtotime($time . '+ 1 days') < strtotime('now')) {
                return 'id="' . $id . '" class="btn btn-danger';
            } else {
                return 'id="none" class="btn btn-secondary';
            }
        }
    }

    private function penyebut($nilai)
    {
        $nilai = abs($nilai);
        $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        $temp = "";
        if ($nilai < 12) {
            $temp = " " . $huruf[$nilai];
        } else if ($nilai < 20) {
            $temp = $this->penyebut($nilai - 10) . " belas";
        } else if ($nilai < 100) {
            $temp = $this->penyebut($nilai / 10) . " puluh" . $this->penyebut($nilai % 10);
        } else if ($nilai < 200) {
            $temp = " seratus" . $this->penyebut($nilai - 100);
        } else if ($nilai < 1000) {
            $temp = $this->penyebut($nilai / 100) . " ratus" . $this->penyebut($nilai % 100);
        } else if ($nilai < 2000) {
            $temp = " seribu" . $this->penyebut($nilai - 1000);
        } else if ($nilai < 1000000) {
            $temp = $this->penyebut($nilai / 1000) . " ribu" . $this->penyebut($nilai % 1000);
        } else if ($nilai < 1000000000) {
            $temp = $this->penyebut($nilai / 1000000) . " juta" . $this->penyebut($nilai % 1000000);
        } else if ($nilai < 1000000000000) {
            $temp = $this->penyebut($nilai / 1000000000) . " milyar" . $this->penyebut(fmod($nilai, 1000000000));
        } else if ($nilai < 1000000000000000) {
            $temp = $this->penyebut($nilai / 1000000000000) . " trilyun" . $this->penyebut(fmod($nilai, 1000000000000));
        }
        return $temp;
    }

    private function terbilang($nilai)
    {
        if ($nilai < 0) {
            $hasil = "minus " . trim($this->penyebut($nilai));
        } else {
            $hasil = trim($this->penyebut($nilai));
        }
        return $hasil;
    }

    // public function coba()
    // {
    //     return print_r($this->m_bayar->buatDelete(1671435762)->result_array());
    //     // $id_users = $this->m_daftar->getIdUserOrder(1670845871);
    //     // foreach ($id_users as $id_user) {
    //     //     //ngaktifin status nya
    //     //     $this->m_peserta->putStatusPeserta($id_user['id_user'], '1');
    //     //     //ngirim wa username & password
    //     //     $param = $this->m_peserta->getUser($id_user['id_user']);
    //     //     $this->m_daftar->postWA($param);
    //     // }
    //     // // print_r($id_users);
    // }
}
