<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">

        <!-- Form Upload Sertifikat-->
        <div class="modal" tabindex="-1" id="form" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <!-- <span aria-hidden="true">&times;</span></button> -->
                <h4 class="modal-title">Upload Sertifikat</h4>
                <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>

              <form action="#" id="form-upload">
                <div class="modal-body">
                  <input type="hidden" id="id" name="id">
                  <input type="hidden" id="id_user" name="id_user">

                  <div class="form-group">
                    <label for="">Nama Peserta</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><img src="<?= base_url() ?>assets/assets/vector/chart2.svg" alt=""></span>
                      <input class="form-control" type="text" name="nama_peserta" id="nama_peserta" readonly>
                      <div class="invalid-feedback"></div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="">Program</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><img src="<?= base_url() ?>assets/assets/vector/book.svg" alt=""></span>
                      <input class="form-control" type="text" name="tipe" id="tipe" value="" readonly>
                      <div class="invalid-feedback"></div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div><label>Jenis Sertifikat</label></div>
                    <div class="form-check" style="margin-left: 15px;">
                      <label for="BNSP">BNSP</label>
                      <input class="form-check-input" type="radio" name="jenis_sertif" id="BNSP" value="BNSP">
                    </div>
                    <div class="form-check" style="margin-left: 15px;">
                      <label for="AMD Academy">AMD Academy</label>
                      <input class="form-check-input" type="radio" name="jenis_sertif" id="amd" value="AMD Academy">
                      <div class="invalid-feedback"></div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="">Link Sertifikat</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><img src="<?= base_url() ?>assets/assets/vector/link1.svg" alt=""></span>
                      <input class="form-control" type="url" name="link" id="link">
                      <div class="invalid-feedback"></div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" data-bs-dismiss="modal" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                  <button type="submit" id="btnSimpan" onclick="simpan()" class="btn btn-primary" data-dismiss="modal">Simpan</button>
                </div>
              </form>
            </div>

            <!-- /.modal-content -->
          </div>
        </div>

        <!-- DataTables -->
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive" style="margin:10px;">
            <table class="table table-hover table-striped align-middle" id="postsList" style="width: 100%;max-width:100%;">
              <thead class="">
                <tr>
                  <th>No</th>
                  <th>Nama Peserta</th>
                  <th>Program Yang Diikuti</th>
                  <th>Sertifikat BNSP</th>
                  <th>Sertifikat AMD</th>
                  <th>Lulus/Tidak Lulus</th>
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
  $(document).ready(function() {
    table = $('#postsList').DataTable({
      responsive: true,
      ajax: "<?= base_url("sertifikat/dataSertifikat") ?>",
      columns: [{
          data: 'no'
        },
        {
          data: 'nama_peserta'
        },
        {
          data: 'program'
        },
        {
          data: 'bnsp'
        },
        {
          data: 'amd'
        },
        {
          data: 'Lulus/Tidak Lulus'
        },
        {
          data: 'action'
        },
      ],
    });

  });

  // Modal Edit Pelatihan
  function uploadSertifikat(id) {
    // save_method = 'update';
    $('#form-upload')[0].reset(); // reset form modal
    $('.form-control').removeClass('is-invalid'); // hapus class error
    $('.form-check-input').removeClass('is-invalid'); // hapus class error
    // $('invalid-feedback').empty(); // hapus pesan error


    $.ajax({
      url: "<?php echo site_url('sertifikat/upload') ?>/" + id,
      type: "POST",
      dataType: "JSON",

      success: function(data) {
        $('[name="nama_peserta"]').val(data.nama);
        $('[name="tipe"]').val(data.nama_pelatihan);
        $('[name="id_user"]').val(data.member_id);
        $('[name="id"]').val(data.id);
        $('#form').modal('show'); // Menampilkan modal
      },
      error: function(jqXHR, textStatus, errorThrown) {
        alert('Error get data from ajax');
      }
    });
  }

  function simpan() {
    $('#btnSimpan').text('menyimpan...'); // Ubah tombol simpan
    $('#btnSimpan').attr('disabled', true); // Menonaktifkan tombol simpan

    $.ajax({
      url: "<?php echo base_url('sertifikat/uploadSertifikat') ?>",
      type: 'POST',
      dataType: 'JSON',
      data: $('#form-upload').serialize(),
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

  function changeStatus(id, status) {
    if (status == 1) {
      // $(this).prop("checked", false)
      var checkPosition = 0;
      console.log('cek okeee');
    } else {
      var checkPosition = 1;
    }

    var id = id;
    $.ajax({
      url: "<?= base_url() ?>sertifikat/changeStatus",
      method: "POST",
      data: {
        checkPosition: checkPosition,
        id: id,
      },
      success: function(data) {
        $('#postsList').DataTable().ajax.reload();
      },
    });
  }
</script>