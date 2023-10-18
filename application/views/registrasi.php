<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/index.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script>
    <script src="<?= base_url() ?>assets/css/tailwind.css"></script>
    <script src="https://unpkg.com/flowbite@1.5.5/dist/datepicker.js"></script>
    <style>
        .blok {
            width: 71%;
            height: 12px;
            background-color: #6BD1FF;
            z-index: -1;
            left: 0px;
            right: 0px;
            top: 31px;
            margin: auto;
        }

        .text-danger {
            color: rgb(255, 0, 0);
        }

        img {
            width: 855px;
        }
    </style>
</head>

<body style="font-family: 'poppins';">
    <div class="container mx-auto mt-20">
        <div class="main flex justify-center">
            <div class="sticky top-0">
                <div class="text-center sticky top-20 hidden lg:block ">
                    <div class="blok absolute"></div>
                    <h1 class="font-bold text-[36px]">Improve your Digital Skill with us</h1>
                    <p>Raih karir sebagai talenta digital melalui program yang kami sediakan</p>
                    <img src="<?= base_url() ?>assets/assets/img/login/jum.svg" alt="">
                </div>
            </div>
            <div class="card md:ml-0 w-[540px] border border-2 rounded-lg p-10">
                <div class="card-body">
                    <p class="text-[21px]">Selamat Datang di <span class="text-[#1089C0] font-semibold no-underline ">AMD Academy</span></p>
                    <h2 class="text-[55px] mb-10 font-semibold">Sign Up</h2>
                    <form action="" method="POST">
                        <div class="mb-6">
                            <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">Nama</label>
                            <input type="text" name="nama" id="nama" value="<?= set_value('nama'); ?>" class="w-full py-3 px-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block focus:outline-none focus:ring-blue-500 focus:border-blue-500 p-2.5" placeholder="Nama">
                            <?php echo form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="mb-6">
                            <label for="nomorHp" class="block mb-2 text-sm font-medium text-gray-900">Nomor HP </label>
                            <div class="flex">
                                <span class="flex items-center mx-2 py-3 px-3 font-semibold text-sm text-white bg-[#1089C0] border border-gray-300 border-gray-300 rounded-lg">
                                    +62
                                </span>
                                <input type="text" id="nomorHp" name="nohp" value="<?= set_value('nohp'); ?>" class="w-full py-3 px-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block focus:outline-none focus:ring-blue-500 focus:border-blue-500 p-2.5" placeholder="8xxxxxxxxxx">
                            </div>
                            <span class="text-green-500 text-[12px]">* Pastikan nomor Anda aktif!</span>
                            <?php echo form_error('nohp', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="mb-6">
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                            <input type="text" name="email" id="email" value="<?= set_value('email'); ?>" class="w-full py-3 px-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  block focus:outline-none focus:ring-blue-500 focus:border-blue-500  p-2.5" placeholder="example@gmail.com">
                            <?php echo form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <label for="password1" class="block mb-2 text-sm font-medium text-gray-900"> Password</label>
                        <div class="input-group flex">
                            <input type="password" id="password1" name="password1" value="<?= set_value('password1'); ?>" class=" w-full border border-1 text-[14px] border-gray-300 rounded-bl-lg rounded-tl-lg py-3 px-3 block focus:outline-none focus:ring-blue-500 focus:border-blue-500" name="password" id="password" placeholder="Masukkan Password" />
                            <button class="border px-2 rounded-tr-lg rounded-br-lg border-[#ADADAD] block" type="button" id="btnPw" onclick="change1()">
                                <i class="fa fa-eye fa-lg"></i>
                            </button>
                        </div>
                        <div>
                            <?php echo form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <label for="password2" class="block mb-2 mt-3 text-sm font-medium text-gray-900">Konfirmasi Password</label>
                        <div class="input-group flex">
                            <input type="password" id="password2" name="password2" value="<?= set_value('password2'); ?>" class=" w-full border border-1 text-[14px] border-gray-300 rounded-bl-lg rounded-tl-lg py-3 px-3 block focus:outline-none focus:ring-blue-500 focus:border-blue-500" name="password" id="password" placeholder="Masukkan Password" />
                            <button class="border px-2 rounded-tr-lg rounded-br-lg border-[#ADADAD] block" type="button" id="btnKPw" onclick="change2()">
                                <i class="fa fa-eye fa-lg"></i>
                            </button>
                        </div>
                        <div>
                            <?php echo form_error('password2', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>



                        <div class="mt-2">
                            <button class="text-white w-full rounded-lg py-3 px-3 mt-4" type="submit" style="background-color: #1089C0;">Buat Akun</button>
                        </div>
                    </form>
                    <p class="text-center text-[13px] text-[#808080] mt-5">Sudah punya akun? <a class="text-[#4285F4]" id="" href="<?= base_url('auth') ?>">Login</a></p>
                </div>
            </div>
        </div>
    </div>






    <!-- <form action="">
        <div class="mb-6">
            <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">Nama</label>
            <input type="text" id="nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5">
        </div>
        <div class="mb-6">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
            <input type="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5" placeholder="nama@gmail.com" required>
        </div>
        <div class="mb-6">
            <label for="nomorHp" class="block mb-2 text-sm font-medium text-gray-900">Nomor HP</label>
            <input type="text" id="nomorHp" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5" required>
        </div>
        <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900">Alamat</label>
        <div class="flex">
            <select id="alamat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block mx-4 mb-6 p-2.5">
                <option selected>Provinsi</option>
                <option value="ML">Malang</option>
                <option value="MDI">Madiun</option>
                <option value="MDA">Medan</option>
            </select>
            <select id="alamat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block mx-4 mb-6 p-2.5">
                <option selected>Kabupaten</option>
                <option value="ML">Malang</option>
                <option value="MDI">Madiun</option>
                <option value="MDA">Medan</option>
            </select>
            <select id="alamat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block mx-4Z mb-6 p-2.5">
                <option selected>Kecamatan</option>
                <option value="ML">Malang</option>
                <option value="MDI">Madiun</option>
                <option value="MDA">Medan</option>
            </select>
        </div>
        <div class="main flex border rounded-lg overflow-hidden select-none w-[400px]">
            <div class="title py-3 my-auto px-5 bg-blue-500 text-white text-sm font-semibold mr-3">Jenis Kelamin</div>
            <label class="flex radio p-2 cursor-pointer">
                <input type="radio" id="lk" name="fav_language" value="Laki-laki">
                <div class="title px-2">Laki-laki</div>
            </label>

            <label class="flex radio p-2 cursor-pointer">
                <input type="radio" id="pr" name="fav_language" value="Perempuan">
                <div class="title px-2">Perempuan</div>
            </label>
        </div>
        <div class="mb-6">
            <label for="tempatLahir" class="block mb-2 text-sm font-medium text-gray-900">Tempat Lahir</label>
            <input type="text" id="tempatLahir" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5">
        </div>
        <div class="relative">
            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <input datepicker type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block pl-10 p-2.5" placeholder="Select date">
        </div>
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm  sm:w-auto px-5 py-2.5 text-center">Submit</button>
    </form> -->

    <!-- <script>
            const noHp = document.querySelector('#nomorHp');
            console.log(noHp);

            noHp.addEventListener("keyup", function () {
                if (noHp.value = String) {
                    alert('harus angka');
                }
            })

            
        </script> -->
    <script src="<?= base_url('assets/js/jquery-3.4.1.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>

    <!-- <script type="text/javascript" src="">
        // ALERT REGISTRASI BERHASIL
        $(document).ready(function(){
            if($this->session->userdata('sukses')){
                Swal({
                title: 'Selamat',
                text: 'Registrasi Akun Anda Berhasil',
                type: 'success'
            }).then(function(){
            window.location.href = <?= base_url('auth') ?>
            });
            }
            } 
        });
    </script> -->

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
                        for (i = 0; i < data.length; i++) {
                            html += '<option value="' + data[i].id + '">' + data[i].nama_kecamatan + '</option>';
                        }
                        $("#kec_id").html(html);
                    }
                });
            });
        }
    </script>
    <script>
        function change1() {
            var x = document.getElementById('password1').type;
            if (x == 'password') {
                document.getElementById('password1').type = 'text';

                document.getElementById('btnPw').innerHTML = '<i class="fa fa-eye-slash fa-lg"></i>'
            } else {
                document.getElementById('password1').type = 'password';

                document.getElementById('btnPw').innerHTML = '<i class="fa fa-eye fa-lg"></i>';
            }
        }

        function change2() {
            var x = document.getElementById('password2').type;
            if (x == 'password') {
                document.getElementById('password2').type = 'text';

                document.getElementById('btnKPw').innerHTML = '<i class="fa fa-eye-slash fa-lg"></i>'
            } else {
                document.getElementById('password2').type = 'password';

                document.getElementById('btnKPw').innerHTML = '<i class="fa fa-eye fa-lg"></i>';
            }
        }
    </script>
</body>

</html>