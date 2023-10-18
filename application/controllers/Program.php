<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Program extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('c_helper');
        $this->load->model('M_Sidebar', 'm_sidebar');
        // $this->load->model('m_auth');
        $this->load->model('M_Auth', 'm_auth');
        $this->load->model('M_User');

        $id_role = $this->session->userdata('role_id');

        if ($this->session->userdata('id_user') == null) {
            redirect('auth');
        }

        if ($id_role == null) {
            redirect('auth');
        }

        $user = $this->m_auth->getCurrentUser();
        // print_r($user);exit;
        // if ($user['user_group_id'] != $this->m_auth->getIDRole('peserta')['id_role']) {
        //     redirect('dashboard');
        // }

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

        $data['url'] = 'program';
        $data['title'] = 'Program';
        $data['sub_title'] = 'Program Pelatihan Lainnya';
        $data['menu'] = $menu;
        $data['user'] = $user;

        $data2 = array(
            'pelatihan' => $this->M_User->getprogram(),
        );
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('program', $data2);
        $this->load->view('templates/footer');
    }
}
