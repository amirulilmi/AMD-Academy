<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Pelatihan extends CI_Model
{
    private $tableA = 'pelatihan';
    private $tableB = 'kategori';

    // FUNCTION CRUD

    public function getPelatihan($id_kategori = null, $tipe = null, $active = null, $id_pel = null)
    {
        if ($active == null) {
            $this->queryGetPelatihan($id_kategori, $tipe, $id_pel);
            $result = $this->db->get()->result_array();
            $code = 200;
        } else if ($active == 0 || $active == 1) {
            $this->queryGetPelatihan($id_kategori, $tipe, $id_pel);
            $this->db->where('is_active', (string)$active);
            $result = $this->db->get()->result_array();
            $code = 200;
        } else {
            $result = 'inputan salah';
            $code = 200;
        }
        return [
            'code' => $code,
            'success' => true,
            'result' => $result
        ];
    }

    public function getKategori($id_kategori = null, $inisial = null)
    {
        if ($id_kategori === null && $inisial != null) {
            $this->queryKategoriIN($inisial);
            $result = $this->db->get()->row_array();
            $code = 200;
        } elseif ($id_kategori != null && $inisial === null) {
            $this->queryKategoriID($id_kategori);
            $result = $this->db->get()->row_array();
            $code = 200;
        } elseif ($id_kategori == null && $inisial == null) {
            $this->queryKategoriAll();
            $result = $this->db->get()->result_array();
            $code = 200;
        } else {
            $result = 'inputan salah';
            $code = 200;
        }
        return [
            'code' => $code,
            'success' => true,
            'result' => $result
        ];
    }

    public function putMateriKategori($data)
    {
        $this->db->trans_start();
        $dataMateri = [
            'materi' => $data['strMateri']
        ];
        $this->db->where(['id_kategori' => $data['id']])
            ->update($this->tableB, $dataMateri);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return [
                'success' => false,
                'message' => 'Gagal'
            ];
        } else {
            $this->db->trans_complete();
            return [
                'success' => true,
                'message' => 'Berhasil'
            ];
        }
    }



    // FUNGSI ADMIN
    public function kategori()
    {
        $this->db->select('*');
        $this->db->from('kategori');
        $get = $this->db->get();
        return $get->result();
    }
    public function getKategoriPelatihan()
    {
        $this->db->select('*');
        $this->db->from('pelatihan');
        $this->db->join('kategori', 'kategori.id_kategori = pelatihan.id_kategori');
        $result = $this->db->get();
        return $result;
    }

    public function kategoriPelatihanId($id)
    {
        $this->db->select('*');
        $this->db->from('pelatihan');
        $this->db->join('kategori', 'kategori.id_kategori = pelatihan.id_kategori');
        $this->db->where('pelatihan.id_pel', $id);
        $query = $this->db->get();

        return $query->row();
    }

    public function tambahKategori($kategori)
    {
        return $this->db->insert('kategori', $kategori);
    }

    public function tambahPelatihan($data)
    {
        return $this->db->insert('pelatihan', $data);
    }


    public function getJumlahPelatihan()
    {
        $this->queryPelatihanAll();
        return $this->db->get()->num_rows();
    }

    public function editKategori($kategori, $id)
    {
        $this->db->set($kategori);
        $this->db->where('id_kategori', $id);
        return $this->db->update('kategori');
    }
    public function editPelatihan($data, $id_pel)
    {
        $this->db->set($data);
        $this->db->where('id_pel', $id_pel);
        return $this->db->update('pelatihan');
    }
    public function hapusPelatihan($id)
    {
        $this->db->delete('pelatihan', array('id_pel' => $id));
    }






    // FUNCTION TOOLS

    public function cekKategori($id_kategori = null, $inisial = null)
    {
        if ($id_kategori === null && $inisial != null) {
            $this->queryKategoriIN($inisial);
            $result = $this->db->get()->num_rows();
            $code = 200;
        } elseif ($id_kategori != null && $inisial === null) {
            $this->queryKategoriID($id_kategori);
            $result = $this->db->get()->num_rows();
            $code = 200;
        } else {
            $result = 'inputan salah';
            $code = 200;
        }
        return [
            'code' => $code,
            'success' => true,
            'result' => $result
        ];
    }

    public function getInisial($id_pel)
    {
        $this->db->select('inisial')
            ->from($this->tableB)
            ->join($this->tableA, 'pelatihan.id_kategori = kategori.id_kategori')
            ->where(['pelatihan.id_pel' => $id_pel]);
        return $this->db->get()->row_array();
    }
    // PRIVATE QUERY

    private function queryKategoriAll()
    {
        $this->db->select('*')->from($this->tableB);
    }

    private function queryKategoriID($id_kategori)
    {
        $this->queryKategoriAll();
        $this->db->where(['id_kategori' => $id_kategori]);
    }
    private function queryKategoriIN($inisial)
    {
        $this->queryKategoriAll();
        $this->db->where(['inisial' => $inisial]);
    }

    // ----- query get pelatihan -----

    private function  queryGetPelatihan($id_kategori, $tipe, $id_pel)
    {
        if ($id_kategori != null && $tipe != null) {
            $this->queryPelatihanTipe($id_kategori, $tipe);
        } elseif ($id_kategori != null && $tipe == null && $id_pel == null) {
            $this->queryPelatihan($id_kategori);
        } elseif ($id_pel != null && $id_kategori == null && $tipe == null) {
            $this->queryGetPelatihanID($id_pel);
        } else {
            $this->queryPelatihanAll();
        }
    }

    private function queryPelatihanAll()
    {
        $this->db->select('*')->from($this->tableA);
    }

    private function queryPelatihan($id_kategori)
    {
        $this->queryPelatihanAll();
        $this->db->where(['id_kategori' => $id_kategori]);
    }

    private function queryGetPelatihanID($id_pel)
    {
        $this->queryPelatihanAll();
        $this->db->where(['id_pel' => $id_pel]);
    }

    private function queryPelatihanTipe($id_kategori, $tipe)
    {
        $this->queryPelatihan($id_kategori);
        $this->db->where(['tipe' => $tipe]);
    }
}
