<section id="jumbo" class="flex justify-center">
    <div class="container relative flex justify-center">
        <img src="<?= base_url() ?>assets/assets/img/lp/ds/jumbo.png" alt="" class="bg-auto bg-no-repeat bg-center absolute -z-10 w-full h-full" />
        <div class="w-full">
            <div class="px-16 lg:pl-32 py-16 md:w-1/2 text-white">
                <div>
                    <h1 class="font-semibold text-xl lg:text-4xl">
                        Pelatihan & Sertifikasi Data Science
                    </h1>
                    <p class="leading-relaxed text-justify font-Open_Sans mt-3 lg:text-xl">
                        Memastikan kamu dapat belajar secara terstruktur dengan studi kasus dan data yang mencerminkan kompleksitas data Industri langsung dari perusahaan data dan praktisi agar kamu mahir dan siap berkarir di bidang data.
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
                <h1 class="h1-section-lp">Kenapa harus Data Science</h1>
                <p class="leading-relaxed text-sm">
                    Data scientist adalah pekerjaan yang kreatif, bahkan untuk standar
                    industri teknologi. Gajinya pun termasuk tinggi di pasar IT.
                    Syarat masuk tergolong mudah dibanding profesi insinyur di bidang
                    IT. Selain itu, lapangan pekerjaan di bidang ini juga terus
                    berkembang pesat. <br> <br>
                    Tugas-tugas menarik <br>
                <ul class="list-disc text-sm ml-5">
                    <li>Analisis big data </li>
                    <li>Terapkan machine learning untuk membuat prediksi, mengidentifikasi pola,
                        dan menarik kesimpulan </li>
                    <li>Bantu membuat dan meningkatkan kualitas
                        produk di bidang bisnis, industri, dan sains</li>
                </ul>

                </p>
                <div id="content" class="my-6 hidden">
                    <h1 class="h2-section-lp">Apakah Saya Cocok dan Bagaimana Pilihan Karier-nya?</h1>
                    <p class="leading-relaxed text-sm">
                        Pelatihan <i>data science</i> sangatlah terbuka bagi umum, namun perlu ditekankan bagi mereka yang ingin berkarier dalam bidang pengolahan data. Keahlian yang akan didapatkan seperti teknik menemukan, memilah, hingga menganalisis data yang relevan bagi bisnis. Lalu dengan keahlian tersebut bagaimana <b>PROSPEK karier-nya?</b> Berikut pilihan karier yang dapat dipilih:

                    </p>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 text-sm my-3">
                        <div class="my-1.5 flex items-center">
                            <img src="<?= base_url() ?>assets/assets/vector/centang.svg" class="mr-6" />
                            <p>Data Scientist</p>
                        </div>
                        <div class="my-1.5 flex items-center">
                            <img src="<?= base_url() ?>assets/assets/vector/centang.svg" class="mr-6" />
                            <p>Data Analyst</p>
                        </div>
                        <div class="my-1.5 flex items-center">
                            <img src="<?= base_url() ?>assets/assets/vector/centang.svg" class="mr-6" />
                            <p>Data Architect</p>
                        </div>
                        <div class="my-1.5 flex items-center">
                            <img src="<?= base_url() ?>assets/assets/vector/centang.svg" class="mr-6" />
                            <p>Machine Learning Engineer</p>
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
                <h3 class="tag-lp">Kurikulum</h3>
                <h1 class="h1-section-lp">Materi yang Anda dapatkan</h1>
                <p class="leading-relaxed text-sm">
                    Saat kamu menuntaskan semua kelas, kamu akan memiliki keahlian dan
                    pengetahuan yang cukup untuk memulai karir di bidang digital
                    marketing atau mengembangkan bisnismu lebih cepat dengan digital
                    marketing.
                </p>
                <h1 class="h2-section-lp mt-6">Konten Materi</h1>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 text-sm my-3">
                    <?php foreach ($kontenMateri as $km) : ?>
                        <div class="my-1.5 flex items-center">
                            <img src="<?= base_url() ?>assets/assets/vector/double_checklist.svg" class="mr-6" />
                            <p><?= $km ?></p>
                        </div>
                    <?php endforeach ?>
                </div>
            </section>
            <!-- SECTION KURIKULUM END -->

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
                            <?php foreach ($pelOnline as $po) : ?>
                                <div class="flex flex-wrap justify-center lg:justify-start">
                                    <!-- ITEM 1 -->
                                    <div class="min-w-[260px]">
                                        <div class="shadow-md rounded-md px-6 pb-6 bg-white my-3 mx-2">
                                            <div class="border-b-2 border-[#F5F5F5];">
                                                <h1 class="pt-[30px] text-center font-semibold text-xl lg:text-[24px]">
                                                    Personal
                                                </h1>

                                                <div class="flex items-center flex-col">
                                                    <img src="<?= base_url(); ?>assets/assets/vector/solo.svg" class="my-[16px]" />
                                                </div>
                                                <h2 class="text-secondaryTextBlue font-semibold text-base lg:text-[18px] text-center">
                                                    Untuk 1 orang
                                                </h2>
                                                <h2 class="my-[4px] text-[#939393] line-through text-lg lg:text-xl font-normal invisible">
                                                    Rp. <?= number_format($po['harga'], 0, '', '.'); ?>
                                                </h2>
                                                <div class="flex items-center flex-col">

                                                    <h2 class="font-semibold text-[26px] lg:text-[28px] text-center">
                                                        Rp. <?= number_format($po['harga'], 0, '', '.'); ?>
                                                    </h2>
                                                    <span class="text-sm font-bold">/orang</span>
                                                </div>
                                            </div>
                                            <div class="my-6">
                                                <div class="flex">
                                                    <img src="<?= base_url() ?>assets/assets/vector/check-circle.svg" class="mx-3" />
                                                    <p class="leading-relaxed lg:text-base text-sm font-normal">
                                                        Pelatihan
                                                    </p>
                                                </div>
                                                <div class="flex">
                                                    <img src="<?= base_url() ?>assets/assets/vector/check-circle.svg" class="mx-3" />
                                                    <p class="leading-relaxed lg:text-base text-sm font-normal">
                                                        Sertifikasi
                                                    </p>
                                                </div>
                                                <div class="flex">
                                                    <img src="<?= base_url() ?>assets/assets/vector/check-circle.svg" class="mx-3" />
                                                    <p class="leading-relaxed lg:text-base text-sm font-normal">
                                                        Mentoring
                                                    </p>
                                                </div>
                                                <div class="flex">
                                                    <img src="<?= base_url() ?>assets/assets/vector/check-circle.svg" class="mx-3" />
                                                    <p class="leading-relaxed lg:text-base text-sm font-normal">
                                                        Materi
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex justify-center relative h-11 top-[-38px]">

                                            <form action="<?= base_url('daftar') ?>" method="post" class="w-fit">
                                                <input id="id_pel" class="absolute" style="visibility:hidden ;" name="id_pel" size="1" type="text" value="<?= $po['id_pel'] ?>">
                                                <input id="pilihan" class="absolute" style="visibility:hidden ;" name="pilihan" size="1" type="text" value=' 1'>
                                                <button id="daftarSekarang" type="submit" class="block font-semibold text-[16px] text-white px-11 py-3 bg-primaryBtn rounded-lg">
                                                    Daftar Sekarang
                                                </button>

                                            </form>

                                        </div>
                                    </div>
                                    <?php if ($po['pot1'] != 0) : ?>
                                        <!-- ITEM 2 -->
                                        <div class="min-w-[260px]">
                                            <div class="shadow-md rounded-md px-6 pb-6 bg-white my-3 mx-2">
                                                <div class="border-b-2 border-[#F5F5F5];">
                                                    <h1 class="pt-[30px] text-center font-semibold text-xl lg:text-[24px]">
                                                        Rombongan I
                                                    </h1>
                                                    <div class="flex items-center flex-col">
                                                        <img src="<?= base_url(); ?>assets/assets/vector/group.svg" class="my-[16px]" />
                                                    </div>
                                                    <div class="flex items-center flex-col">
                                                        <h2 class="text-secondaryTextBlue font-semibold text-base lg:text-[18px] text-center">
                                                            Untuk 2 orang
                                                        </h2>

                                                        <h2 class="my-[4px] text-[#939393] line-through text-lg lg:text-xl font-normal">
                                                            Rp. <?= number_format($po['harga'], 0, '', '.'); ?>
                                                        </h2>
                                                        <h2 class="font-semibold text-[26px] lg:text-[28px] text-center">
                                                            Rp. <?= number_format($po['harga'] - $po['pot1'], 0, '', '.'); ?>
                                                        </h2>
                                                        <span class="text-sm font-bold">/orang</span>
                                                    </div>
                                                </div>
                                                <div class="my-6">
                                                    <div class="flex">
                                                        <img src="<?= base_url() ?>assets/assets/vector/check-circle.svg" class="mx-3" />
                                                        <p class="leading-relaxed lg:text-base text-sm font-normal">
                                                            Pelatihan
                                                        </p>
                                                    </div>
                                                    <div class="flex">
                                                        <img src="<?= base_url() ?>assets/assets/vector/check-circle.svg" class="mx-3" />
                                                        <p class="leading-relaxed lg:text-base text-sm font-normal">
                                                            Sertifikasi
                                                        </p>
                                                    </div>
                                                    <div class="flex">
                                                        <img src="<?= base_url() ?>assets/assets/vector/check-circle.svg" class="mx-3" />
                                                        <p class="leading-relaxed lg:text-base text-sm font-normal">
                                                            Mentoring
                                                        </p>
                                                    </div>
                                                    <div class="flex">
                                                        <img src="<?= base_url() ?>assets/assets/vector/check-circle.svg" class="mx-3" />
                                                        <p class="leading-relaxed lg:text-base text-sm font-normal">
                                                            Materi
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex justify-center relative h-11 top-[-38px]">
                                                <form action="<?= base_url('daftar') ?>" method="post" class="w-fit">
                                                    <input id="id_pel" class="absolute" style="visibility:hidden ;" name="id_pel" size="1" type="text" value="<?= $po['id_pel'] ?>">
                                                    <input id="pilihan" class="absolute" style="visibility:hidden ;" name="pilihan" size="1" type="text" value='2'>
                                                    <button id="daftarSekarang" type="submit" class="block font-semibold text-[16px] text-white px-11 py-3 bg-primaryBtn rounded-lg">
                                                        Daftar Sekarang
                                                    </button>

                                                </form>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($po['pot2'] != 0) : ?>
                                        <!-- ITEM 3 -->
                                        <div class="min-w-[260px]">
                                            <div class="shadow-md rounded-md px-6 pb-6 bg-white my-3 mx-2">
                                                <div class="border-b-2 border-[#F5F5F5];">
                                                    <h1 class="pt-[30px] text-center font-semibold text-xl lg:text-[24px]">
                                                        Rombongan II
                                                    </h1>
                                                    <div class="flex items-center flex-col">
                                                        <img src="<?= base_url(); ?>assets/assets/vector/group.svg" class="my-[16px]" />
                                                    </div>
                                                    <div class="flex items-center flex-col">
                                                        <h2 class="text-secondaryTextBlue font-semibold text-base lg:text-[18px] text-center">
                                                            Minimal 3 Orang
                                                        </h2>
                                                        <h2 class="my-[4px] text-[#939393] line-through text-lg lg:text-xl font-normal">
                                                            Rp. <?= number_format($po['harga'], 0, '', '.'); ?>
                                                        </h2>
                                                        <h2 class="font-semibold text-[26px] lg:text-[28px] text-center">
                                                            Rp. <?= number_format($po['harga'] - $po['pot2'], 0, '', '.'); ?>
                                                        </h2>
                                                        <span class="text-sm font-bold">/orang</span>
                                                    </div>
                                                </div>
                                                <div class="my-6">
                                                    <div class="flex">
                                                        <img src="<?= base_url() ?>assets/assets/vector/check-circle.svg" class="mx-3" />
                                                        <p class="leading-relaxed lg:text-base text-sm font-normal">
                                                            Pelatihan
                                                        </p>
                                                    </div>
                                                    <div class="flex">
                                                        <img src="<?= base_url() ?>assets/assets/vector/check-circle.svg" class="mx-3" />
                                                        <p class="leading-relaxed lg:text-base text-sm font-normal">
                                                            Sertifikasi
                                                        </p>
                                                    </div>
                                                    <div class="flex">
                                                        <img src="<?= base_url() ?>assets/assets/vector/check-circle.svg" class="mx-3" />
                                                        <p class="leading-relaxed lg:text-base text-sm font-normal">
                                                            Mentoring
                                                        </p>
                                                    </div>
                                                    <div class="flex">
                                                        <img src="<?= base_url() ?>assets/assets/vector/check-circle.svg" class="mx-3" />
                                                        <p class="leading-relaxed lg:text-base text-sm font-normal">
                                                            Materi
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex justify-center relative h-11 top-[-38px]">
                                                <form action="<?= base_url('daftar') ?>" method="post" class="w-fit">
                                                    <input id="id_pel" class="absolute" style="visibility:hidden ;" name="id_pel" size="1" type="text" value="<?= $po['id_pel'] ?>">
                                                    <input id="pilihan" class="absolute" style="visibility:hidden ;" name="pilihan" size="1" type="text" value='3'>
                                                    <button id="daftarSekarang" type="submit" class="block font-semibold text-[16px] text-white px-11 py-3 bg-primaryBtn rounded-lg">
                                                        Daftar Sekarang
                                                    </button>

                                                </form>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>

                        </div>

                        <div class="w-full">
                            <?php foreach ($pelOffline as $po) : ?>
                                <div class="flex flex-wrap justify-center lg:justify-start">
                                    <!-- ITEM 1 -->
                                    <div class="min-w-[260px]">
                                        <div class="shadow-md rounded-md px-6 pb-6 bg-white my-3 mx-2">
                                            <div class="border-b-2 border-[#F5F5F5];">
                                                <h1 class="pt-[30px] text-center font-semibold text-xl lg:text-[24px]">
                                                    Personal
                                                </h1>

                                                <div class="flex items-center flex-col">
                                                    <img src="<?= base_url(); ?>assets/assets/vector/solo.svg" class="my-[16px]" />
                                                </div>
                                                <h2 class="text-secondaryTextBlue font-semibold text-base lg:text-[18px] text-center">
                                                    Untuk 1 orang
                                                </h2>
                                                <div class="flex items-center flex-col">

                                                    <h2 class="my-[4px] text-[#939393] line-through text-lg lg:text-xl font-normal invisible">
                                                        Rp. <?= number_format($po['harga'], 0, '', '.'); ?>
                                                    </h2>
                                                    <h2 class="font-semibold text-[26px] lg:text-[28px] text-center">
                                                        Rp. <?= number_format($po['harga'], 0, '', '.'); ?>
                                                    </h2>
                                                    <span class="text-sm font-bold">/orang</span>
                                                </div>
                                            </div>
                                            <div class="my-6">
                                                <div class="flex">
                                                    <img src="<?= base_url() ?>assets/assets/vector/check-circle.svg" class="mx-3" />
                                                    <p class="leading-relaxed lg:text-base text-sm font-normal">
                                                        Pelatihan
                                                    </p>
                                                </div>
                                                <div class="flex">
                                                    <img src="<?= base_url() ?>assets/assets/vector/check-circle.svg" class="mx-3" />
                                                    <p class="leading-relaxed lg:text-base text-sm font-normal">
                                                        Sertifikasi
                                                    </p>
                                                </div>
                                                <div class="flex">
                                                    <img src="<?= base_url() ?>assets/assets/vector/check-circle.svg" class="mx-3" />
                                                    <p class="leading-relaxed lg:text-base text-sm font-normal">
                                                        Mentoring
                                                    </p>
                                                </div>
                                                <div class="flex">
                                                    <img src="<?= base_url() ?>assets/assets/vector/check-circle.svg" class="mx-3" />
                                                    <p class="leading-relaxed lg:text-base text-sm font-normal">
                                                        Materi
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex justify-center relative h-11 top-[-38px]">
                                            <form action="<?= base_url('daftar') ?>" method="post" class="w-fit">
                                                <input id="id_pel" class="absolute" style="visibility:hidden ;" name="id_pel" size="1" type="text" value="<?= $po['id_pel'] ?>">
                                                <input id="pilihan" class="absolute" style="visibility:hidden ;" name="pilihan" size="1" type="text" value='1'>
                                                <button id="daftarSekarang" type="submit" class="block font-semibold text-[16px] text-white px-11 py-3 bg-primaryBtn rounded-lg">
                                                    Daftar Sekarang
                                                </button>

                                            </form>
                                        </div>
                                    </div>
                                    <?php if ($po['pot1'] != 0) : ?>
                                        <!-- ITEM 2 -->
                                        <div class="min-w-[260px]">
                                            <div class="shadow-md rounded-md px-6 pb-6 bg-white my-3 mx-2">
                                                <div class="border-b-2 border-[#F5F5F5];">
                                                    <h1 class="pt-[30px] text-center font-semibold text-xl lg:text-[24px]">
                                                        Rombongan I
                                                    </h1>
                                                    <div class="flex items-center flex-col">
                                                        <img src="<?= base_url(); ?>assets/assets/vector/group.svg" class="my-[16px]" />
                                                    </div>
                                                    <div class="flex items-center flex-col">
                                                        <h2 class="text-secondaryTextBlue font-semibold text-base lg:text-[18px] text-center">
                                                            Untuk 2 orang
                                                        </h2>

                                                        <h2 class="my-[4px] text-[#939393] line-through text-lg lg:text-xl font-normal">
                                                            Rp. <?= number_format($po['harga'], 0, '', '.'); ?>
                                                        </h2>
                                                        <h2 class="font-semibold text-[26px] lg:text-[28px] text-center">
                                                            Rp. <?= number_format($po['harga'] - $po['pot1'], 0, '', '.'); ?>
                                                        </h2>
                                                        <span class="text-sm font-bold">/orang</span>
                                                    </div>
                                                </div>
                                                <div class="my-6">
                                                    <div class="flex">
                                                        <img src="<?= base_url() ?>assets/assets/vector/check-circle.svg" class="mx-3" />
                                                        <p class="leading-relaxed lg:text-base text-sm font-normal">
                                                            Pelatihan
                                                        </p>
                                                    </div>
                                                    <div class="flex">
                                                        <img src="<?= base_url() ?>assets/assets/vector/check-circle.svg" class="mx-3" />
                                                        <p class="leading-relaxed lg:text-base text-sm font-normal">
                                                            Sertifikasi
                                                        </p>
                                                    </div>
                                                    <div class="flex">
                                                        <img src="<?= base_url() ?>assets/assets/vector/check-circle.svg" class="mx-3" />
                                                        <p class="leading-relaxed lg:text-base text-sm font-normal">
                                                            Mentoring
                                                        </p>
                                                    </div>
                                                    <div class="flex">
                                                        <img src="<?= base_url() ?>assets/assets/vector/check-circle.svg" class="mx-3" />
                                                        <p class="leading-relaxed lg:text-base text-sm font-normal">
                                                            Materi
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex justify-center relative h-11 top-[-38px]">
                                                <form action="<?= base_url('daftar') ?>" method="post" class="w-fit">
                                                    <input id="id_pel" class="absolute" style="visibility:hidden ;" name="id_pel" size="1" type="text" value="<?= $po['id_pel'] ?>">
                                                    <input id="pilihan" class="absolute" style="visibility:hidden ;" name="pilihan" size="1" type="text" value='2'>
                                                    <button id="daftarSekarang" type="submit" class="block font-semibold text-[16px] text-white px-11 py-3 bg-primaryBtn rounded-lg">
                                                        Daftar Sekarang
                                                    </button>

                                                </form>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($po['pot2'] != 0) : ?>
                                        <!-- ITEM 3 -->
                                        <div class="min-w-[260px]">
                                            <div class="shadow-md rounded-md px-6 pb-6 bg-white my-3 mx-2">
                                                <div class="border-b-2 border-[#F5F5F5];">
                                                    <h1 class="pt-[30px] text-center font-semibold text-xl lg:text-[24px]">
                                                        Rombongan II
                                                    </h1>
                                                    <div class="flex items-center flex-col">
                                                        <img src="<?= base_url(); ?>assets/assets/vector/group.svg" class="my-[16px]" />
                                                    </div>
                                                    <div class="flex items-center flex-col">
                                                        <h2 class="text-secondaryTextBlue font-semibold text-base lg:text-[18px] text-center">
                                                            Minimal 3 Orang
                                                        </h2>
                                                        <h2 class="my-[4px] text-[#939393] line-through text-lg lg:text-xl font-normal">
                                                            Rp. <?= number_format($po['harga'], 0, '', '.'); ?>
                                                        </h2>
                                                        <h2 class="font-semibold text-[26px] lg:text-[28px] text-center">
                                                            Rp. <?= number_format($po['harga'] - $po['pot2'], 0, '', '.'); ?>
                                                        </h2>
                                                        <span class="text-sm font-bold">/orang</span>
                                                    </div>
                                                </div>
                                                <div class="my-6">
                                                    <div class="flex">
                                                        <img src="<?= base_url() ?>assets/assets/vector/check-circle.svg" class="mx-3" />
                                                        <p class="leading-relaxed lg:text-base text-sm font-normal">
                                                            Pelatihan
                                                        </p>
                                                    </div>
                                                    <div class="flex">
                                                        <img src="<?= base_url() ?>assets/assets/vector/check-circle.svg" class="mx-3" />
                                                        <p class="leading-relaxed lg:text-base text-sm font-normal">
                                                            Sertifikasi
                                                        </p>
                                                    </div>
                                                    <div class="flex">
                                                        <img src="<?= base_url() ?>assets/assets/vector/check-circle.svg" class="mx-3" />
                                                        <p class="leading-relaxed lg:text-base text-sm font-normal">
                                                            Mentoring
                                                        </p>
                                                    </div>
                                                    <div class="flex">
                                                        <img src="<?= base_url() ?>assets/assets/vector/check-circle.svg" class="mx-3" />
                                                        <p class="leading-relaxed lg:text-base text-sm font-normal">
                                                            Materi
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex justify-center relative h-11 top-[-38px]">
                                                <form action="<?= base_url('daftar') ?>" method="post" class="w-fit">
                                                    <input id="id_pel" class="absolute" style="visibility:hidden ;" name="id_pel" size="1" type="text" value="<?= $po['id_pel'] ?>">
                                                    <input id="pilihan" class="absolute" style="visibility:hidden ;" name="pilihan" size="1" type="text" value='3'>
                                                    <button id="daftarSekarang" type="submit" class="block font-semibold text-[16px] text-white px-11 py-3 bg-primaryBtn rounded-lg">
                                                        Daftar Sekarang
                                                    </button>

                                                </form>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
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
                    mengakselerasi kompetensi Digital Marketing kamu secara
                    Komprehensif
                </p>
                <!-- TAMPILAN WEB -->
                <div class="slider">
                    <div class="card-slider">
                        <!-- CARD1 -->
                        <?php foreach ($trainer as $tr) : ?>
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
                                            <a target="_blank" href="<?= $tr['linkedin'] ?>"><img class="my-9" src="<?= base_url(); ?>assets/assets/vector/linkedin.svg" alt="" /></a>
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
?>