<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelatihan</title>
    <!-- <script src="<?= base_url() ?>assets/css/tailwind.css"></script> -->


</head>

<body>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media (min-width: 600px) {
            .judul-1 {
                font-size: 50px;
            }

            .judul-2 {
                font-size: 16px;
            }

            .judul-3 {
                font-size: 32px;
            }

            .judul-4 {
                font-size: 16px;
            }

            .container-pelatihan {
                height: 60px;
            }

            .container-card {
                max-width: 1200px;
            }

            .pelatihan {
                font-size: 24px;
            }

            .digital {
                font-size: 20px;
            }

            .tanggal {
                font-size: 12px;
            }

            .coret-harga {
                font-size: 20px;
            }

            .harga {
                font-size: 28px;
            }

            .kartu {
                width: 325px;
            }

            .btn {
                font-size: 14px;
            }
        }
    </style>
    <div id="biaya" class="jumbotron bg-[url('<?= base_url() ?>assets/image/bg-jumbotron.svg')] bg-cover w-full h-[300px] flex justify-center items-center">
        <div class="title text-center w-[473px]">
            <h1 class="judul-1 text-[30px] mb-3 md:mb-0 text-[#FFB800] font-bold"><?php echo $kategori['kategori']?></h1>
            <p class="judul-2 text-[14px]">Tingkatan skill dan Value Propositions Diri Anda melalui Pelatihan yang ada di AMD Academy</p>
        </div>
    </div>

    <div class="title px-20 max-w-[1400px] text-center lg:text-left my-6 mx-auto">
        <h2 class="judul-3 text-[18px] text-[#1089C0] font-bold">Pilih Pelatihan Yang Tersedia</h2>
        <p class="judul-4 text-[14px] ">Pilih kelas yang sesuai minat kamu.</p>
    </div>

    <div class="container-card mx-auto">
        <div class="flex justify-center flex-wrap">
            <?php if (!empty($pelatihan)) { ?>
                <?php foreach ($pelatihan as $plt) { ?>
                    <div class="kartu w-full p-3 border border-2 mt-8 mx-5 hover:scale-105 hover:shadow-lg transition ease ">
                        <div class="flex flex-col">
                            <div class="container-pelatihan h-[55px] flex items-center">
                                <h1 class="pelatihan text-[22px] p-0 font-bold my-1"><?php echo $plt['nama_pelatihan'] ?></h1>
                            </div>
                            <img class="block w-full" src="<?= base_url() ?>assets/image/program/1.svg" alt="">
                            <p class="digital text-[20px] text-[#1089C0] font-semibold  my-1"><?php echo $plt['kategori'] ?></p>
                            <p class="tanggal text-[12px] my-1"><?php echo konversi($plt['tanggal_mulai']) ?> - <?php echo konversi($plt['tanggal_selesai']) ?></p>
                            <div class="text-center my-1">
                                <p class="coret-harga line-through text-[20px] text-[#939393]">Rp. <?php echo number_format($plt['harga'], 2, ',', '.') ?></p>
                                <p class="harga text-[28px] font-bold text-[#0F345E]">Rp. <?php echo number_format($plt['harga']-$plt['diskon'], 2, ',', '.') ?></p>
                            </div>
                            <a class="btn block bg-[#FFA110] py-3 w-full rounded-lg text-center text-semibold text-white text-[6px] my-1 hover:bg-sky-700 transition ease" href="<?= base_url('AMDA/deskripsi') ?>/<?php echo $plt['id_pel'] ?>">Selengkapnya</a>
                        </div>
                    </div>
                <?php } ?>
            <?php } else {
                echo 'pelatihan tidak tersedia';
            } ?>
        </div>
    </div>

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