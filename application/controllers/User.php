<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('c_helper');
        // $this->load->model('m_Peserta', 'm');
        $this->load->model('M_Sidebar', 'm_sidebar');
        $this->load->model('M_Auth', 'm_auth');
        $this->load->model('M_User');

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

        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();

        $profile_detail = $this->M_User->peserta_detail(); //untuk mengambil id user di table user
        $id_user = $profile_detail['id'];

        $data = array(
            'user' => $data['user']['name'],
            'peserta' => $this->M_User->peserta_detail_fix($id_user),
        );

        $id_role = $this->session->userdata('role_id');
        $menu = $this->m_sidebar->getSidebarMenu($id_role);
        $user = $this->m_auth->getCurrentUser();

        $data['title'] = 'Dashboard';
        $data['sub_title'] = 'Selamat Datang';
        $data['menu'] = $menu;
        $data['user'] = $user;

        // print_r($data);
        // exit;
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('dashboard', $data);
        $this->load->view('templates/footer');
    }

    public function profile()
    {
        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();

        $profile_detail = $this->M_User->peserta_detail(); //untuk mengambil id user di table user
        $id_user = $profile_detail['id'];
        // print_r($id_user);exit;

        $data2 = array(
            'user' => $data['user']['name'],
            'peserta' => $this->M_User->peserta_detail_fix($id_user),
            'data_user' => $this->db->get_where('users', ['id' => $id_user])->row_array(),
        );
        // print_r($data2);exit;

        $id_role = $this->session->userdata('role_id');
        $menu = $this->m_sidebar->getSidebarMenu($id_role);
        $user = $this->m_auth->getCurrentUser();

        $data['url'] = 'dashboard';
        $data['title'] = 'Dashboard';
        $data['sub_title'] = 'Profil';
        $data['menu'] = $menu;
        $data['user'] = $user;

        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('profile', $data2);
        $this->load->view('templates/footer');
    }

    public function profile_edit()
    {
        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();

        $profile_detail = $this->M_User->peserta_detail(); //untuk mengambil id user di table user
        $id_user = $profile_detail['id'];

        $data2 = array(
            'user' => $data['user']['name'],
            'peserta' => $this->M_User->peserta_detail_fix($id_user),
            'data_user' => $this->db->get_where('users', ['id' => $id_user])->row_array(),
            'data_user2' => $this->db->get_where('users', ['id' => $id_user])->row_array(),
        );

        // print_r($data2);exit;
        $id_role = $this->session->userdata('role_id');
        $menu = $this->m_sidebar->getSidebarMenu($id_role);
        $user = $this->m_auth->getCurrentUser();

        $data['url'] = 'dashboard';
        $data['title'] = 'Dashboard';
        $data['sub_title'] = 'Edit Profil';
        $data['menu'] = $menu;
        $data['user'] = $user;

        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('profile_edit', $data2);
        $this->load->view('templates/footer');
    }

    public function proses_edit_gambar()
    {
        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 2000;
        $config['max_width']            = 2000;
        $config['max_height']           = 2000;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('userfile')) {
            $error = array('error' => strip_tags($this->upload->display_errors()));

            // print_r($error['error']);exit;
            $this->session->set_flashdata('no_foto', $error['error']);
            redirect(base_url('user/profile_edit'));
        } else {

            $gambar = $this->upload->data();

            $name = $gambar['file_name'];
            // print_r($name);exit;
            $pathinfo = $gambar['full_path'];
            $filecontent = file_get_contents($pathinfo);
            $base64 = rtrim(base64_encode(($filecontent)));

            $profile_detail = $this->M_User->peserta_detail(); //untuk mengambil id user di table user
            $id_user = $profile_detail['id'];
            $this->M_User->proses_edit_gambar($base64, $id_user);

            // print_r($fileName);exit;
            $fileName = glob("uploads/$name");

            foreach ($fileName as $file) {
                unlink($file);
            }
            $this->session->set_flashdata('pesan', 'diedit');
            redirect(base_url('user/profile_edit'));
        }
    }

    public function proses_edit()
    {
        // $param = $this->input->post();
        // print_r($param);exit;
        $this->form_validation->set_rules('email', '*Email', 'required|valid_email|trim',[
            'required' => '*Email harus diisi',
            'valid_email' => '*Email tidak valid'
        ]);
        $this->form_validation->set_rules('nama', '*Nama', 'required|trim',[
            'required' => '*Nama harus diisi'
        ]);
        $this->form_validation->set_rules('jenis_kelamin', '*Jenis Kelamin', 'required',[
            'required' => '*Jenis kelamin harus diisi'
        ]);
        $this->form_validation->set_rules('tempat_lahir', '*Tempat lahir', 'required|trim',[
            'required' => '*Tempat lahir harus diisi'
        ]);
        $this->form_validation->set_rules('tanggal_lahir', '*Tanggal Lahir', 'required',[
            'required' => '*Tanggal lahir harus diisi'
        ]);
        $this->form_validation->set_rules('no_hp', '*NO HP', 'required|max_length[13]|trim',[
            'max_length' => 'Maksimal no telepon 13 karakter',
            'required' => '*No HP harus diisi'
        ]);
        $this->form_validation->set_rules('alamat', '*Alamat', 'required|trim',[
            'required' => '*Alamat harus diisi'
        ]);
        $this->form_validation->set_rules('instansi', '*Instansi', 'required|trim',[
            'required' => '*Instansi harus diisi'
        ]);
 
        if ($this->form_validation->run() == FALSE) {

            $this->session->set_flashdata('pesan_edit', form_error('email'));

            $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
            $id_role = $this->session->userdata('role_id');
            $menu = $this->m_sidebar->getSidebarMenu($id_role);
            $user = $this->m_auth->getCurrentUser();

            $profile_detail = $this->M_User->peserta_detail(); //untuk mengambil id user di table user
            // print_r($profile_detail);exit;
            $id_user = $profile_detail['id'];
            $la = array(
                'name' => $this->input->post('nama'),
                'email' => $this->input->post('email'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'tempat_lahir' => $this->input->post('tempat_lahir'),
                'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                'nomor_hp' => $this->input->post('no_hp'),
                'alamat' => $this->input->post('alamat'),
                'instansi' => $this->input->post('instansi'),
            );
            $data2 = array(
                'user' => $data['user']['name'],
                'peserta' => $la,
                'data_user' => $la,
                'data_user2' => $this->db->get_where('users', ['id' => $id_user])->row_array()
            );
            // print_r($data2);exit;
            $data['url'] = 'dashboard';
            $data['title'] = 'Dashboard';
            $data['sub_title'] = 'Edit Profile';
            $data['menu'] = $menu;
            $data['user'] = $user;

            // $this->session->set_flashdata('pesan', 'diedit');
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('profile_edit', $data2);
            $this->load->view('templates/footer');

        } else {
          
            $profile_detail = $this->M_User->peserta_detail(); //untuk mengambil id user di table user
            $id_user = $profile_detail['id'];
            $this->M_User->proses_edit($id_user);

            $this->session->set_flashdata('pesan', 'diedit');
            redirect(base_url('user/profile_edit'));
        }
    }


    public function proses_edit_gambar_admin(){
        $config['upload_path']          = FCPATH . './uploads/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 2000;
        $config['max_width']            = 10000;
        $config['max_height']           = 10000;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('userfile')) {

            $error = array('error' => strip_tags($this->upload->display_errors()));
       
            // print_r($error['error']);exit;
            $this->session->set_flashdata('no_foto', $error['error']);
            redirect(base_url('user/profile_edit'));
        } else {
            $gambar = $this->upload->data();

            $name = $gambar['file_name'];
            $pathinfo = $gambar['full_path'];
            $filecontent = file_get_contents($pathinfo);
            $base64 = rtrim(base64_encode(($filecontent)));

            $profile_detail = $this->M_User->peserta_detail(); //untuk mengambil id user di table user
            $id_user = $profile_detail['id'];
            $this->M_User->proses_edit_gambar_admin($base64, $id_user);

            // print_r($fileName);exit;
            $fileName = glob("uploads/$name");

            foreach ($fileName as $file) {
                unlink($file);
            }

            $this->session->set_flashdata('pesan', 'diedit');
            
            redirect(base_url('user/profile_edit'));
        }
    }
    public function proses_edit_admin()
    {
        $this->form_validation->set_rules('email', '*Email', 'required|valid_email|trim',[
            'required' => '*Email wajib diisi',
            'valid_email' => '*Email tidak valid'
        ]);
        $this->form_validation->set_rules('nama', '*Nama', 'required|trim|max_length[100]',[
            'required' => '*Nama wajib diisi',
            'max_length' => '*Panjang Nama maksimal 100 karakter'
        ]);
        if ($this->form_validation->run() == FALSE) {

            $this->session->set_flashdata('pesan_edit', form_error('email'));

            $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
            $id_role = $this->session->userdata('role_id');
            $menu = $this->m_sidebar->getSidebarMenu($id_role);
            $user = $this->m_auth->getCurrentUser();

            $profile_detail = $this->M_User->peserta_detail(); //untuk mengambil id user di table user
            $id_user = $profile_detail['id'];
            $la = array(
                'name' => $this->input->post('nama'),
                'email' => $this->input->post('email'),
                'no_hp' => $this->input->post('no_hp'),
                'alamat' => $this->input->post('alamat'),
                'instansi' => $this->input->post('instansi'),
            );
            $data2 = array(
                'user' => $data['user']['name'],
                'peserta' => $la,
                'data_user' => $la,
                'data_user2' => $this->db->get_where('users', ['id' => $id_user])->row_array()
            );
            $data['url'] = 'dashboard';
            $data['title'] = 'Dashboard';
            $data['sub_title'] = 'Edit Profile';
            $data['menu'] = $menu;
            $data['user'] = $user;

            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('profile_edit', $data2);
            $this->load->view('templates/footer');

        } else {

            $profile_detail = $this->M_User->peserta_detail(); //untuk mengambil id user di table user
            $id_user = $profile_detail['id'];
            $this->M_User->proses_edit_admin($id_user);

            
            $this->session->set_flashdata('pesan', 'diedit');
            redirect(base_url('user/profile_edit'));
        }
    }

    public function proses_edit_pass()
    {
        $profile_detail = $this->M_User->peserta_detail(); //untuk mengambil id user di table user
        $id_user = $profile_detail['id'];
        $password = $this->db->get_where('users', ['id' => $id_user])->row_array();
        $password = $password['password'];

        $oldpass = $this->input->post('oldpass');
        // print_r($oldpass);exit;
        $oldpass = hash('sha256', $oldpass);

        $this->form_validation->set_rules('oldpass', '*Username', 'required|trim',[
            'required' => '*Password lama wajib diisi'
        ]);
        $this->form_validation->set_rules('newpass', '*Password', 'required|trim|min_length[8]',[
            'required' => '*Password baru wajib diisi',
            'min_length' => '*Minimal password 8 karakter'
        ]);
        $this->form_validation->set_rules('confirmpass', '*Password', 'required|trim',[
            'required' => '*Konfirmasi password wajib diisi'
        ]);

        
        if ($this->form_validation->run() == false) {
            // $message['status'] = 'failed';
            // $this->session->set_flashdata('minpass', 'minpass');
            // redirect(base_url('user/profile'));
            $message = [
                'error' => true,
                // 'nim_error' => form_error('nim'),
                'oldpass_error' => form_error('oldpass'),
                'newpass_error' => form_error('newpass'),
                'confirmpass_error' => form_error('confirmpass'),
            ];

        } else {
            if ($password != $oldpass) {
                // $this->session->set_flashdata('lama', 'nconfirm');
                // redirect(base_url('user/profile'));
            
                $message['status'] = 'failed_pass';
            } else {
                $profile_detail = $this->M_User->peserta_detail(); //untuk mengambil id user di table user
                $id_user = $profile_detail['id'];

                $message['status'] = $this->M_User->proses_edit_pass($id_user);
                // $this->session->set_flashdata('pesan', 'diedit');
                
                // redirect(base_url('user/profile'));
            }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($message));
       
    }
}
