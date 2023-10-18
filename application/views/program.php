<section style="font-family: 'Open sans';">

    <div class="container mt-5">
        <div class="list-card d-flex flex-wrap justify-content-start">
            <?php foreach ($pelatihan as $program) { ?>
                <div class="card border-0 my-3 mx-auto mx-md-3">
                    <form action="<?php echo base_url('AMDA/deskripsi') ?>/<?php echo $program['id']?>" method="POST">
                    <h1 class="fw-semibold my-2" style="font-size: 20px;"><?php echo $program['kategori'] ?> </h1>
                    <img src="<?php  echo base_url() . 'assets/assets/img/program/dm.svg'?>">
                        <div class="card-content" style="padding-left:10px;padding-right:10px">
                            <h1 class="fw-semibold my-2" style="font-size: 20px;color:#1089C0"><?php echo $program['nama_pelatihan'] ?> </h1>
                            <div class="list-benefit d-flex">
                                <div class="logo-list">
                                    <img class="d-block my-2" src="<?= base_url() ?>assets/image/centang.svg" alt="">
                                    <img class="d-block my-2" src="<?= base_url() ?>assets/image/centang.svg" alt="">
                                    <img class="d-block my-2" src="<?= base_url() ?>assets/image/centang.svg" alt="">
                                    <img class="d-block my-2" src="<?= base_url() ?>assets/image/centang.svg" alt="">
                                </div>
                                <div class="list p-0">
                                    <ul class="mt-1 ps-2" style="line-height: 1.7; list-style: none">
                                        <li>Pelatihan</li>
                                        <li>Sertifikasi</li>
                                        <li>Mentoring</li>
                                        <li>Materi</li>
                                    </ul>
                                </div>
                            </div>
                            <input type="text" name="id_pel" value="<?php echo $program['id'] ?>" hidden>
                            <input type="text" name="pilihan" value="<?php echo 1 ?>" hidden>
                            <button type="submit" href="<?php echo base_url('AMDA/deskripsi') ?>/<?php echo $program['id']?>" class="btn btn-outline-warning px-4 mt-2" style="font-size: 14px;">DAFTAR</button>
                        </div>
                    </form>
                </div>
                
            <?php } ?>


        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</section>