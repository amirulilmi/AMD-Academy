<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('c_helper');
        $this->load->model('M_Peserta', 'm_peserta');
        $this->load->model('M_Pelatihan', 'm_pelatihan');
        $this->load->model('M_Pendaftaran', 'm_pendaftaran');
        $this->load->model('M_Sertifikat', 'm_sertifikat');
        $this->load->model('M_Sidebar', 'm_sidebar');
        $this->load->model('M_Auth', 'm_auth');
        $this->load->model('M_User', 'm_user');
        $user_group_id = $this->session->userdata('role_id');


        if ($this->session->has_userdata('id_user') == false) {
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
        
        // print_r($currentUser);exit;
        $menu = $this->m_sidebar->getSidebarMenu($currentUser['user_group_id']);
        // print_r($menu);
        // die;

        $data['url'] = 'dashboard';
        $data['title'] = 'Dashboard';
        $data['sub_title'] = 'Selamat Datang';
        $data['menu'] = $menu;
        $data['user'] = $currentUser;
        $data['idPeserta'] = $this->m_auth->getIDRole('Peserta')['id'];
        $data['idAdmin'] = $this->m_auth->getIDRole('Admin')['id'];

        // data sidebar & navbar || end

        // data content || start

        if ($currentUser['user_group_id'] == $this->m_auth->getIDRole('Pendaftar')['id']) {
            $data['listDaftar'] = $this->m_pendaftaran->getPendaftaran($currentUser['id'])['result'];
            // print_r($data);exit;

            $listLulus = $this->m_sertifikat->getSertifikat($currentUser['id'], '1')['result'];
            $jmlhSertif = 0;
            // foreach ($listLulus as $ll) {
            //     $jmlhSertif += count(array_filter(json_decode($ll['link'], true)));
            // }

            $jumlahLulus = count($listLulus);

            $data['titleCard1'] = 'Pelatihan diikuti';
            $data['titleCard2'] = 'Lulus';
            $data['titleCard3'] = 'Sertifikat';
            $data['isi1'] = $this->m_pendaftaran->getJumlahPendaftaran2($currentUser['id'])['result'];
            // $data['isi1'] = 1;
            $data['isi2'] = $jumlahLulus;
            $data['isi3'] = $jmlhSertif;
        } elseif ($currentUser['user_group_id'] == $this->m_auth->getIDRole('admin')['id']) {
            
            $data['titleCard1'] = 'Pelatihan';

            $data['titleCard2'] = 'Peserta';
            $data['titleCard3'] = 'Pendaftar';
            $data['isi1'] = $this->m_pelatihan->getJumlahPelatihan();
            $data['isi2'] = $this->m_peserta->getJumlahPeserta2();
            $data['isi3'] = $this->m_peserta->getJumlahPendaftar();
            // $data['jmlhPeserta'] = $this->m_peserta->getJumlahPeserta();
        } elseif ($currentUser['user_group_id'] == $this->m_auth->getIDRole('Peserta')['id']) {
            $data['listDaftar'] = $this->m_pendaftaran->getPendaftaran($currentUser['id'])['result'];
            $listLulus = $this->m_sertifikat->getSertifikat($currentUser['id'], '1')['result'];
            $jmlhSertif = 0;
            // foreach ($listLulus as $ll) {
            //     $jmlhSertif += count(array_filter(json_decode($ll['link'], true)));
            // }

            $jumlahLulus = count($listLulus);

            $data['titleCard1'] = 'Pelatihan diikuti';
            $data['titleCard2'] = 'Lulus';
            $data['titleCard3'] = 'Sertifikat';
            $data['isi1'] = $this->m_pendaftaran->getJumlahPendaftaran2($currentUser['id'])['result'];
            // $data['isi1'] = 1;
            $data['isi2'] = $jumlahLulus;
            $data['isi3'] = $jmlhSertif;
        }

        // data content || end

        viewAdmin($this, 'dashboard', $data);
    }

    public function dataPeserta()
    {
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $query = $this->m_peserta->getPeserta();
        $data = [];

        foreach ($query as $key => $r) {
            // var_dump($r);
            // die;
            $data[] = array(
                'no' => $key + 1,
                'nama' => $r['nama'],
                'email' => $r['email'],
                'no_hp' => $r['no_hp'],
                'alamat' => $r['alamat'],
                'instansi' => $r['instansi'],
                'active' => '
                <form class="w-25" action="" method="post">
                <div class="form-check form-switch w-50">
                <input class="form-check-input" onclick=changeStatus(' . $r['id_user'] . ',' . $r['is_active'] . ') id="switchActive' . $r['id_peserta'] . '" type="checkbox" role="switch" ' . $this->isChecked($r['is_active']) . '>
              </div>
        </form>
        ',
                'wa' => $this->tampilKirimWA($r['id_user'])
            );
        }
        $result = array(
            "draw" => $draw,
            "recordsTotal" => $this->m_peserta->getJumlahPeserta(),
            "recordFiltered" => $this->m_peserta->getJumlahPeserta(),
            "data" => $data
        );
        // var_dump($result);
        // die;
        echo json_encode($result);
        exit();
    }

    private function isChecked($is_active)
    {
        if ($is_active == 1) {
            return 'checked';
        } else {
            return '';
        }
    }

    public function changeStatus()
    {
        $param = $this->input->post();
        if ($param) {
            $ubahStatus = $this->m_peserta->putStatusPeserta($param['id'], $param['checkPosition']);
            if ($ubahStatus['success'] == true) {
                return true;
            }
        }
    }

    public function kirimWA()
    {
        $id_user = $this->input->post()['id'];
        $this->m_peserta->putStatusPeserta($id_user, '1');
        //ngirim wa username & password
        $param = $this->m_peserta->getUser($id_user);
        // print_r($param);
        // die;
        $result = $this->m_pendaftaran->postWA($param);
        if ($result == 200) {
            $array = [
                'success' => true,
                'message' => 'Berhasil mengirimkan username dan password'
            ];
        } else {
            $array = [
                'success' => false,
                'message' => 'Gagal mengirimkan username dan password'
            ];
        }
        echo json_encode($array);
    }

    private function ijinTampilKirimWA($id_user)
    {
        $records = $this->m_pendaftaran->getIdOrderPeserta($id_user);
        $listIdOrder = array_column($records, 'id_order');
        $hasil = false;
        foreach ($listIdOrder as $io) {
            $cek = $this->m_pendaftaran->getJumlahOrderSukses($io);
            if ($cek > 0) {
                $hasil = true;
                return $hasil;
                break;
            }
        }
    }

    private function tampilKirimWA($id_user)
    {
        if ($this->ijinTampilKirimWA($id_user) == true) {
            return '<button type="button"  class="btn btn-success w-auto btn-sm  kirimWA " id="' . $id_user . '"><i class="fa-brands fa-whatsapp text-white"></i></button>';
        } else {
            return '<button type="button"  class="btn btn-secondary  noWA" id="coba"> <i class="fa-brands fa-whatsapp text-white" aria-hidden="true"></i></button>';
        }
    }

    // public function coba()
    // {
    //     print('sdd');
    //     print_r($this->m_auth->getCurrentUser());
    // }
}
