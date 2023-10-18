<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

  <div class="navbar navbar-main navbar-expand-lg px-0 mx-0  shadow-none" id="navbarBlur" navbar-scroll="true" style="flex-direction:column; align-items:flex-start; ">
    <a id="edit-profile" type='submit' href="<?= base_url('user/profile') ?>">
      <img src="<?= base_url() ?>assets/assets/img/profile/cog.svg" style="margin-right: 3px;">
      <h6 class="" style="margin-top:4px;color:white;">Edit Profil</h6>
    </a>
    <div id="profile" style="position:absolute; display:flex;align-items:center">
      <img src="data:image/jpg;base64,<?php echo $user['gambar']; ?>" class="img-circle" style="margin-left:25px">
      <div style="margin-left: 21px;">
        <h3 style="color:white;"><?= $user['name'] ?></h3>
        <h6><?= $user['email'] ?></h6>
      </div>
    </div>
  </div>

  <div class="cardContainer text-white">
    <div style="background-color: #92D248;" class="cardDashboard">
      <div class="subCardDash">
        <img src="<?= base_url() ?>assets/assets/img/profile/1.svg">
        <p style="display: inline;"><?= $isi1 ?></p>
        <p><?= $titleCard1 ?></p>
      </div>
      <div style="position:absolute;right:0px;top:0px">
        <img src="<?= base_url() ?>assets/assets/img/profile/book.svg" style="transform: rotate(-10deg);">

      </div>
    </div>
    <div style="background-color: #5097FF;" class="cardDashboard">
      <div class="subCardDash">
        <img src="<?= base_url() ?>assets/assets/img/profile/2.svg">
        <p style="display: inline;"><?= $isi2 ?></p>
        <p><?= $titleCard2 ?></p>
      </div>
      <div style="position:absolute;right:0px;top:0px">
        <img src="<?= base_url() ?>assets/assets/img/profile/award.svg" style="transform: rotate(-10deg);">

      </div>
    </div>
    <div style="background-color: #FEC23E;" class="cardDashboard">
      <div class="subCardDash">
        <img src="<?= base_url() ?>assets/assets/img/profile/3.svg">
        <p style="display: inline;"><?= $isi3 ?></p>
        <p><?= $titleCard3 ?></p>
      </div>
      <div style="position:absolute;right:0px;top:0px">
        <img src="<?= base_url() ?>assets/assets/img/profile/teacher.svg" style="transform: rotate(-10deg);">

      </div>
    </div>
  </div>
  <?php if($user['user_group_id']!=1){ ?>
  <h4>Program Yang Diikuti:</h4>
  <div class="row">
          <?php foreach ($listDaftar as $p) : ?>
            <div class="card w-auto m-3">
              <div class="labelTipe">Pelatihan <?= $p['tipe'] ?></div>
              <img class="card-img-top w-100" alt="..." src="<?php echo base_url('assets/assets/img/program/dm.svg') ?>">
              <div class="card-body">
                <h5 class="card-title" style="font-bold:bold"><?= $p['kategori'] ?> : </h5>
                <h5 class="card-title"><?= $p['nama_pelatihan'] ?></h5>
                <small class="card-text"><?= date(' j F Y', strtotime($p['tanggal_mulai'])) . " - " . date('j F Y', strtotime($p['tanggal_selesai'])) ?></small>
              </div>
            </div>

      <?php endforeach; ?>
          <?php } ?>

        </div>

  <script>
    $(document).ready(function() {
      table = $('#listPeserta').DataTable({
        responsive: true,

        ajax: "<?= base_url("Dashboard/dataPeserta") ?>",
        columns: [{
            data: 'no'
          },
          {
            data: 'nama'
          },
          {
            data: 'email'
          },
          {
            data: 'no_hp'
          },
          {
            data: 'alamat'
          },
          {
            data: 'instansi'
          },
          {
            data: 'active'
          },
          {
            data: 'wa'
          },
        ],
      });

      $(document).off('click', '.kirimWA');
      $(document).on('click', '.kirimWA', function(e) {
        e.preventDefault();
        var data = $(this).attr('id');
        // console.log(data);
        $.ajax({
          type: "POST",
          url: "dashboard/kirimWA",
          data: {
            id: data
          },
          dataType: "json",
          success: function(data) {
            if (data.success) {
              $('#listPeserta').DataTable().ajax.reload();
              // location.reload();
              // $(this).prop('disabled', true);
              // $(this).removeClass('btn-success');
              // $(this).addClass('btn-secondary');
              Swal.fire({
                // position: 'top-end',
                icon: "success",
                title: data.message,
                // text: 'Data akan diubah otomatis oleh Midtrans',
                showConfirmButton: false,
                timer: 3000,
              });

            } else {
              Swal.fire({
                // position: 'top-end',
                icon: "error",
                title: data.message,
                text: 'Coba periksa koneksi internet anda',
                showConfirmButton: false,
                timer: 3000,
              });
            }
          }
        });

      });


    });

    function changeStatus(id, is_active) {


      if (is_active == 1) {
        // $(this).prop("checked", false)
        var checkPosition = 0;
        console.log('cek okeee')
      } else {
        var checkPosition = 1;
      }

      var id = id;
      $.ajax({
          url: "<?= base_url() ?>dashboard/changeStatus",
          method: "POST",
          data: {
            checkPosition: checkPosition,
            id: id,
          },
          success: function(data) {
            $('#listPeserta').DataTable().ajax.reload();
          },
        }


      );
    };

    $(document).on('click', '.noWA', function(e) {
      e.preventDefault();
      Swal.fire({
        icon: "error",
        title: 'Gagal Kirim WA',
        text: 'Pengiriman dibatalkan, peserta belum terdaftar di salah satu program',
        showConfirmButton: false,
        timer: 3000,
      });
    });


    // (document).on('click', '#aktifWA', function(e) {
    //   e.preventDefault();
    //   if ($(this).checked) {
    //     $(this).prop('checked', false);
    //     $('#coba').removeAttr('disabled');
    //   } else {
    //     $(this).prop('checked', true);
    //     $('#coba').attr('disabled', 'disabled');
    //   }
    // });
  </script>