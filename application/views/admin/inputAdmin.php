<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">

        <!-- Form modal tambah admin-->
        <div class="modal" tabindex="-1" id="form" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <!-- <span aria-hidden="true">&times;</span></button> -->
                <h4 class="modal-title">Tambah Admin</h4>
                <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="#" id="form-tambah">
                <div class="modal-body">
                  <div class="form-group">
                    <label for="">ID User</label>
                    <input class="form-control" type="text" name="id_user" readonly>
                    <div class="invalid-feedback"></div>
                  </div>
                  <div class="form-group">
                    <label for="">ID Admin</label>
                    <input class="form-control" type="text" name="id_admin" readonly>
                    <div class="invalid-feedback"></div>
                  </div>
                  <div class="form-group">
                    <label for="">Nama</label>
                    <input class="form-control" type="text" name="nama">
                    <div class="invalid-feedback"></div>
                  </div>
                  <div class="form-group">
                    <label for="">Username</label>
                    <input class="form-control" type="text" name="username">
                    <div class="invalid-feedback"></div>
                  </div>
                  <div class="form-group">
                    <label for="">Email</label>
                    <input class="form-control" type="text" name="email">
                    <div class="invalid-feedback"></div>
                  </div>
                  <div class="form-group col-4">
                    <label for="">Status</label>
                    <select class="form-select form-control" name="status" id="status">
                      <option value="">--pilih--</option>
                      <option value="1">Aktif</option>
                      <option value="0">Tidak Aktif</option>
                    </select>
                    <div class="invalid-feedback"></div>
                  </div>

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
            <button style="float: left;" type="button" onclick="tambah_admin()" class="btn btn-primary" id="tombol-tambah" data-bs-toggle="modal" data-bs-target="#form">
              <i class="fa fa-lg fa-fw fa-plus" aria-hidden="true"></i>Tambah
            </button>
            <table class="table table-hover table-striped align-middle" id="postsList" style="width: 100%;max-width:100%;">
              <thead class="">
                <tr>
                  <th>#</th>
                  <th>ID User</th>
                  <th>ID Admin</th>
                  <th>Nama</th>
                  <th>Username</th>
                  <th>Email</th>
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

<script type='text/javascript'>
  var save_method; //for save method string

  $(document).ready(function() {
    table = $('#postsList').DataTable({
      responsive: true,
      ajax: "<?= base_url("Admin/dataAdmin") ?>",
      columns: [{
          data: 'no'
        },
        {
          data: 'id_user'
        },
        {
          data: 'id_admin'
        },
        {
          data: 'nama'
        },
        {
          data: 'username'
        },
        {
          data: 'email'
        },
        {
          data: 'status'
        },
        {
          data: 'action'
        },
      ],
    });
  });

  function tambah_admin() {
    $('[name="data.id_admin"]').val(data.id_admin);
    $('[name="data.id_user"]').val(data.id_user);

    save_method = 'add';
    $('#form-tambah')[0].reset(); // reset form modal
    $('.form-control').removeClass('is-invalid'); // hapus class error
    $('.form-check-input').removeClass('is-invalid'); // hapus class error
    $('#form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Tambah Admin'); // Ubah title modal
  }

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
        $('[name="nama_pelatihan"]').val(data.id_kategori);
        $('[name="harga"]').val(data.harga);
        $('[name="pot1"]').val(data.pot1);
        $('[name="pot2"]').val(data.pot2);
        $('[name="start"]').val(data.start);
        $('[name="end"]').val(data.end);
        $('[name="status"]').val(data.is_active);
        $('[name="id"]').val(id_pel);
        $('#form').modal('show'); // Menampilkan modal
        $('.modal-title').text('Edit Admin'); // Ubah title modal
      },
      error: function(jqXHR, textStatus, errorThrown) {
        alert('Error get data from ajax');
      }
    });
  }

  function simpan() {
    $('#btnSimpan').text('menyimpan...'); // Ubah tombol simpan
    $('#btnSimpan').attr('disabled', true); // Menonaktifkan tombol simpan

    var url;
    if (save_method == 'add') {
      url = "<?php echo base_url('admin/tambahAdmin') ?>";
    } else {
      url = "<?php echo base_url('admin/editAdmin') ?>";
    }
    $.ajax({
      url: url,
      type: 'POST',
      dataType: 'JSON',
      data: $('#form-tambah').serialize(),
      success: function(data) {
        if (data.success) {
          $('#form').modal('hide');
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