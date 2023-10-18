<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PelatihanKategori extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_User', 'user');
        $this->load->helper('c_helper');
        $this->load->model('M_Pelatihan', 'm_pelatihan');
        $this->load->model('M_Sidebar', 'm_sidebar');
        $this->load->model('M_Auth', 'm_auth');

        $user = $this->m_auth->getCurrentUser();
        if ($user['user_group_id'] != $this->m_auth->getIDRole('admin')['id']) {
            redirect('dashboard');
        }

        if ($this->session->has_userdata('id_user') == false) {
            redirect('auth');
        }

        if ($this->m_auth->cekUserAktif($this->session->userdata('id_user')) == 0) {
            $this->session->unset_userdata('id_user');
            redirect('auth');
        }
    }

    public function index()
    {
        //data sidebar & navbar || start

        $currentUser = $this->m_auth->getCurrentUser();
        $menu = $this->m_sidebar->getSidebarMenu($currentUser['user_group_id']);




        $data_kategori = $this->m_pelatihan->kategori();
        $data['kategori'] = $data_kategori;

        $data['title'] = 'Dashboard';
        $data['url'] = 'pelatihankategori';
        $data['sub_title'] = 'Kategori AMD Academy';
        $data['menu'] = $menu;
        $data['user'] = $currentUser;
        $data['idPeserta'] = $this->m_auth->getIDRole('Peserta')['id'];
        $data['idAdmin'] = $this->m_auth->getIDRole('Admin')['id'];

        // data sidebar & navbar || endf

        // $data['user'] = $this->db->get_where('
        // $data_pelatihan = $this->p->getKategori(null, null);
        // $data['pelatihan'] = $data_pelatihan;
        viewAdmin($this, 'admin/pelatihanKategori', $data);
    }

    public function dataPelatihanKategori()
    {
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $query = $this->m_pelatihan->getPelatihanKategori();
        // var_dump($query);
        // die;
        $data = [];

        foreach ($query->result() as $key => $r) {
            // var_dump($r);
            // die;
            $data[] = array(
                'no' => $key + 1,
                'nama_kat' => $r->kategori,
                'nama_pel' => substr($r->uraian, 0, 25) . ' ...',
                'create_at' => date('j M Y h:i:s', strtotime($r->created_at)),
                'update_at' => date('j M Y', strtotime($r->updated_at)),
                'status' => $this->textStatus($r->status),
                'aksi' => '
                <a type="button" href="javascript:void(0)" onclick="editPelatihan(' . "'" . $r->id . "'" . ')" class="btn btn-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                <a href="#" data-delete-url="' . site_url("PelatihanKategori/hapus/" . $r->id) . '" role="button" onclick="return deleteConfirm(this)" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>'
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
        // Join kategori pelatihan
        $cek = $this->m_pelatihan->KategoriPelatihan($id)->num_rows();
        
        if($cek > 1){
            echo json_encode(['failed' => true, 'message' => 'Data tidak bisa dihapus! Terdapat pelatihan dalam kategori ini.']);
        }else{
            $this->m_pelatihan->hapusKategori($id);
            echo json_encode(['success' => true, 'message' => 'Data berhasil dihapus!']);
        }
        
    }

    public function tambahPelatihanKategori()
    {
        $this->_validation();
        // $this->m_pelatihan->tambahKategori($kategori);

        $data = [
            'kategori' => $this->input->post('kategori'),
            'uraian' => $this->input->post('pelatihan'),
            'created_at' => $this->input->post('create'),
            'updated_at' => $this->input->post('update'),
            'status' => 1,
        ];

        $this->m_pelatihan->tambahKategori($data);
        echo json_encode(['success' => true, 'message' => 'Data Berhasil Ditambahkan!']);
    }

    public function editPelatihanKategori()
    {
        $this->_validation('edit');
        $id = $this->input->post('id');

        $data = [
            'kategori' => $this->input->post('kategori'),
            'uraian' => $this->input->post('pelatihan'),
            'created_at' => $this->input->post('create'),
            'updated_at' => $this->input->post('update'),
            'status' => 1,
        ];

        // var_dump($data);
        // die;

        $this->m_pelatihan->editKategori($data, $id);

        echo json_encode(['success' => true, 'message' => 'Data Berhasil Diperbarui!']);
    }

    public function edit($id)
    {
        $data = $this->m_pelatihan->PelatihanKategoriId($id);
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

        if ($this->input->post('kategori') == '') {
            $data['inputerror'][] = 'kategori';
            $data['error_string'][] = 'Kategori pelatihan harus diisi!';
            $data['status'] = false;
        }
        if ($this->input->post('pelatihan')  == '') {
            $data['inputerror'][] = 'pelatihan';
            $data['error_string'][] = 'Deskripsi pelatihan harus diisi!';
            $data['status'] = false;
        }
        // if ($this->input->post('create')  == '') {
        //     $data['inputerror'][] = 'create';
        //     $data['error_string'][] = 'Tanggal create harus diisi!';
        //     $data['status'] = false;
        // }elseif ($edit === null) {
        //     if (strtotime($this->input->post('create').'+ 1 days') < strtotime('now')) {
        //         $data['inputerror'][] = 'create';
        //         $data['error_string'][] = 'Tidak dapat memberikan waktu create sebelum hari ini!';
        //         $data['status'] = false;
        //     }
        //     if (strtotime($this->input->post('end')) < strtotime('now')) {
        //         $data['inputerror'][] = 'end';
        //         $data['error_string'][] = 'Tidak dapat memberikan waktu update sebelum hari ini!';
        //         $data['status'] = false;
        //     }
        // }
        // if ($this->input->post('end')  == '') {
        //     $data['inputerror'][] = 'end';
        //     $data['error_string'][] = 'Tanggal berakhir harus diisi!';
        //     $data['status'] = false;
        // } elseif ($this->input->post('end')  < $this->input->post('start')) {
        //     $data['inputerror'][] = 'end';
        //     $data['error_string'][] = 'Tidak dapat memberikan tanggal akhir sebelum tanggal mulai!';
        //     $data['status'] = false;
        // } elseif ($edit === null) {
        //     if (strtotime($this->input->post('start').'+ 1 days') < strtotime('now')) {
        //         $data['inputerror'][] = 'start';
        //         $data['error_string'][] = 'Tidak dapat memberikan waktu awal sebelum hari ini!';
        //         $data['status'] = false;
        //     }
        //     if (strtotime($this->input->post('end')) < strtotime('now')) {
        //         $data['inputerror'][] = 'end';
        //         $data['error_string'][] = 'Tidak dapat memberikan waktu akhir sebelum hari ini!';
        //         $data['status'] = false;
        //     }
        // }

        // if ($this->input->post('status')  == '') {
        //     $data['inputerror'][] = 'status';
        //     $data['error_string'][] = 'status pelatihan harus diisi!';
        //     $data['status'] = false;
        // }

        if ($data['status'] === false) {
            echo json_encode($data);
            exit();
        }
    }
}
