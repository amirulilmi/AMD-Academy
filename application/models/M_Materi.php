<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Materi extends CI_Model
{
    private $t_materi = 'pelatihan_materi';
    private $t_kategori = 'kategori';
    private $t_pendaftaran = 'pendaftaran';
    private $t_pelatihan = 'pelatihan';
    private $t_order = 'order';
    private $t_tipe_file = 'tipe_file';

    private function queryGetMateriAll()
    {
        $this->db->select('*')->from('materi');
    }

    private function queryGetMateri($id_kategori)
    {
        $this->queryGetMateriAll();
        $this->db->where(['materi.id_kategori' => $id_kategori]);
    }

    private function queryGetMateriFinal($id_kategori = null, $id_materi = null, $id_tipe_file = null, $id_kategori_peserta = null)
    {
        if ($id_kategori != null) {
            $this->queryGetMateri($id_kategori);
        } else {
            $this->queryGetMateriAll();
        }
        if ($id_materi != null) {
            $this->db->where(['materi.id_materi' => $id_materi]);
        }
        if ($id_tipe_file != null) {
            $this->db->where(['materi.id_tipe_file' => $id_tipe_file]);
        }
        if ($id_kategori_peserta != null) {
            $this->db->where_in('materi.id_kategori', $id_kategori_peserta);
        }

        $this->db->join($this->t_kategori, 'materi.id_kategori = kategori.id_kategori');
        $this->db->join($this->t_tipe_file, 'materi.id_tipe_file = tipe_file.id_tipe_file');
    }

    private function queryCekGetByLink($link)
    {
        $this->queryGetMateriAll();
        $this->db->where(['link_materi' => $link]);
    }


    //Ambil kategori yang didaftar peserta
    public function getKategoriMateriPeserta($id_user)
    {
        $this->db->select(['pelatihan.id', 'pelatihan.nama_pelatihan'])
            ->from('pelatihan_pendaftar')
            ->join('pelatihan', 'pelatihan_pendaftar.pelatihan_id = pelatihan.id')
            // ->join($this->t_kategori, 'pelatihan.id_kategori = kategori.id_kategori')
            ->join($this->t_order, 'pelatihan_pendaftar.order_id = order.id_order')
            ->where(['pelatihan_pendaftar.user_id' => $id_user]);

        $array =  $this->db->get()->result_array();

        return array_unique($array, SORT_REGULAR);
    }
    public function getMateri($id_kategori = null, $id_materi = null, $id_tipe_file = null, $id_kategori_peserta = null)
    {
        $this->queryGetMateriFinal($id_kategori, $id_materi, $id_tipe_file, $id_kategori_peserta);
        return $this->db->get()->result_array();
    }


    public function getPelatihanMateri($id_pelatihan = null, $id_materi = null)
    {
        $this->db->select('*')
            ->from($this->t_materi);
        if ($id_pelatihan != null) {
            $this->db->where(['pelatihan_id' => $id_pelatihan]);
        }

        if ($id_materi != null) {
            $this->db->where(['id' => $id_materi]);
        }
        return $this->db->get();
    }




    public function getJumlahMateri($id_kategori = null, $id_materi = null)
    {
        $this->queryGetMateriFinal($id_kategori, $id_materi);
        return $this->db->get()->num_rows();
    }

    public function postMateri($param)
    {

        $data = [
            'materi' => $param['materi'],
            'deskripsi' => $param['deskripsi'],
            'referensi_file' => (string)$param['url_berkas'],
            'referensi_link' => $param['ref_link'],
            'status' => $param['status'],
            'pelatihan_id' => $param['ip'],
        ];
        $this->db->insert($this->t_materi, $data);
        return [
            'code' => 200,
            'success' => true,
            'message' => 'Berhasil menambahkan data'
        ];
    }

    public function putMateri($param)
    {
        $data = [
            'materi' => $param['materi'],
            'deskripsi' => $param['deskripsi'],
            'referensi_file' => (string)$param['url_berkas'],
            'referensi_link' => $param['ref_link'],
            'status' => $param['status'],
            'pelatihan_id' => $param['ip'],
        ];
        $this->db->where(['id' => $param['i']])
            ->update($this->t_materi, $data);
        return [
            'code' => 200,
            'success' => true,
            'message' => 'Berhasil ubah data'
        ];
    }

    public function deleteMateri($id_materi, $ref_file)
    {

        if (file_exists('./' . $ref_file)) {
            unlink(FCPATH . $ref_file);
        }
        $this->db->delete($this->t_materi, ['id' => $id_materi]);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return [
                'success' => false,
                'message' => 'Gagal hapus data ke databse'
            ];
        } else {
            $this->db->trans_complete();
            return [
                'success' => true,
                'message' => 'Berhasil hapus data'
            ];
        }
    }

    public function cekJudul($judul)
    {
        $this->queryGetMateriAll();
        $this->db->where(['judul' => $judul]);
        return $this->db->get()->num_rows();
    }

    public function cekLink($link)
    {
        $this->queryCekGetByLink($link);
        return $this->db->get()->num_rows();
    }

    public function getJudulByLink($link)
    {
        $this->queryCekGetByLink($link);
        return $this->db->get()->row_array();
    }


    public function getMemberUsingIDUser($id_user)
    {
        $this->db->select('id')
            ->from('member')
            ->where(['user_id' => $id_user]);
        return $this->db->get()->row_array();
    }

    public function getPelatihanIdUsingIdMember($id_member)
    {
        $this->db->select('pelatihan_id')
            ->from('pelatihan_pendaftar')
            ->where(['member_id' => $id_member]);
        return $this->db->get()->result_array();
    }

    public function getPelatihan($id_pelatihan)
    {
        $this->db->select(['id', 'nama_pelatihan'])
            ->from('pelatihan')
            ->where(['id' => $id_pelatihan]);
        return $this->db->get()->row_array();
    }



    // public function getTipeFile()
    // {
    //     $this->db->select('*')
    //         ->from($this->t_tipe_file);
    //     return $this->db->get()->result_array();
    // }
}
