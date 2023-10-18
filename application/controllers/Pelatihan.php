<?php

use SebastianBergmann\Environment\Console;

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
        $this->load->model('M_Trainer', 'm_trainer');
        $this->load->model('M_Materi', 'm_materi');
        $this->load->model('M_Harga', 'm_harga');

        $id_role = $this->session->userdata('role_id');

        if ($this->session->userdata('id_user') == null) {
            redirect('auth');
        }

        if ($id_role == null) {
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
        $menu = $this->m_sidebar->getSidebarMenu($id_role);
        $user = $this->m_auth->getCurrentUser();

        $data_kategori = $this->m_pelatihan->kategori();
        $data['kategori'] = $data_kategori;

        $data['title'] = 'Pelatihan';
        $data['url'] = 'pelatihan';
        $data['sub_title'] = 'Pelatihan AMD Academy';
        $data['menu'] = $menu;
        $data['user'] = $user;

        // data sidebar & navbar || end

        // $data['user'] = $this->db->get_where('
        // $data_pelatihan = $this->p->getKategori(null, null);
        // $data['pelatihan'] = $data_pelatihan;

        //Data Statis
        $data['jenisDaftar'] = ["Personal", "Rombongan"];
        $data['jenisPelatihan'] = ['Offline', 'Online'];

        viewAdmin($this, 'admin/inputPel', $data);
    }

    public function dataPelatihan()
    {
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $query = $this->m_pelatihan->getKategoriPelatihan();
        // var_dump($query->result());
        // die;
        $data = [];

        foreach ($query->result() as $key => $r) {
            // var_dump($r);
            // die;
            $data[] = array(
                'no' => $key + 1,
                'nama_pel' => $r->nama_pelatihan,
                'kategori' => $r->kategori,
                'tipe' => $r->tipe,
                'harga' => 'Rp ' . number_format($r->harga, 0, '', '.'),
                // 'pot1' => 'Rp ' . number_format($r->pot1, 0, '', '.'),
                // 'pot2' => 'Rp ' . number_format($r->pot2, 0, '', '.'),
                'start' => date('j M Y', strtotime($r->tanggal_mulai)),
                'end' => date('j M Y', strtotime($r->tanggal_selesai)),
                'status' => $this->textStatus($r->status),
                'action' => '
                <a target="_blank" href="' . base_url() . 'pelatihan/detail/' . $r->id_pelatihan . '" class="btn btn-info btn-sm detailPelatihan"><i class="fa-solid fa-circle-info"></i></a>
                <a type="button" href="javascript:void(0)" onclick="editPelatihan(' . "'" . $r->id_pelatihan . "'" . ')" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                <a href="#" data-delete-url="' . site_url("pelatihan/hapus/" . $r->id_pelatihan) . '" role="button" onclick="return deleteConfirm(this)" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>'
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
        $param = $this->input->post();
        $param['url_gambar'] = '';
        if (!empty($_FILES['gambar']['name'])) {
            $nama_file = $_FILES['gambar']['name'];

            if (!in_array(substr($_FILES['gambar']['name'], -4), [".gif", ".jpg", "jpeg", ".png", ".pdf", "docx", ".doc"])) {
                $array = [
                    'success' => false,
                    'message' => [
                        'gambar' => 'Tipe file yang dapat diupload adalah gif, jpg, jpeg, png, pdf, docx, doc'
                    ]
                ];
                echo json_encode($array);
                die;
            } else {
                $root_folder = './uploadsPelatihan/';
                // if (!file_exists('./' . $root_folder)) {
                //     mkdir($root_folder, 775);
                // }
                $files = uploadBerkas('gambar', 'pelatihan', null, 'gif|jpg|jpeg|png|pdf|docx|doc');
                $param['url_gambar'] = $files['file_name'];
            }
        } else {
            $param['url_gambar'] = '';
        }

        if ($param['i'] == null) {
            $cek =  $this->m_pelatihan->tambahPelatihan($param);

            if ($cek > 0) {
                $message['status'] = 'success';
            } else {
                $message['status'] = 'failed';
            }
        } else {
            $this->_validation('edit');
            $id_pel = $this->input->post('id_pel');

            if ($param['url_gambar'] == '') {
                $param['url_gambar'] = $param['gambar_old'];
            }

            $proses = $this->m_pelatihan->editPelatihan($param);
            if ($proses > 0) {
                $message['status'] = 'success';
            } else {
                $message['status'] = 'failed';
            }

            // $data = [
            //     'nama_pelatihan' => $this->input->post('nama'),
            //     'pelatihan_kategori_id' => $this->input->post('nama_pelatihan'),
            //     'tipe' => $this->input->post('tipe'),
            //     'biaya' => $this->input->post('harga'),
            //     'tanggal_mulai' => $this->input->post('start'),
            //     'tanggal_selesai' => $this->input->post('end'),
            //     'tanggal_mulai_pendaftaran' => $this->input->post('start_daftar'),
            //     'tanggal_selesai_pendaftaran' => $this->input->post('end_daftar'),
            //     'deskripsi' => $this->input->post('deskripsi'),
            //     'kontak' => $this->input->post('kontak'),
            //     'tempat' => $this->input->post('lokasi'),
            //     'status' => $this->input->post('status'),
            // ];


        }

        // $this->m_pelatihan->tambahKategori($kategori);
        // $config['upload_path']          = FCPATH . './uploads_admin/';
        // $config['allowed_types']        = 'gif|jpg|png|';
        // $config['max_size']             = 2048;
        // $config['max_width']            = 10000;
        // $config['max_height']           = 10000;

        // $this->load->library('upload', $config);

        // if (!$this->upload->do_upload('gambar')) {
        //     $error = array('error' => strip_tags($this->upload->display_errors()));
        //     $message = [
        //         'status' => 'pict',
        //         'error' => $error['error'],
        //     ];
        // } else {
        //     $avatar = $this->upload->data();

        //     $name = $avatar['file_name'];
        //     $pathinfo = $avatar['full_path'];
        //     $filecontent = file_get_contents($pathinfo);
        //     $base64 = rtrim(base64_encode(($filecontent)));




        // $cek =  $this->m_pelatihan->tambahPelatihan($data);

        // if ($cek > 0) {
        //     $message['status'] = 'success';
        // } else {
        //     $message['status'] = 'failed';
        // }

        // $fileName = glob("uploads_admin/$name");
        // foreach ($fileName as $file) {
        //     unlink($file);
        // }
        // }

        // echo json_encode($message);
        $this->output->set_content_type('application/json')->set_output(json_encode($message));
    }

    public function editPelatihan()
    {
        $this->_validation('edit');
        $id_pel = $this->input->post('id_pel');

        $kategori = array(
            'nama_kategori' => $this->input->post('nama_pelatihan'),
        );


        $data = [
            'nama_pelatihan' => $this->input->post('nama'),
            'pelatihan_kategori_id' => $this->input->post('nama_pelatihan'),
            'tipe' => $this->input->post('tipe'),
            'biaya' => $this->input->post('harga'),
            // 'pot1' => $this->input->post('pot1'),
            // 'pot2' => $this->input->post('pot2'),
            'tanggal_mulai' => $this->input->post('start'),
            'tanggal_selesai' => $this->input->post('end'),
            'tanggal_mulai_pendaftaran' => $this->input->post('start_daftar'),
            'tanggal_selesai_pendaftaran' => $this->input->post('end_daftar'),
            'deskripsi' => $this->input->post('deskripsi'),
            'kontak' => $this->input->post('kontak'),
            'tempat' => $this->input->post('lokasi'),
            'status' => $this->input->post('status'),
        ];

        // var_dump($data);
        // die;

        $this->m_pelatihan->editPelatihan($data, $id_pel);

        echo json_encode(['success' => true, 'message' => 'Data Berhasil Diperbarui!']);
    }

    public function edit($id)
    {
        $data = $this->m_pelatihan->kategoriPelatihanId($id);
        // print_r($data);
        // die;
        echo json_encode($data);
    }

    public function detail($id = null)
    {

        //nanti cek kalo id nya gk ada
        if ($id === null) {
            redirect('pelatihan');
        } elseif ($this->m_pelatihan->cekIDPel($id) == 0) {
            redirect('pelatihan');
        } else {
            //data sidebar & navbar || start
            $id_role = $this->session->userdata('role_id');
            $menu = $this->m_sidebar->getSidebarMenu($id_role);
            $user = $this->m_auth->getCurrentUser();

            $data_kategori = $this->m_pelatihan->kategori();
            $data['kategori'] = $data_kategori;

            $data['title'] = 'Pelatihan';
            $data['url'] = 'pelatihan';
            $data['sub_title'] = 'Detail Pelatihan AMD Academy';
            $data['menu'] = $menu;
            $data['user'] = $user;

            // data sidebar & navbar || end
            $data_kategori = $this->m_pelatihan->kategori();
            $data['kategori'] = $data_kategori;
            $data['trainer'] = $this->m_trainer->getTrainerPelatihan($id)['result'];
            $data['allTrainer'] = $this->m_trainer->getTrainer()['result'];
            $data['id_pelatihan'] = $id;

            //Data Statis
            $data['jenisDaftar'] = ["Personal", "Rombongan"];
            $data['jenisPelatihan'] = ['Offline', 'Online'];
            viewAdmin($this, 'admin/detailPel', $data);
        }
    }


    // TRAINER
    public function getDetailTrainer()
    {
        $id_trainer = $this->input->post()['id'];
        // print_r($id_trainer);
        // die;
        if ($id_trainer == null || $id_trainer == '') {
            $result = [
                'success' => false,
                'message' => 'Tidak ada id trainer'
            ];
        } else {
            $proses = $this->m_trainer->getTrainerPelatihan(null, $id_trainer);
            if ($proses['success']) {
                $result = [
                    'success' => true,
                    'message' => $proses['result'][0]
                ];
            } else {
                $result = [
                    'success' => false,
                    'message' => 'Gagal ambil data'
                ];
            }
            echo json_encode($result);
        }
    }

    public function postTrainer()
    {
        $param = $this->input->post();
        if ($param == null) {
            $array = [
                'success' => false,
                'message' => 'ID tidak ditemukan'
            ];
        } else {
            if ($param['ip'] == null || $param['ip'] == '') {
                $array = [
                    'success' => false,
                    'message' => 'ID pelatihan tidak ditemukan'
                ];
            } elseif ($param['trainer'] == null || $param['trainer'] == '') {
                $array = [
                    'success' => false,
                    'message' => 'ID trainer tidak ditemukan'
                ];
            } elseif ($this->m_trainer->cekPostPT($param['ip'], $param['trainer']) != 0) {
                $array = [
                    'success' => false,
                    'message' => 'Trainer sudah pernah ditambahkan'
                ];
            } else {
                $proses = $this->m_trainer->postPelatihanTrainer($param);
                if ($proses['success']) {
                    $array = [
                        'success' => true,
                        'message' => 'Data berhasil ditambahkan'
                    ];
                } else {
                    $array = [
                        'success' => false,
                        'message' => 'Data gagal ditambahkan'
                    ];
                }
            }
        }
        echo json_encode($array);
    }

    public function deleteTrainer()
    {
        $id_trainer = $this->input->post()['id'];
        $proses = $this->m_trainer->deletePelatihanTrainer($id_trainer);

        if ($proses['success']) {
            $array = [
                'success' => true,
                'message' => 'Data berhasil dihapus'
            ];
        } else {
            $array = [
                'success' => false,
                'message' => 'Data gagal dihapus'
            ];
        }

        echo json_encode($array);
    }



    // KURIKULUM
    public function getKurikulum($ip)
    {
        // $ip = $this->input->post()['id'];
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $query = $this->m_pelatihan->getPelatihanKurikulum($ip);
        // var_dump($tes);
        // die;
        $data = [];

        foreach ($query->result_array() as $key => $r) {
            // var_dump($r);
            // die;
            $data[] = array(
                'no' => $key + 1,
                'kurikulum' => $r['kurikulum'],
                'deskripsi' => substr($r['deskripsi'], 0, 25) . '...',
                'status' => $this->textStatus($r['status']),
                'action' => '
                <button type="button" id="' . $r['id'] . '" class="btn btn-primary btn-sm edtKurikulum"><i class="fa-solid fa-pen-to-square"></i></button>
                <button type="button" id="' . $r['id'] . '" class="btn btn-danger btn-sm delKurikulum"><i class="fa-solid fa-trash"></i></button>'
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

    public function postKurikulum()
    {
        $param = $this->input->post();

        if ($param == null) {
            $array = [
                'success' => false,
                'message' => 'data tidak ditemukan'
            ];
        } else {
            $this->form_validation->set_rules([
                [
                    'field' => 'kurikulum',
                    'label' => 'kurikulum',
                    'rules' => 'required'
                ],
                [
                    'field' => 'deskripsi',
                    'label' => 'deskripsi',
                    'rules' => 'required|min_length[100]'
                ],

            ]);
            if ($this->form_validation->run() == FALSE) {
                $array = [
                    'success' => false,
                    'message' => [
                        'kurikulum' => strip_tags(form_error('kurikulum')),
                        'deskripsi' => strip_tags(form_error('deskripsi'))
                    ]
                ];
            } else {
                if ($param['i'] == null) {
                    $proses = $this->m_pelatihan->postPelatihanKurikulum($param);
                    if ($proses['success']) {
                        $array = [
                            'success' => true,
                            'message' => 'Berhasil ditambahkan'
                        ];
                    } else {
                        $array = [
                            'success' => false,
                            'message' => 'Gagal ditambahkan'
                        ];
                    }
                } else {
                    $proses = $this->m_pelatihan->putPelatihanKurikulum($param);
                    if ($proses['success']) {
                        $array = [
                            'success' => true,
                            'message' => 'Berhasil diubah'
                        ];
                    } else {
                        $array = [
                            'success' => false,
                            'message' => 'Gagal diubah'
                        ];
                    }
                }
            }
        }
        echo json_encode($array);
    }

    public function deleteKurikulum()
    {
        $param = $this->input->post();
        if ($param == null) {
            $array = [
                'success' => false,
                'message' => 'data tidak ditemukan'
            ];
        } else {
            $result = $this->m_pelatihan->deletePelatihanKurikulum($param['id']);
            if ($result['success']) {
                $array = [
                    'success' => true,
                    'message' => 'Berhasil Hapus Data'
                ];
            } else {
                $array = [
                    'success' => false,
                    'message' => 'Gagal Hapus Data'
                ];
            }
            echo json_encode($array);
        }
    }

    public function putKurikulum()
    {
        $param = $this->input->post();

        if ($param == null) {
            $array = [
                'success' => false,
                'message' => 'data tidak ditemukan'
            ];
        } else {
            $this->form_validation->set_rules([
                [
                    'field' => 'kurikulum',
                    'label' => 'kurikulum',
                    'rules' => 'required'
                ],
                [
                    'field' => 'deskripsi',
                    'label' => 'deskripsi',
                    'rules' => 'required|min_length[100]'
                ],

            ]);
            if ($this->form_validation->run() == FALSE) {
                $array = [
                    'success' => false,
                    'message' => [
                        'kurikulum' => strip_tags(form_error('kurikulum')),
                        'deskripsi' => strip_tags(form_error('deskripsi'))
                    ]
                ];
            } else {
                $proses = $this->m_pelatihan->putPelatihanKurikulum($param);
                if ($proses['success']) {
                    $array = [
                        'success' => true,
                        'message' => 'Berhasil diubah'
                    ];
                } else {
                    $array = [
                        'success' => false,
                        'message' => 'Gagal diubah'
                    ];
                }
            }
        }
        echo json_encode($array);
    }

    public function detailKurikulum()
    {
        $id_kk = $this->input->post()['id'];
        if ($id_kk == null) {
            $array = [
                'success' => false,
                'result' => 'id tidak ditemukan'
            ];
        } else {
            $hasil = $this->m_pelatihan->getPelatihanKurikulum(null, $id_kk)->row_array();
            $array = [
                'success' => true,
                'result' => $hasil
            ];
        }
        echo json_encode($array);
    }


    //MATERI
    public function getMateri($ip)
    {
        // $ip = $this->input->post()['id'];
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $query = $this->m_materi->getPelatihanMateri($ip);
        // var_dump($tes);
        // die;
        $data = [];

        foreach ($query->result_array() as $key => $r) {
            // var_dump($r);
            // die;
            $data[] = array(
                'no' => $key + 1,
                'materi' => $r['materi'],
                'deskripsi' => substr($r['deskripsi'], 0, 25) . '...',
                'status' => $this->textStatus($r['status']),
                'ref_link' => '<a target="_blank" href="' . $r['referensi_link'] . '">' . substr($r['referensi_link'], 0, 25) . '...</a>',
                'referensi_file' =>   '<a target="_blank" href="' . base_url($r['referensi_file']) . '">' . substr($r['referensi_file'], 0, 25) . '...</a>',
                'action' => '
                <button type="button" id="' . $r['id'] . '" class="btn btn-primary btn-sm edtMateri"><i class="fa-solid fa-pen-to-square"></i></button>
                <button type="button" id="' . $r['id'] . '" class="btn btn-danger btn-sm delMateri"><i class="fa-solid fa-trash"></i></button>'
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

    public function detailMateri()
    {
        $id_materi = $this->input->post()['id'];
        if ($id_materi == null) {
            $array = [
                'success' => false,
                'result' => 'id tidak ditemukan'
            ];
        } else {
            $hasil = $this->m_materi->getPelatihanMateri(null, $id_materi)->row_array();
            $array = [
                'success' => true,
                'result' => $hasil
            ];
        }
        echo json_encode($array);
    }

    public function postMateri()
    {
        $param = $this->input->post();
        if ($param == null) {
            $array = [
                'success' => false,
                'message' => 'data tidak ditemukan'
            ];
        } else {
            $this->form_validation->set_rules([
                [
                    'field' => 'materi',
                    'label' => 'materi',
                    'rules' => 'required'
                ],
                [
                    'field' => 'deskripsi',
                    'label' => 'deskripsi',
                    'rules' => 'required|max_length[255]'
                ],
                // [
                //     'field' => 'ref_link',
                //     'label' => 'link referensi',
                //     'rules' => 'required'
                // ],


            ]);
            if ($this->form_validation->run() == FALSE) {
                $array = [
                    'success' => false,
                    'message' => [
                        'materi' => strip_tags(form_error('materi')),
                        'deskripsi' => strip_tags(form_error('deskripsi')),
                        // 'ref_link' => strip_tags(form_error('ref_link'))
                    ]
                ];
            } elseif (!valid_url($this->input->post()['ref_link']) && trim($this->input->post()['ref_link']) != '') {
                $array = [
                    'success' => false,
                    'message' => [
                        'ref_link' => 'Link tidak valid'
                    ]
                ];
            } elseif (preg_match("/^http/i", $this->input->post('ref_link')) == 0 && trim($this->input->post()['ref_link']) != '') {
                $array = [
                    'success' => false,
                    'message' => [
                        'ref_link' => 'Masukkan URL diawali dengan http:// atau https://'
                    ]
                ];
            } else {
                $param['url_berkas'] = '';
                if (!empty($_FILES['ref_file']['name'])) {
                    $nama_file = $_FILES['ref_file']['name'];

                    if (!in_array(substr($_FILES['ref_file']['name'], -4), [".gif", ".jpg", "jpeg", ".png", ".pdf", "docx", ".doc"])) {
                        $array = [
                            'success' => false,
                            'message' => [
                                'ref_file' => 'Tipe file yang dapat diupload adalah gif, jpg, jpeg, png, pdf, docx, doc'
                            ]
                        ];
                        echo json_encode($array);
                        die;
                    } else {
                        $root_folder = './public/uploads/materi';
                        if (!file_exists('./' . $root_folder)) {
                            mkdir($root_folder, 775);
                        }
                        $files = uploadBerkas('ref_file', 'materi', 'materi', null, 'gif|jpg|jpeg|png|pdf|docx|doc');
                        $param['url_berkas'] = $files['file_name'];
                    }
                } else {
                    $param['url_berkas'] = '';
                }
                if ($param['i'] == null) {

                    // print_r($param);
                    // die;
                    $proses = $this->m_materi->postMateri($param);
                    if ($proses['success']) {
                        $array = [
                            'success' => true,
                            'message' => 'Berhasil ditambahkan'
                        ];
                    } else {
                        $array = [
                            'success' => false,
                            'message' => 'Gagal ditambahkan'
                        ];
                    }
                } else {
                    if ($param['url_berkas'] == '') {
                        $param['url_berkas'] = $param['ref_file_old'];
                    }
                    $proses = $this->m_materi->putMateri($param);
                    if ($proses['success']) {
                        $array = [
                            'success' => true,
                            'message' => 'Berhasil diubah'
                        ];
                    } else {
                        $array = [
                            'success' => false,
                            'message' => 'Gagal diubah'
                        ];
                    }
                }
            }
        }
        echo json_encode($array);
    }

    public function deleteMateri()
    {
        if ($this->input->post() == null) {
            $array = [
                'success' => false,
                'message' => 'data tidak ditemukan'
            ];
        } else {
            $id_materi = $this->input->post()['id'];
            $ref_file = $this->m_materi->getPelatihanMateri(null, $id_materi)->row_array()['referensi_file'];

            $proses = $this->m_materi->deleteMateri($id_materi, $ref_file);
            if ($proses['success']) {
                $array = [
                    'success' => true,
                    'message' => 'Berhasil hapus data'
                ];
            } else {
                $array = [
                    'success' => false,
                    'message' => 'Gagal hapus data'
                ];
            }
        }
        echo json_encode($array);
    }


    //HARGA
    public function getHarga($ip)
    {
        // $ip = $this->input->post()['id'];
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $query = $this->m_harga->getPelatihanHarga($ip);
        // var_dump($tes);
        // die;
        $data = [];

        foreach ($query->result_array() as $key => $r) {

            $data[] = array(
                'no' => $key + 1,
                'jenis' => $r['jenis'],
                'jenis_harga' => $r['jenis_harga'],
                'harga' => "Rp." . number_format($r['harga'], 0, '', '.'),
                'diskon' => "Rp." . number_format($r['diskon'], 0, '', '.'),
                'keterangan' => $r['keterangan'],
                'status' => $this->textStatus($r['is_active']),
                'fasilitas' => '<button type="button" id="' . $r['id'] . '" class="btn btn-success btn-sm fasilitas">Fasilitas</button>',
                'action' => '
                <button type="button" id="' . $r['id'] . '" class="btn btn-primary btn-sm edtHarga"><i class="fa-solid fa-pen-to-square"></i></button>
                <button type="button" id="' . $r['id'] . '" class="btn btn-danger btn-sm delHarga"><i class="fa-solid fa-trash"></i></button>'
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

    public function detailHarga()
    {
        $id_harga = $this->input->post()['id'];
        if ($id_harga == null) {
            $array = [
                'success' => false,
                'result' => 'id tidak ditemukan'
            ];
        } else {
            $hasil = $this->m_harga->getPelatihanHarga(null, $id_harga)->row_array();
            $array = [
                'success' => true,
                'result' => $hasil
            ];
        }
        echo json_encode($array);
    }

    public function postHarga()
    {
        $param = $this->input->post();
        // print_r($param);
        // die;
        if ($param == null) {
            $array = [
                'success' => false,
                'message' => 'data tidak ditemukan'
            ];
        } else {
            $this->form_validation->set_rules([
                [
                    'field' => 'jenis',
                    'label' => 'Jenis pendaftaran',
                    'rules' => 'required'
                ],
                [
                    'field' => 'jenis_harga',
                    'label' => 'jenis pelatihan',
                    'rules' => 'required'
                ],
                [
                    'field' => 'harga',
                    'label' => 'Harga',
                    'rules' => 'required'
                ],
                [
                    'field' => 'keterangan',
                    'label' => 'keterangan',
                    'rules' => 'required|max_length[255]'
                ]


            ]);
            if ($this->form_validation->run() == FALSE) {
                $array = [
                    'success' => false,
                    'message' => [
                        'jenis' => strip_tags(form_error('jenis')),
                        'jenis_harga' => strip_tags(form_error('jenis_harga')),
                        'harga' => strip_tags(form_error('harga')),
                        'keterangan' => strip_tags(form_error('keterangan')),
                        // 'ref_link' => strip_tags(form_error('ref_link'))
                    ]
                ];
            } elseif (strlen((int)$param['harga']) > 8) {
                $array = [
                    'success' => false,
                    'message' => [
                        'harga' => 'Jumlah karakter lebih dari 8 karakter'

                    ]
                ];
            } elseif ($param['harga'] < $param['diskon']) {
                $array = [
                    'success' => false,
                    'message' => [
                        'harga' => 'Harga lebih kecil dari diskon'

                    ]
                ];
            } elseif ($param['min_jumlah_daftar'] <= 0 || $param['max_jumlah_daftar'] <= 0) {
                if ($param['min_jumlah_daftar'] <= 0) {
                    $error_min = 'Jumlah pendaftar tidak boleh kurang atau sama dengan 0';
                } else {
                    $error_min = '';
                }
                if ($param['max_jumlah_daftar'] <= 0) {
                    $error_max = 'Jumlah pendaftar tidak boleh kurang atau sama dengan 0';
                } else {
                    $error_max = '';
                }

                $array = [
                    'success' => false,
                    'message' => [
                        'min_jumlah_daftar' => $error_min,
                        'max_jumlah_daftar' => $error_max

                    ]
                ];
            } elseif ($param['max_jumlah_daftar'] <  $param['min_jumlah_daftar']) {
                $array = [
                    'success' => false,
                    'message' => [
                        'max_jumlah_daftar' => 'Maks jumlah pendaftar, harus lebih besar atau sama dengan minimal jumlah pendaftar'
                    ]
                ];
            } elseif ($param['jenis'] == 'Rombongan' && $param['min_jumlah_daftar'] <= 1) {
                $array = [
                    'success' => false,
                    'message' => [
                        'min_jumlah_daftar' => 'Untuk jenis pendaftaran rombongan, minimal 2 pendaftar'
                    ]
                ];
            } else {
                if ($param['i'] == null) {

                    // print_r($param);
                    // die;
                    $proses = $this->m_harga->postPelatihanHarga($param);
                    if ($proses['success']) {
                        $array = [
                            'success' => true,
                            'message' => 'Berhasil ditambahkan'
                        ];
                    } else {
                        $array = [
                            'success' => false,
                            'message' => 'Gagal ditambahkan'
                        ];
                    }
                } else {
                    $proses = $this->m_harga->putPelatihanHarga($param);
                    if ($proses['success']) {
                        $array = [
                            'success' => true,
                            'message' => 'Berhasil diubah'
                        ];
                    } else {
                        $array = [
                            'success' => false,
                            'message' => 'Gagal diubah'
                        ];
                    }
                }
            }
        }
        echo json_encode($array);
    }

    public function deleteHarga()
    {
        if ($this->input->post() == null) {
            $array = [
                'success' => false,
                'message' => 'data tidak ditemukan'
            ];
        } else {
            $id_harga = $this->input->post()['id'];
            $proses = $this->m_harga->deletePelatihanHarga($id_harga);
            if ($proses['success']) {
                $array = [
                    'success' => true,
                    'message' => 'Berhasil hapus data'
                ];
            } else {
                $array = [
                    'success' => false,
                    'message' => 'Gagal hapus data'
                ];
            }
        }
        echo json_encode($array);
    }

    //fasiliats
    public function putFasilitas()
    {
        $param = $this->input->post();
        // print_r(json_decode($param['data']));
        // die;
        if ($param == null) {
            redirect(base_url('custom404'));
        } else {
            $arrMateri = array_column($param['data'], 'value');
            // $arrMateriName = array_column($param['data'], 'name');
            $myarray = array();
            $fslt = [];
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
                $myarray['fasilitas'] = $am;
                $fslt[] = json_encode($myarray);
            };

            $data = [
                'id' => $param['id'],
                'fasilitas' => json_encode($fslt),
            ];


            $result = $this->m_harga->putFasilitas($data);
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


    //PRIVATE FUNCTION
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

        if ($this->input->post('nama') == '') {
            $data['inputerror'][] = 'nama';
            $data['error_string'][] = 'Nama pelatihan harus diisi!';
            $data['status'] = false;
        }
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
        // if ($this->input->post('pot1')  < 0) {
        //     $data['inputerror'][] = 'pot1';
        //     $data['error_string'][] = 'Potongan untuk pendaftar 2 orang tidak boleh negatif!';
        //     $data['status'] = false;
        // } elseif (strlen((string)$this->input->post('pot1')) > 12) {
        //     $data['inputerror'][] = 'pot1';
        //     $data['error_string'][] = 'Harga potongan 1 melebihi 12 digit!';
        //     $data['status'] = false;
        // }
        // if ($this->input->post('pot2')  < 0) {
        //     $data['inputerror'][] = 'pot2';
        //     $data['error_string'][] = 'Potongan untuk pendaftar 3 orang atau lebih tidak boleh negatif!';
        //     $data['status'] = false;
        // } elseif (strlen((string)$this->input->post('pot2')) > 12) {
        //     $data['inputerror'][] = 'pot2';
        //     $data['error_string'][] = 'Harga potongan 2 melebihi 12 digit!';
        //     $data['status'] = false;
        // }
        if ($this->input->post('start')  == '') {
            $data['inputerror'][] = 'start';
            $data['error_string'][] = 'Tanggal mulai pelaksanaan harus diisi!';
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
            $data['error_string'][] = 'Tanggal berakhir pelaksanaan harus diisi!';
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

        if ($this->input->post('start_daftar')  == '') {
            $data['inputerror'][] = 'start_daftar';
            $data['error_string'][] = 'Tanggal mulai pendaftaranharus diisi!';
            $data['status'] = false;
        } elseif ($edit === null) {
            if (strtotime($this->input->post('start_daftar') . '+ 1 days') < strtotime('now')) {
                $data['inputerror'][] = 'start_daftar';
                $data['error_string'][] = 'Tidak dapat memberikan waktu awal sebelum hari ini!';
                $data['status'] = false;
            }
            if (strtotime($this->input->post('end_daftar')) < strtotime('now')) {
                $data['inputerror'][] = 'end_daftar';
                $data['error_string'][] = 'Tidak dapat memberikan waktu akhir sebelum hari ini!';
                $data['status'] = false;
            }
        }
        if ($this->input->post('end_daftar')  == '') {
            $data['inputerror'][] = 'end_daftar';
            $data['error_string'][] = 'Tanggal berakhir pendaftaran harus diisi!';
            $data['status'] = false;
        } elseif ($this->input->post('end_daftar')  < $this->input->post('start_daftar')) {
            $data['inputerror'][] = 'end_daftar';
            $data['error_string'][] = 'Tidak dapat memberikan tanggal akhir sebelum tanggal mulai!';
            $data['status'] = false;
        } elseif ($edit === null) {
            if (strtotime($this->input->post('start_daftar') . '+ 1 days') < strtotime('now')) {
                $data['inputerror'][] = 'start_daftar';
                $data['error_string'][] = 'Tidak dapat memberikan waktu awal sebelum hari ini!';
                $data['status'] = false;
            }
            if (strtotime($this->input->post('end_daftar')) < strtotime('now')) {
                $data['inputerror'][] = 'end_daftar';
                $data['error_string'][] = 'Tidak dapat memberikan waktu akhir sebelum hari ini!';
                $data['status'] = false;
            }
        }
        if ($this->input->post('status')  == '') {
            $data['inputerror'][] = 'status';
            $data['error_string'][] = 'status pelatihan harus diisi!';
            $data['status'] = false;
        }
        if ($this->input->post('deskripsi')  == '') {
            $data['inputerror'][] = 'deskripsi';
            $data['error_string'][] = 'Deskripsi pelatihan harus diisi!';
            $data['status'] = false;
        }
        if ($this->input->post('lokasi')  == '') {
            $data['inputerror'][] = 'lokasi';
            $data['error_string'][] = 'Lokasi pelatihan harus diisi!';
            $data['status'] = false;
        }
        if ($this->input->post('kontak')  == '') {
            $data['inputerror'][] = 'kontak';
            $data['error_string'][] = 'Kontak penanggung jawab pelatihan harus diisi!';
            $data['status'] = false;
        }

        if ($data['status'] === false) {
            echo json_encode($data);
            exit();
        }
    }
}
