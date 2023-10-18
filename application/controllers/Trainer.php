<?php defined('BASEPATH') or exit('No direct script access allowed');

class Trainer extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('c_helper');
        // $this->load->model('m_peserta');
        $this->load->model('M_Sidebar', 'm_sidebar');
        // $this->load->model('m_auth');
        $this->load->model('M_Auth', 'm_auth');
        $this->load->model('M_User');
        $this->load->model('M_Trainer');

        $id_role = $this->session->userdata('role_id');

        if ($this->session->has_userdata('id_user') == false) {
            redirect('auth');
        }

        if ($this->m_auth->cekUserAktif($this->session->userdata('id_user')) == 0) {
            $this->session->unset_userdata('id_user');
            redirect('auth');
        }

        $user = $this->m_auth->getCurrentUser();
        if ($user['user_group_id'] != $this->m_auth->getIDRole('admin')['id']) {
            redirect('dashboard');
        }
    }

    public function index()
    {
        $id_role = $this->session->userdata('role_id');
        $menu = $this->m_sidebar->getSidebarMenu($id_role);
        $user = $this->m_auth->getCurrentUser();

        $data['url'] = 'trainer';
        $data['title'] = 'pemateri';
        $data['sub_title'] = 'Pemateri AMD Academy';
        $data['menu'] = $menu;
        $data['user'] = $user;

        // $data['result'] = $this->M_Trainer->getData();
        // $data['pelatihan'] = $this->M_Trainer->getData_pelatihan();asdas

        // print_r($data['kategori']);exit;
        viewAdmin($this, 'admin/trainer', $data);
    }

    public function get()
    {
        $draw = intval($this->input->get("draw"));
        $query = $this->M_Trainer->getTrainer()['result'];
        $data = [];

        foreach ($query as $key => $r) {
            $data[] = array(
                'no' => $key + 1,
                'nama' => $r['nama'],
                'avatar' => '<img src="data:image/jpg;base64, ' . $r['avatar'] . '" class="img-circle2">',
                'linkedin' => '<a target="_blank" href="' . $r['linkedin'] . '">' . substr($r['linkedin'], 0, 25) . '...</a>',
                'profesi' => $r['profesi'],
                // 'nama_kategori' => $r['nama_kategori'],
                'action' => '<a href="#" onclick="byid(' . $r['id_trainer'] . ')" class="badge badge-primary"><img src="' . base_url() . 'assets/assets/img/trainer/edit.svg"></a>
                <a href="#" onclick="deleted(' . $r['id_trainer'] . ')" class="badge badge-danger tombol-hapus"><img src=" ' . base_url() . 'assets/assets/img/trainer/delete.svg"></a>
                '
            );
        }
        $result = array(
            "draw" => $draw,
            "data" => $data
        );

        echo json_encode($result);
    }

    public function add()
    {
        $param = $this->input->post();
        $this->form_validation->set_rules('nama', 'Nama ', 'required|max_length[100]', [
            'required' => '*Nama wajib diisi',
            'max_length' => 'Panjang nama maksimal 100 karakter'
        ]);
        $this->form_validation->set_rules('email', '*Email', 'required|valid_email', [
            'required' => '*Email wajib diisi',
        ]);
        $this->form_validation->set_rules('alamat', '*Alamat', 'required', [
            'required' => '*Alamat wajib diisi',
        ]);
        $this->form_validation->set_rules('telepon', '*Nomor telepon', 'required', [
            'required' => '*Nomor telepon wajib diisi',
        ]);
        $this->form_validation->set_rules('bidang', '*Bidang Keahlian', 'required', [
            'required' => '*Bidang keahlian wajib diisi',
        ]);
        $this->form_validation->set_rules('profesi', '*Profesi', 'required', [
            'required' => '*Profesi wajib diisi',
        ]);
        $this->form_validation->set_rules('jk', '*jenis kelamin', 'required', [
            'required' => '*jenis kelamin wajib diisi',
        ]);

        $this->form_validation->set_rules('lahir', '*Tempat lahir', 'required', [
            'required' => '*Tempat lahir wajib diisi',
        ]);
        $this->form_validation->set_rules('linkedin', '*Linkedin', 'required|valid_url', [
            'required' => '*Linkedin wajib diisi',
        ]);
        $this->form_validation->set_rules('tgl_lahir', '*Tanggal lahir', 'required', [
            'required' => '*Tanggal lahir wajib diisi',
        ]);


        // $this->form_validation->set_rules('userfile', '*File', 'required');
        if ($this->form_validation->run() == FALSE) {
            $message = [
                'error' => true,
                // 'nim_error' => form_error('nim'),
                'nama_error' => strip_tags(form_error('nama')),
                'email_error' => strip_tags(form_error('email')),
                'alamat_error' => strip_tags(form_error('alamat')),
                'telepon_error' => strip_tags(form_error('telepon')),
                'bidang_error' => strip_tags(form_error('bidang')),
                'profesi_error' => strip_tags(form_error('profesi')),
                'jk_error' => strip_tags(form_error('jk')),
                // 'program_error' => strip_tags(form_error('program')),
                'linkedin_error' => strip_tags(form_error('linkedin')),
                'lahir_error' => strip_tags(form_error('lahir')),
                'tgl_lahir_error' => strip_tags(form_error('tgl_lahir')),
                // 'file_error' => strip_tags(form_error('userfile')),
            ];
        } elseif (valid_url($this->input->post('linkedin')) == false && form_error('linkedin') == '') {
            $message = [
                'error' => true,
                'linkedin_error' => 'Link invalid'
            ];
        } elseif (!strpos($this->input->post('linkedin'), 'linkedin')) {
            $message = [
                'error' => true,
                'linkedin_error' => 'Masukkan URL LinkedIn'
            ];
        } elseif (preg_match('/^http/i', $this->input->post('linkedin')) == 0) {
            $message = [
                'error' => true,
                'linkedin_error' => 'Masukkan URL diawali dengan http:// atau https://'
            ];
        } elseif ($this->M_Trainer->cekUniqueHp($param['telepon']) != 0) {
            $message = [
                'status' => false,
                'error' => true,
                'telepon_error' => 'Nomor HP sudah ada'
            ];
        } elseif ($this->M_Trainer->cekUniqueEmail($param['email']) != 0) {
            $message = [
                'status' => false,
                'error' => true,
                'email_error' => 'Email sudah ada'
            ];
        } else {
            $config['upload_path']          = FCPATH . './uploads_admin/';
            $config['allowed_types']        = 'gif|jpg|png|';
            $config['max_size']             = 2048;
            $config['max_width']            = 10000;
            $config['max_height']           = 10000;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('userfile')) {
                $error = array('error' => strip_tags($this->upload->display_errors()));
                $message = [
                    'status' => 'pict',
                    'error' => $error['error'],
                ];
            } else {
                $avatar = $this->upload->data();

                $name = $avatar['file_name'];
                $pathinfo = $avatar['full_path'];
                $filecontent = file_get_contents($pathinfo);
                $base64 = rtrim(base64_encode(($filecontent)));


                $param['avatar'] = $base64;
                $cek = $this->M_Trainer->create($param);

                if ($cek > 0) {
                    $message['status'] = 'success';
                } else {
                    $message['status'] = 'failed';
                }

                $fileName = glob("uploads_admin/$name");
                foreach ($fileName as $file) {
                    unlink($file);
                }
            }
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($message));
    }

    public function delete($id_trainer)
    {
        $cek = $this->M_Trainer->function_delete($id_trainer);

        if ($cek > 0) {
            $message['status'] = 'success';
        } else {
            $message['status'] = 'failed';
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($message));
    }

    public function byid($id_trainer)
    {
        // $data = $this->M_Trainer->getDataById($id_trainer);
        // $data = $this->M_Trainer->getDataKategori($id_trainer);

        $data = array(
            "trainer" => $this->M_Trainer->getTrainer(null, $id_trainer)['result'][0],
            // "kategori_trainer" => $this->M_Trainer->getDataKategori($id_trainer)
        );
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function update()
    {
        $param = $this->input->post();
        // print_r($param);
        // die;
        $this->form_validation->set_rules('nama', 'Nama ', 'required|max_length[100]', [
            'required' => '*Nama wajib diisi',
            'max_length' => 'Panjang nama maksimal 100 karakter'
        ]);
        $this->form_validation->set_rules('email', '*Email', 'required|valid_email', [
            'required' => '*Email wajib diisi',
        ]);
        $this->form_validation->set_rules('alamat', '*Alamat', 'required', [
            'required' => '*Alamat wajib diisi',
        ]);
        $this->form_validation->set_rules('telepon', '*Nomor telepon', 'required', [
            'required' => '*Nomor telepon wajib diisi',
        ]);
        $this->form_validation->set_rules('bidang', '*Bidang Keahlian', 'required', [
            'required' => '*Bidang keahlian wajib diisi',
        ]);
        $this->form_validation->set_rules('profesi', '*Profesi', 'required', [
            'required' => '*Profesi wajib diisi',
        ]);
        $this->form_validation->set_rules('jk', '*jenis kelamin', 'required', [
            'required' => '*jenis kelamin wajib diisi',
        ]);
        // $this->form_validation->set_rules('program', '*Program', 'required', [
        //     'required' => '*Program wajib diisi',
        // ]);
        $this->form_validation->set_rules('lahir', '*Tempat lahir', 'required', [
            'required' => '*Tempat lahir wajib diisi',
        ]);
        $this->form_validation->set_rules('linkedin', '*Linkedin', 'required|valid_url', [
            'required' => '*Linkedin wajib diisi',
        ]);
        $this->form_validation->set_rules('tgl_lahir', '*Tanggal lahir', 'required', [
            'required' => '*Tanggal lahir wajib diisi',
        ]);
        // $this->form_validation->set_rules('userfile', '*File', 'required');
        if ($this->form_validation->run() == FALSE) {
            $message = [
                'error' => true,
                // 'nim_error' => form_error('nim'),
                'nama_error' => strip_tags(form_error('nama')),
                'email_error' => strip_tags(form_error('email')),
                'alamat_error' => strip_tags(form_error('alamat')),
                'telepon_error' => strip_tags(form_error('telepon')),
                'bidang_error' => strip_tags(form_error('bidang')),
                'profesi_error' => strip_tags(form_error('profesi')),
                'jk_error' => strip_tags(form_error('jk')),
                // 'program_error' => strip_tags(form_error('program')),
                'linkedin_error' => strip_tags(form_error('linkedin')),
                'lahir_error' => strip_tags(form_error('lahir')),
                'tgl_lahir_error' => strip_tags(form_error('tgl_lahir')),
                // 'file_error' => strip_tags(form_error('userfile')),
            ];
        } elseif (valid_url($this->input->post('linkedin')) == false && form_error('linkedin') == '') {
            $message = [
                'status' => false,
                'error' => true,
                'linkedin_error' => 'Link invalid'
            ];
        } else {
            $config['upload_path']          = FCPATH . './uploads/';
            $config['allowed_types']        = 'gif|jpg|png|';
            $config['max_size']             = 2048;
            $config['max_width']            = 10000;
            $config['max_height']           = 10000;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('userfile')) {

                $base64 = $this->input->post('userfile2');
                $id_trainer = $this->input->post('id_trainer');

                // print_r($param);
                // die;
                $cek = $this->M_Trainer->proses_edit($base64, $id_trainer);
                $this->session->set_flashdata('pesan', 'diedit');

                if ($cek > 0) {
                    $message['status'] = 'success';
                } else {
                    $message['status'] = 'failed';
                }
            } else {
                $gambar = $this->upload->data();

                $name = $gambar['file_name'];
                $pathinfo = $gambar['full_path'];
                $filecontent = file_get_contents($pathinfo);
                $base64 = rtrim(base64_encode(($filecontent)));

                $id_trainer = $this->input->post('id_trainer');
                $cek = $this->M_Trainer->proses_edit($base64, $id_trainer);

                if ($cek > 0) {
                    $message['status'] = 'success';
                } else {
                    $message['status'] = 'failed';
                }


                $fileName = glob("uploads/$name");
                foreach ($fileName as $file) {
                    unlink($file);
                }
            }
        }


        $this->output->set_content_type('application/json')->set_output(json_encode($message));
    }
}
