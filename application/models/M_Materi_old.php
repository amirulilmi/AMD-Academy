<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Materi extends CI_Model
{
    private $t_materi = 'materi';
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
        $this->db->select(['kategori.id_kategori', 'kategori.nama_kategori'])
            ->from($this->t_pendaftaran)
            ->join($this->t_pelatihan, 'pendaftaran.id_pel = pelatihan.id_pel')
            ->join($this->t_kategori, 'pelatihan.id_kategori = kategori.id_kategori')
            ->join($this->t_order, 'pendaftaran.id_order = order.id_order')
            ->where(['pendaftaran.id_user' => $id_user]);

        $array =  $this->db->get()->result_array();

        return array_unique($array, SORT_REGULAR);
    }









    public function getMateri($id_kategori = null, $id_materi = null, $id_tipe_file = null, $id_kategori_peserta = null)
    {
        $this->queryGetMateriFinal($id_kategori, $id_materi, $id_tipe_file, $id_kategori_peserta);
        return $this->db->get()->result_array();
    }

    public function getJumlahMateri($id_kategori = null, $id_materi = null)
    {
        $this->queryGetMateriFinal($id_kategori, $id_materi);
        return $this->db->get()->num_rows();
    }

    public function postMateri($param)
    {

        $data = [
            'judul' => $param['judul'],
            'id_kategori' => $param['kategori'],
            'id_tipe_file' => $param['tipe'],
            'link_materi' => $param['link']
        ];
        $this->db->insert($this->t_materi, $data);
        return [
            'code' => 200,
            'success' => true,
            'message' => 'Berhasil menambahkan data'
        ];
    }

    public function putMateri($param, $id_materi)
    {
        $data = [
            'judul' => $param['judul'],
            'id_kategori' => $param['kategori'],
            'id_tipe_file' => $param['tipe'],
            'link_materi' => $param['link']
        ];
        $this->db->where(['id_materi' => $id_materi])
            ->update($this->t_materi, $data);
        return [
            'code' => 200,
            'success' => true,
            'message' => 'Berhasil ubah data'
        ];
    }

    public function deleteMateri($id_materi)
    {
        $this->db->delete($this->t_materi, ['id_materi' => $id_materi]);
        return [
            'code' => 200,
            'success' => true,
            'message' => 'Berhasil hapus data'
        ];
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




    public function getTipeFile()
    {
        $this->db->select('*')
            ->from($this->t_tipe_file);
        return $this->db->get()->result_array();
    }
}
