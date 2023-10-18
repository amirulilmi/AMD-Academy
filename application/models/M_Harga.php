<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Harga extends CI_Model
{
    private $t_harga = 'pelatihan_harga';

    public function getPelatihanHarga($id_pel = null, $id_harga = null)
    {
        $this->db->select('*')
            ->from($this->t_harga);
        if ($id_pel !== null) {
            $this->db->where(['pelatihan_id' => $id_pel]);
        }
        if ($id_harga !== null) {
            $this->db->where(['id' => $id_harga]);
        }
        return $this->db->get();
    }

    public function postPelatihanHarga($param)
    {
        $data = [
            'pelatihan_id' => $param['ip'],
            'jenis' => $param['jenis'],
            'jenis_harga' => $param['jenis_harga'],
            'harga' => $param['harga'],
            'diskon' => $param['diskon'],
            'max_jumlah_daftar' => $param['max_jumlah_daftar'],
            'min_jumlah_daftar' => $param['min_jumlah_daftar'],
            'fasilitas' => '[{"fasilitas": "Pelatihan"}, {"fasilitas": "Sertifikat"}, {"fasilitas": "Mentoring"}]',
            'keterangan' => $param['keterangan'],
            'is_active' => $param['status']
        ];
        $this->db->insert('pelatihan_harga', $data);
        return [
            'success' => true
        ];
    }

    public function deletePelatihanHarga($id_harga)
    {
        $this->db->from('pelatihan_harga');
        $this->db->where('id', $id_harga);
        $this->db->delete('pelatihan_harga');
        return [
            'success' => true
        ];
    }

    public function putPelatihanHarga($param)
    {
        $data = [
            'pelatihan_id' => $param['ip'],
            'jenis' => $param['jenis'],
            'jenis_harga' => $param['jenis_harga'],
            'harga' => $param['harga'],
            'diskon' => $param['diskon'],
            'max_jumlah_daftar' => $param['max_jumlah_daftar'],
            'min_jumlah_daftar' => $param['min_jumlah_daftar'],
            // 'fasilitas' => '[{"fasilitas": "Pelatihan"}, {"fasilitas": "Sertifikat"}, {"fasilitas": "Mentoring"}]',
            'keterangan' => $param['keterangan'],
            'is_active' => $param['status']
        ];
        $this->db->from('pelatihan_harga');
        $this->db->where('id', $param['i']);
        $this->db->update('pelatihan_harga', $data);
        return [
            'success' => true
        ];
    }

    public function putFasilitas($param)
    {
        $data = [
            'fasilitas' => $param['fasilitas']
        ];
        $this->db->from('pelatihan_harga');
        $this->db->where('id', $param['id']);
        $this->db->update('pelatihan_harga', $data);
        return [
            'success' => true
        ];
    }
}
