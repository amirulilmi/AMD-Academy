<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Auth extends CI_Model
{
    private $_table = "users";
    private $tableB = 'user_groups';
    const SESSION_KEY = 'id_user';


    public function current_user()
    {
        if (!$this->session->has_userdata(self::SESSION_KEY)) {
            return null;
        }
        $id_user = $this->session->userdata(self::SESSION_KEY);
        $query = $this->db->get_where($this->_table, ['id' => $id_user]);
        return $query->row();
    }

    public function user($username)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('users.username', $username);
        $query = $this->db->get();
        return $query;
    }

    public function getCurrentUser()
    {
        $this->db->select('*')
            ->from($this->_table)
            ->where(['id' => $this->session->userdata('id_user')]);
        return $this->db->get()->row_array();
    }

    public function cekUserAktif($id_user)
    {
        $this->db->select('is_active')
            ->from($this->_table)
            ->where(['id' => $id_user, 'is_active' => '1']);
        return $this->db->get()->num_rows();
    }

    // tools

    public function getIDRole($nama_role)
    {
        $this->db->select('*')
            ->from($this->tableB)
            ->where(['group' => $nama_role]);
        return $this->db->get()->row_array();
    }

    // REGISTRASI
    public function insertUsers($users)
    {
        $this->db->insert('users', $users);
    }
    public function insertMember($member)
    {
        $this->db->insert('member', $member);
    }

    public function logout()                                // buat unset session
    {
        $this->session->unset_userdata('id_user');
        return !$this->session->has_userdata('id_user');
    }

    public function login($username){
        $this->db->where('username', $username)->or_where('email', $username);
        return $this->db->get('users');
    }

    //ALAMAT
    public function provinsi()
    {
        $query = $this->db->query("SELECT * FROM ref_provinsi ORDER BY nama_provinsi ASC");
        return $query->result();
    }
    public function kabupaten($prov_id)
    {
        $query = $this->db->query("SELECT * FROM ref_kabupaten_kota WHERE ref_provinsi_id = '$prov_id' ORDER BY nama_kabupaten_kota ASC");
        return $query->result();
    }
    public function kecamatan($kab_id)
    {
        $query = $this->db->query("SELECT * FROM ref_kecamatan WHERE ref_kabupaten_kota_id= '$kab_id' ORDER BY nama_kecamatan ASC");
        return $query->result();
    }

    //PENDIDIKAN
    public function pendidikan()
    {
        $this->db->select('*')
            ->from('ref_pendidikan')
            ->order_by('pendidikan', 'ASC');
        return $this->db->get()->result_array();
    }
    //PEKERJAAN
    public function pekerjaan()
    {
        $this->db->select('*')
            ->from('ref_pekerjaan')
            ->order_by('pekerjaan', 'ASC');
        return $this->db->get()->result_array();
    }
}
