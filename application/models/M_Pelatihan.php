<?php

use function PHPUnit\Framework\returnSelf;

defined('BASEPATH') or exit('No direct script access allowed');

class M_Pelatihan extends CI_Model
{
    private $tableA = 'pelatihan_harga';
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

    private function countPelatihan()
    {

        $data =  $this->db->get('pelatihan')->num_rows();

        if ($data >= 6) {

            $data = $data - 6;
        } else {
            $data = 0;
        }
        //    print_r($dataa);exit;
        //    print_r($data);exit;
        return $data;
    }

    public function getPelatihan2()
    {
        $count = $this->countPelatihan();
        // print_r($count);exit;

        $this->db->select(['*', 'pelatihan.id as id_pel']);
        $this->db->from('pelatihan');
        $this->db->join('kategori', 'kategori.id = pelatihan.pelatihan_kategori_id');
        $this->db->join('pelatihan_harga', 'pelatihan_harga.pelatihan_id = pelatihan.id', 'LEFT')
        ->where(['pelatihan.status' => 1])
        ->where(['pelatihan_harga.jenis' => 'Personal']);

        // $this->db->where('user.id_user = admin.id_user');
        $data = $this->db->get('', 6, $count)->result_array();

        return $data;
    }
    public function getPelatihan3()
    {
        return $this->db->get('pelatihan')->result_array();
    }

    public function getPelatihanBy($id = null)
    {
        if ($id != null) {
            // return $this->db->get_where('pelatihan', ['pelatihan_kategori_id' => $id])->result_array();

            $this->db->select(['*', 'pelatihan.id as id_pel'])
                ->from('pelatihan')
                ->join('kategori', 'kategori.id = pelatihan.pelatihan_kategori_id ')
                ->join('pelatihan_harga', 'pelatihan_harga.pelatihan_id = pelatihan.id ')
                ->where(['kategori.id' => $id])
                ->where(['pelatihan.status' => 1])
                ->where(['pelatihan_harga.jenis' => 'Personal']);
            // ->where(['pelatihan_harga.jenis_harga'=>'Online']);
            return $this->db->get()->result_array();
        } else {
            redirect(base_url('AMDA'));
        }
    }
    public function getPelatihanFUll($id_pelatihan)
    {
        $data = $this->db->get_where('pelatihan', ['id' => $id_pelatihan])->row_array();
        $data['kurikulum'] = $this->getKurikulum($id_pelatihan);
        $data['materi'] = $this->getMateri($id_pelatihan);
        return $data;
    }
    public function getKategoriFUll($id)
    {
        $id = $this->db->get_where('pelatihan', ['id' => $id])->row_array();
        // print_r($id);exit;
        $id = $id['pelatihan_kategori_id'];
        return $this->db->get_where('kategori', ['id' => $id])->row_array();
    }

    private function getKurikulum($id_pelatihan)
    {
        $this->db->where('pelatihan_id', $id_pelatihan);
        $this->db->where('status', 1);
        return $this->db->get('pelatihan_kurikulum')->result_array();

        // return $this->db->get_where('pelatihan_kurikulum', ['pelatihan_id' => $id_pelatihan])->result_array();
    }
    private function getMateri($id_pelatihan)
    {

        $this->db->where('pelatihan_id', $id_pelatihan);
        $this->db->where('status', 1);
        return $this->db->get('pelatihan_materi')->result_array();

        // return $this->db->get_where('pelatihan_materi', ['pelatihan_id' => $id_pelatihan])->result_array();
    }

    public function getPelatihanTrainer($id)
    {
        $this->db->select('*')
            ->from('pelatihan_trainer')
            ->join('trainer', 'trainer.id = pelatihan_trainer.trainer_id ')
            ->where(['pelatihan_trainer.pelatihan_id' => $id]);
        return $this->db->get()->result_array();
    }
    public function getTrainerBy($trainer_id)
    {
        return $this->db->get_where('trainer', ['id' => $trainer_id])->result_array();
    }

    public function getPendaftar()
    {
        return $this->db->get('member')->result_array();
    }
    public function getPeserta()
    {
        // $this->db->select('*');
        // $this->db->from('pelatihan_pendaftar');
        // $this->db->join('member', 'member.id = pelatihan_pendaftar.member_id');
        // $this->db->join('pelatihan', 'pelatihan.id = pelatihan_pendaftar.pelatihan_id');
        // return $this->db->get()->result_array();

        $this->db->select('*')
            ->from('pelatihan_pendaftar')
            ->join('member', 'member.id = pelatihan_pendaftar.member_id')
            ->join('pelatihan', 'pelatihan.id = pelatihan_pendaftar.pelatihan_id')
            ->where(['pelatihan_pendaftar.status_pendaftaran' => 'Valid']);
        return $this->db->get()->result_array();
    }
    public function getPesertaWhere($id)
    {
        $this->db->select('*')
            ->from('pelatihan_pendaftar')
            ->join('member', 'member.id = pelatihan_pendaftar.member_id')
            ->join('pelatihan', 'pelatihan.id = pelatihan_pendaftar.pelatihan_id')
            ->where(['pelatihan_pendaftar.pelatihan_id' => $id])
            ->where(['pelatihan_pendaftar.status_pendaftaran' => 'Valid']);
        return $this->db->get()->result_array();
    }
    public function cekPelatihan($id_pelatihan)
    {
        return $this->db->get_where('pelatihan_pendaftar', ['pelatihan_id' => $id_pelatihan])->num_rows();
    }
    public function cekPelatihan2($id_pelatihan)
    {
        return $this->db->get_where('pelatihan', ['id' => $id_pelatihan])->num_rows();
    }

    public function getKategoriNav()
    {
        return $this->db->get_where('kategori', ['status' => 1])->result_array();
    }
    public function getKategoriBy($id_kategori)
    {
        return $this->db->get_where('kategori', ['id' => $id_kategori])->row_array();
    }






    // private function getHargaOff($id_pelatihan){
    //     $data = $this->db->get_where('pelatihan_harga',['pelatihan_id'=> $id_pelatihan])->result_array();
    //     $data = $d
    // }
    // private function getHargaOn($id_pelatihan){
    //     return $this->db->get_where('pelatihan_harga',['pelatihan_id'=> $id_pelatihan])->result_array();
    // }



    // public function getKurikulum($id_pelatihan = null)
    // {
    //     if ($id_pelatihan != null) {
    //         return $this->db->get_where('pelatihan_kurikulum', ['pelatihan_id' => $id_pelatihan])->result_array();
    //     } else {
    //         $this->db->select('*')
    //             ->from('pelatihan_kurikulum');
    //         return $this->db->get()->result_array();
    //     }
    // }




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
        $this->db->select(['*', 'kategori.id as id_kategori', 'pelatihan.id as id_pelatihan']);
        $this->db->from('pelatihan');
        $this->db->join('kategori', 'kategori.id = pelatihan.pelatihan_kategori_id');
        $this->db->join('pelatihan_harga', 'pelatihan.id = pelatihan_harga.pelatihan_id');

        $result = $this->db->get();
        return $result;
    }

    public function kategoriPelatihanId($id)
    {
        $this->db->select(['*', 'kategori.id as id_kategori', 'pelatihan.id as id_pelatihan']);
        $this->db->from('pelatihan');
        $this->db->join('kategori', 'kategori.id = pelatihan.pelatihan_kategori_id');
        $this->db->where(['pelatihan.id' => $id]);
        $query = $this->db->get();

        return $query->row();
    }

    // public function tambahKategori($kategori)
    // {
    //     return $this->db->insert('kategori', $kategori);
    // }

    public function tambahPelatihan($param)
    {
        $data = [
            'nama_pelatihan' => $param('nama'),
            'pelatihan_kategori_id' => $param('nama_pelatihan'),
            'tipe' => $param('tipe'),
            'tanggal_mulai' => $param('start'),
            'tanggal_selesai' => $param('end'),
            'tanggal_mulai_pendaftaran' => $param('start_daftar'),
            'tanggal_selesai_pendaftaran' => $param('end_daftar'),
            'deskripsi' => $param('deskripsi'),
            'kontak' => $param('kontak'),
            'tempat' => $param('lokasi'),
            'status' => $param('status'),
            'gambar' => (string)$param('url_gambar'),
        ];
        return $this->db->insert('pelatihan', $data);
    }


    public function getJumlahPelatihan()
    {
        $this->db->select('id')
            ->from('pelatihan');
        return $this->db->get()->num_rows();
    }

    public function editPelatihan($param)
    {
        $data = [
            'nama_pelatihan' => $param('nama'),
            'pelatihan_kategori_id' => $param('nama_pelatihan'),
            'tipe' => $param('tipe'),
            'biaya' => $param('harga'),
            'tanggal_mulai' => $param('start'),
            'tanggal_selesai' => $param('end'),
            'tanggal_mulai_pendaftaran' => $param('start_daftar'),
            'tanggal_selesai_pendaftaran' => $param('end_daftar'),
            'deskripsi' => $param('deskripsi'),
            'kontak' => $param('kontak'),
            'tempat' => $param('lokasi'),
            'status' => $param('status'),
            'gambar' => (string)$param('url_gambar'),
        ];
        $this->db->from('pelatihan');
        $this->db->where('id', $param['i']);
        return $this->db->update('pelatihan', $data);
        // $this->db->set($data);
        // $this->db->where('id', $id_pel);
        // return $this->db->update('pelatihan');
    }
    public function hapusPelatihan($id)
    {
        $this->db->delete('pelatihan', array('id' => $id));
    }


    // FUNCTION TOOLS
    public function cekIDPel($id_pelatihan)
    {
        $this->db->select('id')
            ->from('pelatihan')
            ->where(['id' => $id_pelatihan]);
        return $this->db->get()->num_rows();
    }


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
        $this->db->where(['pelatihan_id' => $id_kategori]);
    }

    private function queryGetPelatihanID($id_pel)
    {
        // $this->queryPelatihanAll();
        // $this->db->where(['pelatihan_id' => $id_pel]);
    }

    private function queryPelatihanTipe($id_kategori, $tipe)
    {
        $this->queryPelatihan($id_kategori);
        $this->db->where(['jenis_harga' => $tipe]);
    }

    // CRUD PELATIHAN KATEGORI
    public function getPelatihanKategori()
    {
        $this->db->select('*');
        $this->db->from('kategori');
        $result = $this->db->get();
        return $result;
    }

    public function KategoriPelatihan($id_kategori)
    {
        $this->db->select('*');
        $this->db->from('pelatihan');
        // $this->db->join('kategori', 'kategori.id = pelatihan.pelatihan_kategori_id');
        $this->db->where('pelatihan.pelatihan_kategori_id', $id_kategori);
        $result = $this->db->get();
        return $result;
    }
    
    public function PelatihanKategoriId($id)
    {
        $this->db->select('*');
        $this->db->from('kategori');
        $this->db->where('kategori.id', $id);
        $query = $this->db->get();

        return $query->row();
    }
    public function tambahKategori($data)
    {
        return $this->db->insert('kategori', $data);
    }
    public function editKategori($data, $id)
    {
        $this->db->set($data);
        $this->db->where('id', $id);
        return $this->db->update('kategori');
    }
    public function hapusKategori($id)
    {
        $this->db->delete('kategori', array('id' => $id));
    }


    // CRUD PELATIHAN KURIKULUM

    public function getPelatihanKurikulum($id_pelatihan = null, $id_kurikulum = null)
    {
        $this->db->select('*')
            ->from('pelatihan_kurikulum');
        if ($id_pelatihan != null) {
            $this->db->where(['pelatihan_id' => $id_pelatihan]);
        }

        if ($id_kurikulum != null) {
            $this->db->where(['id' => $id_kurikulum]);
        }
        return $this->db->get();
    }

    public function postPelatihanKurikulum($param)
    {
        $data = [
            'pelatihan_id' => $param['ip'],
            'kurikulum' => $param['kurikulum'],
            'deskripsi' => $param['deskripsi'],
            'status' => $param['status']
        ];
        $this->db->insert('pelatihan_kurikulum', $data);
        return [
            'success' => true
        ];
    }

    public function deletePelatihanKurikulum($id_kurikulum)
    {
        $this->db->from('pelatihan_kurikulum');
        $this->db->where('id', $id_kurikulum);
        $this->db->delete('pelatihan_kurikulum');
        return [
            'success' => true
        ];
    }

    public function putPelatihanKurikulum($param)
    {
        $data = [
            'pelatihan_id' => $param['ip'],
            'kurikulum' => $param['kurikulum'],
            'deskripsi' => $param['deskripsi'],
            'status' => $param['status']
        ];
        $this->db->from('pelatihan_kurikulum');
        $this->db->where('id', $param['i']);
        $this->db->update('pelatihan_kurikulum', $data);
        return [
            'success' => true
        ];
    }

    //GET PELATIHAN DAFTAR
    public function getPelatihanWithID($id)
    {
        $this->db->select('*')
            ->from('pelatihan')
            ->where(['id' => $id]);
        return $this->db->get()->row_array();
    }
}
