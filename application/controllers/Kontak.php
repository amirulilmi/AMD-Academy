<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kontak extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('c_helper');
        $this->load->model('M_Pelatihan', 'm_pelatihan');
        // $this->load->model('M_Trainer', 'm_trainer');
    }
    public function index()
    {
        $data['allKategori'] = $this->m_pelatihan->getKategori()['result'];
        // $data['inisial'] = $inisial;
        $data['title'] = 'AMD Academy';
        viewUser($this, 'kontak', $data);
    }
}
