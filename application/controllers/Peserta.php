<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Peserta extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('c_helper');
        // $this->load->model('m_peserta');
        $this->load->model('M_Sidebar', 'm_sidebar');
        $this->load->model('M_Pelatihan', 'm_pelatihan');
        $this->load->model('M_Peserta', 'm_peserta');
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
        $data['url'] = 'peserta';
        $data['title'] = 'Peserta';
        $data['sub_title'] = 'Peserta di AMD Academy';
        $data['menu'] = $menu;
        $data['user'] = $user;

        $data['pelatihan'] = $this->m_pelatihan->getPelatihan3();

        viewAdmin($this, 'admin/peserta', $data);
    }

    public function getData()
    {

        // print_r($this->input->post('pelatihan'));exit;

        // if(!empty($this->input->post()['pelatihan'])){
        //     $query = $this->m_pelatihan->getPeserta();
        // }else{
        //     $query = $this->m_pelatihan->getPesertaWhere($this->input->post('pelatihan'));
        // }

        // print_r($this->input->post());exit;
        if ($this->input->post()['pelatihan'] == '') {
            $query = $this->m_pelatihan->getPelatihan3();
        } else {

            // $cek =  $this->m_pelatihan->cekPelatihan($this->input->post()['pelatihan']);
            // print_r($cek);exit;
            
             $query = $this->m_pelatihan->getPelatihanBy($this->input->post()['pelatihan']);
            
        }
        // print_r($query);exit;
        // $pelatihan = $_GET('pelatihan');

        $draw = intval($this->input->get("draw"));
        // print_r($query);exit;

        // if($query==0){

        // }else{

        // }
        $data = [];
        foreach ($query as $key => $r) {
            $data[] = array(
                'no' => $key + 1,
                'nama_pelatihan' => $r['nama_pelatihan'],
                'nama' => $r['nama_pelatihan'],
                // 'email' => $r['email'],
                // 'nomor_hp' => $r['nomor_hp'],
                // 'alamat' => $r['alamat'],
                // 'jenis_kelamin' => $r['jenis_kelamin'],
            );
        }
        $result = array(
            "draw" => $draw,
            "data" => $data,
        );
        // echo '<pre>';
        // print_r($query);
        // echo '</pre>';exit;


        echo json_encode($result);
        // print_r($result);exit;
    }

    // public function filterPelatihan(){
    //     if($this->input->post()==null){
    //         $array = [
    //             'success' => false ,
    //             'message' => 'gak ada data'
    //         ];
    //     }else{
    //         $data = $this->input->post()['id'];


    //         $query = $this->m_peserta->getPesertaBy($data);
    //         $draw = intval($this->input->get("draw"));
    //         // print_r($query);exit;
    //         foreach ($query as $key => $r) {
    //             $data[] = array(
    //                 'no' => $key + 1,
    //                 'nama_pelatihan' => $r['nama_pelatihan'],
    //                 'nama' => $r['nama'],
    //                 'email' => $r['email'],
    //                 'nomor_hp' => $r['nomor_hp'],
    //                 'alamat' => $r['alamat'],
    //                 'jenis_kelamin' => $r['jenis_kelamin'],
    //             );
    //         }
    //         $result = array(
    //             "draw" => $draw,
    //             "data" => $data,

    //         );
    //     }
    //     echo json_encode($result);
    // }
}
