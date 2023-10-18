<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-sKxzbcA3JlIuWwOd"></script>

<form id="payment-form" method="post" action="<?= site_url() ?>/snap/finish">
    <input type="hidden" name="result_type" id="result-type" value=""></div>
    <input type="hidden" name="result_data" id="result-data" value=""></div>
</form>


<section class="flex justify-center">
    <div class="container">
        <div class="flex flex-wrap w-full h-full px-6 lg:px-16 py-16">
            <div class="w-full lg:w-2/5 flex justify-center p-10">
                <div class="w-fit flex flex-col items-center">
                    <!--Program Pelatihan -->
                    <div class="min-w-[260px] w-fit">
                        <div class="shadow-md rounded-md lg:px-16 pb-6 bg-white m-4 border">
                            <div class="border-b-2 border-[#F5F5F5];">
                                <h1 class="pt-[30px] text-center font-semibold text-xl lg:text-[24px]">
                                    <?= $pelPilihan['jenis'] ?>
                                </h1>
                                <div class="flex items-center flex-col">
                                    <img src="<?= base_url('assets/assets/vector/solo.svg'); ?>" class="my-[16px]" />
                                </div>
                                <div class="flex items-center flex-col">
                                    <h2 class="text-secondaryTextBlue font-semibold text-base lg:text-[18px] text-center">
                                        <?= $pelPilihan['keterangan'] ?>
                                    </h2>
                                    <?php if ($pelPilihan['diskon'] != 0) : ?>
                                        <h2 class="my-[4px] text-[#939393] line-through text-lg lg:text-xl font-normal">
                                            Rp. <?= number_format($pelPilihan['harga'], 0, '', '.'); ?>
                                        </h2>
                                    <?php endif; ?>
                                    <h2 class="font-semibold text-[26px] lg:text-[28px] text-center">
                                        Rp. <?= number_format($pelPilihan['harga'] - $pelPilihan['diskon'], 0, '', '.'); ?>
                                    </h2>
                                    <span class="text-sm font-bold">/orang</span>
                                </div>
                            </div>

                            <!-- Konten Materi -->
                            <div class="px-4">
                                <h1 class="h2-section-lp mt-6 text-secondaryDetailText">
                                    Konten Materi
                                </h1>
                                <div class="gap-4 text-sm my-3">
                                    <?php foreach ($kontenMateri as $km) : ?>
                                        <div class="my-1.5 flex items-center">
                                            <img src="<?= base_url() ?>assets/assets/vector/double_checklist.svg" class="mr-6" />
                                            <p><?= $km['materi'] ?></p>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                            </div>
                            <!-- Fasililtas -->
                            <div class="p-4">
                                <h1 class="h2-section-lp text-secondaryDetailText mt-6">
                                    Fasililtas
                                </h1>
                                <div class="gap-4 text-sm my-3">
                                    <?php foreach ($fasilitas as $fs) : ?>
                                        <div class="my-1.5 flex items-center">
                                            <img src="<?= base_url('assets/assets/vector/double_checklist.svg'); ?>" class="mr-6" />
                                            <p><?= $fs->fasilitas ?></p>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="flex justify-center relative h-11 top-[-38px]"></div> -->
                    </div>
                </div>
            </div>
            <div class="w-full lg:w-3/5 flex justify-center p-6 lg:p-8">
                <div class="w-full">
                    <!-- Form Pendaftaran -->
                    <form id="daftar" method="post">
                        <h1 class="h1-section-lp text-center text-3xl">
                            Form Pendaftaran
                        </h1>
                        <label class="block mb-7">
                            <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700">
                                Email
                            </span>
                            <input required type="email" id="email" name="email" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" placeholder="you@example.com" />

                        </label>
                        <label class="block mb-7">
                            <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700">
                                Nama
                            </span>
                            <input required value="<?= (array_key_exists('nama', $data_member)) ? $data_member['nama'] : ''; ?>" type="text" id="nama" name="nama" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" placeholder="Masukkan nama anda" />

                        </label>
                        <label class="block mb-7">
                            <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700">
                                Nomor Telepon
                            </span>
                            <div class="flex">
                                <span class="flex items-center mt-1 px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                    +62
                                </span>
                                <input required value="<?= (array_key_exists('nomor_hp', $data_member)) ? $data_member['nomor_hp'] : ''; ?>" type="text" id="no_hp" name="no_hp" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-r-md sm:text-sm focus:ring-1" placeholder="Masukkan nomor telepon anda" />
                            </div>
                            <small id="mustNum" class="text-red-500"></small>
                        </label>
                        <label class="block mb-7">
                            <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700">
                                Alamat
                            </span>
                            <div class="flex flex-wrap mt-1 pt-2">
                                <select id="prov_id" name="provinsi_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block mx-1 mb-3 p-2.5">
                                    <option selected value="">Provinsi</option>
                                    <?php foreach ($provinsi as $p) : ?>
                                        <option value="<?= $p->id ?>"><?= $p->nama_provinsi ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <select id="kab_id" name="kabupaten_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block mx-1 mb-3 p-2.5">
                                    <option selected>Kabupaten / Kota</option>

                                </select>
                                <select id="kec_id" name="kecamatan_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block mx-1 mb-3 p-2.5">
                                    <option selected>Kecamatan</option>
                                </select>
                            </div>
                            <input required type="text" value="<?= (array_key_exists('alamat', $data_member)) ? $data_member['alamat'] : ''; ?>" id="alamat" name="alamat" class=" px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" placeholder="Masukkan alamat anda" />

                        </label>

                        <label for="jk" class="block mb-7"><span class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700">
                                Jenis Kelamin
                            </span>
                            <div class="main flex border rounded-lg overflow-hidden select-none">
                                <!-- <div class="title py-3 my-auto px-5 bg-blue-500 text-white text-sm font-semibold mr-3">Jenis Kelamin</div> -->
                                <label class="flex radio p-2 cursor-pointer">
                                    <input type="radio" id="lk" name="jenis_kelamin" value="L">
                                    <div class="title px-2">Laki-laki</div>
                                </label>

                                <label class="flex radio p-2 cursor-pointer">
                                    <input type="radio" id="pr" name="jenis_kelamin" value="P">
                                    <div class="title px-2">Perempuan</div>
                                </label>
                            </div>
                        </label>
                        <label class="block mb-7">
                            <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700">
                                Tempat & Tanggal Lahir
                            </span>
                            <input type="text" id="tempat_lahir" value="<?= (array_key_exists('tempat_lahir', $data_member)) ? $data_member['tempat_lahir'] : ''; ?>" name="tempat_lahir" class="mt-1 px-3 py-2 my-3 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" placeholder="Masukkan tempat lahir anda" />
                            <input datetimepicker value="<?= (array_key_exists('tanggal_lahir', $data_member)) ? $data_member['tanggal_lahir'] : ''; ?>" type="date" id="tgl_lahir" name="tgl_lahir" class="focus:shadow-soft-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" type="text" placeholder="Please select a date" />
                        </label>

                        <label class="block mb-7">
                            <div class="flex flex-wrap mt-1 pt-2">
                                <div class="">
                                    <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700">
                                        Pendidikan
                                    </span>
                                    <select id="pendidikan_id" name="pendidikan_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block mx-1 mb-3 p-2.5">
                                        <option selected value="">Pendidikan</option>
                                        <?php foreach ($pendidikan as $p) : ?>
                                            <option value="<?= $p['id'] ?>"><?= $p['pendidikan'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div>
                                    <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700">
                                        Pekerjaan
                                    </span>
                                    <select id="pekerjaan_id" name="pekerjaan_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block mx-1 mb-3 p-2.5">
                                        <option selected value="">Pekerjaan</option>
                                        <?php foreach ($pekerjaan as $p) : ?>
                                            <option value="<?= $p['id'] ?>"><?= $p['pekerjaan'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                        </label>

                        <label class="block mb-7">
                            <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700">
                                Instansi
                            </span>
                            <input required type="text" id="instansi" value="<?= (array_key_exists('instansi', $data_member)) ? $data_member['instansi'] : ''; ?>" name="instansi" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" placeholder="Masukkan nama instansi anda" />
                            <small style="font-size: x-small ;">(Isi dengan "-" apabila tidak terikat instansi)</small>
                        </label>

                        <?php if ($pelPilihan['jenis'] != 'Personal') : ?>
                            <div class="my-16">
                                <h1 class="h1-section-lp">Masukkan Nomor Peserta</h1>
                                <p>
                                    masukkan nomor telepon aktif milik peserta. tahap
                                    selanjutnya admin akan menghubungi via whatsApp
                                </p>
                                <!-- nomor kamu -->
                                <label class="block my-3">
                                    <span class="block text-sm font-medium text-slate-700">
                                        Nomor Telepon Kamu
                                    </span>
                                    <div class="flex">
                                        <span class="flex items-center mt-1 px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                            +62
                                        </span>
                                        <input disabled type="text" id="no_hp1" name="no_hp1" value="" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" disabled placeholder="Nomormu akan muncul otomatis disini" />
                                    </div>
                                </label>
                                <!-- nomor lain -->
                                <div id="list_no_lain">
                                    <!-- per Nomor -->

                                    <?php for ($i = 1; $i < $pelPilihan['min_jumlah_daftar']; $i++) : ?>
                                        <div id="per_nomor" class="flex items-end w-full">
                                            <label class="block my-3 w-full">
                                                <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700">
                                                    Nomor telepon peserta lain
                                                </span>
                                                <div class="flex">
                                                    <span class="flex items-center mt-1 px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                                        +62
                                                    </span>
                                                    <input required type="text" id="no_hp_lain" name="no_hp_lain[]" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" placeholder="Masukkan nomor telepon peserta lain" />
                                                </div>

                                            </label>
                                        </div>
                                    <?php endfor; ?>
                                    <div id="d_no_hp">
                                        <button id="add_no_hp" value="<?= $pelPilihan['max_jumlah_daftar'] ?>" class="bg-green-500 rounded-xl text-white py-4 px-3">
                                            Tambah Peserta
                                        </button>
                                    </div>


                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Metode Pembayaran -->
                        <div class="min-w-[260px] lg:p-6">
                            <h1 class="h1-section-lp">Pilih Metode Pembayaran</h1>
                            <div>
                                <!-- control -->
                                <div class="flex">
                                    <a id="p_otomatis" class="metodeBayar-active cursor-pointer mx-3 px-5 py-3 bg-white rounded-t-lg flex items-center justify-center text-center">
                                        <span class="text-primaryText font-semibold bg-transparent">Otomatis</span>
                                    </a>
                                    <a id="p_manual" class="cursor-pointer mx-3 px-5 py-3 bg-white rounded-t-lg flex items-center justify-center text-center">
                                        <span class="text-primaryText font-semibold bg-transparent">Manual Transfer</span>
                                    </a>
                                </div>
                                <div class="rounded-lg bg-white rounded-t-lg shadow-[0px_25px_90px_10px_rgba(130,130,130,0.23)] mx-2 py-3 px-3 border-x border-b">
                                    <div class="flex w-full py-1 justify-between">
                                        <span for="n_program"><?= $katPilihan['nama_pelatihan'] ?> x <span id="jumlahBeli"><?= $pelPilihan['min_jumlah_daftar'] ?></span></span>
                                        <span class="" id="biaya">Rp. <?= number_format($pelPilihan['harga'] * $pelPilihan['min_jumlah_daftar'], 0, '', '.'); ?>,00</span>
                                        <input type="hidden" id="hdnBiaya" value="<?= $pelPilihan['harga'] ?>">
                                    </div>
                                    <div class="flex w-full py-1 justify-between">
                                        <span for="n_program">Potongan</span>

                                        <div class="w-fit h-fit">
                                            <span>- </span>
                                            <span class="" id="potongan">Rp.
                                                <?= number_format($pelPilihan['diskon'] * $pelPilihan['min_jumlah_daftar'], 0, '', '.'); ?>,00
                                            </span>
                                            <input type="hidden" id="hdnDiskon" value="<?= $pelPilihan['diskon'] ?>">
                                        </div>
                                    </div>
                                    <div class="flex w-full py-1 my-4 justify-between font-bold border-t">
                                        <span for="n_program">Total</span>
                                        <span class="" id="total">Rp.
                                            <?php
                                            echo number_format(($pelPilihan['harga'] - $pelPilihan['diskon']) * $pelPilihan['min_jumlah_daftar'], 0, '', '.');
                                            ?>,00
                                        </span>
                                    </div>

                                    <div id="tf_ke" class="m-5 w-full hidden">
                                        <h2 class="font-bold">Transfer ke</h2>
                                        <div class="flex flex-wrap">
                                            <div id="transfer" class="mx-3">
                                                <img class="my-6" id="logo" src="<?= base_url() ?>assets/assets/img/lp/form/mandiri-logo.png" width="150px" alt="" />
                                                <p id="nama">Arkatama Multi Solusindo</p>
                                                <p id="no_rek" class="font-bold">1440056500009</p>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" id="b_confirm_midtrans" name='id_pel' class="bg-secondaryDetailText text-white rounded-lg py-4 font-bold w-full hover:ring-primaryDetailText ring-2">
                                        Bayar Menggunakan Midtrans
                                    </button>
                                    <button type="button" id="b_confirm" class="hidden bg-secondaryDetailText text-white rounded-lg py-4 font-bold w-full hover:ring-primaryDetailText ring-2">
                                        Konfirmasi Pembayaran
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- <p><?= $data_member['nama'] ?></p> -->


<!-- <?php if ($this->session->has_userdata('id_user')) : ?>
    <script>
        $('#nama').val(<?= $data_member['nama'] ?>);
        console.log('coba');
    </script>
<?php endif ?> -->

<script type="text/javascript">
    $(document).ready(function() {
        loadkabupaten();
        loadkecamatan();
    });

    function loadkabupaten() {
        $("#prov_id").change(function() {
            var getprovinsi = $(this).val();

            $.ajax({
                type: "POST",
                dataType: "JSON",
                url: "<?= base_url(); ?>auth/getdatakab",
                data: {
                    provinsi: getprovinsi
                },
                async: false,
                success: function(data) {
                    console.log(data);
                    var html = '';
                    var i;
                    html = '<option selected>Kabupaten</option>';
                    for (i = 0; i < data.length; i++) {
                        html += '<option value="' + data[i].id + '">' + data[i].nama_kabupaten_kota + '</option>';
                    }
                    $("#kab_id").html(html);
                }
            });
        });
    }

    function loadkecamatan() {
        $("#kab_id").change(function() {
            var getkabupaten = $(this).val();
            console.log(getkabupaten);
            $.ajax({
                type: "POST",
                dataType: "JSON",
                url: "<?= base_url(); ?>auth/getdatakec",
                data: {
                    kabupaten: getkabupaten
                },
                async: false,
                success: function(data) {
                    console.log(data);
                    var html = '';
                    var i;
                    html = '<option selected>Kecamatan</option>';
                    for (i = 0; i < data.length; i++) {
                        html += '<option value="' + data[i].id + '">' + data[i].nama_kecamatan + '</option>';
                    }
                    $("#kec_id").html(html);
                }
            });
        });
    }
</script>