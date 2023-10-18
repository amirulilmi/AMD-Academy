<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<link rel="stylesheet" href="<?= base_url() ?>assets/css/stylecontact.css">
<div class="container mx-auto mt-20 ">
    <div class="kontak flex flex-wrap p-2 bg lg:p-20">
        <div class="page1 relative w-full self-center p-5 rounded-bl-xl bg-white shadow-lg lg:w-1/2">
            <h1 class="font-semibold text-2xl text-center lg:text-start lg:text-4xl">Hubungi Kami</h1>
            <p class="font-normal text-lg text-center mt-2 lg:text-start lg:text-2xl">AMD Academy bekerjasama dengan PT ArkatamaMulti Solusindo, LSP Teknologi Digital, dan BNSP.</p>
            <div class="alamat mt-9 pb-4 border-b-2 border-gray-300 lg:flex lg:items-start" style="margin-top: 40px;">
                <img class="block" src="<?= base_url() ?>assets/logo/location.svg" alt="">
                <div class="lg:ml-3">
                    <h2 class="font-medium text-xl my-3 lg:text-3xl">Alamat</h2>
                    <p class="font-normal text-sm lg:text-lg">Perum Joyo Agung Greenland Nomor B4, Desa/Kelurahan Tlogomas, Kec. Lowokwaru, Kota Malang, Provinsi Jawa Timur, Kode
                        Pos: 65144</p>
                </div>
            </div>
            <div class="telepon mt-9 pb-4 border-b-2 border-gray-300 lg:flex lg:items-start" style="margin-top: 40px;">
                <img class="block" src="<?= base_url() ?>assets/logo/contact.svg" alt="">
                <div class="lg:ml-3">
                    <h2 class="font-medium text-xl my-3 lg:text-3xl">No. Telepon</h2>
                    <p class="font-normal text-sm lg:text-lg">0813-3233-2036</p>
                </div>
            </div>
            <div class="email mt-9 pb-4 border-b-2 border-gray-300 lg:flex lg:items-start" style="margin-top: 40px;">
                <img class="block" src="<?= base_url() ?>assets/logo/email.svg" alt="">
                <div class="lg:ml-3">
                    <h2 class="font-medium text-xl my-3 lg:text-3xl">Email</h2>
                    <p class="font-normal text-sm lg:text-lg">alfamedia.malang@gmail.com</p>
                </div>
            </div>
            <div class="social-media mt-10 text-center lg:text-start" style="margin-top: 40px;">
                <p class="font-normal text-sm lg:text-xl">Follow akun kami</p>
                <div class="icons flex justify-center mt-3 lg:justify-start">
                    <a href="https://www.instagram.com/amd.academy/">
                        <img class="m-2 lg:mr-1" src="<?= base_url() ?>assets/logo/instagram.svg" alt="">
                    </a>
                    <a href="https://www.facebook.com/people/AMD-Academy/100085030776403/">
                        <img class="m-2 lg:mr-1" src="<?= base_url() ?>assets/logo/facebook.svg" alt="">
                    </a>
                    <!-- <img class="m-2 lg:mr-1" src="<?= base_url() ?>assets/logo/twitter.svg" alt=""> -->
                    <a href="https://www.tiktok.com/@amd_academy?is_from_webapp=1&sender_device=pc">
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-top: 8px;">
                            <path d="M22.1333 7.76C22.1333 7.76 22.8133 8.42667 22.1333 7.76C21.2219 6.7195 20.7196 5.38324 20.72 4H16.6V20.5333C16.5682 21.428 16.1905 22.2755 15.5463 22.8973C14.9022 23.519 14.0419 23.8665 13.1467 23.8667C11.2533 23.8667 9.68 22.32 9.68 20.4C9.68 18.1067 11.8933 16.3867 14.1733 17.0933V12.88C9.57333 12.2667 5.54666 15.84 5.54666 20.4C5.54666 24.84 9.22666 28 13.1333 28C17.32 28 20.72 24.6 20.72 20.4V12.0133C22.3907 13.2131 24.3965 13.8569 26.4533 13.8533V9.73333C26.4533 9.73333 23.9467 9.85333 22.1333 7.76Z" fill="#1089C0" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        <div class="page2 relative w-full p-5 rounded-bl-xl rounded-br-xl bg-white shadow-lg lg:w-1/2 lg:pt-20 lg:rounded-br-xl lg:rounded-bl-none">
            <div class="logo mb-8">
                <img class="hidden lg:block" src="<?= base_url() ?>assets/logo/amd.svg" alt="">
            </div>
            <form action="mailto:alfamedia.malang@gmail.com" method="get" style="margin-top: 40px;">
                <label class="block text-base font-normal" for="nama">Nama</label>
                <input class="block w-full py-2 px-3 mt-2 mb-4 border border-gray-400 rounded-md font-normal" style="margin-top: 10px;" id="full-name" name="full-name" type="text" placeholder="Nama">
                <label class="block text-base font-normal lg:mt-9" for="email">Subject</label>
                <input class="block w-full py-2 px-3 mt-2 mb-4 border border-gray-400 rounded-md font-normal" style="margin-top: 10px;" id="subject" name="subject" type="text" placeholder="Subjet">
                <label class="block text-base font-normal lg:mt-9" for="message">Message</label>
                <textarea class="block w-full py-2 px-3 mt-2 mb-4 border border-gray-400 rounded-md font-normal" style="margin-top: 10px;" name="message" id="message" rows="5"></textarea>
                <button class="w-full mt-4 py-3 rounded-lg text-white bg-[#1DACD9]" style="margin-top: 10px;" type="submit">Send</button>
            </form>
        </div>
    </div>
    <iframe style="margin-top: -110px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.5011457439073!2d112.60201281442686!3d-7.947050881368931!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7883301eae507d%3A0x75ebfb28028c7d94!2sSertifikasi%20Digital%20Marketing%20-%20AMD%20Academy!5e0!3m2!1sen!2sid!4v1670396265402!5m2!1sen!2sid" width="100%" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
    </iframe>
</div>
<script>
    $(document).ready(function() {
        $('.text-kontak').addClass('text-secondary-100');
    });
</script>