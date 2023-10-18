<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('M_Auth', 'm_auth');
        $this->load->model('M_Pendaftaran', 'm_daftar');
        $this->load->helper('c_helper');
    }

    public function index()
    {
        if ($this->session->has_userdata('id_user')) {
            redirect(base_url('dashboard'));
        }
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == false) {

            // $this->load->view('templates/sidebar');
            // $this->load->view('templates/navbar');
            $this->load->view('login');
            // $this->load->view('templates/footer'); 
        } else {
            $this->login();
        }
    }

    public function login2(){
        $this->load->view('login2');
    }


    private function login()
    {
        $username = $this->input->post('username');
        $password =  hash('sha256', $this->input->post('password'));

        $user = $this->m_auth->login($username)->row_array();

        if ($user) {

            if ($user['is_active'] == 1) {

                if ($password == $user['password']) {
                    $data = [
                        'id_user' => $user['id'],
                        'username' => $user['username'],
                        'role_id' => $user['user_group_id']
                    ];

                    $this->session->set_userdata($data);
                    redirect('dashboard');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong password!');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Your account is inactive, please contact the admin!');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Your account is not registered');
            redirect('auth');
        }
    }

    public function checkAlphaOnly($nama){
        if(!preg_match('/^[a-zA-Z ]*$/', $nama)) return FALSE ;
        else return TRUE;
    }

    public function checkNumber($no){
        if(!preg_match('/((^(\+62)\d{12}))/', $no)) return FALSE;
        else return TRUE;
    }

    public function registrasi()
    {
       
        $this->form_validation->set_rules('email', 'Email', 'required|valid_emails|is_unique[users.email]');
        $this->form_validation->set_rules('nama', 'Nama', 'required|callback_checkAlphaOnly');
        $this->form_validation->set_rules('nohp', 'No hp', 'required|max_length[15]|min_length[10]|is_unique[users.username]');
        $this->form_validation->set_rules('password1', 'Password', 'required|min_length[8]');
        $this->form_validation->set_rules('password2', 'Konfirmasi password', 'required|min_length[8]|matches[password1]');

        $this->form_validation->set_message('required', '{field} harus diisi!');
        $this->form_validation->set_message('matches', '{field} tidak valid!');
        $this->form_validation->set_message('is_unique', '{field} sudah digunakan!');
        $this->form_validation->set_message('valid_emails', '{field} tidak valid!');
        $this->form_validation->set_message('min_length', '{field} terlalu pendek');
        $this->form_validation->set_message('max_length', '{field} terlalu panjang');
        $this->form_validation->set_message('checkAlphaOnly', '{field} hanya berisi huruf dan spasi');
        // $this->form_validation->set_message('checkNumber', 'Gunakan format +628');

        

        if($this->form_validation->run()=== FALSE){
            $this->load->view('registrasi');
        }else{
            $users = [
                'username' => "62".$this->input->post('nohp'),
                'name' => $this->input->post('nama'),
                'email' => $this->input->post('email'),
                'password' =>  hash('sha256', $this->input->post('password1')),
            ];

            $this->db->trans_begin();
            $this->m_auth->insertUsers($users);

            $id_users = $this->db->insert_id();
            $query = $this->m_daftar->lastIDMember();
            
            // var_dump($urutan);
            // die();
            $member = [
                'kode_member' => kodeMember($query['id'] + 1),
                'nama' => $this->input->post('nama'),
                'email' => $this->input->post('email'),
                'nomor_hp' => "62" . $this->input->post('nohp'),
                'user_id' => $id_users,
            ];
            // var_dump($member);
            // die();
            $this->m_auth->insertMember($member);

            if ($this->db->trans_status()===true) {
                $this->db->trans_commit();
                $data['status'] ='Registrasi berhasil';  
                // return TRUE;
            }else{
                $this->db->trans_rollback();
                $data['status'] ='Registrasi gagal';
                // return FALSE;
            }
            $this->session->set_flashdata('sukses', '<div class="alert alert-success" role="alert">Selamat! Pendaftaran akun berhasil. Silahkan Login!</div>');
            return redirect('auth');
        }
    }

    public function forgot()
    {
        $this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">Kamu nanya? password kamu apa kamu nanya?');
        redirect('auth');
    }

    public function logout()
    {
        $this->m_auth->logout();
        redirect("index.php/auth");
    }

    // GET ALAMAT
    public function getdatakab(){
        $prov_id = $this->input->post('provinsi');
        $kabupaten = $this->m_auth->kabupaten($prov_id);
        echo json_encode($kabupaten);
    }
    public function getdatakec(){
        $kab_id = $this->input->post('kabupaten');
        $kecamatan = $this->m_auth->kecamatan($kab_id);
        echo json_encode($kecamatan);
    }
}
