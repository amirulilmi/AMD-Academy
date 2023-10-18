<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_User extends CI_Model
{
    public function getUser()
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('role', 'role.id_role = user.role_id');
        return $this->db->get();
    }
    public function getUserPeserta()
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('peserta', 'peserta.id_user = user.id_user');
        return $this->db->get();
    }
    public function getUserAdmin()
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('admin', 'user.id_user = admin.id_user');
        // $this->db->where('user.id_user = admin.id_user');
        $result = $this->db->get();
        return $result;
    }
    public function tambahUser($user)
    {
        return $this->db->insert('user', $user);
    }
    public function tambahAdmin($admin)
    {
        return $this->db->insert('admin', $admin);
    }


    //PUNYA ILMI
    public function peserta_detail()
    {
        return $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
    }
    public function peserta_detail_fix($id_user)
    {
        return $this->db->get_where('member', ['user_id' => $id_user])->row_array();
    }
    public function base64($id_user)
    {
        return $this->db->get_where('users', ['id' => $id_user])->row_array();
    }
    public function proses_edit($id_user)
    {
        $cek = $this->cek_noHP($this->input->post('no_hp'));
        $cek2 = $this->cek_noHP2($id_user);
        // print_r($cek2);exit;
        $cek2 = $cek2['nomor_hp'];

        // print_r($cek2);exit;
        if(($cek>1 && $cek2!=$this->input->post('no_hp'))){
            $this->session->set_flashdata('hp', 'duplikat');
            redirect(base_url('user/profile_edit'));
        }
        else{

            if($this->input->post('jenis_kelamin')=='Laki-laki'){
                $jenis_kelamin = 'L';
            }else{
                $jenis_kelamin = 'P';
            }
            $data_peserta = array(
                'email' => $this->input->post('email'),
                'nama' => $this->input->post('nama'),
                'jenis_kelamin' => $jenis_kelamin,
                'tempat_lahir' => $this->input->post('tempat_lahir'),
                'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                'nomor_hp' => $this->input->post('no_hp'),
                'alamat' => $this->input->post('alamat'),
                'instansi' => $this->input->post('instansi'),
            );
    
            $this->db->from('member');
            $this->db->where('user_id', $id_user);
            $this->db->update('member', $data_peserta);
    
            $data_peserta2 = array(
                'email' => $this->input->post('email'),
                'name' => $this->input->post('nama'),
            );
            $this->db->from('users');
            $this->db->where('id', $id_user);
            $this->db->update('users', $data_peserta2);
            
        }
        
    }
    public function proses_edit_gambar($base64,$id_user)
    {

        $gambar = array(
            'gambar' => $base64,
        );
        $this->db->from('users');
        $this->db->where('id', $id_user);
        $this->db->update('users', $gambar);

    }

    private function cek_noHP($no_HP)
    {
       return $this->db->get_where('member', ['nomor_hp' => $no_HP])->num_rows();
    }

    private function cek_noHP2($id_user)
    {
       return $this->db->get_where('member', ['user_id' => $id_user])->row_array();
    }

    public function proses_edit_gambar_admin($base64,$id_user){
        $data_admin = array(
            'gambar' => $base64,
        );
        $this->db->from('users');
        $this->db->where('id', $id_user);
        $this->db->update('users', $data_admin);
    }

    public function proses_edit_admin($id_user){
        $data_admin = array(
            'email' => $this->input->post('email'),
            'name' => $this->input->post('nama'),
        );
        $this->db->from('users');
        $this->db->where('id', $id_user);
        $this->db->update('users', $data_admin);

        // $data_admin = array(
        //     'email' => $this->input->post('email'),
        //     'name' => $this->input->post('nama'),
        // );
        // $this->db->from('user');
        // $this->db->where('id_user', $id_user);
        // $this->db->update('user', $data_admin);
    }

    public function proses_edit_pass($id_user)
    {
        // print_r($this->input->post('oldpass'));exit;
        $password = $this->db->get_where('users', ['id' => $id_user])->row_array();
        // print_r($password);exit;
        $password = $password['password'];

        $oldpass = $this->input->post('oldpass');
        $oldpass = hash('sha256', $oldpass);

        // print_r($password);exit;
        if ($password == $oldpass) {
            if ($this->input->post('newpass') == $this->input->post('confirmpass')) {
                $confirmpass = $this->input->post('confirmpass');
                $confirmpass = hash('sha256', $confirmpass);
                $data = array(
                    'password' => $confirmpass,
                );
                $this->db->from('users');
                $this->db->where('id', $id_user);
                $this->db->update('users', $data);
                $message['status'] = 'success';
                
            } else {
                // $this->session->set_flashdata('baru', 'nconfirm');
                // redirect(base_url('user/profile'));
                $message['status'] = 'failed_pass_baru';       
            }
        } else {
            // $this->session->set_flashdata('lama', 'salah');
            // // redirect(base_url('user/profile'));
            $message['status'] = 'failed_pass';
        }
        return $message['status'];
       
    }

    public function getProgram(){
        $this->db->from('kategori');
        $this->db->join('pelatihan','pelatihan.pelatihan_kategori_id = kategori.id');
        
        $query = $this->db->get();
        return $query->result_array();
    }
}
