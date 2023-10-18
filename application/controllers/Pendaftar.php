<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pendaftar extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('c_helper');
        // $this->load->model('m_peserta');
        $this->load->model('M_Sidebar', 'm_sidebar');
        $this->load->model('M_Pelatihan', 'm_pelatihan');
        // $this->load->model('m_auth');
        $this->load->model('M_Auth', 'm_auth');
        $this->load->model('M_User');
        $this->load->model('M_Trainer');

        $id_role = $this->session->userdata('role_id');

        if ($this->session->has_userdata('id_user') == false) {
            redirect('auth');
        }

        if ($this->m_auth->cekUserAktif($this->session->userdata('id_user')) == 0) {
            $this->session->unset_userdata('id_user');
            redirect('auth');
        }

        $user = $this->m_auth->getCurrentUser();
        if ($user['user_group_id'] != $this->m_auth->getIDRole('admin')['id']) {
            redirect('dashboard');
        }
    }

    public function index()
    {
        $id_role = $this->session->userdata('role_id');
        $menu = $this->m_sidebar->getSidebarMenu($id_role);
        $user = $this->m_auth->getCurrentUser();
      
        // print_r($data);exit;
        $data['url'] = 'pendaftar';
        $data['title'] = 'Pendaftar';
        $data['sub_title'] = 'Pendaftar di AMD Academy';
        $data['menu'] = $menu;
        $data['user'] = $user;

        
       viewAdmin($this, 'admin/pendaftar', $data);
    }

    public function getData(){

        $query = $this->m_pelatihan->getPendaftar();
        $draw = intval($this->input->get("draw"));
        
        $data = [];
        foreach ($query as $key => $r) {
            $data[] = array(
                'no' => $key + 1,
                'kode_member' => $r['kode_member'],
                'nama' => $r['nama'],
                'email' => $r['email'],
                'nomor_hp' => $r['nomor_hp'],
                'alamat' => $r['alamat'],
                'jenis_kelamin' => $r['jenis_kelamin'],
                
            );
        }

        $result = array(
            "draw" => $draw,
            "data" => $data
        );

        echo json_encode($result);
    }
}
