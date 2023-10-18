<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends CI_Controller
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
        $currentUser = $this->m_auth->getCurrentUser();
        $menu = $this->m_sidebar->getSidebarMenu($currentUser['role_id']);

        $data['url'] = 'kategori';
        $data['title'] = 'Kategori';
        $data['sub_title'] = 'Garis besar dari materi yang akan dipelajari';
        $data['menu'] = $menu;
        $data['user'] = $currentUser;
        $data['idPeserta'] = $this->m_auth->getIDRole('peserta')['id_role'];
        $data['idAdmin'] = $this->m_auth->getIDRole('admin')['id_role'];

        // data sidebar & navbar || end

        $data['kategori'] = $this->m_pelatihan->getKategori()['result'];

        viewAdmin($this, 'admin/kategori', $data);
    }

    public function getKategori()
    {
        $param = $this->input->post();
        if ($param == null) {
            redirect(base_url('custom404'));
        } else {
            $result = $this->m_pelatihan->getKategori($param['id'])['result'];
            $array = [
                'success' => true,
                'result' => $result
            ];
            echo json_encode($array);
        }
    }

    public function putMateriKat()
    {
        $param = $this->input->post();
        if ($param == null) {
            redirect(base_url('custom404'));
        } else {
            $arrMateri = array_column($param['data'], 'value');

            foreach ($arrMateri as $am) {
                if (strlen(trim($am, " ")) == 0) {
                    $array = [
                        'success' => false,
                        'message' => 'Tidak dapat diisi hanya dengan spasi'
                    ];
                    echo json_encode($array);
                    die;
                } elseif (strlen($am) < 5 || strlen($am) > 255) {
                    $array = [
                        'success' => false,
                        'message' => 'List materi setidaknya terdapat 5 karakter dan paling banyak 255 karakter'
                    ];
                    echo json_encode($array);
                    die;
                }
            }

            $data = [
                'id' => $param['id'],
                'strMateri' => implode('#~#', $arrMateri),
            ];


            $result = $this->m_pelatihan->putMateriKategori($data);
            if ($result['success']) {
                $array = [
                    'success' => true,
                    'icon' => 'success',
                    'message' => 'Berhasil mengubah materi'
                ];
            } else {
                $array = [
                    'success' => false,
                    'icon' => 'error',
                    'message' => 'Gagal mengubah materi'
                ];
            }

            echo json_encode($array);
        }
    }
}
