<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Pembayaran extends CI_Model
{
    private $t_daftar = 'pelatihan_pendaftar';
    private $t_member = 'member';
    private $t_users = 'users';
    private $t_order = 'order';
    private $t_latihan = 'pelatihan';
    private $t_kategori = 'kategori';
    private $t_pelatihan_harga = 'pelatihan_harga';

    private function queryAllPembayaran()
    {
        $this->db->select(['*', 'order.jenis as jenis_order'])
            ->from($this->t_daftar);
    }

    private function queryPembayaran($id_user = null)
    {
        $this->queryAllPembayaran();
        $this->db->where(['pelatihan_pendaftar.user_id' => $id_user]);
    }

    private function queryJoinPembayaran()
    {
        $this->db->join($this->t_member, 'member.id = pelatihan_pendaftar.member_id');
        $this->db->join($this->t_users, 'users.id = pelatihan_pendaftar.user_id');
        $this->db->join($this->t_order, 'order.id_order = pelatihan_pendaftar.order_id');
        $this->db->join($this->t_latihan, 'pelatihan.id = pelatihan_pendaftar.pelatihan_id');
        $this->db->join($this->t_pelatihan_harga, 'pelatihan_harga.id = pelatihan_pendaftar.pelatihan_harga_id');
    }

    private function queryGetPembayaran($id_user = null, $sts_code = null, $jenis = null)
    {
        if ($id_user == null) {
            $this->queryAllPembayaran();
        } else {
            $this->queryPembayaran($id_user);
        }
        $this->queryJoinPembayaran();
        if ($sts_code !== null && $jenis !== null) {
            $this->db->where([
                'status_code' => $sts_code,
                'jenis' => $jenis
            ]);
        }
    }

    private function getIdOrderStatus($status_code)
    {
        $this->db->select('id_order')
            ->from($this->t_order)
            ->where(['status_code' => $status_code]);
        return $this->db->get()->result_array();
    }



    //main function

    public function getPembayaran($id_user = null, $sts_code = null, $jenis = null)
    {
        $this->queryGetPembayaran($id_user, $sts_code, $jenis);
        return $this->db->get()->result_array();
    }

    public function getJumlahBayar($id_user = null, $sts_code = null, $jenis = null)
    {
        $this->queryGetPembayaran($id_user, $sts_code, $jenis);
        return $this->db->get()->num_rows();
    }

    public function getOrderTable($id_order =  null)
    {
        $this->db->select('*')
            ->from($this->t_order);
        if ($id_order != null) {
            $this->db->where(['id_order' => $id_order]);
            return $this->db->get()->row_array();
        } else {
            return $this->db->get()->result_array();
        }
    }

    private function buatDelete1($id_order)
    {
        $this->db->select('id_order')
            ->from($this->t_order)
            ->where("DATE(`time`) + INTERVAL 1 DAY < NOW()")
            ->where(['status_code' => 0])
            ->where(['id_order' => $id_order]);
    }

    private function buatDelete2()
    {
        $this->db->select('id_order')
            ->from($this->t_order)
            ->where("DATE(`time`) + INTERVAL 1 DAY < NOW()")
            ->where(['status_code' => 0]);
    }

    public function buatDelete($id_order = null)
    {
        $this->load->helper('date');

        if ($id_order == null) {
            $this->buatDelete2();
        } else {
            $this->buatDelete1($id_order);
        }
        return $this->db->get();
    }

    public function numDelete()
    {
        return $this->buatDelete()->num_rows();
    }

    public function deletePembayaranMitrans($id_order = null)
    {
        $this->db->trans_start();
        $this->load->helper('date');
        if ($id_order !== null) {
            $listIO = $this->buatDelete($id_order)->result_array();
            if (count($listIO) === 0) {
                return [
                    'success' => false,
                    'message' => 'Gagal hapus data',
                    'text' => 'Pendaftaran yang bisa dihapus hanya pendaftaran yang tidak diketahui'
                ];
            }
        } else {
            $listIO = $this->buatDelete()->result_array();
        }


        foreach ($listIO as $IO) {
            $listIS = $this->getSertifUsingIdOrder($IO['id_order']);
            $this->db->delete($this->t_daftar, ['id_order' => $IO['id_order']]);

            foreach ($listIS as $IS) {
                $this->db->delete('sertifikat', ['id_sertif' => $IS['id_sertif']]);
            }

            $this->db->delete($this->t_order, ['id_order' => $IO['id_order']]);
        }
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return [
                'success' => false,
                'message' => 'Gagal hapus data',
                'text' => 'Terjadi kesalahan pada database'
            ];
        } else {
            $this->db->trans_complete();
            return [
                'success' => true,
                'message' => 'Berhasil hapus data',
                'text' => 'YESS'
            ];
        }
    }

    public function getSertifUsingIdOrder($id_order)
    {
        $this->db->select('sertifikat.id_sertif')
            ->from($this->t_daftar)
            ->join('sertifikat', 'sertifikat.id_sertif = pelatihan_pendaftar.id_sertif')
            ->where(['pelatihan_pendaftar.id_order' => $id_order]);
        return $this->db->get()->result_array();
    }
}
