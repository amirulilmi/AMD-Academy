<!-- DataTables Example -->
<div class="card card-body card_ilmi px-0 pt-0 pb-2">
    <div class="table-responsive" style="margin:10px;">
        <table class="table table-hover table-striped align-middle" id="table" style="width: 100%;max-width:100%;">
            <!-- <button type="button" class="btn btn-primary" onclick="show_modalTambah()" style="float: right;">
                Tambah Data
            </button> -->
            <thead class="">
                <tr>
                    <th>No</th>
                    <th>Profil</th>
                    <th>Nama</th>
                    <th>Linkedin</th>
                    <th>Profesi</th>
                    <!-- <th>Program</th> -->
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- <?php $no = 1;
                        foreach ($result as $r) {
                        ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><img src="data:image/jpg;base64,<?php echo $r['avatar']; ?>" class="img-circle2"></td>
                        <td><?php echo $r['nama']; ?></td>
                        <td><?php echo $r['linkedin']; ?></td>
                        <td><?php echo $r['profesi']; ?></td>
                        <td><?php echo $r['nama_kategori']; ?></td>
                        <td>
                            <a onclick="byid('<?php echo $r['id_trainer'] ?>')" class="badge badge-primary"><img src="<?php echo base_url() ?>assets/assets/img/trainer/edit.svg"></a>
                            <a href="<?php echo base_url('trainer/delete') ?>/<?php echo $r['id_trainer'] ?>" class="badge badge-danger tombol-hapus"><img src="<?php echo base_url() ?>assets/assets/img/trainer/delete.svg"></a>
                        </td>
                    </tr>

                <?php } ?> -->
            </tbody>
        </table>
        <!-- Paginate -->
        <div class="pagination"></div>
    </div>
</div>


<!-- Modal Tambah Data -->
<div class="modal fade" id="exampleModall" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" id="submit">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Tambah Pemateri</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <input type="file" class="form-control" name="userfile" value="asdad">
                        <span class="form-text text-danger" id="file_error"></span>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama</label>
                        <input type="text" class="form-control" name="nama" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <span class="form-text text-danger" id="nama_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email">
                        <span class="form-text text-danger" id="email_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" name="alamat" id="alamat">
                        <span class="form-text text-danger" id="alamat_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="telepon">Nomor Telepon</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">+62</span>
                            <input type="text" class="form-control" name="telepon" id="telepon">
                        </div>
                        <span class="form-text text-danger" id="telepon_error"></span>
                        <span class="form-text text-danger" id="mustNum"></span>
                    </div>
                    <div class="form-group">
                        <label for="bidang">Bidang Keahlian</label>
                        <input type="text" class="form-control" name="bidang" id="bidang">
                        <span class="form-text text-danger" id="bidang_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Profesi</label>
                        <input type="text" class="form-control" name="profesi" id="exampleInputPassword1">
                        <span class="form-text text-danger" id="profesi_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Jenis Kelamin</label>
                        <select class="form-select form-control" name="jk">

                            <option value="">--pilih--</option>
                            <option value="P">Perempuan</option>
                            <option value="L">Laki-laki</option>
                        </select>
                        <span class="form-text text-danger" id="jk_error"></span>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Linkedin</label>
                        <input type="text" class="form-control" name="linkedin" id="exampleInputPassword1">
                        <span class="form-text text-danger" id="linkedin_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="lahir">Tempat Lahir</label>
                        <input type="text" class="form-control" name="lahir" id="lahir">
                        <span class="form-text text-danger" id="lahir_error"></span>
                    </div>
                    <div class="col">
                        <label for="">Tanggal Lahir</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><img src="<?= base_url() ?>assets/assets/vector/timer1.svg" alt=""></span>
                            <input class="form-control" type="date" name="tgl_lahir">
                        </div>
                        <span class="form-text text-danger" id="tgl_lahir_error"></span>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary " id="submit]">Save changes</button>

                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" id="edit">
                <input type="text" class="form-control" name="id_trainer" id="exampleInputEmail1" aria-describedby="emailHelp" hidden>
                <input type="text" class="form-control" name="userfile2" id="exampleInputEmail1" aria-describedby="emailHelp" hidden>
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Ubah Data Pemateri</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <label for="exampleInputEmail1">Foto Profil</label>
                    <div class="form-group">
                        <input type="file" class="form-control" name="userfile" value="asdad">
                        <span class="form-text text-danger" id="file_error"></span>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama</label>
                        <input type="text" class="form-control" name="nama" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <span class="form-text text-danger" id="nama_error1"></span>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email">
                        <span class="form-text text-danger" id="email_error1"></span>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" name="alamat" id="alamat">
                        <span class="form-text text-danger" id="alamat_error1"></span>
                    </div>
                    <div class="form-group">
                        <label for="telepon">Nomor Telepon</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">+62</span>
                            <input type="text" class="form-control" name="telepon" id="telepon1">
                        </div>
                        <span class="form-text text-danger" id="telepon_error1"></span>
                        <span class="form-text text-danger" id="mustNum1"></span>
                    </div>
                    <div class="form-group">
                        <label for="bidang">Bidang Keahlian</label>
                        <input type="text" class="form-control" name="bidang" id="bidang">
                        <span class="form-text text-danger" id="bidang_error1"></span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Profesi</label>
                        <input type="text" class="form-control" name="profesi" id="exampleInputPassword1">
                        <span class="form-text text-danger" id="profesi_error1"></span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Jenis Kelamin</label>
                        <select class="form-select form-control" name="jk">

                            <option value="">--pilih--</option>
                            <option value="P">Perempuan</option>
                            <option value="L">Laki-laki</option>
                        </select>
                        <span class="form-text text-danger" id="jk_error1"></span>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Linkedin</label>
                        <input type="text" class="form-control" name="linkedin" id="exampleInputPassword1">
                        <span class="form-text text-danger" id="linkedin_error1"></span>
                    </div>
                    <div class="form-group">
                        <label for="lahir">Tempat Lahir</label>
                        <input type="text" class="form-control" name="lahir" id="lahir">
                        <span class="form-text text-danger" id="lahir_error1"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Tanggal Lahir</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><img src="<?= base_url() ?>assets/assets/vector/timer1.svg" alt=""></span>
                            <input class="form-control" type="date" name="tgl_lahir">
                        </div>
                        <span class="form-text text-danger" id="tgl_lahir_error1"></span>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary " id="submit]">Ubah</button>

                </div>
            </form>
        </div>
    </div>
</div>

<script>
    var saveData;
    var modal = $('#exampleModall');
    var modal_edit = $('#exampleModal');
    var tableData = $('#table');
    var formData = $('#submit');
    var btnSave = $('#btnSave');
    $(document).ready(function() {
        table = $('#table').DataTable({
            responsive: true,
            dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6 d-grid gap-2 d-md-flex justify-content-md-end'<'float-md-right ml-2'f>B>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            select: 'single',
            buttons: ['csv', {
                'text': '<span class="fa fa-plus"></span> Tambah Trainer',
                'className': 'btn btn-primary btn-sm tambahMateri',
                'attr': {
                    'title': 'Tambah materi',
                }
            }],
            ajax: "<?= base_url("trainer/get") ?>",
            columns: [{
                    data: 'no'
                },
                {
                    data: 'avatar'
                },
                {
                    data: 'nama'
                },
                {
                    data: 'linkedin'
                },
                {
                    data: 'profesi'
                },
                // {
                //     data: 'nama_kategori'
                // },
                {
                    data: 'action'
                },
            ],

        });

    });

    function reload() {
        tableData.DataTable().ajax.reload();
    }

    $(document).off('click', '.tambahMateri');
    $(document).on('click', '.tambahMateri', function() {
        formData[0].reset();
        modal.modal('show');
    });

    function show_modalTambah() {
        formData[0].reset();
        modal.modal('show');
    }
    //tambah data
    $(document).ready(function() {
        $('#submit').submit(function(e) {
            $('#nama_error').text('');
            $('#profesi_error').text('');
            $('#program_error').text('');
            $('#linkedin_error').text('');
            $('#email_error').text('');
            $('#alamat_error').text('');
            $('#telepon_error').text('');
            $('#bidang_error').text('');
            $('#jk_error').text('');
            $('#lahir_error').text('');
            $('#tgl_lahir_error').text('');
            $('#file_error').text('');
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>Trainer/add',
                type: "POST",
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                success: function(response) {
                    if (response.status == 'success') {
                        Swal.fire({
                            title: 'Data Trainer',
                            text: 'Berhasil ditambah',
                            icon: 'success',
                        })
                        modal.modal('hide');
                        reload();
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

                    if (response.error == true) {
                        $('#nama_error').text(response.nama_error);
                        $('#profesi_error').text(response.profesi_error);
                        $('#program_error').text(response.program_error);
                        $('#linkedin_error').text(response.linkedin_error);
                        $('#email_error').text(response.email_error);
                        $('#alamat_error').text(response.alamat_error);
                        $('#telepon_error').text(response.telepon_error);
                        $('#bidang_error').text(response.bidang_error);
                        $('#jk_error').text(response.jk_error);
                        $('#lahir_error').text(response.lahir_error);
                        $('#tgl_lahir_error').text(response.tgl_lahir_error);
                        $('#file_error').text(response.file_error);
                    }
                }
            });
        });


    });

    function byid(id_trainer) {
        $.ajax({
            type: "GET",
            url: "<?php echo base_url('trainer/byid/') ?>" + id_trainer,
            dataType: "JSON",
            success: function(response) {
                console.log(response.trainer);
                $('[name="id_trainer"]').val(response.trainer['id_trainer']);
                $('[name="linkedin"]').val(response.trainer['linkedin']);
                $('[name="nama"]').val(response.trainer['nama']);
                $('[name="email"]').val(response.trainer['email']);
                $('[name="alamat"]').val(response.trainer['alamat']);
                $('[name="telepon"]').val(response.trainer['nomor_hp']);
                $('[name="bidang"]').val(response.trainer['bidang']);
                $('[name="profesi"]').val(response.trainer['profesi']);
                $('[name="jk"]').val(response.trainer['jenis_kelamin']);
                $('[name="lahir"]').val(response.trainer['tempat_lahir']);
                $('[name="tgl_lahir"]').val(response.trainer['tanggal_lahir']);

                // $('[name="program"]').val(response.kategori_trainer['id_kategori']);
                $('[name="userfile2"]').val(response.trainer['avatar']);
                modal_edit.modal('show');
            }
        });

    }

    //edit data
    $(document).ready(function() {
        $('#edit').submit(function(e) {
            $('#nama_error1').text('');
            $('#profesi_error1').text('');
            $('#program_error1').text('');
            $('#linkedin_error1').text('');
            $('#email_error1').text('');
            $('#alamat_error1').text('');
            $('#telepon_error1').text('');
            $('#bidang_error1').text('');
            $('#jk_error1').text('');
            $('#lahir_error1').text('');
            $('#tgl_lahir_error1').text('');
            $('#file_error1').text('');
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>trainer/update',
                type: "POST",
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                success: function(response) {
                    if (response.status == 'success') {
                        Swal.fire({
                            title: 'Data Trainer',
                            text: 'Berhasil diubah',
                            icon: 'success',

                        })
                        modal_edit.modal('hide');
                        reload();
                    }
                    if (response.error == true) {
                        $('#nama_error1').text(response.nama_error);
                        $('#profesi_error1').text(response.profesi_error);
                        $('#program_error1').text(response.program_error);
                        $('#linkedin_error1').text(response.linkedin_error);
                        $('#email_error1').text(response.email_error);
                        $('#alamat_error1').text(response.alamat_error);
                        $('#telepon_error1').text(response.telepon_error);
                        $('#bidang_error1').text(response.bidang_error);
                        $('#jk_error1').text(response.jk_error);
                        $('#lahir_error1').text(response.lahir_error);
                        $('#tgl_lahir_error1').text(response.tgl_lahir_error);
                        $('#file_error1').text(response.file_error);

                    }
                    // else {
                    //     Swal.fire({
                    //         title: 'Format Gambar Salah!',
                    //         text: 'format gambar (jpg, png, gif) ',
                    //         icon: 'warning',
                    //     })
                    // }
                }
            });
        });


    });

    function deleted(id_trainer) {
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
                    $.ajax({
                        type: "GET",
                        url: "<?php echo base_url('trainer/delete/') ?>" + id_trainer,
                        dataType: "JSON",
                        success: function(response) {
                            if (response.status == 'success') {
                                reload();
                            }

                        }
                    });
                }

            }
        })


    }
    $(document).ready(function() {
        $("#telepon").keyup(function(e) {
            e.preventDefault();

            if (/\D/g.test(this.value)) {
                // Filter non-digits from input value.
                this.value = this.value.replace(/\D/g, "");
                $("#mustNum").text("Hanya dapat diisi menggunakan nomor");
            }
        });
        $("#telepon1").keyup(function(e) {
            e.preventDefault();

            if (/\D/g.test(this.value)) {
                // Filter non-digits from input value.
                this.value = this.value.replace(/\D/g, "");
                $("#mustNum1").text("Hanya dapat diisi menggunakan nomor");
            }
        });
    });
</script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>