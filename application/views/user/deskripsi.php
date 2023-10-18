

<section id="jumbo" class="flex justify-center">
    <div class="container relative flex justify-center">
        <img src="<?= base_url() ?>assets/assets/img/lp/dm/jumbo.png" alt="" class="bg-auto bg-no-repeat bg-center absolute -z-10 w-full h-full" />
        <div class="w-full">
            <div class="px-16 lg:pl-32 py-16 md:w-1/2 text-white">
                <div>
                    <h1 class="font-semibold text-xl lg:text-4xl">
                        Pelatihan & Sertifikasi <?php echo $pelatihan['nama_pelatihan'] ?> : <?php echo $kategori['kategori'] ?>
                    </h1>
                    <p class="leading-relaxed text-justify font-Open_Sans mt-3 lg:text-xl">
                        <?php echo $kategori['uraian']?>
                    </p>
                </div>
                <a href="#biaya">
                    <button class="bg-primaryBtn px-4 py-3 text-xs lg:text-sm mt-6 rounded-lg border-2 border-primaryBtn hover:bg-transparent hover:text-primaryBtn">
                        Daftar Sekarang
                    </button>
                </a>
            </div>
        </div>
    </div>
</section>

<div class="flex justify-center">
    <div class="container flex justify-center py-16 px-9 md:px-16">
        <!-- SIDE DETAIL START-->
        <div id="detail" class="w-1/4 px-9 hidden md:block">
            <h1 class="text-primaryDetailText font-semibold">DETAIL</h1>
            <div>
                <li class="li-lp">
                    <a class="detail-side" href="#deskripsi">Deskripsi</a>
                </li>
                <li class="li-lp">
                    <a class="detail-side" href="#kurikulum">Kurikulum</a>
                </li>
                <li class="li-lp">
                    <a class="detail-side" href="#biaya">Biaya</a>
                </li>
                <li class="li-lp">
                    <a class="detail-side" href="#trainer">Trainer</a>
                </li>
            </div>
        </div>
        <!-- SIDE DETAIL END -->
        <div class="w-3/4">
            <!-- SECTION DESKRIPSI START -->

            <section id="deskripsi">
                <h3 class="tag-lp">Deskripsi</h3>
                <h1 class="h1-section-lp">Kenapa harus Digital Marketing</h1>
                <php class="leading-relaxed text-sm">
                    <?php echo $pelatihan['deskripsi'] ?>
                    </p>
                    <div id="content" class="my-6 hidden">
                        <h1 class="h2-section-lp">Apakah Saya Cocok dan Bagaimana Pilihan Karier-nya?
                        </h1>
                        <p class="leading-relaxed text-sm">
                            Pelatihan digital <i>marketing</i> cocok untuk dikuasai oleh semua orang, terkhusus mereka yang ingin berkarier di bidang <i>marketing</i> atau sedang mengembangkan bisnis. Keahlian yang akan didapatkan seperti, teknik riset data digital, teknik digital <i>marketing</i>, serta berbagai optimasi pemilihan <i>marketing</i> channel. Lalu dengan keahlian tersebut bagaimana <b>PROSPEK KARIER-nya?</b> Berikut pilihan karier yang dapat dipilih:

                        </p>
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 text-sm my-3">
                            <div class="my-1.5 flex items-center">
                                <img src="<?= base_url() ?>assets/assets/vector/centang.svg" class="mr-6" />
                                <p>Digital Marketing Agency</p>
                            </div>
                            <div class="my-1.5 flex items-center">
                                <img src="<?= base_url() ?>assets/assets/vector/centang.svg" class="mr-6" />
                                <p>Social Media Specialist</p>
                            </div>
                            <div class="my-1.5 flex items-center">
                                <img src="<?= base_url() ?>assets/assets/vector/centang.svg" class="mr-6" />
                                <p>Business Consultant</p>
                            </div>
                            <div class="my-1.5 flex items-center">
                                <img src="<?= base_url() ?>assets/assets/vector/centang.svg" class="mr-6" />
                                <p>Business Owner</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex mt-6">
                        <input id="cb" type="checkbox" class="peer hidden opacity-0" />

                        <button id="showHide" class="flex items-center text-secondaryDetailText font-semibold text-sm">
                            Show More
                        </button>
                        <img id="arrow" src="<?= base_url() ?>assets/assets/vector/show_arrow.svg" alt="" class="m-2 transition-transform duration-500 rotate-180 peer-checked:rotate-0" />
                    </div>
            </section>

            <!-- SECTION DESKRIPSI END -->

            <!-- SECTION KURIKULUM START -->
            <section id="kurikulum" class="mt-6">
                <h3 class="tag-lp">Kurikulum </h3>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 text-sm my-3">
                    <?php foreach ($pelatihan['kurikulum'] as $plt) : ?>
                        <div class="my-1.5 flex items-center">
                            <img src="<?= base_url() ?>assets/assets/vector/double_checklist.svg" class="mr-6" />
                            <div>
                                <p class="my-2"> <?php echo $plt['kurikulum'] ?></p>
                                <div class="my-1.5 flex items-center">
                                    <p class=""> <?php echo $plt['deskripsi'] ?></p>
                                </div>
                            </div>
                        </div>

                    <?php endforeach ?>

                    <!-- Deskripsi kurikulum -->

                </div>
                <!-- SECTION KURIKULUM END -->

                <!-- SECTION MATERI -->
                <h1 class="h2-section-lp mt-6">Konten Materi</h1>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 text-sm my-3">
                    <?php foreach ($pelatihan['materi'] as $plt) : ?>
                        <div class="my-1.5 flex items-center">
                            <img src="<?= base_url() ?>assets/assets/vector/double_checklist.svg" class="mr-6" />
                            <div>
                                <p> <?php echo $plt['materi'] ?></p>
                                <div class="my-1.5 flex items-center">
                                    <p class=""> <?php echo $plt['deskripsi'] ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>

                </div>
            </section>
            <!-- SECTION MATERI END -->

            <!-- SECTION BIAYA START -->
            <section id="biaya" class="mt-6">
                <h3 class="tag-lp">Biaya</h3>
                <h1 class="h1-section-lp">Penawaran spesial untuk Anda</h1>
                <p class="leading-relaxed text-sm">
                    Berikut rincian biaya program ini serta pilihan metode pembayaran.
                    Jangan lewatkan promo dan dapatkan harga eksklusif!
                </p>
                <div class="carousel slide relative" data-bs-ride="static">
                    <div class="action flex">
                        <a href="#" data-slide="1" class="w-fit h-fit m-5"><button id="online" class="flex items-center justify-center p-0 text-center focus:outline-none  border-b-2" style='--tw-border-opacity: 1; border-color: rgb(0 0 0 / var(--tw-border-opacity));'>
                                ONLINE
                            </button></a>
                        <a href="#" data-slide="2" class="w-fit h-fit m-5"><button id="offline" class="flex items-center justify-center p-0 text-center focus:outline-none " style='--tw-border-opacity: 1; border-color: rgb(0 0 0 / var(--tw-border-opacity));'>
                                OFFLINE
                            </button></a>
                    </div>
                    <!-- control end -->
                    <div class="slider slider-for relative w-full overflow-hidden">
                        <div class="w-full">

                            <div class="flex flex-wrap justify-center lg:justify-start">
                                <?php foreach ($pelOnline as $po) : ?>

                                    <!-- ITEM 2 -->
                                    <div class="min-w-[260px]">
                                        <div class="shadow-md rounded-md px-6 pb-6 bg-white my-3 mx-2">
                                            <div class="border-b-2 border-[#F5F5F5];">
                                                <h1 class="pt-[30px] text-center font-semibold text-xl lg:text-[24px]">
                                                    <?php echo $po['jenis'] ?>
                                                </h1>
                                                <div class="flex items-center flex-col">
                                                    <img src="<?= base_url(); ?>assets/assets/vector/group.svg" class="my-[16px]" />
                                                </div>
                                                <div class="flex items-center flex-col">
                                                    <h2 class="text-secondaryTextBlue font-semibold text-base lg:text-[18px] text-center">
                                                        <?php echo $po['keterangan'] ?>
                                                    </h2>

                                                    <h2 class="my-[4px] text-[#939393] line-through text-lg lg:text-xl font-normal">
                                                        Rp. <?= number_format($po['harga'], 0, '', '.'); ?>
                                                    </h2>
                                                    <h2 class="font-semibold text-[26px] lg:text-[28px] text-center">
                                                        Rp. <?= number_format($po['harga'] - $po['diskon'], 0, '', '.'); ?>
                                                    </h2>
                                                    <span class="text-sm font-bold">/orang</span>
                                                </div>
                                            </div>
                                            <div class="my-6">
                                                <?php foreach (json_decode($po['fasilitas']) as $fas) : ?>
                                                    <div class="flex">
                                                        <img src="<?= base_url() ?>assets/assets/vector/check-circle.svg" class="mx-3" />
                                                        <p class="leading-relaxed lg:text-base text-sm font-normal">
                                                            <?= $fas->fasilitas ?>
                                                        </p>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                        <div class="flex justify-center relative h-11 top-[-38px]">
                                            <form action="<?= base_url('daftar') ?>" method="post" class="w-fit">
                                                <input class="absolute" style="visibility:hidden ;" name="id_pel" size="1" type="text" value="<?= $id_pel ?>">
                                                <input class="absolute" style="visibility:hidden ;" name="id_biaya" size="1" type="text" value="<?= $po['id'] ?>">
                                                <button id="daftarSekarang" type="submit" class="block font-semibold text-[16px] text-white px-11 py-3 bg-primaryBtn rounded-lg" style="background-color: orange;">
                                                    Daftar Sekarang
                                                </button>
                                            </form>

                                        </div>
                                    </div>

                                <?php endforeach; ?>
                            </div>


                        </div>

                        <div class="w-full">

                            <div class="flex flex-wrap justify-center lg:justify-start">
                                <?php foreach ($pelOffline as $po) : ?>

                                    <!-- ITEM 2 -->
                                    <div class="min-w-[260px]">
                                        <div class="shadow-md rounded-md px-6 pb-6 bg-white my-3 mx-2">
                                            <div class="border-b-2 border-[#F5F5F5];">
                                                <h1 class="pt-[30px] text-center font-semibold text-xl lg:text-[24px]">
                                                    <?php echo $po['jenis'] ?>
                                                </h1>
                                                <div class="flex items-center flex-col">
                                                    <img src="<?= base_url(); ?>assets/assets/vector/group.svg" class="my-[16px]" />
                                                </div>
                                                <div class="flex items-center flex-col">
                                                    <h2 class="text-secondaryTextBlue font-semibold text-base lg:text-[18px] text-center">
                                                        <?php echo $po['keterangan'] ?>
                                                    </h2>

                                                    <h2 class="my-[4px] text-[#939393] line-through text-lg lg:text-xl font-normal">
                                                        Rp. <?= number_format($po['harga'], 0, '', '.'); ?>
                                                    </h2>
                                                    <h2 class="font-semibold text-[26px] lg:text-[28px] text-center">
                                                        Rp. <?= number_format($po['harga'] - $po['diskon'], 0, '', '.'); ?>
                                                    </h2>
                                                    <span class="text-sm font-bold">/orang</span>
                                                </div>
                                            </div>
                                            <div class="my-6">
                                                <?php foreach (json_decode($po['fasilitas']) as $fas) : ?>
                                                    <div class="flex">
                                                        <img src="<?= base_url() ?>assets/assets/vector/check-circle.svg" class="mx-3" />
                                                        <p class="leading-relaxed lg:text-base text-sm font-normal">
                                                            <?= $fas->fasilitas ?>
                                                        </p>
                                                    </div>
                                                <?php endforeach; ?>

                                            </div>
                                        </div>
                                        <div class="flex justify-center relative h-11 top-[-38px]">
                                            <form action="<?= base_url('daftar') ?>" method="post" class="w-fit">
                                                <input class="absolute" style="visibility:hidden ;" name="id_pel" size="1" type="text" value="<?= $id_pel ?>">
                                                <input class="absolute" style="visibility:hidden ;" name="id_biaya" size="1" type="text" value="<?= $po['id'] ?>">
                                                <button id="daftarSekarang" type="submit" class="block font-semibold text-[16px] text-white px-11 py-3 bg-primaryBtn rounded-lg" style="background-color: orange;">
                                                    Daftar Sekarang
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                <?php endforeach; ?>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
            <!-- SECTION BIAYA END -->

            <!-- SECTION TRAINER START -->
            <section id="trainer" class="mt-6">
                <h3 class="tag-lp">Trainer</h3>
                <h1 class="h1-section-lp">Instruktur yang akan mendampingi kamu</h1>
                <p class="leading-relaxed text-sm">
                    Profesional dan berpengalaman dibidangnya. Mereka siap
                    mengakselerasi skill kamu secara
                    Komprehensif
                </p>
                <!-- TAMPILAN WEB -->
                <div class="slider">
                    <div class="card-slider">
                        <!-- CARD1 -->
                        <?php foreach ($pelatihan_trainer as $tr) : ?>
                            <div class="m-3 shadow-md rounded-[10px] p-3">
                                <div class="w-full flex justify-center my-5">
                                    <img class="rounded-full h-[114px] w-[114px] bg-secondaryDetailText" src="data:image/jpg;base64,<?= $tr['avatar']; ?>" alt="Card image cap" />
                                </div>
                                <div class="flex justify-center">
                                    <div class="h-[197px] flex items-center">
                                        <div class="text-secondaryText text-sm font-normal flex flex-col items-center">
                                            <h5 class="font-semibold text-primaryText">
                                                <?= $tr['nama'] ?>
                                            </h5>
                                            <p><?= $tr['profesi'] ?></p>
                                            <a href="<?= $tr['linkedin']  ?>"><img class="my-9" src="<?= base_url(); ?>assets/assets/vector/linkedin.svg" alt="" /></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
            <!-- SECTION TRAINER END -->
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('.text-program').addClass('text-secondary-100');
    });
    <?php
    if ($this->session->flashdata('sukses_daftar')) : ?>
        $(document).ready(function() {
            Swal.fire({
                // position: 'top-end',
                icon: 'success',
                title: " <?= $this->session->flashdata('sukses_daftar') ?>",
                showConfirmButton: false,
                timer: 2000,
            });
        });
    <?php endif; ?>
</script>