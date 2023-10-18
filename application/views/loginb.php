<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | AMD</title>
  <link id="pagestyle" href="<?php echo base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet" />
  <script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="<?php echo base_url() ?>assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- <style>
    body {
      font-family: Poppins;
    }

    h2 {
      top: 20px;
    }

    button.btn.login {
      color: white;
      background-color: #1089C0;
      font-size: 16px;
    }

    button.btn.login:hover {
      background-color: #0F345E;
    }
  </style> -->
  <style>
    .container-fluid {
      margin-top: 150px;
    }

    .blok {
      width: 71%;
      height: 12px;
      background-color: #6BD1FF;
      z-index: -1;
      left: 0px;
      right: 0px;
      top: 31px;
      margin: auto;
    }

    img {
      width: 855px;
    }

    .card {
      width: 540px;
      padding-top: 50px;
      padding-bottom: 70px;
      margin-top: -80px;
    }

    .card-body {
      padding: 35px;
    }

    .card-body form input {
      width: 100%;
      font-size: 14px;
    }

    .card-body form input {
      border-radius: 10px;
    }

    .card-body form button {
      border-radius: 10px;
    }

    .box {
      background-color: salmon;
      width: 100px;
      height: 100px;
    }
  </style>
</head>

<body style="font-family: 'Poppins';">

  <div class="container-fluid">
    <div class="main d-flex">
      <div class="text-center position-relative d-lg-block d-none">
        <div class="blok position-absolute"></div>
        <h1 class="fw-bold" style="font-size: 36px;">Improve your Digital Skill with us</h1>
        <p>Raih karir sebagai talenta digital melalui program yang kami sediakan</p>
        <img class="img-fluid" src="<?= base_url() ?>assets/assets/img/login/jum.svg" alt="jumbotron">
      </div>
      <div class="card mx-auto">
        <div class="card-body">
          <p style="font-size: 21px;">Welcome to <a href="<?= base_url() ?>" style="color: #1089C0; font-weight: 600; text-decoration: none;">AMD Academy</a></p>
          <h2 style="font-size: 55px; font-weight: 500;">Login</h2>
          <form method="POST" action="<?= base_url('auth') ?>">
            <div><?= $this->session->flashdata('message'); ?></div>
            <label for="username" class="form-label mt-4">Enter your Username</label>
            <input type="text" class="form-control py-3 px-3 my-1" id="username" name="username" placeholder="Username">
            <div><?= form_error('username', '<small class="text-danger ps-3">', '</small>') ?></div>
            <label for="password" class="form-label mt-4">Enter your Password</label>

            <div class="input-group">
              <input type="password" class="form-control py-3 px-3" name="password" id="password" placeholder="Password" />
              <button class="btn btn-outline-secondary" style="text-decoration: none; border-color: #ADADAD;" type="button" id="btnPw" onclick="change()">
                <i class="fa fa-eye fa-lg"></i>
              </button>
            </div>
            <div><?= form_error('password', '<small class="text-danger ps-3">', '</small>') ?></div>
            <!-- <a href="<?= base_url('auth/forgot') ?>" class="d-block my-1 ms-auto text-end" style="font-size: 13px; text-decoration: none;">Forgot Password?</a> -->
            <button class="btn text-white w-100 py-3 px-3 mt-4" type="submit" style="background-color: #1089C0;">Login</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>




<!-- <div class="container">
    <div class="row mt-5">
      <div class="col-md-7 position-relative d-none d-md-block" style="margin-top: 100px;">
        <div class="block mt-5 ms-4" style="background-color: #6BD1FF ; height: 15px; width: 600px;"></div>
        <h2 class="ps-4 fw-bold position-absolute" style="font-size: 36px;">Improve your Digital Skill with us</h2>
        <p class="mt-2 mb-4 ms-5" style="font-size: 16px;">Raih karir sebagai talenta digital melalui program yang kami sediakan</p>
        <img class="img d-none d-md-block img-fluid" src="<?= base_url() ?>assets/assets/img/login/jum.svg" width="760px" alt="">
      </div>


      <div class="col-md-5">
        <div class="card mt-2 w-auto shadow-lg" style="height: 740px;">
          <div class="mx-auto my-auto">
            <p class="" style="font-size: 21px;">Welcome to <span style="color:#1089C0;">AMD Academy</span></p>
            <h1 class="mb-5" style="font-size: 55px;">Login</h1>
            <form class="user" method="POST" action="<?= base_url('auth') ?>">
              <div><?= $this->session->flashdata('message'); ?></div>
              <label class="mb-2" style="font-size: 16px;" for="username">Enter your Username</label>
              <div class="mb-4">
                <input class="rounded-3 ps-3 py-3" type="text" id="username" name="username" style="font-size: 14px; width: 100%;" placeholder="username" value="<?= set_value('username'); ?>">
                <div><?= form_error('username', '<small class="text-danger ps-3">', '</small>') ?></div>
              </div>
              <label class="mb-2" style="font-size: 16px;" for="password">Enter your Password</label>
              <div class="input-group">
                <input class="form-control rounded-3 ps-3 py-3" type="password" id="password" name="password" style="font-size: 14px; width: 450px;" placeholder="password">
                <div><?= form_error('password', '<small class="text-danger ps-3">', '</small>') ?></div>
              </div> 
              <div class="input-group">
                <input class="form-control rounded-3 ps-3 py-3" type="password" id="password" name="password" style="font-size: 14px; width: 450px;" placeholder="password">
                <button class="btn btn-outline-secondary" type="button" id="btnPw" onclick="change()">
                  <i class="fa fa-eye fa-lg"></i>
                </button>
              </div>
              <div><?= form_error('password', '<small class="text-danger ps-3">', '</small>') ?></div>

              <div class="text-end mb-5 mt-2">
                <a href="<?= base_url('auth/forgot') ?>" style="color: #4285F4; text-decoration: none;">Forgot Password?</a>
                <?= base_url('auth/registration') ?>" style="color: #4285F4; text-decoration: none;">Register</a>
              </div>
              <button type="submit" class="btn login py-3 w-100 rounded-3">Login</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div> -->
<script type="text/javascript">
  function change() {
    var x = document.getElementById('password').type;
    if (x == 'password') {
      document.getElementById('password').type = 'text';

      document.getElementById('btnPw').innerHTML = '<i class="fa fa-eye-slash fa-lg"></i>'
    } else {
      document.getElementById('password').type = 'password';

      document.getElementById('btnPw').innerHTML = '<i class="fa fa-eye fa-lg"></i>';
    }
  }
</script>