<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!-- jika menggunakan bootstrap4 gunakan css ini  -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- Modal Tambah Data Trainer -->
<div class="modal fade" id="TrainerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="jdlModelPemateri">Tambah Pemateri</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="formTrainer">
                    <input type="hidden" class="form-control" name="ip" id="ip" value="<?= $id_pelatihan ?>">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Nama Trainer</label>
                        <select class="form-control" name="trainer" id="addTrainer">

                            <option value="">--pilih--</option>
                            <?php foreach ($allTrainer as $tr) : ?>
                                <option value="<?= $tr['id_trainer'] ?>"><?= $tr['nama'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" id="" class="btn btn-primary aksiTrainer">Tambah</button>

            </div>
        </div>
    </div>
</div>

<!-- Modal Data Kurikulum -->
<div class="modal fade" id="KurikulumModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="jdlModelKK">Tambah Kurikulum</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="formKurikulum">
                    <input type="hidden" class="form-control" name="ip" id="ip" value="<?= $id_pelatihan ?>">
                    <input type="hidden" class="form-control" name="i" id="i" value="">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Status</label>
                        <select class="form-select form-control" name="status" id="statusKK">
                            <option value="1">Aktif</option>
                            <option value="0">Non-aktif</option>
                        </select>
                        <span class="form-text text-danger" id="status_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Kurikulum</label>
                        <input type="text" class="form-control" id="kurikulum" name="kurikulum">
                        <span class="form-text text-danger" id="kurikulum_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3"></textarea>
                    </div>
                    <span class="form-text text-danger" id="deskripsi_error"></span>

                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" id="" class="btn btn-primary aksiKurikulum">Tambah</button>

            </div>
        </div>
    </div>
</div>

<!-- Modal Data Materi -->
<div class="modal fade" id="MateriModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="jdlModelMateri">Tambah Materi</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="formMateri" enctype="multipart/form-data">
                    <input type="hidden" class="form-control" name="ip" id="ip" value="<?= $id_pelatihan ?>">
                    <input type="hidden" class="form-control" name="i" id="iM" value="">
                    <input type="hidden" class="form-control" name="ref_file_old" id="ref_file_old" value="">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Status</label>
                        <select class="form-select form-control" name="status" id="statusM">
                            <option value="1">Aktif</option>
                            <option value="0">Non-aktif</option>
                        </select>
                        <span class="form-text text-danger" id="status_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Materi <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="materi" name="materi">
                        <span class="form-text text-danger" id="materi_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="deskripsi" id="deskripsiM" rows="3"></textarea>
                        <span class="form-text text-danger" id="materi_error"></span>
                    </div>
                    <span class="form-text text-danger" id="deskripsi1_error"></span>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Referensi Link </label>
                        <input type="text" class="form-control" id="ref_link" name="ref_link">
                        <span class="form-text text-danger" id="ref_link_error"></span>
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Upload referensi file</label>
                        <input class="form-control" type="file" id="ref_file" name="ref_file">
                    </div>
                    <span class="form-text text-danger" id="ref_file_error"></span>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" id="" class="btn btn-primary aksiMateri">Tambah</button>

            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Data hARGA -->
<div class="modal fade" id="HargaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="jdlModelHarga">Tambah Harga</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="formHarga">
                    <input type="hidden" class="form-control" name="ip" id="ip" value="<?= $id_pelatihan ?>">
                    <input type="hidden" class="form-control" name="i" id="iH" value="">
                    <input type="hidden" class="form-control" name="ref_file_old" id="ref_file_old" value="">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Status</label>
                        <select class="form-select form-control" name="status" id="statusH">
                            <option value="1">Aktif</option>
                            <option value="0">Non-aktif</option>
                        </select>
                        <span class="form-text text-danger" id="statusH_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Jenis Pendaftaran</label>
                        <select class="form-select form-control" name="jenis" id="jenis">
                            <option value="">--- PILIH ---</option>
                            <?php foreach ($jenisDaftar as $jd) : ?>
                                <option value="<?= $jd ?>"><?= $jd ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="form-text text-danger" id="jenis_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Jenis Pelatihan</label>
                        <select class="form-select form-control" name="jenis_harga" id="jenis_harga">
                            <option value="">--- PILIH ---</option>
                            <?php foreach ($jenisPelatihan as $jp) : ?>
                                <option value="<?= $jp ?>"><?= $jp ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="form-text text-danger" id="jenis_harga_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Harga <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="harga" name="harga">
                        <span class="form-text text-danger" id="harga_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Potongan Harga</label>
                        <input type="number" class="form-control" id="diskon" name="diskon">
                        <span class="form-text text-danger" id="diskon_error"></span>
                    </div>
                    <div class="form-group">
                        <div id="minmax" class="row align-items-start">
                            <div class="col">
                                <label for="">Jumlah Minimal Daftar</label>
                                <div class="input-group mb-3">
                                    <!-- <span class="input-group-text"><img src="<?= base_url() ?>assets/assets/vector/discountshape.svg" alt=""></span> -->
                                    <input class="form-control" type="number" name="min_jumlah_daftar" id="min_jumlah_daftar" minlength="5" maxlength="13">
                                    <span class="form-text text-danger" id="min_jumlah_daftar_error"></span>
                                </div>
                            </div>
                            <div class="col">
                                <label for="">Jumlah Maksimal Daftar</label>
                                <div class="input-group mb-3">
                                    <!-- <span class="input-group-text"><img src="<?= base_url() ?>assets/assets/vector/discountshape.svg" alt=""></span> -->
                                    <input class="form-control" type="number" name="max_jumlah_daftar" id="max_jumlah_daftar" minlength="5" maxlength="13">
                                    <span class="form-text text-danger" id="max_jumlah_daftar_error"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Keterangan <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="keterangan" id="keterangan" rows="3"></textarea>
                        <span class="form-text text-danger" id="keterangan_error"></span>
                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" id="" class="btn btn-primary aksiHarga">Tambah</button>

            </div>
        </div>
    </div>
</div>

<!-- Modal data fasilitas -->
<div class="modal fade" id="FasilitasModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="jdlModelHarga">Sertifikat</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="d-md-flex">
                        <div class="list-card w-100" id="fasilitas">
                            <h4 id="jdlList"></h4>
                            <form id="listFasilitas" method="POST" class="position-relative">


                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>

            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#addTrainer").select2({
            dropdownParent: $("#TrainerModal")
        });
    });
</script>

<link rel="stylesheet" href="<?= base_url('assets/css/slick.css'); ?>" />
<link rel="stylesheet" href="<?= base_url('assets/css/slick-theme.css'); ?>" />

<style>
    /* a {
        color: inherit;
        text-decoration: inherit;
    } */

    button {
        background: none;
        color: inherit;
        border: none;
        padding: 0;
        font: inherit;
        cursor: pointer;
        outline: inherit;
    }

    .w-fit {
        width: -moz-fit-content;
        width: fit-content;
    }

    .h-fit {
        height: -moz-fit-content;
        height: fit-content;
    }

    .m-5 {
        margin: 1.25rem;
    }

    .flex {
        display: flex;
    }

    .flex-wrap {
        flex-wrap: wrap;
    }

    .items-center {
        align-items: center;
    }

    .justify-center {
        justify-content: center;
    }

    .text-center {
        text-align: center;
    }

    .border-b-2 {
        border-bottom-width: 2px;
    }

    .w-full {
        width: 100%;
    }

    .h-\[114px\] {
        height: 114px;
    }

    .w-\[114px\] {
        width: 114px;
    }

    .rounded-full {
        border-radius: 9999px;
    }
</style>


<div class="carousel slide relative container" data-bs-ride="static">
    <div class="action flex">
        <a href="#" data-slide="1" class="w-fit h-fit m-5 border-b-2">Trainer</a>
        <a href="#" data-slide="2" class="w-fit h-fit m-5">Materi</a>
        <a href="#" data-slide="3" class="w-fit h-fit m-5">Kurikulum</a>
        <a href="#" data-slide="4" class="w-fit h-fit m-5">Harga</a>
    </div>
    <!-- control end -->
    <div class="slider slider-for relative w-full overflow-hidden">
        <input id="ip" type="hidden" value="<?= $id_pelatihan ?>">
        <div class=" w-full">
            <button type="button" class="btn btn-primary addTrainer">
                Tambah Trainer
            </button>
            <div class="flex flex-wrap">
                <?php foreach ($trainer as $tr) : ?>
                    <div class="card shadow-lg border" style="width: 18rem; margin: 0.5rem;">
                        <div class="w-full flex justify-center mt-4">
                            <img src="data:image/jpg;base64,<?= $tr['avatar'] ?>" class="img-circle">
                        </div>
                        <div class="card-body">
                            <a target="_blank" href="<?= $tr['linkedin'] ?>">
                                <h5 class="card-title"><?= $tr['nama'] ?></h5>
                            </a>
                            <h6 class="card-subtitle mb-2 text-muted"><?= $tr['profesi'] ?></h6>
                            <p>Telp : <?= $tr['nomor_hp'] ?> <br> Email : <?= $tr['email'] ?> </p>
                            <button type="button" class="btn btn-danger delTrainer" id="<?= $tr['trainer_id'] ?>"><i class="fa-solid fa-trash"></i></button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="w-full">
            <!-- DataTables -->
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive" style="margin:10px;">
                    <button style="float: left;" type="button" class="btn btn-primary" id="addMateri">
                        <i class="fa fa-lg fa-fw fa-plus" aria-hidden="true"></i>Tambah Materi
                    </button>
                    <table class="table1 table-hover table-striped align-middle" id="materiTable" style="width: 100%;max-width:100%;">
                        <thead class="">
                            <tr>
                                <th>#</th>
                                <th>Materi</th>
                                <th>Deskripsi</th>
                                <th>Referensi Link</th>
                                <th>Referensi File</th>
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
        <div class="w-full">
            <!-- DataTables -->
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive" style="margin:10px;">
                    <button style="float: left;" type="button" class="btn btn-primary" id="addKurikulum">
                        <i class="fa fa-lg fa-fw fa-plus" aria-hidden="true"></i>Tambah Kurikulum Pelatihan
                    </button>
                    <table class="table table-hover table-striped align-middle" id="kurikulumTable" style="width: 100%;max-width:100%;">
                        <thead class="">
                            <tr>
                                <th>#</th>
                                <th>Kurikulum</th>
                                <th>Deskripsi</th>
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
        <div class="w-full">
            <!-- DataTables -->
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive" style="margin:10px;">
                    <button style="float: left;" type="button" class="btn btn-primary" id="addHarga">
                        <i class="fa fa-lg fa-fw fa-plus" aria-hidden="true"></i>Tambah Harga Pelatihan
                    </button>
                    <table class="table table-hover table-striped align-middle" id="hargaTable" style="width: 100%;max-width:100%;">
                        <thead class="">
                            <tr>
                                <th>#</th>
                                <th>Jenis</th>
                                <th>Jenis Pelatihan</th>
                                <th>Harga (1 orang)</th>
                                <th>Diskon (1 orang)</th>
                                <th>Keterangan</th>
                                <th>Status</th>
                                <th>Fasilitas</th>
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

<script>
    $(document).off("click", ".addTrainer");
    $(document).on("click", ".addTrainer", function() {

        $('#jdlModelPemateri').text('Tambah Pemateri');
        $('.aksiTrainer').text('Tambah');
        $("#TrainerModal").modal("show");
        $("#formTrainer")[0].reset();
    });

    $(document).off("click", ".aksiTrainer");
    $(document).on("click", ".aksiTrainer", function() {
        var data = $('#formTrainer').serialize();
        $.ajax({
            type: "POST",
            url: "<?= base_url() ?>pelatihan/postTrainer",
            data: data,
            dataType: "JSON",
            success: function(response) {

                if (response.success) {
                    Swal.fire({
                        // position: 'top-end',
                        icon: "success",
                        text: response.message,
                        showConfirmButton: false,
                        timer: 2000,
                    });
                    $('#TrainerModal').modal('hide');
                    var delayInMilliseconds = 3000;
                    setTimeout(function() {
                        location.reload();
                    }, delayInMilliseconds);
                } else {
                    Swal.fire({
                        // position: 'top-end',
                        icon: "error",
                        text: response.message,
                        showConfirmButton: false,
                        timer: 3000,
                    });
                    $('#TrainerModal').modal('hide');
                }
            }
        });
    });

    $(document).off("click", ".delTrainer");
    $(document).on("click", ".delTrainer", function() {
        Swal.fire({
            title: 'Data akan dihapus',
            text: "Apakah anda yakin?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Hapus!',
            cancelButtonText: 'Batal'

        }).then((result) => {
            if (result.isConfirmed) {
                if (result.isConfirmed) {
                    var id = $(this).attr('id');
                    $.ajax({
                        type: "POST",
                        url: "<?= site_url() ?>pelatihan/deleteTrainer",
                        data: {
                            id: id
                        },
                        dataType: "JSON",
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    // position: 'top-end',
                                    icon: "success",
                                    text: response.message,
                                    showConfirmButton: false,
                                    timer: 3000,
                                });
                                $('#TrainerModal').modal('hide');
                                location.reload();
                            } else {
                                Swal.fire({
                                    // position: 'top-end',
                                    icon: "error",
                                    text: response.message,
                                    showConfirmButton: false,
                                    timer: 3000,
                                });
                                $('#TrainerModal').modal('hide');

                            }

                        }
                    });
                }

            }
        })


    });




    $(document).ready(function() {
        var ip = $('#ip').val();
        table = $('#kurikulumTable').DataTable({
            responsive: true,
            ajax: `<?= base_url() ?>pelatihan/getKurikulum/${ip}`,
            columns: [{
                    data: 'no'
                },
                {
                    data: 'kurikulum'
                },
                {
                    data: 'deskripsi'
                },
                {
                    data: 'status'
                },
                {
                    data: 'action'
                },
            ],
        });
        var ip = $('#ip').val();
        table1 = $('#materiTable').DataTable({
            responsive: true,
            ajax: `<?= base_url() ?>pelatihan/getMateri/${ip}`,
            columns: [{
                    data: 'no'
                },
                {
                    data: 'materi'
                },
                {
                    data: 'deskripsi'
                },
                {
                    data: 'ref_link'
                },
                {
                    data: 'referensi_file'
                },
                {
                    data: 'status'
                },
                {
                    data: 'action'
                },
            ],
        });
        var ip = $('#ip').val();
        table2 = $('#hargaTable').DataTable({
            responsive: true,
            ajax: `<?= base_url() ?>pelatihan/getHarga/${ip}`,
            columns: [{
                    data: 'no'
                },
                {
                    data: 'jenis'
                },
                {
                    data: 'jenis_harga'
                },
                {
                    data: 'harga'
                },
                {
                    data: 'diskon'
                },
                {
                    data: 'keterangan'
                },
                {
                    data: 'status'
                },
                {
                    data: 'fasilitas'
                },
                {
                    data: 'action'
                },
            ],
        });
    })

    $(document).off("click", "#addKurikulum");
    $(document).on("click", "#addKurikulum", function() {

        $('#kurikulum_error').text('');
        $('#deskripsi_error').text('');
        $('#jdlModelKK').text('Tambah Kurikulum Baru');
        $('.aksiKurikulum').text('Tambah');
        $('#i').val('');
        // $('.aksiKurikulum').attr(id, '');
        $("#KurikulumModal").modal("show");
        $("#formKurikulum")[0].reset();
    });

    $(document).off("click", "#addMateri");
    $(document).on("click", "#addMateri", function() {

        $('#materi_error').text('');
        $('#deskripsi1_error').text('');
        $('#ref_link_error').text('');
        $('#ref_file_error').text('');
        $('#jdlModelMateri').text('Tambah Materi Baru');
        $('.aksiMateri').text('Tambah');
        $('#iM').val('');
        // $('.aksiMateri').attr(id, '');
        $("#MateriModal").modal("show");
        $("#formMateri")[0].reset();
    });
    $(document).off("click", "#addHarga");
    $(document).on("click", "#addHarga", function() {

        $('#jenis_harga_error').text('');
        $('#jenis_error').text('');
        $('#harga_error').text('');
        $('#max_jumlah_daftar_error').text('');
        $('#min_jumlah_daftar_error').text('');
        $('#keterangan_error').text('');
        $('#jdlModelHarga').text('Tambah Harga Baru');
        $('.aksiHarga').text('Tambah');
        $('#iH').val('');
        // $('.aksiMateri').attr(id, '');
        $("#HargaModal").modal("show");
        $("#formHarga")[0].reset();
    });

    $(document).off("click", ".edtKurikulum");
    $(document).on("click", ".edtKurikulum", function() {

        $('#kurikulum_error').text('');
        $('#deskripsi_error').text('');
        var id = $(this).attr('id');
        $.ajax({
            type: "post",
            url: "<?= base_url() ?>pelatihan/detailKurikulum",
            data: {
                id: id
            },
            dataType: "JSON",
            success: function(data) {
                $('#jdlModelKK').text('Ubah Kurikulum');
                $('.aksiKurikulum').text('Ubah');
                var response = data.result
                $('#i').val(response.id);
                $('#statusKK').val(response.status);
                $('#kurikulum').val(response.kurikulum);
                $('#deskripsi').val(response.deskripsi);
                $("#KurikulumModal").modal("show");
            }
        });
    });
    $(document).off("click", ".edtHarga");
    $(document).on("click", ".edtHarga", function() {

        $('#jenis_harga_error').text('');
        $('#jenis_error').text('');
        $('#harga_error').text('');
        $('#max_jumlah_daftar_error').text('');
        $('#min_jumlah_daftar_error').text('');
        $('#keterangan_error').text('');
        var id = $(this).attr('id');
        $.ajax({
            type: "post",
            url: "<?= base_url() ?>pelatihan/detailHarga",
            data: {
                id: id
            },
            dataType: "JSON",
            success: function(data) {
                $('#jdlModelHarga').text('Ubah Harga');
                $('.aksiHarga').text('Ubah');
                var response = data.result
                $('#iH').val(response.id);
                $('#jenis_harga').val(response.jenis_harga);
                $('#jenis').val(response.jenis);
                $('#harga').val(response.harga);
                $('#diskon').val(response.diskon);
                $('#max_jumlah_daftar').val(response.max_jumlah_daftar);
                $('#min_jumlah_daftar').val(response.min_jumlah_daftar);
                $('#keterangan').val(response.keterangan);
                $("#HargaModal").modal("show");
            }
        });
    });

    $(document).off("click", ".fasilitas");
    $(document).on("click", ".fasilitas", function() {

        var id = $(this).attr('id');
        $.ajax({
            type: "post",
            url: "<?= base_url() ?>pelatihan/detailHarga",
            data: {
                id: id
            },
            dataType: "JSON",
            success: function(response) {

                var data = response.result;
                // $("#jdlList").text(`Konten Materi ${data.nama_kategori}`);
                var content = "";
                var fasilitas = data.fasilitas;
                if (fasilitas == null) {
                    fasilitas = "";
                }
                arr = JSON.parse(fasilitas);
                console.log(arr);
                $.each(arr, function(key, value) {
                    content += `<div class="row "><div class="col">
                                    <input type="text" class="form-control w-100" id="fasilitas" name="fasilitas[]" placeholder="" value="${value.fasilitas}">
                                </div>
                                <div class="col-auto">
                                    <button type="button" id="remove_fasilitas" class="btn btn-danger"><i class="fa-solid fa-xmark fs-6"></i></button>
                                </div></div>`;
                });
                content += `<div id="ac_fasilitas" class="d-flex justify-content-between mt-3">
                <button id="add_fasilitas" type="button" class="btn btn-success">
                                     Tambah Fasilitas
                                 </button>
                                 <button id="save_fasilitas" value="${data.id}" type="button" class="btn btn-primary">
                                     Simpan
                                 </button>
                                 
                            </div>`;
                $("#listFasilitas").html(content);
                $("#FasilitasModal").modal("show");

            },
        });
    });

    function validasi() {
        var peringatan = [];
        $("[id^=materiKategori]").each(function() {
            if ($(this).val() == "") {
                peringatan.push("kolom tidak boleh kosong");
                $(this).focus();
                return false;
            }

            if ($(this).val().length < 5) {
                peringatan.push("List materi setidaknya terdapat 5 karakter");
                $(this).focus();
                return false;
            }

            if ($(this).val().length > 255) {
                peringatan.push("List materi paling banyak 255 karakter");
                $(this).focus();
                return false;
            }

            if ($(this).val().trim().length == 0) {
                peringatan.push("Tidak dapat memasukkan materi hanya dengan spasi");
                $(this).focus();
                return false;
            }
        });

        var arr = [];
        $("[id^=materiKategori]").each(function() {
            var value = $(this).val();
            if (arr.indexOf(value) == -1) {
                if (value != "") {
                    arr.push(value);
                }
                $(this).removeClass("errorInput");
            } else {
                $(this).addClass("errorInput");
                peringatan.push("Terdapat konten materi yang sama");
            }
        });
        return removeDuplicates(peringatan).toString();
    }

    function removeDuplicates(arr) {
        return arr.filter((item, index) => arr.indexOf(item) === index);
    }

    function notifikasi() {
        Swal.fire({
            // position: 'top-end',
            icon: "error",
            text: validasi(),
            showConfirmButton: true,
        });
    }

    $("#add_fasilitas").off("click");
    $(document).on("click", "#add_fasilitas", function(e) {
        e.preventDefault();

        $("#ac_fasilitas").before(`<div class="row "><div class="col">
            <input type="text" class="form-control w-100" id="materiKategori" name="fasilitas[]" placeholder="" value="">
          </div>
          <div class="col-auto">
            <button type="button" id="remove_fasilitas" class="btn btn-danger"><i class="fa-solid fa-xmark fs-6"></i></button>
          </div></div>`);
    });

    $(document).on("click", "#remove_fasilitas", function(e) {
        e.preventDefault();
        let listNoLain = $(this).parent().parent();
        $(listNoLain).remove();
    });

    $("#save_fasilitas").off("click");
    $(document).on("click", "#save_fasilitas", function() {
        // e.preventDefault();
        if (validasi() != []) {
            notifikasi();
            return;
        }
        var data = $("#listFasilitas").serializeArray();
        var id = $(this).val();
        $.ajax({
            type: "POST",
            url: "<?= base_url() ?>pelatihan/putFasilitas",
            data: {
                data,
                id,
            },
            dataType: "JSON",
            success: function(data) {
                // console.log(data);
                Swal.fire({
                    // position: 'top-end',
                    icon: data.icon,
                    title: data.message,
                    showConfirmButton: false,
                    timer: 2000,
                });
            },
        });
    });

    $(document).off("click", ".edtMateri");
    $(document).on("click", ".edtMateri", function() {

        $('#materi_error').text('');
        $('#deskripsi1_error').text('');
        $('#ref_link_error').text('');
        $('#ref_file_error').text('');
        var id = $(this).attr('id');
        // console.log(id);
        $.ajax({
            type: "post",
            url: "<?= base_url() ?>pelatihan/detailMateri",
            data: {
                id: id
            },
            dataType: "JSON",
            success: function(data) {
                $('#jdlModelMateri').text('Ubah Materi');
                $('.aksiMateri').text('Ubah');
                var response = data.result
                $('#iM').val(response.id);
                $('#statusM').val(response.status);
                $('#materi').val(response.materi);
                $('#deskripsiM').val(response.deskripsi);
                $('#ref_link').val(response.referensi_link);
                $('#ref_file_old').val(response.referensi_file);
                $("#MateriModal").modal("show");
                console.log($('#i').val());
            }
        });
    });

    $(document).off("click", ".aksiKurikulum");
    $(document).on("click", ".aksiKurikulum", function() {
        console.log($('#i').val());


        $('#kurikulum_error').text('');
        $('#deskripsi_error').text('');
        var data = $('#formKurikulum').serialize();
        console.log(data);
        $.ajax({
            type: "POST",
            url: "<?= base_url() ?>pelatihan/postKurikulum",
            data: data,
            dataType: "JSON",

            success: function(response) {

                if (response.success) {
                    Swal.fire({
                        // position: 'top-end',
                        icon: "success",
                        text: response.message,
                        showConfirmButton: false,
                        timer: 2000,
                    });
                    $("#kurikulumTable").DataTable().ajax.reload();
                    $('#KurikulumModal').modal('hide');
                } else {
                    var error = response.message;
                    // console.log(error.kurikulum);
                    $('#kurikulum_error').text(error.kurikulum);
                    $('#deskripsi_error').text(error.deskripsi);
                }
            }
        });

    });

    $(document).off("click", ".aksiHarga");
    $(document).on("click", ".aksiHarga", function() {

        $('#jenis_harga_error').text('');
        $('#jenis_error').text('');
        $('#harga_error').text('');
        $('#max_jumlah_daftar_error').text('');
        $('#min_jumlah_daftar_error').text('');
        $('#keterangan_error').text('');

        var data = $('#formHarga').serialize();
        console.log(data);
        $.ajax({
            type: "POST",
            url: "<?= base_url() ?>pelatihan/postHarga",
            data: data,
            dataType: "JSON",
            success: function(response) {

                if (response.success) {
                    Swal.fire({
                        // position: 'top-end',
                        icon: "success",
                        text: response.message,
                        showConfirmButton: false,
                        timer: 2000,
                    });
                    $("#hargaTable").DataTable().ajax.reload();
                    $('#HargaModal').modal('hide');
                } else {
                    var error = response.message;
                    // console.log(error.kurikulum);
                    $('#jenis_harga_error').text(error.jenis_harga);
                    $('#jenis_error').text(error.jenis);
                    $('#harga_error').text(error.harga);
                    $('#max_jumlah_daftar_error').text(error.max_jumlah_daftar);
                    $('#min_jumlah_daftar_error').text(error.min_jumlah_daftar);
                    $('#keterangan_error').text(error.keterangan);
                }
            }
        });
    });

    $(document).off("click", ".aksiMateri");
    $(document).ready(function() {
        $('#formMateri').submit(function(e) {
            e.preventDefault();
            $('#materi_error').text('');
            $('#deskripsi1_error').text('');
            $('#ref_link_error').text('');
            $('#ref_file_error').text('');
            $.ajax({
                type: "POST",
                url: "<?= base_url() ?>pelatihan/postMateri",
                data: new FormData(this),
                dataType: "JSON",
                contentType: false,
                processData: false,
                success: function(response) {

                    if (response.success) {
                        Swal.fire({
                            // position: 'top-end',
                            icon: "success",
                            text: response.message,
                            showConfirmButton: false,
                            timer: 2000,
                        });
                        $("#materiTable").DataTable().ajax.reload();
                        $('#MateriModal').modal('hide');
                    } else {
                        var error = response.message;
                        // console.log(error.kurikulum);
                        $('#materi_error').text(error.materi);
                        $('#deskripsi1_error').text(error.deskripsi);
                        $('#ref_link_error').text(error.ref_link);
                        $('#ref_file_error').text(error.ref_file);
                    }
                }
            });
        })
    });

    $(document).off("click", ".delKurikulum");
    $(document).on("click", ".delKurikulum", function() {
        Swal.fire({
            title: 'Data akan dihapus',
            text: "Apakah anda yakin?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Hapus!',
            cancelButtonText: 'Batal'

        }).then((result) => {
            if (result.isConfirmed) {
                if (result.isConfirmed) {
                    var data = $(this).attr('id');
                    $.ajax({
                        type: "POST",
                        data: {
                            id: data
                        },
                        url: "<?= base_url() ?>pelatihan/deleteKurikulum",
                        dataType: "JSON",
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    // position: 'top-end',
                                    icon: "success",
                                    text: response.message,
                                    showConfirmButton: false,
                                    timer: 2000,
                                });
                                $("#kurikulumTable").DataTable().ajax.reload();
                            }

                        }
                    });
                }

            }
        })
    });

    $(document).off("click", ".delMateri");
    $(document).on("click", ".delMateri", function() {
        Swal.fire({
            title: 'Data akan dihapus',
            text: "Apakah anda yakin?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Hapus!',
            cancelButtonText: 'Batal'

        }).then((result) => {
            if (result.isConfirmed) {
                if (result.isConfirmed) {
                    var data = $(this).attr('id');
                    $.ajax({
                        type: "POST",
                        data: {
                            id: data
                        },
                        url: "<?= base_url() ?>pelatihan/deleteMateri",
                        dataType: "JSON",
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    // position: 'top-end',
                                    icon: "success",
                                    text: response.message,
                                    showConfirmButton: false,
                                    timer: 2000,
                                });
                                $("#materiTable").DataTable().ajax.reload();
                            }

                        }
                    });
                }
            }
        })
    });
    $(document).off("click", ".delHarga");
    $(document).on("click", ".delHarga", function() {
        Swal.fire({
            title: 'Data akan dihapus',
            text: "Apakah anda yakin?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Hapus!',
            cancelButtonText: 'Batal'

        }).then((result) => {
            if (result.isConfirmed) {
                if (result.isConfirmed) {
                    var data = $(this).attr('id');
                    $.ajax({
                        type: "POST",
                        data: {
                            id: data
                        },
                        url: "<?= base_url() ?>pelatihan/deleteHarga",
                        dataType: "JSON",
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    // position: 'top-end',
                                    icon: "success",
                                    text: response.message,
                                    showConfirmButton: false,
                                    timer: 2000,
                                });
                                $("#hargaTable").DataTable().ajax.reload();
                            }

                        }
                    });
                }
            }
        })
    });

    $('#jenis').change(function() {
        // e.preventDefault();
        console.log('aman');
        if ($(this).val() == 'Personal') {
            $('#minmax').addClass('d-none');
            $('#min_jumlah_daftar').val('1');
            $('#max_jumlah_daftar').val('1');
        } else {
            $('#minmax').removeClass('d-none');
            $('#min_jumlah_daftar').val('');
            $('#max_jumlah_daftar').val('');
        }
    });
</script>


<script src="<?= base_url('assets/js/index.js'); ?>"></script>
<script src="<?= base_url('assets/js/slick.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/landingpage.js'); ?>"></script>