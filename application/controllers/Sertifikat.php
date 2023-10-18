<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sertifikat extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('c_helper');
        $this->load->model('M_Peserta', 'm_peserta');
        $this->load->model('M_Sidebar', 'm_sidebar');
        $this->load->model('M_Auth', 'm_auth');
        $this->load->model('M_Sertifikat', 'm_sertifikat');
        $this->load->model('M_Pelatihan', 'm_pelatihan');

        $id_role = $this->session->userdata('role_id');

        if ($this->session->userdata('id_user') == null) {
            redirect('auth');
        }

        if ($id_role == null) {
            redirect('auth');
        }

        if ($this->m_auth->cekUserAktif($this->session->userdata('id_user')) == 0) {
            $this->session->unset_userdata('id_user');
            redirect('auth');
        }
    }

    public function index()
    {
        $id_role = $this->session->userdata('role_id');
        $menu = $this->m_sidebar->getSidebarMenu($id_role);
        $user = $this->m_auth->getCurrentUser();
        // var_dump($id_role);
        // die;
        $id_user = $this->session->userdata('id_user');

        $data_sertif = $this->m_sertifikat->getLinkSertifikat($id_user);
        $data['data_sertif'] = $data_sertif;

        // var_dump($data_sertif->result());    
        // die;

        $data['url'] = 'sertifikat';
        $data['title'] = 'Sertifikat';
        $data['sub_title'] = 'Sertifikat Pelatihan';
        $data['menu'] = $menu;
        $data['user'] = $user;

        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('sertifikat', $data);
        $this->load->view('templates/footer', $data);
    }


    // SERTIFIKAT ADMIN
    public function sertifAdmin()
    {
        $id_role = $this->session->userdata('role_id');
        $menu = $this->m_sidebar->getSidebarMenu($id_role);
        $user = $this->m_auth->getCurrentUser();

        $data_kategori = $this->m_pelatihan->kategori();
        $data['kategori'] = $data_kategori;

        $data['url'] = 'sertifikat/sertifAdmin';
        $data['title'] = 'Dashboard';
        $data['sub_title'] = 'Sertifikat Peserta';
        $data['menu'] = $menu;
        $data['user'] = $user;

        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('admin/sertifikat', $data);
        $this->load->view('templates/footer', $data);
    }

    public function dataSertifikat()
    {
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $query = $this->m_sertifikat->getSertifikatPeserta();

        // print_r($query);
        // die;

        $data = [];

        foreach ($query->result() as $key => $r) {
            // var_dump($r->status);
            // die;
            // $sertifikat = $this->m_sertifikat->Sertifikat($id_pel);
            $rows = json_decode($r->nama_sertif);
            $link = json_decode($r->link);

            // print_r ($rows);
            // die;            
            $data[] = array(
                'no' => $key + 1,
                'nama_peserta' => $r->nama,
                'program' => $r->nama_pelatihan,
                'bnsp' => '<a  href="'.$link->bnsp.'" target="_blank" style="width:244px;height:188px;background-color: white;box-shadow: 0 0 0 2px #F8F8F8;" >'.$rows->bnsp.'</a>',
                'amd' => '<a  href="'.$link->amd.'" target="_blank" style="width:244px;height:188px;background-color: white;box-shadow: 0 0 0 2px #F8F8F8;" >'.$rows->amd.'</a>',
                'Lulus/Tidak Lulus' => ($rows->bnsp != "" && $rows->amd != ""?'
                <form class="w-25" action="" method="post">
                <div class="form-check form-switch w-50">
                <input class="form-check-input" type="checkbox" role="switch" checked disabled>
                </div>
                </form>
                ':'
                <form class="w-25" action="" method="post">
                <div class="form-check form-switch w-50">
                <input class="form-check-input" onclick=changeStatus(' . $r->id. ',' . $r->status . ') id="switchActive' . $r->id. '" type="checkbox" role="switch" ' . $this->isChecked($r->status) . '>
                </div>
                </form>
                '),
                'action' => ($r->status == "1" ? '<a type="button" href="javascript:void(0)" onclick="uploadSertifikat(' . "'" . $r->id. "'" . ')" class="btn btn-warning">Upload<a>' : '<a type="button" href="javascript:void(0)" onclick="uploadSertifikat(' . "'" . $r->id. "'" . ')" class="btn btn-warning  disabled">Upload<a>')
            );
        }

        // print_r($data);
        // die;

        $result = array(
            "draw" => $draw,
            "recordsTotal" => $query->num_rows(),
            "recordFiltered" => $query->num_rows(),
            "data" => $data
        );
        echo json_encode($result);
        exit();
    }

    private function isChecked($status)
    {
        if ($status == 1) {
            return 'checked';
        } else {
            return '';
        }
    }

    public function changeStatus()
    {
        $param = $this->input->post();
        // print_r($param['checkPosition']);
        // die;
        if ($param) {
            $ubahStatus = $this->m_sertifikat->ubahStatusSertifikat($param['id'], $param['checkPosition']);
            if ($ubahStatus['success'] == true) {
                return true;
            }
        }
    }

    public function upload($id)
    {
        $data = $this->m_sertifikat->getSertifikatPesertaID($id);
        // var_dump($data);
        // die;
        echo json_encode($data);
    }

    public function uploadSertifikat()
    {
        $this->_validation();
        $id = $this->input->post('id');
        // $file = isset($_POST['file'])? $_POST['file']: '{"bnsp":"","amd":""}';

        $sertifikat = [
            // 'id_peserta' => $id,
            // 'id_kategori' => $this->input->post('tipe'),
            'link' => $this->_link(),
            'nama_sertif' => $this->_file(),
            // 'id_user' => $this->input->post('id_user')
        ];

        // var_dump($sertifikat);
        // die;
        $this->m_sertifikat->uploadSertif($sertifikat, $id);
        echo json_encode(['success' => true, 'message' => 'Data Berhasil Diperbarui!']);
    }

    private function _link()
    {
        $id = $this->input->post('id');

        $link = $this->m_sertifikat->Sertifikat($id);

        // var_dump($link->bnsp);
        // die;

        $jenis_sertif = $this->input->post('jenis_sertif');
        $jenis_link = $this->input->post('link');

        foreach ($link->result() as $key => $r) {
            $rows = json_decode($r->link);

            if ($jenis_sertif == 'BNSP') {
                $link = array(
                    'bnsp' => $jenis_link,
                    'amd' => $rows->amd,
                );
            } elseif ($jenis_sertif == 'AMD Academy') {
                $link = array(
                    'bnsp' => $rows->bnsp,
                    'amd' => $jenis_link,
                );
            }
            // var_dump(json_encode($link));
            // die;
            return json_encode($link);
        }
    }

    private function _file()
    {
        $id = $this->input->post('id');

        $nama_sertif = $this->m_sertifikat->Sertifikat($id);

        // var_dump($nama_sertif->bnsp);
        // die;

        $jenis_sertif = $this->input->post('jenis_sertif');
        $nama_pelatihan = $this->input->post('tipe');

        foreach ($nama_sertif->result() as $key => $r) {
            $rows = json_decode($r->nama_sertif);

            if ($jenis_sertif == 'BNSP') {
                $nama_sertif = array(
                    'bnsp' => $nama_pelatihan . "BNSP",
                    'amd' => $rows->amd,
                );
            } elseif ($jenis_sertif == 'AMD Academy') {
                $nama_sertif = array(
                    'bnsp' => $rows->bnsp,
                    'amd' => $nama_pelatihan . "AMD",
                );
            }

            // var_dump(json_encode($nama_sertif));
            // die;
            return json_encode($nama_sertif);
        }
    }


    private function _validation()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = true;

        if ($this->input->post('nama_peserta') == '') {
            $data['inputerror'][] = 'nama_peserta';
            $data['error_string'][] = 'Nama peserta harus diisi!';
            $data['status'] = false;
        }
        if ($this->input->post('tipe')  == '') {
            $data['inputerror'][] = 'tipe';
            $data['error_string'][] = 'Tipe pelatihan harus diisi!';
            $data['status'] = false;
        }
        if ($this->input->post('jenis_sertif')  == '') {
            $data['inputerror'][] = 'jenis_sertif';
            $data['error_string'][] = 'Jenis sertifikat harus diisi!';
            $data['status'] = false;
        }
        if ($this->input->post('link')  == '') {
            $data['inputerror'][] = 'link';
            $data['error_string'][] = 'Link harus diisi!';
            $data['status'] = false;
        }
        if (valid_url($this->input->post('link')) == false) {
            $data['inputerror'][] = 'link';
            $data['error_string'][] = 'Link tidak valid!';
            $data['status'] = false;
        }

        if ($data['status'] === false) {
            echo json_encode($data);
            exit();
        }
    }
}
