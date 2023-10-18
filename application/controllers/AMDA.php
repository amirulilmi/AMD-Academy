<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class AMDA extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('c_helper');
        $this->load->model('M_Pelatihan', 'm_pelatihan');
        $this->load->model('M_Trainer', 'm_trainer');
    }

    public function index()
    {
        $data['pelatihan'] =  $this->m_pelatihan->getPelatihan2();
        $data['allKategori'] = $this->m_pelatihan->getKategoriNav();
        $data['title'] = 'AMD Academy';
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
        viewUser($this, 'user/home', $data);
    }

    public function pelatihan($id = null)
    {
        $data['id'] = $id; //id kategori

        $data['pelatihan'] = $this->m_pelatihan->getPelatihanBy($id);
        $data['allKategori'] = $this->m_pelatihan->getKategoriNav();
        $data['title'] = 'AMD Academy';
        $data['kategori'] = $this->m_pelatihan->getKategoriBy($id);
    
        viewUser($this, 'user/pelatihan', $data);
    }
    public function deskripsi($id)
    {
        $active = 1;
        $getPelatihanOffline = $this->m_pelatihan->getPelatihan($id, 'Offline', $active)['result'];
        $getPelatihanOnline = $this->m_pelatihan->getPelatihan($id, 'Online', $active)['result'];

        $data['pelOffline'] = $getPelatihanOffline;
        $data['pelOnline'] = $getPelatihanOnline;

        $cek = $this->m_pelatihan->cekPelatihan2($id);
        if (empty($cek)) {
            redirect(base_url('Custom404'));
        } else {
            $data['id_pel'] = $id;
            $data['pelatihan'] = $this->m_pelatihan->getPelatihanFull($id);
            $data['pelatihan_trainer'] =  $this->m_pelatihan->getPelatihanTrainer($id);
            $data['kategori'] = $this->m_pelatihan->getKategoriFull($id);
            $data['allKategori'] = $this->m_pelatihan->getKategoriNav();
            $data['title'] = 'AMD Academy';

            viewUser($this, 'user/deskripsi', $data);
        }
    }
}
