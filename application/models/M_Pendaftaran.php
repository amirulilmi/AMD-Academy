<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Pendaftaran extends CI_Model
{
    private $t_users = 'users';
    private $t_member = 'member';
    private $t_pendaftar = 'pelatihan_pendaftar';
    private $tableD = 'order';
    private $tableE = 'sertifikat';
    private $role = 'user_groups';
    private $s_id_pel = 'id_pel';
    private $s_id_biaya = 'id_biaya';

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('c_helper');
    }
    // function tools

    private function getRole($nama_role)
    {
        $this->db->select('*')
            ->from($this->role)
            ->where(['group' => $nama_role]);
        return $this->db->get()->row_array();
    }

    public function cekIdOrder($id_order)
    {
        $this->db->select('id_order')
            ->from($this->tableD)
            ->where(['id_order' => $id_order]);
        return $this->db->get()->num_rows();
    }

    public function cekTelp($no_hp)
    {
        $this->db->select('nomor_hp')
            ->from($this->t_member)
            ->where(['nomor_hp' => $no_hp]);
        return $this->db->get()->num_rows();
    }

    public function getPeserta($id_member = null, $no_hp = null)
    {
        if ($id_member != null && $no_hp == null) {
            $code = 200;
            $this->queryPesertaID($id_member);
            $result = $this->db->get()->row_array();
        } elseif ($id_member == null && $no_hp != null) {
            $code = 200;
            $this->queryPesertaHP($no_hp);
            $result = $this->db->get()->row_array();
        } elseif ($id_member == null && $no_hp == null) {
            $code = 200;
            $this->queryPesertaAll();
            $result = $this->db->get()->result_array();
        } else {
            $code = 200;
            $result = 'Inputan salah';
        }
        return [
            'code' => $code,
            'success' => true,
            'result' => $result
        ];
    }

    // Buat kebutuhan spesifik
    private function customQueryPendaftaran($select, $from, $where = null)
    {
        $this->db->select($select)
            ->from($from);
        if ($where != null) {
            $this->db->where($where);
        }
        return $this->db->get();
    }

    //BUAT NGATUR BUTTON KIRIM WA
    public function getIdOrderPeserta($id_user)
    {
        $query = $this->customQueryPendaftaran('id_order', $this->t_pendaftar, ['id_user' => $id_user]);
        return $query->result_array();
    }

    public function getJumlahOrderSukses($id_order)
    {
        $query = $this->customQueryPendaftaran('status_code', $this->tableD, ['id_order' => $id_order, 'status_code' => 200]);
        return $query->num_rows();
    }
    // END


    //MAIN FUNCTION

    public function postPendaftaran($param = null, $id_order = null, $jumlah_org_lain = null)
    {
        $this->db->trans_start();
        $this->postIdOrder($id_order, $param['total'], $param['jenis']);
        $id_user_pj = $this->postPendaftaranSendiri($param, $id_order);
        if ($jumlah_org_lain > 0) {
            foreach ($param['no_hp_lain'] as $no_hp) {
                $no_hp = "62" . $no_hp;
                $this->postPendaftaranOrgLain($no_hp, $id_order);
            }
        }

        $data = [
            'id_user_pj' => $id_user_pj
        ];

        $this->db->where(['id_order' => $id_order])->update('order', $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return [
                'success' => false,
                'message' => 'Gagal ketika menambahkan data ke databse'
            ];
        } else {
            $this->db->trans_complete();
            return [
                'success' => true,
                'message' => 'Berhasil menambahkan data'
            ];
        }
    }

    public function getPendaftaran($id_user = null, $id_order = null)
    {
        $this->querygetPendaftaran($id_user);
        if ($id_order != null) {
            $this->db->where(['pelatihan_pendaftar.order_id' => $id_order]);
        }
        $result = $this->db->get()->result_array();
        return [
            'code' => 200,
            'success' => true,
            'result' => $result
        ];
    }

    public function getJumlahPendaftaran($id_user = null)
    {
        $this->querygetPendaftaran($id_user);
        $result = $this->db->get()->num_rows();
        return [
            'code' => 200,
            'success' => true,
            'result' => $result
        ];
    }

    public function getJumlahPendaftaran2($id_user = null)
    {

        $result = $this->db->get_where('pelatihan_pendaftar', ['user_id' => $id_user])->num_rows();
        return [
            'code' => 200,
            'success' => true,
            'result' => $result
        ];
    }

    public function putOrder($result, $tipe)
    {
        $this->db->trans_start();
        switch ($tipe) {
            case 'manual':
                $dataOrder = [
                    'status_code' => $result['status_code'],
                    'bukti' => trim($result['bukti'])
                    // 'gross_amount' => $result['gross_amount']
                ];
                break;
            case 'midtrans':
                // if (array_key_exists("settlement_time", $result)) {
                //     $date =  date("d/M/Y H:i:s", strtotime($result['settlement_time']));
                // } else {
                //     $date = date("Y-m-d H:i:s");
                // }
                $dataOrder = [
                    'status_code' => $result['status_code'],
                    'gross_amount' => $result['gross_amount'],
                    // 'time' => $result['settlement_time']
                ];
                break;

            default:
                return [
                    'success' => false,
                    'message' => 'Gagal '
                ];
                break;
        }

        $this->db->where(['id_order' => $result['order_id']])
            ->update($this->tableD, $dataOrder);

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

    //FUNCTION PAKE API WA

    public function postWA($param)
    {
        $api_key = 'e1a87e27-d6fc-49f6-b043-10ec7bc5403c';
        $text = "*Selamat*\n Anda telah terdaftar mengikuti pelatihan di AMD Academy. \n Berikut adalah username dan password akun anda : \n *Username : " . $param['username'] . "* \n *Password : " . $param['username'] . "* \n\n *Perhatian !* \n Apabila sebelumnya anda telah memiliki akun, password anda sama seperti password sebelumnya. ";
        // $headers = array('Content-Type: application/json; charset=UTF-8',);
        $method = 'POST';
        $url = 'http://api.dripsender.id/send';
        $data = [
            'api_key' => $api_key,
            'phone' => $param['no_hp'],
            'text' => $text
        ];
        $jsonData = json_encode($data);

        return callAPI($method, $url, $jsonData, $headers = false)['status'];
    }


    public function getIdUserOrder($id_order)
    {
        $this->db->select('user_id')
            ->from($this->t_pendaftar)
            ->where(['order_id' => $id_order]);
        return $this->db->get()->result_array();
    }

    private function getIdSertif($id_user)
    {
        $this->db->select('id_sertif')
            ->from($this->tableE)
            ->where(['id_user' => $id_user]);
        return $this->db->get()->row_array();
    }






    // FUNCTION PRIVATE
    private function postIdOrder($id_order, $total, $jenis)
    {
        $dataIdOrder = [
            'id_order' => $id_order,
            'jenis' => $jenis,
            'status_code' => 000,
            'gross_amount' => $total
        ];
        $this->db->insert($this->tableD, $dataIdOrder);
    }

    private function postPendaftaranSendiri($param, $id_order)
    {

        // $idRoleAdmin = $this->getRole('admin')['id'];
        $idRolePeserta = $this->getRole('peserta')['id'];
        $default_profile = default_profil();

        if ($this->cekTelp($param['no_hp']) == 0) {
            $dataUserUtama = [
                'username' => $param['no_hp'],
                'password' => hash('sha256', $param['no_hp']),
                'name' => $param['nama'],
                'email' => $param['email'],
                'user_group_id' => $idRolePeserta,
                'gambar' => $default_profile
            ];
            $this->db->insert($this->t_users, $dataUserUtama);
            $last_id_user_utama = $this->db->insert_id();

            $dataPesertaUtama = [
                'user_id' => $last_id_user_utama,
                'kode_member' => kodeMember($this->lastIDMember()['id'] + 1),
                'nama' => $param['nama'],
                'email' => $param['email'],
                'nomor_hp' => $param['no_hp'],
                'instansi' => $param['instansi'],
                'alamat' => $param['alamat'],
                'jenis_kelamin' => $param['jenis_kelamin'],
                // 'status_pendaftaran' => 'Peserta',
                'tempat_lahir' => $param['tempat_lahir'],
                'tanggal_lahir' => $param['tgl_lahir'],
                'provinsi_id' => $param['provinsi_id'],
                'kabupaten_id' => $param['kabupaten_id'],
                'kecamatan_id' => $param['kecamatan_id'],
                'pendidikan_id' => $param['pendidikan_id'],
                'pekerjaan_id' => $param['pekerjaan_id'],

            ];
            $this->db->insert($this->t_member, $dataPesertaUtama);
            $last_id_member = $this->db->insert_id();
        } else {
            $last_id_user_utama = $this->getPeserta(null, $param['no_hp'])['result']['user_id'];
            $last_id_member = $this->getPeserta(null, $param['no_hp'])['result']['id'];
        }

        $dataSertifUtama = [
            'member_id' => $last_id_member,
            'pelatihan_id' => $this->session->userdata($this->s_id_pel),
            // 'id_user' => $last_id_user_utama,
            'nama_sertif' => '{"bnsp":"","amd":""}',
            'link' => '{"bnsp":"","amd":""}'
        ];
        $this->db->insert($this->tableE, $dataSertifUtama);
        $last_id_sertif = $this->db->insert_id();
        $dataPendaftaranUtama = [
            'pelatihan_id' => $this->session->userdata($this->s_id_pel),
            'member_id' => $last_id_member,
            'order_id' => $id_order,
            'user_id' => $last_id_user_utama,
            'pelatihan_harga_id' => $this->session->userdata($this->s_id_biaya),
            'kode_pendaftaran' => $this->randomID(),
            'sertif_id' => $last_id_sertif,

        ];
        $this->db->insert($this->t_pendaftar, $dataPendaftaranUtama);
        return $last_id_user_utama;
    }

    private function postPendaftaranOrgLain($no_hp, $id_order)
    {

        // $idRoleAdmin = $this->getRole('admin')['id'];
        $idRolePeserta = $this->getRole('peserta')['id'];
        $default_profile = default_profil();
        if ($this->cekTelp($no_hp) == 0) {
            $dataUser = [
                'username' => $no_hp,
                'email' => $no_hp . '@amdacademy.id',
                'password' => hash('sha256', $no_hp),
                'user_group_id' => $idRolePeserta,
                'gambar' => $default_profile

            ];
            $this->db->insert($this->t_users, $dataUser);
            $last_id_user = $this->db->insert_id();
            # code...
            $dataPeserta = [
                'user_id' => $last_id_user,
                'kode_member' => kodeMember($this->lastIDMember()['id'] + 1),
                'nomor_hp' => $no_hp,
            ];
            $this->db->insert($this->t_member, $dataPeserta);
            $last_id_member = $this->db->insert_id();
        } else {
            $last_id_user = $this->getPeserta(null, $no_hp)['result']['user_id'];
            $last_id_member = $this->getPeserta(null, $no_hp)['result']['id'];
        }
        $dataSertifUtama = [
            'member_id' => $last_id_member,
            'pelatihan_id' => $this->session->userdata($this->s_id_pel),
            // 'users_id' => $last_id_user,
            'nama_sertif' => '{"bnsp":"","amd":""}',
            'link' => '{"bnsp":"","amd":""}'

        ];
        $this->db->insert($this->tableE, $dataSertifUtama);
        $last_id_sertif = $this->db->insert_id();

        $dataPendaftaran = [
            'pelatihan_id' => $this->session->userdata($this->s_id_pel),
            'member_id' => $last_id_member,
            'order_id' => $id_order,
            'user_id' => $last_id_user,
            'pelatihan_harga_id' => $this->session->userdata($this->s_id_biaya),
            'kode_pendaftaran' => $this->randomID(),
            'sertif_id' => $last_id_sertif,

        ];
        $this->db->insert($this->t_pendaftar, $dataPendaftaran);
    }

    private function querygetPendaftaran($id_user = null)
    {
        if ($id_user != null) {
            $this->queryPendaftaran($id_user);
        } else {
            $this->queryAllPendaftaran();
        }
        $this->db->join('pelatihan', 'pelatihan.id =  pelatihan_pendaftar.pelatihan_id');
        $this->db->join('kategori', 'kategori.id =  pelatihan.pelatihan_kategori_id');
        $this->db->where(['pelatihan.status' => '1']);
    }

    private function queryAllPendaftaran()
    {
        $this->db->select('*')
            ->from($this->t_pendaftar);
    }

    private function queryPendaftaran($id_user)
    {
        $this->queryAllPendaftaran();
        $this->db->where(['pelatihan_pendaftar.user_id' => $id_user]);
    }

    private function queryJoin()
    {
        // $this->db->join($this->t_member, 'pendaftaran.id_peserta = peserta.id_peserta');
        $this->db->join($this->t_users, 'pendaftaran.id_pel = pelatihan.id_pel');
    }

    private function queryPesertaAll()
    {
        $this->db->select('*')
            ->from($this->t_member);
    }

    private function queryPesertaHP($no_hp)
    {
        $this->queryPesertaAll();
        $this->db->where(['nomor_hp' => $no_hp]);
    }

    private function queryPesertaID($id_member)
    {
        $this->queryPesertaAll();
        $this->db->where(['id' => $id_member]);
    }

    public function lastIDMember()
    {
        $this->db->select_max('id');
        return $this->db->get('member')->row_array();
    }

    private function randomID()
    {
        $code = time() + rand(1, 9);
        if ($this->cekKodePendaftaran($code) != 0) {
            $code = $code + rand(1, 8);
        }
        return $code;
    }

    private function cekKodePendaftaran($code)
    {
        $this->db->select('kode_pendaftaran')
            ->from($this->t_pendaftar)
            ->where(['kode_pendaftaran' => $code]);
        return $this->db->get()->num_rows();
    }

    public function getPesertaByIdUser($id_user)
    {
        $this->db->select('*')
            ->from($this->t_member)
            ->where(['user_id' => $id_user]);
        return $this->db->get()->row_array();
    }

    // public function getUser
}
