<?php

function viewUser($c_name, $content, $data)
{
    $c_name->load->view('user/templates/header', $data);
    $c_name->load->view('user/templates/navbar', $data);
    $c_name->load->view($content, $data);
    $c_name->load->view('user/templates/footer', $data);
}

function viewAdmin($c_name, $content, $data)
{
    $c_name->load->view('templates/sidebar', $data);
    $c_name->load->view('templates/navbar', $data);
    $c_name->load->view($content, $data);
    $c_name->load->view('templates/footer', $data);
}

function rulesForm()
{
    return [
        [
            'field' => 'instansi',
            'label' => 'instansi',
            'rules' => 'required|max_length[100]'
        ],
        [
            'field' => 'nama',
            'label' => 'Nama',
            'rules' => 'required|max_length[100]|min_length[3]'
        ],
        [
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|valid_email|max_length[100]'
        ],
        [
            'field' => 'alamat',
            'label' => 'Alamat',
            'rules' => 'required|max_length[255]'
        ],
        [
            'field' => 'no_hp',
            'label' => 'Nomor Telepon',
            'rules' => 'required|max_length[15]|min_length[10]'
        ],



    ];
}

function rulesBayar()
{
    return [
        [
            'field' => 'bukti',
            'label' => 'bukti bayar',
            'rules' => 'required'
        ],
    ];
}

// function rulesMateri()
// {
//     return [
//         [
//             'field' => 'judul',
//             'label' => 'Judul',
//             'rules' => 'required|max_length[100]'
//         ],
//         [
//             'field' => 'kategori',
//             'label' => 'Kategori',
//             'rules' => 'required'
//         ],
//         [
//             'field' => 'tipe',
//             'label' => 'Tipe',
//             'rules' => 'required'
//         ],
//         [
//             'field' => 'link',
//             'label' => 'Link materi',
//             'rules' => 'required'
//         ],
//     ];
// }

function unlinkFile($filename)
{
    // try to use real path
    if (realpath($filename) && realpath($filename) !== $filename) {
        return is_writable($filename) && @unlink(realpath($filename));
    } else {
        return false;
    }
}

function rulesTrainer()
{
    return [
        [
            'field' => 'nama',
            'label' => 'Nama',
            'rules' => 'required|max_length[100]'
        ],
        [
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|valid_email|max_length[100]'
        ],
        [
            'field' => 'alamat',
            'label' => 'Alamat',
            'rules' => 'required|max_length[255]'
        ],
        [
            'field' => 'telepon',
            'label' => 'Nomor Telepon',
            'rules' => 'required|max_length[15]|min_length[10]'
        ],
        [
            'field' => 'linkedin',
            'label' => 'URL Linkedin',
            'rules' => 'required'
        ],
        [
            'field' => 'bidang',
            'label' => 'Bidang keahlian',
            'rules' => 'required'
        ],
        [
            'field' => 'profesi',
            'label' => 'Profesi',
            'rules' => 'required'
        ],
    ];
}

function valid_url($url)
{
    $regex = "((https?|ftp)\:\/\/)?";
    $regex .= "([a-z0-9+!*(),;?&=\$_.-]+(\:[a-z0-9+!*(),;?&=\$_.-]+)?@)?";
    $regex .= "([a-z0-9-.]*)\.([a-z]{2,3})";
    $regex .= "(\:[0-9]{2,5})?";
    $regex .= "(\/([a-z0-9+\$_-]\.?)+)*\/?";
    $regex .= "(\?[a-z+&\$_.-][a-z0-9;:@&%=+\/\$_.-]*)?";
    $regex .= "(#[a-z_.-][a-z0-9+\$_.-]*)?";

    if (preg_match("/^$regex$/i", $url)) {
        return true;
    }

    return false;
}

function callAPI($method, $url, $data, $headers = false)
{
    $curl = curl_init();
    switch ($method) {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);
            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }
    // OPTIONS:
    curl_setopt($curl, CURLOPT_URL, $url);
    if (!$headers) {
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
        ));
    } else {
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            $headers
        ));
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    // EXECUTE:
    $result = curl_exec($curl);
    //Get status code
    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if (!$result) {
        $result = "Connection Failure";
        $status = 502;
    }
    curl_close($curl);
    return [
        'result' => $result,
        'status' => $status
    ];
}

function inisial($kalimat)
{
    $words = explode(" ", $kalimat);
    $acronym = "";

    foreach ($words as $w) {
        $acronym .= mb_substr($w, 0, 1);
    }
    return $acronym;
}

function kodeMember($urutan)
{
    $tahun = date('y');
    $bulan = date('m');
    $no_urut = sprintf('%04s', $urutan);
    return 'AMD' . $tahun . $bulan . '-' . $no_urut;
}


function default_profil()
{
    $default_profil =  "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";
    return $default_profil;
}
