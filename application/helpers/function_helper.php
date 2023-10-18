<?php

$ci = &get_instance();
function getAllKecamatan($keyword = null)
{
  $ci = &get_instance();
  $query = $ci->db->query("SELECT kec.id as kode_kec, CONCAT_WS(' - ',kec.name, kab.name, prov.name) as nama_kec FROM districts kec
    LEFT JOIN regencies kab ON kab.id=kec.regency_id
    LEFT JOIN provinces prov ON prov.id=kab.province_id
    WHERE kec.name LIKE '%$keyword%'")->result_array();
  return $query;
}

function getKecKabProv($kode_kecamatan = null)
{
  $ci = &get_instance();
  $query = $ci->db->query("SELECT kec.id as kode_kec, CONCAT_WS(' - ',kec.name, kab.name, prov.name) as nama_kec FROM districts kec
    LEFT JOIN regencies kab ON kab.id=kec.regency_id
    LEFT JOIN provinces prov ON prov.id=kab.province_id
    WHERE kec.id=?", $kode_kecamatan)->row_array();
  return $query;
}

function getKecamatan($kode_kecamatan = null)
{
  $ci = &get_instance();
  $query = null;
  if ($kode_kecamatan) {
    $query = $ci->db->get_where('districts', array('id' => $kode_kecamatan))->row_array();
  } else {
    $query = $ci->db->get_where('districts')->result_array();
  }
  return $query;
}

function getKabupatenKota($kode_kabupaten = null)
{
  $ci = &get_instance();
  $query = null;
  if ($kode_kabupaten) {
    $query = $ci->db->get_where('regencies', array('id' => $kode_kabupaten))->row_array();
  } else {
    $query = $ci->db->get_where('regencies')->result_array();
  }
  return $query;
}

function getTahunPWMP($iscurrent = null)
{
  $ci = &get_instance();
  $query = null;
  if ($iscurrent == '1') {
    $query = $ci->db->get_where('ref_tahun', array('is_active' => '1', 'is_current' => '1'))->row_array();
  } else {
    $query = $ci->db->get_where('ref_tahun', array('is_active' => '1'))->result_array();
  }
  return $query;
}


function randomPassword()
{
  $alphabet = 'abcdefghijklmnopqrstuvwxyz1234567890';
  $pass = array();
  $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
  for ($i = 0; $i < 8; $i++) {
    $n = rand(0, $alphaLength);
    $pass[] = $alphabet[$n];
  }
  return implode($pass); //turn the array into a string
}

function randomPassword_number()
{
  $alphabet = '1234567890';
  $pass = array(); //remember to declare $pass as an array
  $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
  for ($i = 0; $i < 8; $i++) {
    $n = rand(0, $alphaLength);
    $pass[] = $alphabet[$n];
  }
  return implode($pass); //turn the array into a string
}

function getUUID()
{
  $ci = &get_instance();
  $result = $ci->db->query("SELECT UUID()")->row_array()['UUID()'];
  return $result;
}

function ceknik($nik)
{
  $return['pesan'] = '';
  $return['status'] = false;
  $ci = &get_instance();
  if (strlen($nik) != 16) {
    $return['pesan'] = 'NIK Harus 16 Digit';
    $return['status'] = false;
  } else {
    $return['pesan'] = '';
    $return['status'] = true;
  }
  return $return;
}

function getRefPersyaratan($member_type, $param)
{
  $ci = &get_instance();
  $ref = $ci->db->where(['member_type' => $member_type, 'nama_syarat' => $param])->get('ref_persyaratan');
  if ($ref->num_rows() != 0) {
    return $ref->result()[0];
  } else {
    return null;
  }
}

function isPDF($param)
{
  $file = 'gambar';
  $panjang =  strlen($param);
  if (strpos($param, '.pdf')) {
    $file = 'pdf';
  }
  return $file;
}

function tampil_sebagian($param, $panjang)
{
  //$panjang = strlen($param);
  $tampil = substr($param, 0, $panjang);
  return $tampil;
}

function tgl_indo($param)
{
  $tanggal = date('Y-m-d', strtotime($param));
  $bulan = array(
    1 =>   'Januari',
    'Februari',
    'Maret',
    'April',
    'Mei',
    'Juni',
    'Juli',
    'Agustus',
    'September',
    'Oktober',
    'November',
    'Desember'
  );
  $pecahkan = explode('-', $tanggal);

  // variabel pecahkan 0 = tahun
  // variabel pecahkan 1 = bulan
  // variabel pecahkan 2 = tanggal

  return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}


function getStatusPO($param)
{
  $status = '';
  if ($param == '0') {
    $status = 'Belum disetujui';
  } elseif ($param == '1') {
    $status = 'Disetujui';
  } elseif ($param == '2') {
    $status = 'Dikirim';
  }
  return $status;
}

function getStatusPOFormat($param)
{
  $status = '';
  if ($param == '0') {
    $status = "<span class='text-danger'>Belum disetujui</span>";
  } elseif ($param == '1') {
    $status = "<span class='text-success'>Disetujui</span>";
  } elseif ($param == '2') {
    $status = "<span class='text-success'>Dikirim</span>";
  }
  return $status;
}

function active_page($page, $class)
{
  $_this = &get_instance();
  if ($page == $_this->uri->segment(1)) {
    return $class;
  }
}
function is_active_page($page, $class)
{
  $_this = &get_instance();
  if ($page == $_this->uri->segment(1) || $page == $_this->uri->segment(2)) {
    return $class;
  }
}
function active_subpage($pages)
{
  $_this = &get_instance();
  $active = '';

  if ((count($pages) == 1 && $pages[0] == $_this->uri->segment(1)) && $_this->uri->segment(2) == null) {
    $active = 'active';
  } else {
    foreach ($pages as $key => $page) {
      if ($page == $_this->uri->segment($key + 1) && count($pages) > 1) {
        $active = 'active';
      } else {
        $active = '';
      }
    }
  }

  return $active;
}

function getInitial($name)
{
  if (!isset($name)) {
    return "HK";
  }

  $str_arr = explode(' ', $name);
  $count = str_word_count($name);

  if ($count == 1) {
    return strtoupper(substr($name, 0, 2));
  } else {
    return strtoupper(substr($str_arr[0], 0, 1) . substr($str_arr[1], 0, 1));
  }
}

function activeYear()
{
  $ci = &get_instance();
  $get = $ci->db->query("SELECT * FROM ref_tahun where is_current='1'");
  $return = ($get->num_rows() != 0) ? $get->row_array()['tahun'] : null;
  return $return;
}

function getDayName($day_of_week)
{
  switch ($day_of_week) {
    case 1:
      return 'Senin';
      break;

    case 2:
      return 'Selasa';
      break;

    case 3:
      return 'Rabu';
      break;

    case 4:
      return 'Kamis';
      break;

    case 5:
      return 'Jumat';
      break;

    case 6:
      return 'Sabtu';
      break;

    case 0:
      return 'Minggu';
      break;

    default:
      return 'Senin';
      break;
  }
}

function getMonthName($month)
{
  switch ($month) {
    case 1:
      return 'Januari';
      break;

    case 2:
      return 'Februari';
      break;

    case 3:
      return 'Maret';
      break;

    case 4:
      return 'April';
      break;

    case 5:
      return 'Mei';
      break;

    case 6:
      return 'Juni';
      break;

    case 7:
      return 'Juli';
      break;

    case 8:
      return 'Agustus';
      break;

    case 9:
      return 'September';
      break;

    case 10:
      return 'Oktober';
      break;

    case 11:
      return 'November';
      break;

    case 12:
      return 'Desember';
      break;

    default:
      # code...
      break;
  }
}

function parseTanggal($date)
{
  date_default_timezone_set('Asia/Jakarta');
  $day_name = getDayName(date('w', strtotime($date)));
  $day = date('d', strtotime($date));
  $month = getMonthName(date('m', strtotime($date)));
  $year = date('Y', strtotime($date));
  return "$day_name, $day $month $year";
}

function isPendaftar()
{
  $ci = &get_instance();
  $ci->load->model('M_auth', 'auth');
  $result = $ci->auth->getIdGroup($ci->session->intern_userId);
  if ($result->row()->id_group == 2) return TRUE;
  else return FALSE;
}

function isCalonKaryawan()
{
  $ci = &get_instance();
  $ci->load->model('M_member', 'member');
  $result = $ci->member->getJabatan($ci->session->intern_userId);
  if ($result->row()->jabatan == 'calon_karyawan') return TRUE;
  else return FALSE;
}

function isCalonIntern()
{
  $ci = &get_instance();
  $ci->load->model('M_member', 'member');
  $result = $ci->member->getJabatan($ci->session->intern_userId);
  if ($result->row()->jabatan == 'calon_intern') return TRUE;
  else return FALSE;
}

function isBelumLengkap()
{
  $ci = &get_instance();
  $ci->load->model('M_member', 'member');
  $result = $ci->member->getJabatan($ci->session->intern_userId);
  if ($result->row()->jabatan == 'pendaftar') return TRUE;
  else return FALSE;
}

function gen_uuid()
{
  return sprintf(
    '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
    // 32 bits for "time_low"
    mt_rand(0, 0xffff),
    mt_rand(0, 0xffff),

    // 16 bits for "time_mid"
    mt_rand(0, 0xffff),

    // 16 bits for "time_hi_and_version",
    // four most significant bits holds version number 4
    mt_rand(0, 0x0fff) | 0x4000,

    // 16 bits, 8 bits for "clk_seq_hi_res",
    // 8 bits for "clk_seq_low",
    // two most significant bits holds zero and one for variant DCE1.1
    mt_rand(0, 0x3fff) | 0x8000,

    // 48 bits for "node"
    mt_rand(0, 0xffff),
    mt_rand(0, 0xffff),
    mt_rand(0, 0xffff)
  );
}

function uploadFile($name)
{
  $ci = &get_instance();
  $file_name = $_FILES[$name]['name'];
  $path = '/public/uploads/pendaftar/documents/';
  $config['upload_path']          = FCPATH . $path;
  $config['allowed_types']        = 'gif|jpg|jpeg|png|pdf|docx|doc';
  $config['encrypt_name']         = true;
  $config['file_name']            = $file_name;
  $config['overwrite']            = true;
  $config['max_size']             = 1024; // 1MB
  /*  $config['max_width']            = 1080;
        $config['max_height']           = 1080; */
  $ci->load->library('upload', $config);

  // if (isset($_FILES[$name]['name']) && $_FILES[$name]['name'] != "") {
  if (!$ci->upload->do_upload($name)) {
    $data['error'] = $ci->upload->display_errors();
    // return $data['error'];
    $uploaded_data['file_name'] = "";
  } else {
    $uploaded_data = $ci->upload->data();
  }
  $finalFileName =  $path . $uploaded_data['file_name'];
  // return $name;
  return $finalFileName;

  // }
  // return null;
}
