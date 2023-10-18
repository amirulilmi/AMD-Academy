<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Sertifikat extends CI_Model
{
    private $tabelA = 'sertifikat';

    public function getJumlahSertifikat($id_user = null)
    {

        $this->queryGetSertifikat($id_user);
        $this->db->where(['status' => '1']);
        $result = $this->db->get()->num_rows();
        return [
            'code' => 200,
            'success' => true,
            'result' => $result
        ];
    }
    public function getSertifikat($id_user = null, $status = null)
    {

        $this->queryGetSertifikat($id_user);
        if ($status !== null) {
            $this->db->where(['status' => $status]);
        }
        $result = $this->db->get()->result_array();
        return [
            'code' => 200,
            'success' => true,
            'result' => $result
        ];
    }

    // private function
    private function queryGetSertifikat($id_user = null)
    {
        if ($id_user == null) {
            $this->db->select('*');
            $this->db->from($this->tabelA);
        } elseif ($id_user != null) {
            $this->db->select('*');
            $this->db->from($this->tabelA);
            $this->db->where(['member_id' => $id_user]);
        }
    }

    // JOIN SERTIFIKAT, PELATIHAN, PESERTA
    public function getSertifikatPeserta()
    {
        $this->db->select('*');
        $this->db->from('pelatihan_pendaftar');
        $this->db->join('pelatihan', 'pelatihan_pendaftar.pelatihan_id = pelatihan.id');
        $this->db->join('member', 'pelatihan_pendaftar.member_id = member.id');
        $this->db->join('sertifikat', 'sertifikat.member_id = member.id');
        // $this->db->where('pelatihan_pendaftar.id_peserta = peserta.id_peserta');

        $query = $this->db->get();
        return $query;
    }

    public function getSertifikatPesertaID($id)
    {
        $this->db->select('*');
        $this->db->from('pelatihan_pendaftar');
        $this->db->join('pelatihan', 'pelatihan_pendaftar.pelatihan_id = pelatihan.id');
        $this->db->join('member', 'pelatihan_pendaftar.member_id = member.id');
        $this->db->join('sertifikat', 'sertifikat.member_id = member.id');

        $this->db->where('sertifikat.id', $id);

        $query = $this->db->get();
        return $query->row();
    }

    public function getLinkSertifikat($id_user)
    {
        // $this->db->select('*');
        // $this->db->from('pelatihan_pendaftar');
        // $this->db->join('sertifikat', 'user.id_user = sertifikat.id_user');
        // $this->db->join('pelatihan', 'pelatihan.id_pel = sertifikat.id_pel');
        // $this->db->join('kategori', 'kategori.id_kategori = pelatihan.id_kategori');
        // $this->db->where('sertifikat.id_user', $id_user);
        // $this->db->where('sertifikat.status', 1);
        $this->db->select('*');
        $this->db->from('pelatihan_pendaftar');
        // $this->db->join('pelatihan', 'pelatihan_pendaftar.pelatihan_id = pelatihan.id');
        $this->db->join('member', 'pelatihan_pendaftar.member_id = member.id');
        $this->db->join('users', 'users.id = member.user_id');
        $this->db->join('sertifikat', 'sertifikat.member_id = member.id');
        $this->db->where('member.user_id', $id_user);
        $this->db->where('sertifikat.status', 1);
        $query = $this->db->get();
        return $query;
    }

    public function Sertifikat($id)
    {
        $this->db->select('*');
        $this->db->from('sertifikat');
        $this->db->where('id', $id);
        return $this->db->get();
    }

    public function uploadSertif($sertifikat, $id)
    {
        $this->db->set($sertifikat);
        $this->db->where('id', $id);
        return $this->db->update('sertifikat');
    }

    public function ubahStatusSertifikat($id_sertif, $newStatus)
    {
        $dataStatus = [
            'status' => (string)$newStatus,
        ];
        $this->db->where(['id' => $id_sertif])
            ->update('sertifikat', $dataStatus);

        return [
            'success' => true,
        ];
    }
}
