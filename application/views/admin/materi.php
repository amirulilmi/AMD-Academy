<style>
    .cards tbody tr {
        float: left;
        width: 19rem;
        margin: 0.5rem;
        border: 0.0625rem solid rgba(0, 0, 0, 0.125);
        border-radius: 0.25rem;
        box-shadow: 0px 0px 9px 1px rgba(105, 105, 105, 0.46);
        -webkit-box-shadow: 0px 0px 9px 1px rgba(57, 57, 57, 0.46);
        -moz-box-shadow: 0px 0px 9px 1px rgba(70, 70, 70, 0.46);
    }

    .cards tbody td {
        display: block;
    }

    .cards thead {
        display: none;
    }

    .cards td:before {
        content: attr(data-label);
        position: relative;
        float: left;
        color: #808080;
        min-width: 4rem;
        margin-left: 0;
        margin-right: 1rem;
        text-align: left;
    }

    tr.selected td:before {
        color: #ccc;
    }

    .table .avatar {
        width: 50px;
    }

    .cards .avatar {
        width: 90%;
        height: 50px;
        margin: 15px;
    }
</style>

<?php switch ($user['user_group_id']):
    case $idPeserta: ?>


        <input type="hidden" id="ktgr" name="ktgr" value="">
        <input type="hidden" id="tpfl" name="tpfl" value="">

        <?php if ($this->session->userdata('id_user')) : ?>
            <script>
                Swal.fire({
                    // position: 'top-end',
                    icon: 'error',
                    // title: data.message,
                    text: '<?= $this->session->userdata('id_user') ?>',
                    showConfirmButton: false,
                    timer: 3000,
                });
            </script>
        <?php endif ?>


        <div class="container mt-5">
            <div class="row">
                <div class="list-card d-md-flex">
                    <?php foreach ($kategori as $kat) : ?>
                        <button id="a" class="card m-3 kat " value="<?= $kat['id'] ?>" style=" border-radius: 15px;">
                            <div class="card-body text-white p-3">
                                <h5 class="" style="font-weight: 700; margin: 0px; padding: 0px; font-size: 16px;"><?= $kat['nama_pelatihan'] ?></h5>
                                <!-- <p style="margin: 0px; padding: 0px; font-size: 12px;">by : AMD Academy</p> -->
                            </div>
                        </button>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>


        <!-- <div class="container mt-3">
            <div class="row">
                <div class="list-card d-flex flex-wrap justify-content-center justify-content-md-start">
                    <?php foreach ($tipe_file as $tf) : ?>
                        <button id="b" class="card me-3 mb-3 tf" value="<?= $tf['id_tipe_file'] ?>" style="width: 11rem; box-shadow: none; border-color: #9D95F5; border-radius: 10px;">
                            <div class="d-flex align-items-center">
                                <div class="card-header p-2 bg-white" style=" border-radius: 10px;">
                                    <img class="img-fluid" src="<?= base_url() ?>assets/assets/tipeMateri/<?= $tf['tipe_file'] ?>.png" alt="" style="height: 30px; width: 30px;">
                                </div>
                                <div class="card-body ms-4 p-0">
                                    <p class="p-0 m-0"><?= $tf['tipe_file'] ?></p>
                                </div>
                            </div>
                        </button>
                    <?php endforeach; ?>
                </div>
            </div>
        </div> -->


        <div class="container">
            <table id="materiPeserta" class="table table-sm table-hover cards" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th></th>
                        <th>Materi</th>
                        <th>Deskripsi</th>
                        <th>Referensi Link</th>
                        <th>Referensi File</th>
                    </tr>
                </thead>
            </table>
        </div>


    <?php break;
    case $idAdmin: ?>
        <div class="container my-5">

            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive" style="margin:10px;">
                    <table class="table table-hover table-striped align-middle" width="100%" id="listMateri">
                        <thead class="">
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Tipe File</th>
                                <th>Dibuat</th>
                                <th>Diubah</th>
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
<?php break;
endswitch; ?>




<!-- modal -->
<!-- <div class="modal fade" id="materiModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="modalLabel">Tambah Materi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formMateri" method="POST">
                <input type="hidden" name="id_materi" value="" id="i">
                <div class="modal-body">

                    <div>
                        <label for="">Judul materi <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="judul" name="judul" placeholder="Judul Materi" aria-label="linkBukti" aria-describedby="basic-addon1">
                        <small class="text-danger" id="errJudul"></small>
                    </div>

                    <div class="form-group">
                        <label for="kategori">Kategori materi</label>
                        <select class="form-select" id="kategori" name="kategori">
                            <option value=''>-- Pilih Kategori --</option>
                            <?php foreach ($kategori as $k) : ?>
                                <option value="<?= $k['id_kategori'] ?>"><?= $k['nama_kategori'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <small class="text-danger" id="errKat"></small>
                    </div>

                    <div class="form-group">
                        <label for="tipe">Tipe file</label>
                        <select class="form-select" id="tipe" name="tipe">
                            <option value=''>-- Pilih Tipe File --</option>
                            <?php foreach ($tipe_file as $tf) : ?>
                                <option value="<?= $tf['id_tipe_file'] ?>"><?= $tf['tipe_file'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <small class="text-danger" id="errTipe"></small>
                    </div>


                    <div>
                        <label for="">Link materi <span class="text-danger">*</span></label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><img src="<?= base_url() ?>assets/assets/vector/link1.svg" alt=""></span>
                            </div>
                            <input type="url" class="form-control" id="link" name="link" placeholder="Link materi" aria-label="linkmateri" aria-describedby="basic-addon1">
                        </div>
                        <small class="text-danger" id="errLink"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="addEditMateri" name="id_materi" value="" class="btn btn-primary">

                    </button>
                </div>
            </form>
        </div>
    </div>

</div> -->

<!-- modal hapus -->
<!-- <div class="modal fade" id="dltMateriModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="modalLabelHapus">Hapus Materi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formMateriHapus" method="POST">
                <p id="pesan"></p>
                <input type="hidden" name="id_materi" value="" id="is">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="deleteMateri" class="btn btn-primary"></button>
                </div>
            </form>
        </div>
    </div>




</div> -->

<!-- Datatable admin -->
<script>
    $(document).ready(function() {
        table = $('#listMateri').DataTable({
            responsive: true,
            ajax: "<?= base_url("Materi/dataMateriAdmin") ?>",
            dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6 d-grid gap-2 d-md-flex justify-content-md-end'<'float-md-right ml-2'f>B>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            select: 'single',
            buttons: ['csv', {
                'text': '<span class="fa fa-plus"></span> Tambah Materi',
                'className': 'btn btn-primary tambahMateri',
                'attr': {
                    'title': 'Tambah materi',
                }
            }],
            columns: [{
                    data: 'no'
                },
                {
                    data: 'judul'
                },
                {
                    data: 'kategori'
                },
                {
                    data: 'tipe_file'
                },
                {
                    data: 'create_at'
                },
                {
                    data: 'update_at'
                },
                {
                    data: 'action'
                },
            ],
        });


    });
</script>

<!-- Datatable peserta -->
<script>
    $(document).ready(function() {
        var table = $("#materiPeserta").DataTable({
            responsive: true,
            // "serverSide": true,
            dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6 d-grid gap-2 d-md-flex justify-content-md-end'<'float-md-right ml-2'f>B>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            // ajax: "<?= base_url("Materi/dataMateriPeserta") ?>",
            ajax: {

                url: '<?= base_url() ?>Materi/dataMateriPeserta',
                method: 'POST',
                data: function() {
                    return {
                        ktgr: $('#ktgr').val(),
                        // tpfl: $('#tpfl').val()
                    }
                },
                dataType: 'JSON',
            },
            buttons: [
                "csv",
                {
                    text: '<i class="fa fa-id-badge fa-fw" aria-hidden="true"></i>',
                    action: function(e, dt, node) {
                        $(dt.table().node()).toggleClass("cards");
                        $(".fa", node).toggleClass(["fa-table", "fa-id-badge"]);

                        dt.draw("page");
                    },
                    className: "btn-sm",
                    attr: {
                        title: "Change views",
                    },
                },
            ],
            select: "single",
            columns: [{
                    data: 'thumbnail'
                },
                {
                    data: "materi",
                },

                {
                    data: "deskripsi",
                },
                {
                    data: "ref_link",
                },
                {
                    data: "referensi_file",
                },
                // {
                //     data: "deskripsi",
                // },

            ],
            drawCallback: function(settings) {
                var api = this.api();
                var $table = $(api.table().node());

                if ($table.hasClass("cards")) {
                    // Create an array of labels containing all table headers
                    var labels = [];
                    $("thead th", $table).each(function() {
                        labels.push($(this).text());
                    });

                    // Add data-label attribute to each cell
                    $("tbody tr", $table).each(function() {
                        $(this)
                            .find("td")
                            .each(function(column) {
                                $(this).attr("data-label", labels[column]);
                            });
                    });

                    var max = 0;
                    $("tbody tr", $table)
                        .each(function() {
                            max = Math.max($(this).height(), max);
                        })
                        .height(max);
                } else {
                    // Remove data-label attribute from each cell
                    $("tbody td", $table).each(function() {
                        $(this).removeAttr("data-label");
                    });

                    $("tbody tr", $table).each(function() {
                        $(this).height("auto");
                    });
                }
            },
        })
    });

    $('.kat').click(function(e) {
        e.preventDefault();
        $('#ktgr').val($(this).val());
        $('.kat').removeClass('aktip1');
        $(this).addClass('aktip1');
        $("#materiPeserta").DataTable().ajax.reload();
    });

    $('.tf').click(function(e) {
        e.preventDefault();
        $('#tpfl').val($(this).val());
        $('.tf').removeClass('aktip2');
        $(this).addClass('aktip2');
        $("#materiPeserta").DataTable().ajax.reload();
    });
</script>

<script src="<?= base_url('assets/js/materi.js') ?>"></script>

<script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>