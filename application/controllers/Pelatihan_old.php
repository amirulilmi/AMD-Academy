<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelatihan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_User', 'user');
        $this->load->helper('c_helper');
        $this->load->model('M_Pelatihan', 'm_pelatihan');
        $this->load->model('M_Sidebar', 'm_sidebar');
        $this->load->model('M_Auth', 'm_auth');

        if ($this->session->userdata('id_user') == null) {
            redirect('auth');
        }
        $user = $this->m_auth->getCurrentUser();
        if ($user['role_id'] != $this->m_auth->getIDRole('admin')['id_role']) {
            redirect('dashboard');
        }

        if ($this->m_auth->cekUserAktif($this->session->userdata('id_user')) == 0) {
            $this->session->unset_userdata('id_user');
            redirect('auth');
        }
    }

    public function index()
    {
        //data sidebar & navbar || start
        $id_role = $this->session->userdata('role_id');
        $menu = $this->m_sidebar->getSidebarMenu($id_role);
        $user = $this->m_auth->getCurrentUser();
        // print_r($this->m_auth->getIDRole('peserta'));
        // die;

        $data_kategori = $this->m_pelatihan->kategori();
        $data['kategori'] = $data_kategori;

        $data['title'] = 'Dashboard';
        $data['url'] = 'pelatihan';
        $data['sub_title'] = 'Pelatihan AMD Academy';
        $data['menu'] = $menu;
        $data['user'] = $user;

        // data sidebar & navbar || end

        // $data['user'] = $this->db->get_where('
        // $data_pelatihan = $this->p->getKategori(null, null);
        // $data['pelatihan'] = $data_pelatihan;
        viewAdmin($this, 'admin/inputPel', $data);
    }

    public function dataPelatihan()
    {
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $query = $this->m_pelatihan->getKategoriPelatihan();
        // var_dump($tes);
        // die;
        $data = [];

        foreach ($query->result() as $key => $r) {
            // var_dump($r);
            // die;
            $data[] = array(
                'no' => $key + 1,
                'nama_pel' => $r->nama_kategori,
                'tipe' => $r->tipe,
                'harga' => 'Rp ' . number_format($r->harga, 0, '', '.'),
                'pot1' => 'Rp ' . number_format($r->pot1, 0, '', '.'),
                'pot2' => 'Rp ' . number_format($r->pot2, 0, '', '.'),
                'start' => date('j M Y', strtotime($r->start)),
                'end' => date('j M Y', strtotime($r->end)),
                'status' => $this->textStatus($r->is_active),
                'action' => '
                <a type="button" href="javascript:void(0)" onclick="editPelatihan(' . "'" . $r->id_pel . "'" . ')" class="btn btn-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                <a href="#" data-delete-url="' . site_url("pelatihan/hapus/" . $r->id_pel) . '" role="button" onclick="return deleteConfirm(this)" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>'
            );
        }
        $result = array(
            "draw" => $draw,
            "recordsTotal" => $query->num_rows(),
            "recordFiltered" => $query->num_rows(),
            "data" => $data
        );
        echo json_encode($result);
        exit();
    }

    public function hapus($id)
    {
        $this->m_pelatihan->hapusPelatihan($id);
        echo json_encode(['success' => true, 'message' => 'Data berhasil dihapus!']);
    }

    public function tambahPelatihan()
    {
        $this->_validation();
        $kategori = array(
            'nama_kategori' => $this->input->post('nama_pelatihan')
        );

        // $this->m_pelatihan->tambahKategori($kategori);

        $data = [
            'id_kategori' => $this->input->post('nama_pelatihan'),
            'tipe' => $this->input->post('tipe'),
            'harga' => $this->input->post('harga'),
            'pot1' => $this->input->post('pot1'),
            'pot2' => $this->input->post('pot2'),
            'start' => $this->input->post('start'),
            'end' => $this->input->post('end'),
            'is_active' => $this->input->post('status'),
        ];

        $this->m_pelatihan->tambahPelatihan($data);
        echo json_encode(['success' => true, 'message' => 'Data Berhasil Ditambahkan!']);
    }

    public function editPelatihan()
    {
        $this->_validation('edit');
        $id_pel = $this->input->post('id_pel');

        $kategori = array(
            'nama_kategori' => $this->input->post('nama_pelatihan'),
        );


        $data = [
            'id_kategori' => $this->input->post('nama_pelatihan'),
            'tipe' => $this->input->post('tipe'),
            'harga' => $this->input->post('harga'),
            'pot1' => $this->input->post('pot1'),
            'pot2' => $this->input->post('pot2'),
            'start' => $this->input->post('start'),
            'end' => $this->input->post('end'),
            'is_active' => $this->input->post('status'),
        ];

        // var_dump($data);
        // die;

        $this->m_pelatihan->editPelatihan($data, $id_pel);

        echo json_encode(['success' => true, 'message' => 'Data Berhasil Diperbarui!']);
    }

    public function edit($id)
    {
        $data = $this->m_pelatihan->kategoriPelatihanId($id);
        echo json_encode($data);
    }

    private function textStatus($status_code)
    {
        switch ($status_code) {
            case 1:
                return '<p>Aktif</p>';
                break;
            case 0:
                return '<p>Tidak Aktif</p>';
                break;
        }
    }

    private function _validation($edit = null)
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = true;

        if ($this->input->post('nama_pelatihan') == '') {
            $data['inputerror'][] = 'nama_pelatihan';
            $data['error_string'][] = 'Nama pelatihan harus diisi!';
            $data['status'] = false;
        }
        if ($this->input->post('tipe')  == '') {
            $data['inputerror'][] = 'tipe';
            $data['error_string'][] = 'Tipe pelatihan harus diisi!';
            $data['status'] = false;
        }
        if ($this->input->post('harga')  == '') {
            $data['inputerror'][] = 'harga';
            $data['error_string'][] = 'Harga pelatihan harus diisi!';
            $data['status'] = false;
        } elseif ($this->input->post('harga')  < 0) {
            $data['inputerror'][] = 'harga';
            $data['error_string'][] = 'Harga pelatihan tidak boleh negatif!';
            $data['status'] = false;
        } elseif (strlen((string)$this->input->post('harga')) > 12) {
            $data['inputerror'][] = 'harga';
            $data['error_string'][] = 'Harga pelatihan melebihi 12 digit!';
            $data['status'] = false;
        }
        if ($this->input->post('pot1')  < 0) {
            $data['inputerror'][] = 'pot1';
            $data['error_string'][] = 'Potongan untuk pendaftar 2 orang tidak boleh negatif!';
            $data['status'] = false;
        } elseif (strlen((string)$this->input->post('pot1')) > 12) {
            $data['inputerror'][] = 'pot1';
            $data['error_string'][] = 'Harga potongan 1 melebihi 12 digit!';
            $data['status'] = false;
        }
        if ($this->input->post('pot2')  < 0) {
            $data['inputerror'][] = 'pot2';
            $data['error_string'][] = 'Potongan untuk pendaftar 3 orang atau lebih tidak boleh negatif!';
            $data['status'] = false;
        } elseif (strlen((string)$this->input->post('pot2')) > 12) {
            $data['inputerror'][] = 'pot2';
            $data['error_string'][] = 'Harga potongan 2 melebihi 12 digit!';
            $data['status'] = false;
        }
        if ($this->input->post('start')  == '') {
            $data['inputerror'][] = 'start';
            $data['error_string'][] = 'Tanggal mulai harus diisi!';
            $data['status'] = false;
        } elseif ($edit === null) {
            if (strtotime($this->input->post('start') . '+ 1 days') < strtotime('now')) {
                $data['inputerror'][] = 'start';
                $data['error_string'][] = 'Tidak dapat memberikan waktu awal sebelum hari ini!';
                $data['status'] = false;
            }
            if (strtotime($this->input->post('end')) < strtotime('now')) {
                $data['inputerror'][] = 'end';
                $data['error_string'][] = 'Tidak dapat memberikan waktu akhir sebelum hari ini!';
                $data['status'] = false;
            }
        }


        if ($this->input->post('end')  == '') {
            $data['inputerror'][] = 'end';
            $data['error_string'][] = 'Tanggal berakhir harus diisi!';
            $data['status'] = false;
        } elseif ($this->input->post('end')  < $this->input->post('start')) {
            $data['inputerror'][] = 'end';
            $data['error_string'][] = 'Tidak dapat memberikan tanggal akhir sebelum tanggal mulai!';
            $data['status'] = false;
        } elseif ($edit === null) {
            if (strtotime($this->input->post('start') . '+ 1 days') < strtotime('now')) {
                $data['inputerror'][] = 'start';
                $data['error_string'][] = 'Tidak dapat memberikan waktu awal sebelum hari ini!';
                $data['status'] = false;
            }
            if (strtotime($this->input->post('end')) < strtotime('now')) {
                $data['inputerror'][] = 'end';
                $data['error_string'][] = 'Tidak dapat memberikan waktu akhir sebelum hari ini!';
                $data['status'] = false;
            }
        }
        if ($this->input->post('status')  == '') {
            $data['inputerror'][] = 'status';
            $data['error_string'][] = 'status pelatihan harus diisi!';
            $data['status'] = false;
        }

        if ($data['status'] === false) {
            echo json_encode($data);
            exit();
        }
    }
}
