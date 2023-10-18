<div class="container-fluid py-4">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <!-- jika menggunakan bootstrap4 gunakan css ini  -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">

        <div class="col-md-3">
          <table>
            <tr>
              <td>
                <select name="" id="pelatihan" class="form-select form-control">
                  <option value="">Pilih Semua</option>
                  <?php foreach ($pelatihan as $plt) { ?>
                    <option value="<?php echo $plt['id']?>"><?php echo $plt['nama_pelatihan'] ?></option>
                  <?php } ?>
                </select>
               <input type="hidden" id="kata" value="">
              </td>
            </tr>
          </table>
        </div>

        <!-- DataTables -->
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive" style="margin:10px;">
            <table class="table table-hover table-striped align-middle" id="table" style="width: 100%;max-width:100%;">
              <thead class="">
                <tr>
                  <th>No</th>
                  <th>Nama Pelatihan</th>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>No HP</th>
                  <th>Alamat</th>
                  <th>Jenis Kelamin</th>

                </tr>
              </thead>
              <tbody id="tbl_data">

              </tbody>
            </table>
            <!-- Paginate -->
            <div class="pagination"></div>
          </div>
        </div>
        <!-- Akhir DataTables -->



      </div>
    </div>
  </div>
</div>


<!-- Data Table -->
<script type='text/javascript'>
  var save_method; //for save method string

  function myfun(){
    $('#table').DataTable({

      "ajax" : {
        "url" : "<?php echo base_url('Peserta/getData') ?>",
        "type" : "POST",
        "data" :
          function() {
                    return {
                        pelatihan: $('#kata').val(),      
                    }
                },
      },
      bDestroy : true,
      dom : 'lfrtip8',
      columns: [{
          data: 'no'
        },
        {
          data: 'nama_pelatihan'
        },
        {
          data: 'nama'
        },
        {
          data: 'email'
        },
        {
          data: 'nomor_hp'
        },
        {
          data: 'alamat'
        },
        {
          data: 'jenis_kelamin'
        },

      ]
      
    });
  }

myfun();

$('#pelatihan').change(function(){
 
  $('#kata').val( $('#pelatihan').val());
  $("#table").DataTable().ajax.reload();
  
})

  // $(document).ready(function() {
  //   table = $('#table').DataTable({
      
  //     responsive: true,
  //     dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6 d-grid gap-2 d-md-flex justify-content-md-end'<'float-md-right ml-2'f>B>>" +
  //       "<'row'<'col-sm-12'tr>>" +
  //       "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
  //     select: 'single',
  //     buttons: ['csv', {
  //       'text': '<span class="fa fa-plus"></span> Tambah Trainer',
  //       'className': 'btn btn-primary btn-sm tambahMateri',
  //       'attr': {
  //         'title': 'Tambah materi',
  //       }
  //     }],
  //     ajax: "<?= base_url("Peserta/getData") ?>",
  //     columns: [{
  //         data: 'no'
  //       },
  //       {
  //         data: 'nama_pelatihan'
  //       },
  //       {
  //         data: 'nama'
  //       },
  //       {
  //         data: 'email'
  //       },
  //       {
  //         data: 'nomor_hp'
  //       },
  //       {
  //         data: 'alamat'
  //       },
  //       {
  //         data: 'jenis_kelamin'
  //       },

  //     ]

  //   });

  // });

  $(document).ready(function() {
    $("#pelatihan").change(function() {
      var a = $(this).val();
      

    })
  });

  $(document).ready(function() {
        $("#pelatihan").select2();
  });

  function tes(){
    var pelatihan = $('#pelatihan').val();
    $.ajax({
      type: "method",
      url: "<?php echo base_url()?>",
      data: pelatihan ,
      success: function (response) {
        
      }
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
            } else alert('Something is GJ')
          }
        })
      }
    })
  }
</script>