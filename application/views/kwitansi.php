<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kwitansi | AMD Academy</title>
    <link href="https://fonts.cdnfonts.com/css/algeria" rel="stylesheet">
    <style>
        html,
        body,
        div,
        span,
        applet,
        object,
        iframe,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        blockquote,
        pre,
        a,
        abbr,
        acronym,
        address,
        big,
        cite,
        code,
        del,
        dfn,
        em,
        img,
        ins,
        kbd,
        q,
        s,
        samp,
        small,
        strike,
        strong,
        sub,
        sup,
        tt,
        var,
        b,
        u,
        i,
        center,
        dl,
        dt,
        dd,
        ol,
        ul,
        li,
        fieldset,
        form,
        label,
        legend,
        table,
        caption,
        tbody,
        tfoot,
        thead,
        tr,
        th,
        td,
        article,
        aside,
        canvas,
        details,
        embed,
        figure,
        figcaption,
        footer,
        header,
        hgroup,
        menu,
        nav,
        output,
        ruby,
        section,
        summary,
        time,
        mark,
        audio,
        video {
            margin: 0;
            padding: 0;
            border: 0;
            font-size: 100%;
            font: inherit;
            vertical-align: baseline;
        }

        /* HTML5 display-role reset for older browsers */
        article,
        aside,
        details,
        figcaption,
        figure,
        footer,
        header,
        hgroup,
        menu,
        nav,
        section {
            display: block;
        }

        body {
            line-height: 1;
        }

        ol,
        ul {
            list-style: none;
        }

        blockquote,
        q {
            quotes: none;
        }

        blockquote:before,
        blockquote:after,
        q:before,
        q:after {
            content: '';
            content: none;
        }

        table {
            border-collapse: collapse;
            border-spacing: 0;
        }

        body {
            background-color: gray;
            font-family: Arial, Helvetica, sans-serif;
        }

        section {
            margin-top: 40px;
        }

        .container {
            width: 100%;

        }

        .page {
            width: 650px;
            height: 997px;
            margin: 0px auto;
            background-color: white;
            padding: 50px 75px 75px;
            box-sizing: border-box;
        }

        .list-logo {
            display: flex;
            align-items: center;
            border-bottom: 1.5px solid black;
            padding-bottom: 4px;
        }

        img.logo {
            display: block;
            margin-right: 15px;
        }

        .title {
            text-align: center;
        }

        .title h1 {
            font-family: 'Algeria', sans-serif;
            font-size: 40px;
            display: inline-block;
            text-transform: uppercase;
            border-bottom: 2px solid black;
        }

        .title p {
            padding-top: 5px;
            font-size: 14px;
        }

        table {
            font-size: 13px;
        }

        .signature p {
            font-size: 13px;
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="page">
        <header>
            <div class="container">
                <div class="list-logo">
                    <img class="logo" src="<?= base_url() ?>assets/logo/amda.png" width="90px" alt="logoAMD">
                    <img class="logo" src="<?= base_url() ?>assets/logo/arkatama.svg" width="120px" height="25px" alt="logoArkatama">
                    <img class="logo" src="<?= base_url() ?>assets/logo/lsp.svg" width="35px" height="35px" alt="logoLSP">
                </div>
            </div>
        </header>
        <section>
            <div class="container">
                <div class="title">
                    <h1>Kwitansi</h1>
                    <p>No: AMD/<?= $order['id_order'] ?>/<?= date('n/Y', strtotime($order['time'])) ?></p>
                </div>
            </div>
        </section>
        <section>
            <div class="container">
                <table>
                    <tr>
                        <td style="width: 18%;">Sudah terima dari</td>
                        <td style="width: 2%; padding-left: 50px; padding-right: 10px;">:</td>
                        <td style="border: 1.5px solid black; padding: 10px; width: 80%;"><?= $peserta['nama'] ?> (<?= $peserta['instansi'] ?>)</td>
                    </tr>
                    <tr>
                        <td style="padding-bottom: 10px;"></td>
                    </tr>
                    <tr>
                        <td style="width: 18%;">Untuk Sebesar</td>
                        <td style="width: 2%; padding-left: 50px; padding-right: 10px;">:</td>
                        <td style="border: 1.5px solid black; padding: 10px; width: 80%;">#<?= ucwords($terbilang)  ?> Rupiah#</td>
                    </tr>
                    <tr>
                        <td style="padding-bottom: 10px;"></td>
                    </tr>
                    <tr>
                        <td style="width: 18%;">Untuk Pembayaran</td>
                        <td style="width: 2%; padding-left: 50px; padding-right: 10px;">:</td>
                        <td style="border: 1.5px solid black; padding: 10px; width: 80%;">Registrasi Pelatihan dan Sertifikasi <?= $user['nama_pelatihan'] ?> (<?= $user['tipe'] ?>)</td>
                    </tr>
                    <tr>
                        <td style="padding-bottom: 10px;"></td>
                    </tr>
                </table>
                <br>
                <table>
                    <tr>
                        <td style="padding: 10px 38px; border: 1.5px solid black; font-weight: bold;">Rp <?= number_format($order['gross_amount'], 0, '', '.') ?>,00</td>
                    </tr>
                </table>
                <div class="signature" style="margin-top: 70px;">
                    <p style="margin: 5px 35px;">Malang, <?= date('j F Y', strtotime($order['time'])) ?></p>
                    <p style="padding-right: 65px;">AMD Academy</p>
                    <div>
                        <img src="<?= base_url() ?>assets/logo/ttd amd2.svg" style="margin-left: 450px; visibility: hidden;" width="170px" alt="">
                    </div>
                    <p style="margin: 2px 39px; padding-right: 15px; text-decoration: underline; ">Fauziah, SE., MM</p>
                </div>
            </div>
        </section>
    </div>
</body>

</html>