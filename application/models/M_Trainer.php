<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Trainer extends CI_Model
{
    private $pel_trainer = 'pelatihan_trainer';
    private $trainer = 'trainer';


    public function getTrainer($id_pelatihan = null, $id_trainer = null)
    {
        if ($id_pelatihan == null) {
            $this->queryTrainerAllKategori();
        } else {
            $this->queryTrainerKategori($id_pelatihan);
        }

        if ($id_trainer != null) {
            $this->db->where(['id' => $id_trainer]);
        }

        $result = $this->db->get()->result_array();
        return [
            'code' => 200,
            'success' => true,
            'result' => $result
        ];
    }

    public function getTrainerPelatihan($id_pelatihan = null, $id_trainer = null)
    {

        if ($id_pelatihan == null) {
            $this->db->select(['*', 'trainer.id as id_trainer', 'pelatihan_trainer.id as id_pel_trainer'])
                ->from($this->pel_trainer)
                ->join($this->trainer, "$this->pel_trainer.trainer_id = $this->trainer.id");
        } else {
            $this->db->select(['*', 'trainer.id as id_trainer', 'pelatihan_trainer.id as id_pel_trainer'])
                ->from($this->pel_trainer)
                ->join($this->trainer, "$this->pel_trainer.trainer_id = $this->trainer.id");
            $this->db->where(['pelatihan_id' => $id_pelatihan]);
        }

        if ($id_trainer != null) {
            $this->db->where(['id' => $id_trainer]);
        }

        $result = $this->db->get()->result_array();
        return [
            'code' => 200,
            'success' => true,
            'result' => $result
        ];
    }

    public function cekUniqueHp($no_hp)
    {
        $this->db->select('nomor_hp')
            ->from('trainer')
            ->where(['nomor_hp' => $no_hp]);
        return $this->db->get()->num_rows();
    }
    public function cekUniqueEmail($email)
    {
        $this->db->select('email')
            ->from('trainer')
            ->where(['email' => $email]);
        return $this->db->get()->num_rows();
    }

    public function cekPostPT($id_pel, $id_trainer)
    {
        $this->db->select('pelatihan_id')
            ->from($this->pel_trainer)
            ->where([
                'pelatihan_id' => $id_pel,
                'trainer_id' => $id_trainer
            ]);
        return $this->db->get()->num_rows();
    }

    public function postPelatihanTrainer($param)
    {
        $data = [
            'pelatihan_id' => $param['ip'],
            'trainer_id' => $param['trainer']
        ];
        $this->db->insert('pelatihan_trainer', $data);
        return [
            'success' => true
        ];
    }

    public function deletePelatihanTrainer($id_trainer)
    {
        $this->db->from('pelatihan_trainer');
        $this->db->where('trainer_id', $id_trainer);
        $this->db->delete('pelatihan_trainer');
        return [
            'success' => true
        ];
    }


    // PRIVATE QUERY

    private function queryTrainerAllKategori()
    {
        $this->db->select(['*', 'trainer.id as id_trainer'])
            ->from($this->trainer);
        // ->join($this->trainer, "$this->pel_trainer.trainer_id = $this->trainer.id");
    }

    private function queryTrainerKategori($id_pelatihan)
    {
        $this->queryTrainerAllKategori();
        $this->db->where(['pelatihan_id' => $id_pelatihan]);
    }


    public function getData()
    {

        $this->db->from('trainer');
        $this->db->join('pelatihan_trainer', 'pelatihan_trainer.trainer_id = trainer.id');
        $this->db->join('kategori', 'kategori.id = pelatihan_trainer.id_kategori');


        $query = $this->db->get();
        return $query->result_array();
    }

    public function create($param)
    {

        $this->db->trans_start();
        $data = [
            'nama' => $param['nama'],
            'email' => $param['email'],
            'alamat' => $param['alamat'],
            'nomor_hp' => $param['telepon'],
            'bidang' => $param['bidang'],
            'profesi' => $param['profesi'],
            'jenis_kelamin' => $param['jk'],
            'tempat_lahir' => $param['lahir'],
            'tanggal_lahir' => $param['tgl_lahir'],
            'avatar' => $param['avatar'],
            'linkedin' => $param['linkedin'],
        ];
        $this->db->insert('trainer', $data);
        // $last_id_user = $this->db->insert_id();

        // $program = [
        //     'pelatihan_id' => $param['program'],
        //     'trainer_id' => $last_id_user,
        // ];

        // $this->db->insert('pelatihan_trainer', $program);
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
        };
    }

    public function getData_pelatihan()
    {
        $query = $this->db->select(['id', 'nama_pelatihan'])->get('pelatihan');

        return $query->result_array();
    }

    public function function_delete($id_trainer)
    {
        // $this->db->from('pelatihan_trainer');
        // $this->db->where('trainer_id', $id_trainer);
        // $cek = $this->db->delete('pelatihan_trainer');

        $this->db->from('trainer');
        $this->db->where('id', $id_trainer);
        $cek = $this->db->delete('trainer');

        return $cek;
    }
    public function getDataById($id_trainer)
    {


        return $this->db->get_where('trainer', ['id_trainer' => $id_trainer])->row();
    }
    public function getDataKategori($id_trainer)
    {

        return $this->db->get_where('kategori_trainer', ['id_trainer' => $id_trainer])->row();
    }

    public function proses_edit($base64, $id_trainer)
    {
        $this->db->trans_start();
        $param = $this->input->post();
        $data = [
            'nama' => $param['nama'],
            'email' => $param['email'],
            'alamat' => $param['alamat'],
            'nomor_hp' => $param['telepon'],
            'bidang' => $param['bidang'],
            'profesi' => $param['profesi'],
            'jenis_kelamin' => $param['jk'],
            'tempat_lahir' => $param['lahir'],
            'tanggal_lahir' => $param['tgl_lahir'],
            'avatar' => $base64,
            'linkedin' => $param['linkedin'],
        ];
        $this->db->from('trainer');
        $this->db->where('id', $id_trainer);
        $cek = $this->db->update('trainer', $data);
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
        };

        // $data = [
        //     'id_kategori' => $this->input->post('program'),
        // ];

        // // print_r($data);exit;
        // $this->db->from('kategori_trainer');
        // $this->db->where('id_trainer', $id_trainer);
        // $cek = $this->db->update('kategori_trainer', $data);


        return $cek;



        // $data2= [
        //     'id_kategori' =>$this->input->post('program'),
        // ];
        // $this->db->from('kategori_trainer');
        // $this->db->where('id_trainer', $id_trainer);
        // $this->db->update('kategori_trainer', $data2);
    }
}
