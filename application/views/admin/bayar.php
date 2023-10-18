<main class="  main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <div class="container p-3">


        <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive" style="margin:10px;">
                <table class="table table-hover table-striped align-middle" id="listBayar" style="width: 100%;max-width:100%;">
                    <thead class="">
                        <tr>
                            <?php switch ($user['user_group_id']):
                                case $idAdmin: ?>
                                    <th>ID Order</th>
                                    <th>Nama Peserta</th>
                                    <th>Jenis Pembayaran</th>
                                    <th>Nama Pelatihan</th>
                                    <th>Nominal (1 orang)</th>
                                    <th>Waktu Pendaftaran</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                <?php break;
                                case $idPeserta: ?>
                                    <th>No</th>
                                    <th>Nama Pelatihan</th>
                                    <th>Tipe </th>
                                    <th>Nominal</th>
                                    <th>Waktu</th>
                                    <th>ID Pembelian</th>
                                    <th>Status</th>
                                    <th>Action</th>
                            <?php break;
                            endswitch; ?>

                        </tr>
                    </thead>
                    <tbody id="tbl_data">

                    </tbody>
                </table>
                <!-- Paginate -->
                <div class="pagination"></div>
            </div>
        </div>
        <?php switch ($user['user_group_id']):
            case $idAdmin: ?>
                <button type="button" class="btn btn-danger " id="delBayar" data-bs-toggle="popover" data-bs-placement="right" data-bs-custom-class="custom-popover" data-bs-trigger="hover" data-bs-title="Hapus Transaksi Pendaftaran" data-bs-content="Data pendaftaran yang akan dihapus adalah seluruh data pendaftaran yang dalam 1 hari statusnya tidak diketahui">
                    <i class="fa fa-lg fa-fw fa-trash" aria-hidden="true"></i>
                </button>
            <?php break;
            case $idPeserta: ?>

        <?php break;
        endswitch; ?>

    </div>

    <!-- modal -->
    <div class="modal fade" id="terimaModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Terima Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formTerima" method="POST">
                    <input type="hidden" name="i" id="i" value="">
                    <div class="modal-body">
                        <label for="">Status</label>
                        <div class="row">
                            <fieldset id="group1" class="row">

                                <div class="col-3 align-middle">

                                    <input type="radio" id="200" name="status_code" class="w-25" value="200" style="accent-color: green;">
                                    <label class="text-success mr-3" for="200">Acepted</label>
                                </div>

                                <div class="col-3">

                                    <input type="radio" id="201" name="status_code" class="w-25" value="201" style="accent-color: yellow;">
                                    <label class="text-warning mr-3" for="201">Pending</label>
                                </div>
                                <div class="col-3">

                                    <input type="radio" id="1" name="status_code" class="w-25" value="1" style="accent-color: red;">
                                    <label class="text-danger" for="1">Declined</label>
                                </div>
                            </fieldset>

                        </div>

                        <div id="linkBuktiBayar">
                            <label for="">Link Bukti Pembayaran</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><img src="<?= base_url() ?>assets/assets/vector/link1.svg" alt=""></span>
                                </div>
                                <input type="text" class="form-control" id="bukti" name="bukti" placeholder="Link bukti" aria-label="linkBukti" aria-describedby="basic-addon1">
                            </div>
                        </div>




                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="sc" name="order_id" value="" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>




    </div>



    <script>
        $(document).ready(function() {
            table = $('#listBayar').DataTable({
                responsive: true,

                <?php switch ($user['user_group_id']):
                    case $idAdmin: ?>
                        ajax: "<?= base_url("Pembayaran/dataBayar") ?>",
                        columns: [{
                                data: 'id_order'
                            },
                            {
                                data: 'nama'
                            },
                            {
                                data: 'jenis'
                            },
                            {
                                data: 'nama_kategori'
                            },
                            {
                                data: 'nominal'
                            },
                            {
                                data: 'waktu'
                            },
                            {
                                data: 'status'
                            },
                            {
                                data: 'action'
                            },
                        ],
                    <?php break;
                    case $idPeserta: ?>
                        ajax: "<?= base_url("Pembayaran/dataBayarPeserta") ?>",
                        columns: [{
                                data: 'no'
                            },
                            {
                                data: 'nama_kategori'
                            },
                            {
                                data: 'tipe'
                            },
                            {
                                data: 'nominal'
                            },
                            {
                                data: 'waktu'
                            },
                            {
                                data: 'order_id'
                            },
                            {
                                data: 'status'
                            },
                            {
                                data: 'action'
                            },
                        ],
                    <?php break;
                    default: ?>
                <?php break;
                endswitch; ?>

            });

        });
    </script>

    <script src="<?= base_url('assets/js/bayar.js') ?>"></script>