<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Materi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('c_helper');
        $this->load->model('M_Materi', 'm_materi');
        $this->load->model('M_Pelatihan', 'm_pelatihan');
        $this->load->model('M_Sidebar', 'm_sidebar');
        $this->load->model('M_Auth', 'm_auth');

        if (!$this->session->has_userdata('id_user')) {
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
        $id_role = $this->session->userdata('role_id');
        $currentUser = $this->m_auth->getCurrentUser();
        $menu = $this->m_sidebar->getSidebarMenu($currentUser['user_group_id']);

        $data['url'] = 'materi';
        $data['title'] = 'Materi';
        $data['sub_title'] = 'Materi Pelatihan';
        $data['menu'] = $menu;
        $data['user'] = $currentUser;
        $data['idPeserta'] = $this->m_auth->getIDRole('peserta')['id'];
        $data['idAdmin'] = $this->m_auth->getIDRole('admin')['id'];

        // data sidebar & navbar || end


        // $data['tipe_file'] = $this->m_materi->getTipeFile();

        // switch ($currentUser['role_id']) {
        //     case $data['idPeserta']:
        // $id_member = $this->m_materi->getMemberUsingIDUser($this->session->userdata('id_user'))['id'];
        // $id_pelatihan = $this->m_materi->getPelatihanIdUsingIdMember($id_member);
        // $list_pelatihan = array_unique(array_column($id_pelatihan, 'pelatihan_id'), SORT_REGULAR);


        // $btnPelatihan = [];
        // foreach ($list_pelatihan as $lp) {
        //     $btnPelatihan[] = $this->m_materi->getPelatihan($lp);
        // }
        // print_r(array_unique($btnPelatihan), SORT_REGULAR);
        $data['kategori'] = $this->m_materi->getKategoriMateriPeserta($this->session->userdata('id_user'));

        // print_r($list_pelatihan);
        // die;
        // print_r();


        // $pelatihanMateri = $this->m_materi->getPelatihanMateri($id_pelatihan)
        //         break;
        //     case $data['idAdmin']:
        //         $data['kategori'] = $this->m_pelatihan->getKategori()['result'];
        //         break;

        //     default:
        //         # code...
        //         break;
        // }

        viewAdmin($this, 'admin/materi', $data);
    }

    // public function dataMateriAdmin()
    // {
    //     $draw = intval($this->input->get("draw"));
    //     $start = intval($this->input->get("start"));
    //     $length = intval($this->input->get("length"));
    //     $materi = $this->m_materi->getPelatihanMateri();
    //     $data = [];

    //     foreach ($materi as $key => $r) {
    //         // var_dump($r);
    //         // die;
    //         $data[] = array(
    //             'no' => $key + 1,
    //             'judul' => '<a target="_blank" href="' . $r['link_materi'] . '">' . $r['judul'] . '</a>',
    //             'kategori' => $r['nama_kategori'],
    //             'tipe_file' => $r['tipe_file'],
    //             'create_at' =>  date('j M Y', strtotime($r['create_at'])),
    //             'update_at' => ($r['update_at'] != null) ? date('j M Y', strtotime($r['update_at'])) : '-',
    //             'action' => ' <div class="col">
    //             <button class="btn btn-sm btn-info text-white edtMateri" id="' . $r['id_materi'] . '"><i class="fa-solid fa-pen-to-square"></i></button>
    //              <button class="btn btn-sm btn-danger text-white dltMateri" id="' . $r['id_materi'] . '"><i class="fa fa-trash" aria-hidden="true"></i></button>
    //         </div>'
    //         );
    //     }
    //     $result = array(
    //         "draw" => $draw,
    //         "recordsTotal" => $this->m_materi->getJumlahMateri(),
    //         "recordFiltered" => $this->m_materi->getJumlahMateri(),
    //         "data" => $data
    //     );
    //     // var_dump($result);
    //     // die;
    //     echo json_encode($result);
    //     exit();
    // }

    public function dataMateriPeserta($ip = null)
    {
        $ip = null;
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $query = $this->m_materi->getPelatihanMateri($ip);
        // var_dump($tes);
        // die;
        $data = [];

        foreach ($query->result_array() as $r) {
            // var_dump($r);
            // die;
            $data[] = array(
                'thumbnail' => '<img class="w-100 h-100 pb-4" src="' . base_url('assets/image/profile/laptop.svg') . '" alt="">',
                'materi' => $r['materi'],
                'deskripsi' => substr($r['deskripsi'], 0, 20) . '...',
                'ref_link' => '<a target="_blank" href="' . $r['referensi_link'] . '">' . substr($r['referensi_link'], 0, 20) . '...</a>',
                'referensi_file' =>   '<a target="_blank" href="' . base_url($r['referensi_file']) . '">' . substr($r['referensi_file'], 0, 25) . '...</a>',
            );
        }
        $result = array(
            "draw" => $draw,
            "recordsTotal" => $query->num_rows(),
            "recordFiltered" => $query->num_rows(),
            "data" => $data
        );
        echo json_encode($result);
    }

    private function makeThumbnail($linkMateri)
    {
        $arr = explode('/', $linkMateri);
        $linkThumnail = array_slice($arr, 0, 6);

        $thumbnail = '<iframe style="overflow:hidden;" class="w-100 h-100" src="' . implode('/', $linkThumnail) . '/preview"></iframe>';
        return $thumbnail;
    }

    // public function postMateri()
    // {
    //     $param = $this->input->post();
    //     if ($param == null) {
    //         redirect(base_url('dashboard'));
    //     }
    //     $this->form_validation->set_rules(rulesMateri());
    //     if ($this->form_validation->run() == FALSE) {

    //         $invalidUrl = '';
    //         if (valid_url($param['link']) == false && form_error('link') == '') {
    //             $invalidUrl = 'Link invalid';
    //         }
    //         $arr = [
    //             'success' => false,
    //             'message' => [
    //                 'judul' => strip_tags(form_error('judul')),
    //                 'kategori' => strip_tags(form_error('kategori')),
    //                 'tipe' => strip_tags(form_error('tipe')),
    //                 'link' => strip_tags(form_error('link')) . $invalidUrl
    //             ]
    //         ];
    //     } elseif (valid_url($param['link']) == false && form_error('link') == '') {
    //         $arr = [
    //             'success' => false,
    //             'message' => [
    //                 'link' => 'Link invalid'
    //             ]
    //         ];
    //     } elseif ($this->m_materi->cekJudul($param['judul']) != 0) {
    //         $arr = [
    //             'success' => false,
    //             'message' => [
    //                 'judul' => 'Judul ini telah digunakan'
    //             ]
    //         ];
    //     } elseif ($this->m_materi->cekLink($param['link']) != 0) {
    //         $judul = $this->m_materi->getJudulByLink($param['link'])['judul'];
    //         $arr = [
    //             'success' => false,
    //             'message' => [
    //                 'link' => 'Link materi sudah pernah diupload pada judul "' . $judul . '"'
    //             ]
    //         ];
    //     } else {

    //         $result = $this->m_materi->postMateri($param);
    //         if ($result['success']) {
    //             $arr = [
    //                 'success' => true,
    //                 'message' => 'Berhasil menambahkan data'
    //             ];
    //         } else {
    //             $arr = [
    //                 'success' => false,
    //                 'message' => 'Gagal menambahkan data'
    //             ];
    //         }
    //     }
    //     echo json_encode($arr);
    // }

    // public function putMateri()
    // {
    //     $param = $this->input->post();
    //     if ($param == null) {
    //         redirect(base_url('dashboard'));
    //     }
    //     $oldData = $this->m_materi->getMateri(null, $param['id_materi'])[0];
    //     // print_r($oldData);
    //     // die;
    //     $this->form_validation->set_rules(rulesMateri());
    //     if ($this->form_validation->run() == FALSE) {

    //         $invalidUrl = '';
    //         if (valid_url($param['link']) == false && form_error('link') == '') {
    //             $invalidUrl = 'Link invalid';
    //         }
    //         $arr = [
    //             'success' => false,
    //             'message' => [
    //                 'judul' => strip_tags(form_error('judul')),
    //                 'kategori' => strip_tags(form_error('kategori')),
    //                 'tipe' => strip_tags(form_error('tipe')),
    //                 'link' => strip_tags(form_error('link')) . $invalidUrl
    //             ]
    //         ];
    //     } elseif (valid_url($param['link']) == false && form_error('link') == '') {
    //         $arr = [
    //             'success' => false,
    //             'message' => [
    //                 'link' => 'Link invalid'
    //             ]
    //         ];
    //     } elseif ($this->m_materi->cekLink($param['link']) != 0 && $oldData['link_materi'] != $param['link']) {
    //         $judul = $this->m_materi->getJudulByLink($param['link'])['judul'];
    //         $arr = [
    //             'success' => false,
    //             'message' => [
    //                 'link' => 'Link materi sudah pernah diupload pada judul <b>"' . $judul . '"</b>'
    //             ]
    //         ];
    //     } else {

    //         $result = $this->m_materi->putMateri($param, $param['id_materi']);
    //         if ($result['success']) {
    //             $arr = [
    //                 'success' => true,
    //                 'message' => 'Berhasil Mengubah Data'
    //             ];
    //         } else {
    //             $arr = [
    //                 'success' => false,
    //                 'message' => 'Gagal Mengubah Data'
    //             ];
    //         }
    //     }
    //     echo json_encode($arr);
    // }

    // public function deleteMateri()
    // {
    //     $param = $this->input->post();
    //     if ($param == null) {
    //         redirect(base_url('dashboard'));
    //     } else {
    //         $result = $this->m_materi->deleteMateri($this->input->post()['id_materi']);

    //         if ($result['success']) {
    //             $arr = [
    //                 'success' => true,
    //                 'message' => 'Berhasil Hapus Data'
    //             ];
    //         } else {
    //             $arr = [
    //                 'success' => false,
    //                 'message' => 'Gagal Hapus Data'
    //             ];
    //         }
    //         echo json_encode($arr);
    //     }
    // }

    // public function getDetailMateri()
    // {
    //     $id_materi = $this->input->post('id');
    //     if ($id_materi == null) {
    //         $data = array(
    //             'success' => false,
    //             'message' => 'Tidak diizinkan mengubah data !'
    //         );
    //     } else {
    //         $data = [
    //             'success' => true,
    //             'data' => $this->m_materi->getMateri(null, $id_materi)[0]
    //         ];
    //     }
    //     echo json_encode($data);
    // }

    // public function coba()
    // {
    //     $array = $this->m_materi->getKategoriMateriPeserta('5');

    //     print_r(array_unique($array, SORT_REGULAR));
    // }
}
