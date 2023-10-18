<div class="container mt-5">
    <div class="d-md-flex">
        <div class="list-card">
            <?php foreach ($kategori as $kat) : ?>
                <button id="a" class="card m-3 pilKat btn " value="<?= $kat['id_kategori'] ?>" style=" border-radius: 10px;">

                    <?= $kat['nama_kategori'] ?>

                </button>
            <?php endforeach; ?>
        </div>
        <div class="list-card w-100" id="materiKat">
            <h4 id="jdlList"></h4>
            <form id="listMateri" method="POST" class="position-relative">

                <h3 class="position-absolute top-50 start-50 translate-middle-x text-secondary text-center">Pilih kategori di samping</h3>

            </form>
        </div>
    </div>
</div>


<script src="<?= base_url('assets/js/kategori.js') ?>"></script>