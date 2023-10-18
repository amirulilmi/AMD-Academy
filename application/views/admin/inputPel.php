<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">

        <!-- Form modal tambah pelatihan-->
        <div class="modal" tabindex="-1" id="form" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <!-- <span aria-hidden="true">&times;</span></button> -->
                <h4 class="modal-title">Tambah Program</h4>
                <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="#" id="form-tambah" enctype="multipart/form-data" method="POST">
                <div class="modal-body">

                  <input type="hidden" name="id_pel" id="">
                  <input type="hidden" name="i" id="iP">
                  <div class="form-group">
                    <label for="exampleFormControlInput1">Nama Pelatihan</label>
                    <input type="nama" class="form-control" name='nama' id="nama" placeholder="">
                    <div class="invalid-feedback"></div>
                  </div>
                  <!-- <input type="hidden" name="id_kat" id=""> -->
                  <div class="form-group">
                    <div><label>Kategori Pelatihan</label></div>
                    <div class="input-group mb-3">
                      <span class="input-group-text"><img src="<?= base_url() ?>assets/assets/vector/book.svg" alt=""></span>
                      <select class="form-select form-control" name="nama_pelatihan">
                        <option value="">--pilih--</option>
                        <?php foreach ($kategori as $k) : ?>
                          <option value="<?php echo $k->id ?>"><?php echo $k->kategori ?></option>
                        <?php endforeach; ?>
                      </select>
                      <div class="invalid-feedback"></div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div><label>Tipe Pelatihan</label></div>
                    <div class="form-check" style="margin-left: 15px;">
                      <label for="Online">Online</label>
                      <input class="form-check-input" type="radio" name="tipe" id="online" value="online">
                    </div>
                    <div class="form-check" style="margin-left: 15px;">
                      <label for="Offline">Offline</label>
                      <input class="form-check-input" type="radio" name="tipe" id="offline" value="offline">
                      <div class="invalid-feedback"></div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="">Harga</label>
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="basic-addon1"><img src="<?= base_url() ?>assets/assets/vector/money2.svg" alt=""></span>
                      <input class="form-control" type="number" name="harga" minlength="5" maxlength="12">
                      <div class="invalid-feedback"></div>
                    </div>
                  </div>
                  <!-- <div class="form-group">
                    <div class="row align-items-start">
                      <div class="col">
                        <label for="">Potongan 1</label>
                        <div class="input-group mb-3">
                          <span class="input-group-text"><img src="<?= base_url() ?>assets/assets/vector/discountshape.svg" alt=""></span>
                          <input class="form-control" type="number" name="pot1" minlength="5" maxlength="13">
                          <div class="invalid-feedback"></div>
                        </div>
                      </div>
                      <div class="col">
                        <label for="">Potongan 2</label>
                        <div class="input-group mb-3">
                          <span class="input-group-text"><img src="<?= base_url() ?>assets/assets/vector/discountshape.svg" alt=""></span>
                          <input class="form-control" type="number" name="pot2" minlength="5" maxlength="13">
                          <div class="invalid-feedback"></div>
                        </div>
                      </div>
                    </div>
                  </div> -->
                  <div class="form-group">
                    <div class="row align-items-start">
                      <div class="col">
                        <label for="">Tanggal Mulai Pelaksanaan</label>
                        <div class="input-group mb-3">
                          <span class="input-group-text"><img src="<?= base_url() ?>assets/assets/vector/timer1.svg" alt=""></span>
                          <input class="form-control" type="date" name="start" value="<?php echo date("Y-m-d"); ?>">
                          <div class="invalid-feedback"></div>
                        </div>
                      </div>
                      <div class="col">
                        <label for="">Tanggal Berakhir Pelaksanaan</label>
                        <div class="input-group mb-3">
                          <span class="input-group-text"><img src="<?= base_url() ?>assets/assets/vector/timer1.svg" alt=""></span>
                          <input class="form-control" type="date" name="end">
                          <div class="invalid-feedback"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row align-items-start">
                      <div class="col">
                        <label for="">Tanggal Mulai Pendaftaran</label>
                        <div class="input-group mb-3">
                          <span class="input-group-text"><img src="<?= base_url() ?>assets/assets/vector/timer1.svg" alt=""></span>
                          <input class="form-control" type="date" name="start_daftar" value="<?php echo date("Y-m-d");?>">
                          <div class="invalid-feedback"></div>
                        </div>
                      </div>
                      <div class="col">
                        <label for="">Tanggal Berakhir Pendaftaran</label>
                        <div class="input-group mb-3">
                          <span class="input-group-text"><img src="<?= base_url() ?>assets/assets/vector/timer1.svg" alt=""></span>
                          <input class="form-control" type="date" name="end_daftar">
                          <div class="invalid-feedback"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group col-6">
                    <label for="">Status</label>
                    <div class="input-group mb-3">
                      <span class="input-group-text"><img src="<?= base_url() ?>assets/assets/vector/activity.svg" alt=""></span>
                      <select class="form-select form-control" name="status" id="status">
                        <option value="">--pilih--</option>
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                      </select>
                      <div class="invalid-feedback"></div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3"></textarea>
                    <div class="invalid-feedback"></div>
                  </div>
                  <div class="form-group">
                    <label for="lokasi">Lokasi</label>
                    <textarea class="form-control" name='lokasi' id="lokasi" rows="1"></textarea>
                    <div class="invalid-feedback"></div>
                  </div>
                  <label for="kontak">Kontak</label>
                  <div class="col-auto">
                    <div class="input-group mb-2">
                      <div class="input-group-prepend">
                        <div class="input-group-text">+62</div>
                      </div>
                      <input type="text" class="form-control" name="kontak" id="kontak" placeholder="">
                      <div class="invalid-feedback"></div>
                    </div>
                  </div>
                  <label for="gambar">Gambar</label>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" name="gambar" id="gambar" accept=".jpg, .jpeg, .png">
                    <label class="custom-file-label" for="customFile"></label>
                  </div>

                </div>

                <div class="modal-footer">
                  <button type="button" data-bs-dismiss="modal" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                  <button type="submit" id="btnSimpan" class="btn btn-primary">Simpan</button>
                </div>

              </form>
            </div>
            <!-- /.modal-content -->
          </div>
        </div>

        <!-- DataTables -->
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive" style="margin:10px;">
            <button style="float: left;" type="button" onclick="tambah_pelatihan()" class="btn btn-primary" id="tombol-tambah" data-bs-toggle="modal" data-bs-target="#form">
              <i class="fa fa-lg fa-fw fa-plus" aria-hidden="true"></i>Tambah Pelatihan
            </button>
            <table class="table table-hover table-striped align-middle" id="postsList" style="width: 100%;max-width:100%;">
              <thead class="">
                <tr>
                  <th>#</th>
                  <th>Nama Program</th>
                  <th>Kategori</th>
                  <!-- <th>Tipe</th> -->
                  <th>Harga</th>
                  <!-- <th>Potongan 1</th>
                  <th>Potongan 2</th> -->
                  <th>Mulai Pelaksanaan</th>
                  <th>Akhir Pelaksanaan</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="tbl_data">

              </tbody>
            </table>
            <!-- Paginate -->
            <div class="pagination"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Data Table -->
<script type='text/javascript'>
  var save_method; //for save method string

  $(document).ready(function() {
    table = $('#postsList').DataTable({
      responsive: true,
      ajax: "<?= base_url("Pelatihan/dataPelatihan") ?>",
      columns: [{
          data: 'no'
        },
        {
          data: 'nama_pel'
        },
        {
          data: 'kategori'
        },
        // {
        //   data: 'tipe'
        // },
        {
          data: 'harga'
        },
        // {
        //   data: 'pot1'
        // },
        // {
        //   data: 'pot2'
        // },
        {
          data: 'start'
        },
        {
          data: 'end'
        },
        {
          data: 'status'
        },
        {
          data: 'action'
        },
      ],
    });

    $("input").change(function() {
      $(this).removeClass('is-invalid');
      $(this).next().empty();
    });

    $("select").change(function() {
      $(this).removeClass('is-invalid');
      $(this).next().empty();
    });


  });

  // Modal Edit Pelatihan
  function editPelatihan(id_pel) {
    save_method = 'update';
    $('#form-tambah')[0].reset(); // reset form modal
    $('.form-control').removeClass('is-invalid'); // hapus class error
    $('.form-check-input').removeClass('is-invalid'); // hapus class error
    // $('invalid-feedback').empty(); // hapus pesan error


    $.ajax({
      url: "<?php echo site_url('pelatihan/edit') ?>/" + id_pel,
      type: "POST",
      dataType: "JSON",

      success: function(data) {
        $('[name="nama"]').val(data.nama_pelatihan);
        $('[name="nama_pelatihan"]').val(data.id_kategori);
        $("#" + data.tipe).prop("checked", true);
        $('[name="harga"]').val(data.biaya);
        // $('[name="pot1"]').val(data.pot1);
        // $('[name="pot2"]').val(data.pot2);
        $('[name="start"]').val(data.tanggal_mulai);
        $('[name="end"]').val(data.tanggal_selesai);
        $('[name="start_daftar"]').val(data.tanggal_mulai_pendaftaran);
        $('[name="end_daftar"]').val(data.tanggal_selesai_pendaftaran);
        $('[name="status"]').val(data.status);
        $('[name="id_pel"]').val(data.id_pelatihan);
        $('#form').modal('show'); // Menampilkan modal
        $('.modal-title').text('Edit Program'); // Ubah title modal
      },
      error: function(jqXHR, textStatus, errorThrown) {
        alert('Error get data from ajax');
      }
    });
  }

  function tambah_pelatihan() {
    save_method = 'add';
    $('#form-tambah')[0].reset(); // reset form modal
    $('.form-control').removeClass('is-invalid'); // hapus class error
    $('.form-check-input').removeClass('is-invalid'); // hapus class error

    $('#form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Tambah Pelatihan'); // Ubah title modal
  }

  function simpan() {
    $('#btnSimpan').text('menyimpan...'); // Ubah tombol simpan
    $('#btnSimpan').attr('disabled', true); // Menonaktifkan tombol simpan

    var url;
    // var gambar = new FormData(this);
    if (save_method == 'add') {
      url = "<?php echo base_url('pelatihan/tambahPelatihan') ?>";
    } else {
      url = "<?php echo base_url('pelatihan/editPelatihan') ?>";
    }
    $.ajax({
      url: url,
      type: 'POST',
      dataType: 'JSON',
      data: $('#form-tambah').serialize(),
      success: function(data) {
        if (data.success) {
          $("#form").modal("hide");
          table.ajax.reload();
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            showCloseButton: true,
            timer: 5000,
            timeProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
          });
          Toast.fire({
            icon: 'success',
            title: data.message
          });
        } else {
          for (var i = 0; i < data.inputerror.length; i++) {
            $('[name="' + data.inputerror[i] + '"]').addClass('is-invalid');
            $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]);
          }
        }
        $('#btnSimpan').text('Simpan'); // Ubah tombol simpan
        $('#btnSimpan').attr('disabled', false); // Menonaktifkan tombol simpan 
      },
    });
  }

  // ajax form tambah baru
  $(document).ready(function() {
    $('#form-tambah').submit(function(e) {
      e.preventDefault();
      $.ajax({
        url: '<?php echo base_url('pelatihan/tambahPelatihan') ?>',
        type: "POST",
        data: new FormData(this),
        processData: false,
        contentType: false,
        cache: false,
        async: false,
        success: function(response) {
          $("#form").modal("hide");
          table.ajax.reload();
          if (response.status == 'success') {
            Swal.fire({
              title: 'Data Pelatihan',
              text: 'Berhasil ditambah',
              icon: 'success',
            })

          } else {
            for (var i = 0; i < data.inputerror.length; i++) {
              $('[name="' + data.inputerror[i] + '"]').addClass('is-invalid');
              $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]);
            }
          }
          if (response.status == 'pict') {
            Swal.fire({
              title: 'Gagal',
              text: response.error,
              icon: 'error',
            })
            modal.modal('hide');
            reload();
          }
        }
      });
    });


  });
</script>

<!-- Fungsi Hapus -->
<script>
  function deleteConfirm(event) {
    Swal.fire({
      title: 'Konfirmasi Hapus Data!',
      text: 'Yakin ingin menghapus data ini?',
      icon: 'warning',
      showCancelButton: true,
      cancelButtonText: 'Tidak',
      confirmButtonText: 'Ya, Hapus',
      confirmButtonColor: 'red'
    }).then(dialog => {
      if (dialog.isConfirmed) {
        $.ajax({
          url: event.dataset.deleteUrl,
          type: 'GET',
          dataType: "JSON",
          error: function() {
            alert('Terjadi Kesalahan');
          },
          success: function(data) {
            if (data.success) {
              table.ajax.reload();
              const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                showCloseButton: true,
                timer: 5000,
                timeProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener('mouseenter', Swal.stopTimer)
                  toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
              })
              Toast.fire({
                icon: 'success',
                title: data.message
              });
            } else alert('Something is GJ')
          }
        })
      }
    })
  }
</script>