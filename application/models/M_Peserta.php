<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Peserta extends CI_Model
{
    private $t_peserta = 'member';
    private $t_user = 'users';



    // MAIN FUNCTION 

    public function getPeserta($id_peserta = null, $is_active = null)
    {
        if ($id_peserta != null) {
            $this->queryPeserta($id_peserta);
        } else {
            $this->queryAllPeserta();
        }
        if ($is_active != null) {
            $this->queryWhere($is_active);
        }
        $this->queryJoin();
        return $this->db->get()->result_array();
    }

    public function getPesertaBy($id_pel)
    {
        $this->db->select('*')
            ->from('pelatihan_pendaftar')
            ->where(['pelatihan_id' => $id_pel]);
        return $this->db->get()->result_array();
    }


    public function putStatusPeserta($id_user, $param)
    {
        $this->db->trans_start();
        $dataStatus = [
            'status_pendaftaran' => $this->status($param['status_code']),
            'status_pembayaran'  => $this->status($param['status_code'])
        ];
        $this->db->where(['user_id' => $id_user])
            ->update('pelatihan_pendaftar', $dataStatus);

        if ($param['status_code'] == 200) {
            $peserta = $this->m_auth->getIDRole('peserta')['id'];
            $dataMember = [
                'status_pendaftaran' => 'Peserta'
            ];
            $this->db->where(['user_id' => $id_user])
                ->update('member', $dataMember);
            $dataUser = [
                'user_group_id' => $peserta
            ];
            $this->db->where(['id' => $id_user])
                ->update('users', $dataUser);
        } else {
            // $peserta = $this->m_auth->getIDRole('peserta')['id'];
            // $dataMember = [
            //     'status_pendaftaran' => 'Peserta'
            // ];
            // $this->db->where(['user_id' => $id_user])
            //     ->update('member', $dataMember);
            // $dataUser = [
            //     'user_group_id' => $peserta
            // ];
            // $this->db->where(['id' => $id_user])
            //     ->update('users', $dataUser);
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return [
                'success' => false,
                'message' => 'Gagal ubah data ke databse'
            ];
        } else {
            $this->db->trans_complete();
            return [
                'success' => true,
                'message' => 'Berhasil ubah data'
            ];
        }
    }

    private function status($status_code)
    {
        if ($status_code == 201) {
            return 'Menunggu Verifikasi';
        } elseif ($status_code == 200) {
            return 'Valid';
        } elseif ($status_code == 0) {
            return 'Menunggu Verifikasi';
        } else {
            return 'Tidak Valid';
        }
    }

    public function getJumlahPeserta()
    {
        $this->queryAllPeserta();
        return $this->db->get()->num_rows();
    }

    public function getJumlahPeserta2()
    {
        $this->db->select('*')
            ->from('member')
            ->where(['status_pendaftaran' => 'Peserta']);
        return $this->db->get()->num_rows();
    }
    public function getJumlahPendaftar()
    {
        $this->db->select('*')
            ->from('member')
            ->where(['status_pendaftaran' => 'Pendaftar']);
        return $this->db->get()->num_rows();
    }

    public function getUser($id_user)
    {
        $this->db->select('*')
            ->from($this->t_user)
            ->join($this->t_peserta, 'pelatihan_pendaftar.user_id = users.id')
            ->where(['users.id' => $id_user]);
        return $this->db->get()->row_array();
    }

    // PRIVATE FUNCTION 

    public function queryAllPeserta()
    {
        $this->db->select('*')
            ->from($this->t_peserta);
    }

    private function queryPeserta($id_peserta)
    {
        $this->queryAllPeserta();
        $this->db->where(['member.id' => $id_peserta]);
    }

    private function queryWhere($is_active)
    {
        $this->db->where(['is_active' => $is_active]);
    }

    private function queryJoin()
    {
        $this->db->join(
            $this->t_user,
            'member.user_id = users.id'
        );
    }
}
