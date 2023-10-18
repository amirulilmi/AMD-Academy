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
              <form action="#" id="form-tambah">
                <div class="modal-body">

                  <input type="hidden" name="id" id="">
                  <!-- <input type="hidden" name="id_kat" id=""> -->
                  <div class="form-group">
                    <label for="">Nama Kategori</label>
                    <div class="input-group mb-3">
                      <!-- <span class="input-group-text" id="basic-addon1"><img src="<?= base_url() ?>assets/assets/vector/money2.svg" alt=""></span> -->
                      <input class="form-control" type="text" name="kategori">
                      <div class="invalid-feedback"></div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="">Deskripsi</label>
                    <div class="input-group mb-3">
                      <!-- <span class="input-group-text" id="basic-addon1"><img src="<?= base_url() ?>assets/assets/vector/money2.svg" alt=""></span> -->
                      <!-- <input class="form-control" type="text" name="pelatihan"> -->
                      <textarea class="form-control" name="pelatihan" id="pelatihan" rows="3"></textarea>
                      <div class="invalid-feedback"></div>
                    </div>
                  </div>
                  <!-- <div class="form-group">
                    <label for="">Created at</label>
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="basic-addon1"><img src="<?= base_url() ?>assets/assets/vector/money2.svg" alt=""></span>
                      <input class="form-control" type="hidden" name="create" value="<?php echo date("Y-m-d"); ?>" readonly>
                      <div class="invalid-feedback"></div>
                    </div>
                  </div> 
                  <div class="form-group">
                    <label for="">Updated at</label>
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="basic-addon1"><img src="<?= base_url() ?>assets/assets/vector/money2.svg" alt=""></span>
                      <input class="form-control" type="hidden" name="update" value="<?php echo date("Y-m-d"); ?>" readonly>
                      <div class="invalid-feedback"></div>
                    </div>
                  </div>          -->
                </div>

                <div class="modal-footer">
                  <button type="button" data-bs-dismiss="modal" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                  <button type="submit" onclick="simpan()" id="btnSimpan" class="btn btn-primary">Simpan</button>
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
              <i class="fa fa-lg fa-fw fa-plus" aria-hidden="true"></i>Tambah Kategori
            </button>
            <table class="table table-hover table-striped align-middle" id="postsList" style="width: 100%;max-width:100%;">
              <thead class="">
                <tr>
                  <th>#</th>
                  <th>Nama Kategori</th>
                  <th>Deskripsi</th>
                  <th>Pembuatan</th>
                  <th>Perubahan</th>
                  <th>Status</th>
                  <th>Aksi</th>
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
      ajax: "<?= base_url("PelatihanKategori/dataPelatihanKategori") ?>",
      columns: [{
          data: 'no'
        },
        {
          data: 'nama_kat'
        },
        {
          data: 'nama_pel'
        },
        {
          data: 'create_at'
        },
        {
          data: 'update_at'
        },
        {
          data: 'status'
        },
        {
          data: 'aksi'
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
  function editPelatihan(id) {
    save_method = 'update';
    $('#form-tambah')[0].reset(); // reset form modal
    $('.form-control').removeClass('is-invalid'); // hapus class error
    $('.form-check-input').removeClass('is-invalid'); // hapus class error
    // $('invalid-feedback').empty(); // hapus pesan error


    $.ajax({
      url: "<?php echo site_url('PelatihanKategori/edit') ?>/" + id,
      type: "POST",
      dataType: "JSON",

      success: function(data) {
        $('[name="id"]').val(data.id);
        $('[name="kategori"]').val(data.kategori);
        $('[name="pelatihan"]').val(data.uraian);
        $('[name="create"]').val(data.created_at);
        $('[name="update"]').val(data.updated_at);

        $('#form').modal('show'); // Menampilkan modal
        $('.modal-title').text('Edit Kategori Pelatihan'); // Ubah title modal
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
    $('.modal-title').text('Tambah Kategori Pelatihan'); // Ubah title modal
  }

  function simpan() {
    $('#btnSimpan').text('menyimpan...'); // Ubah tombol simpan
    $('#btnSimpan').attr('disabled', true); // Menonaktifkan tombol simpan

    var url;
    if (save_method == 'add') {
      url = "<?php echo base_url('PelatihanKategori/tambahPelatihanKategori') ?>";
    } else {
      url = "<?php echo base_url('PelatihanKategori/editPelatihanKategori') ?>";
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
            } else {
              table.ajax.reload();
              const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                showCloseButton: true,
                timeProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener('mouseenter', Swal.stopTimer)
                  toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
              })
              Toast.fire({
                icon: 'warning',
                title: data.message
              });
            }
          }
        })
      }
    })
  }
</script>