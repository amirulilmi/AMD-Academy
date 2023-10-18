<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelatihan</title>
    <script src="<?= base_url() ?>assets/css/tailwind.css"></script>
</head>

<body>
    <div class="jumbotron bg-[url('<?= base_url() ?>assets/image/bg-jumbotron.svg')] bg-cover w-full h-[300px] flex justify-center items-center">
        <div class="title text-center w-[473px]">
            <h1 class="text-[25px] mb-3 md:mb-0 lg:text-[50px] text-[#FFB800] font-bold">AMD Academy</h1>
            <p class="text-[12px] lg:text-[16px]">Tingkatan Value Propositions Diri Anda melalui Pelatihan dan Sertifikasi Digital Marketing</p>
        </div>
    </div>

    <div class="title max-w-[1280px] text-center lg:text-left px-5 my-6 mx-auto">
        <h2 class="text-[16px] lg:text-[32px] text-[#1089C0] font-bold">Pilih Pelatihan Yang Tersedia</h2>
        <p class="lg:text-[16px] text-[10px] ">Pilih kelas yang sesuai minat kamu.</p>
    </div>

    <div class="container mx-auto max-w-[1200px]">
        <div class="flex flex-wrap justify-evenly ">
            <?php if (!empty($pelatihan)) { ?>
                <?php foreach ($pelatihan as $plt) { ?>
                    <div class="w-[162px] flex flex-row md:w-[324px] bg-green-200 bg-white p-2 my-2 md:p-5 md:my-4 border border-gray-200 shadow-md  hover:scale-105 transition-all duration-200 hover:shadow-xl">
                        <div class="title p-0 h-[50px] md:h-[100px] md:mb-0 flex items-center">
                            <h3 class="text-sm md:text-2xl font-bold mb-1 md:mb-3 text-black"><?php echo $plt['nama_pelatihan'] ?></h3>
                        </div>
                        <a href="#">
                            <img class="block w-full" src="<?= base_url() ?>assets/image/program/1.svg" alt="" />
                        </a>
                        <h3 class="text-sm md:text-xl font-bold mb-1 md:mb-3 text-[#1089C0] mt-2"><?php echo $plt['kategori'] ?></h2>
                            <p class="my-1 text-[7px] md:text-sm -mt-2"> <?php echo konversi($plt['tanggal_mulai']) ?> - <?php echo konversi($plt['tanggal_selesai']) ?> </p>
                            <div class="my-1">
                                <!-- <h2 class="my-[4px] text-[#939393] line-through text-lg lg:text-xl font-normal">
                                    Rp. <?= number_format($plt['harga'], 0, '', '.'); ?>
                                </h2>
                                <h2 class="font-semibold text-[26px] lg:text-[28px] text-center">
                                    Rp. <?= number_format($plt['harga'] - $plt['pot1'], 0, '', '.'); ?>
                                </h2> -->
                                <a href="#">
                                    <p class="my-1 text-[7px] overflow-auto md:text-sm"><?php echo substr($plt['deskripsi'], 0, 200) ?></p>
                                </a>
                                <div class="flex bg-red-500 ">
                                    <a href="<?php echo base_url('AMDA/deskripsi') ?>/<?php echo $plt['id'] ?>" class="block text-center font-semibold text-white text-[10px] md:text-[14px] bg-[#FFA110] w-full my-3 py-3 rounded-lg hover:bg-[#ee8f00] transition-all duration-200">
                                        Selengkapnya
                                    </a>
                                </div>
                            </div>
                    </div>
                <?php } ?>
            <?php } else {
                echo 'pelatihan tidak tersedia';
            } ?>
        </div>
    </div>
    <!-- CARD -->
    <!-- <div id="biaya" class="my-container md:py-24 py-16 md:py-12 md:flex-col flex-col items-center md:flex-row gap-12">
        <div class="flex flex-col md:items-center items-center gap-4 md:text-left text-center">
            <div class="text-primary-700 bg-[#A3CEFF] rounded px-3 py-2 md:py-1 text-sm">
                <p class="text-[#036ADF] font-semibold">Study Topics</p>
            </div>
            <p class="font-bold text-2xl pb-6">
                Pelatihan <?php echo 'Digital Marketing' ?> Di AMD Academy
            </p>
        </div>
        <div class="flex justify-center md:items-center">
            <div class="lg:h-full flex md:w-[1194px] flex-row gap-2 md:gap-12 flex-wrap justify-center text-center">
                <?php foreach ($pelatihan as $plt) { ?>
                    <div id="card-fwd" class=" md:w-1/4 lg:h-auto p-4 flex md:flex-col gap-4 rounded-xl border-2 border-neutral-10">
                        <img src="<?= base_url() ?>assets/assets/img/index/laptop.svg" class="w-1/3 md:w-full md:h-[186px]" />
                        <div class="w-2/3 md:w-full">
                            <p class="text-xl md:text-md font-semibold">
                                <?php echo $plt['nama_pelatihan'] ?>
                            </p>
                            <br />
                            <p class="text-left md:text-center">
                                <?php echo $plt['deskripsi'] ?>
                            </p>
                            <br />
                            <a href="<?= base_url('AMDA/deskripsi') ?>/<?php echo $plt['id'] ?>" class="text-[#FFA110] font-semibold">Lihat Selengkapnya</a>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>
    </div> -->
    <div class="my-container mt-20 flex md:flex-row items-center md:pt-0 md:pb-24 pb-16 pt-0 gap-6 lg:gap-24">
        <div class="">
            <div class="flex md:hidden flex-col items-start gap-6">
                <div class="text-[#036ADF] bg-[#A3CEFF] rounded px-3 py-2 lg:py-1 text-sm font-semibold">
                    Ask More
                </div>
                <p class="font-bold text-2xl">
                    Masih ada <br />pertanyaan lain?<br />
                </p>
                <div></div>
            </div>

            <div class="flex flex-col text-center md:text-left items-start md:items-start gap-6 flex-grow lg:w-2/3">
                <div class="hidden md:flex flex-col items-start gap-6">
                    <div class="text-[#036ADF] bg-[#A3CEFF] rounded px-3 py-2 lg:py-1 text-sm font-semibold">
                        Ask More
                    </div>
                    <p class="font-bold text-2xl">Masih ada <br />pertanyaan lain?</p>
                </div>
                <p class="text-start">
                    Klik tombol di bawah untuk konsultasi lebih lanjut dengan Tim kami
                </p>
                <div class="w-[206px] h-[45px] bg-[#1089C0] flex rounded-lg cursor-pointer">
                    <div class="flex w-full items-center">
                        <img src="<?= base_url() ?>assets/assets/img/index/wa.svg" class="w-1/4 h-[16px] -mr-2" />
                        <button type="button" class="font-semibold text-white w-3/4" id="tanya">
                            Tanya lebih lanjut
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="hidden lg:block">
            <img src="<?= base_url() ?>assets/assets/img/index/bola2.svg" />
        </div>
    </div>
</body>

</html>