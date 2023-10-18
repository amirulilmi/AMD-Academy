<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice AMD</title>
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/invoice.css">
</head>

<body class="">
    <style>
        /*
! tailwindcss v3.2.1 | MIT License | https://tailwindcss.com
*/

        /*
1. Prevent padding and border from affecting element width. (https://github.com/mozdevs/cssremedy/issues/4)
2. Allow adding a border to an element by just adding a border-width. (https://github.com/tailwindcss/tailwindcss/pull/116)
*/

        *,
        ::before,
        ::after {
            box-sizing: border-box;
            /* 1 */
            border-width: 0;
            /* 2 */
            border-style: solid;
            /* 2 */
            border-color: #e5e7eb;
            /* 2 */
        }

        ::before,
        ::after {
            --tw-content: "";
        }

        /*
1. Use a consistent sensible line-height in all browsers.
2. Prevent adjustments of font size after orientation changes in iOS.
3. Use a more readable tab size.
4. Use the user's configured `sans` font-family by default.
*/

        html {
            line-height: 1.5;
            /* 1 */
            -webkit-text-size-adjust: 100%;
            /* 2 */
            -moz-tab-size: 4;
            /* 3 */
            -o-tab-size: 4;
            tab-size: 4;
            /* 3 */
            font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont,
                "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif,
                "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            /* 4 */
        }

        /*
1. Remove the margin in all browsers.
2. Inherit line-height from `html` so users can set them as a class directly on the `html` element.
*/

        body {
            margin: 0;
            /* 1 */
            line-height: inherit;
            /* 2 */
        }

        /*
1. Add the correct height in Firefox.
2. Correct the inheritance of border color in Firefox. (https://bugzilla.mozilla.org/show_bug.cgi?id=190655)
3. Ensure horizontal rules are visible by default.
*/

        hr {
            height: 0;
            /* 1 */
            color: inherit;
            /* 2 */
            border-top-width: 1px;
            /* 3 */
        }

        /*
Add the correct text decoration in Chrome, Edge, and Safari.
*/

        abbr:where([title]) {
            -webkit-text-decoration: underline dotted;
            text-decoration: underline dotted;
        }

        /*
Remove the default font size and weight for headings.
*/

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-size: inherit;
            font-weight: inherit;
        }

        /*
Reset links to optimize for opt-in styling instead of opt-out.
*/

        a {
            color: inherit;
            text-decoration: inherit;
        }

        /*
Add the correct font weight in Edge and Safari.
*/

        b,
        strong {
            font-weight: bolder;
        }

        /*
1. Use the user's configured `mono` font family by default.
2. Correct the odd `em` font sizing in all browsers.
*/

        code,
        kbd,
        samp,
        pre {
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas,
                "Liberation Mono", "Courier New", monospace;
            /* 1 */
            font-size: 1em;
            /* 2 */
        }

        /*
Add the correct font size in all browsers.
*/

        small {
            font-size: 80%;
        }

        /*
Prevent `sub` and `sup` elements from affecting the line height in all browsers.
*/

        sub,
        sup {
            font-size: 75%;
            line-height: 0;
            position: relative;
            vertical-align: baseline;
        }

        sub {
            bottom: -0.25em;
        }

        sup {
            top: -0.5em;
        }

        /*
1. Remove text indentation from table contents in Chrome and Safari. (https://bugs.chromium.org/p/chromium/issues/detail?id=999088, https://bugs.webkit.org/show_bug.cgi?id=201297)
2. Correct table border color inheritance in all Chrome and Safari. (https://bugs.chromium.org/p/chromium/issues/detail?id=935729, https://bugs.webkit.org/show_bug.cgi?id=195016)
3. Remove gaps between table borders by default.
*/

        table {
            text-indent: 0;
            /* 1 */
            border-color: inherit;
            /* 2 */
            border-collapse: collapse;
            /* 3 */
        }

        /*
1. Change the font styles in all browsers.
2. Remove the margin in Firefox and Safari.
3. Remove default padding in all browsers.
*/

        button,
        input,
        optgroup,
        select,
        textarea {
            font-family: inherit;
            /* 1 */
            font-size: 100%;
            /* 1 */
            font-weight: inherit;
            /* 1 */
            line-height: inherit;
            /* 1 */
            color: inherit;
            /* 1 */
            margin: 0;
            /* 2 */
            padding: 0;
            /* 3 */
        }

        /*
Remove the inheritance of text transform in Edge and Firefox.
*/

        button,
        select {
            text-transform: none;
        }

        /*
1. Correct the inability to style clickable types in iOS and Safari.
2. Remove default button styles.
*/

        button,
        [type="button"],
        [type="reset"],
        [type="submit"] {
            -webkit-appearance: button;
            /* 1 */
            background-color: transparent;
            /* 2 */
            background-image: none;
            /* 2 */
        }

        /*
Use the modern Firefox focus style for all focusable elements.
*/

        :-moz-focusring {
            outline: auto;
        }

        /*
Remove the additional `:invalid` styles in Firefox. (https://github.com/mozilla/gecko-dev/blob/2f9eacd9d3d995c937b4251a5557d95d494c9be1/layout/style/res/forms.css#L728-L737)
*/

        :-moz-ui-invalid {
            box-shadow: none;
        }

        /*
Add the correct vertical alignment in Chrome and Firefox.
*/

        progress {
            vertical-align: baseline;
        }

        /*
Correct the cursor style of increment and decrement buttons in Safari.
*/

        ::-webkit-inner-spin-button,
        ::-webkit-outer-spin-button {
            height: auto;
        }

        /*
1. Correct the odd appearance in Chrome and Safari.
2. Correct the outline style in Safari.
*/

        [type="search"] {
            -webkit-appearance: textfield;
            /* 1 */
            outline-offset: -2px;
            /* 2 */
        }

        /*
Remove the inner padding in Chrome and Safari on macOS.
*/

        ::-webkit-search-decoration {
            -webkit-appearance: none;
        }

        /*
1. Correct the inability to style clickable types in iOS and Safari.
2. Change font properties to `inherit` in Safari.
*/

        ::-webkit-file-upload-button {
            -webkit-appearance: button;
            /* 1 */
            font: inherit;
            /* 2 */
        }

        /*
Add the correct display in Chrome and Safari.
*/

        summary {
            display: list-item;
        }

        /*
Removes the default spacing and border for appropriate elements.
*/

        blockquote,
        dl,
        dd,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        hr,
        figure,
        p,
        pre {
            margin: 0;
        }

        fieldset {
            margin: 0;
            padding: 0;
        }

        legend {
            padding: 0;
        }

        ol,
        ul,
        menu {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        /*
Prevent resizing textareas horizontally by default.
*/

        textarea {
            resize: vertical;
        }

        /*
1. Reset the default placeholder opacity in Firefox. (https://github.com/tailwindlabs/tailwindcss/issues/3300)
2. Set the default placeholder color to the user's configured gray 400 color.
*/

        input::-moz-placeholder,
        textarea::-moz-placeholder {
            opacity: 1;
            /* 1 */
            color: #9ca3af;
            /* 2 */
        }

        input::placeholder,
        textarea::placeholder {
            opacity: 1;
            /* 1 */
            color: #9ca3af;
            /* 2 */
        }

        /*
Set the default cursor for buttons.
*/

        button,
        [role="button"] {
            cursor: pointer;
        }

        /*
Make sure disabled buttons don't get the pointer cursor.
*/

        :disabled {
            cursor: default;
        }

        /*
1. Make replaced elements `display: block` by default. (https://github.com/mozdevs/cssremedy/issues/14)
2. Add `vertical-align: middle` to align replaced elements more sensibly by default. (https://github.com/jensimmons/cssremedy/issues/14#issuecomment-634934210)
   This can trigger a poorly considered lint error in some tools but is included by design.
*/

        img,
        svg,
        video,
        canvas,
        audio,
        iframe,
        embed,
        object {
            display: block;
            /* 1 */
            vertical-align: middle;
            /* 2 */
        }

        /*
Constrain images and videos to the parent width and preserve their intrinsic aspect ratio. (https://github.com/mozdevs/cssremedy/issues/14)
*/

        img,
        video {
            max-width: 100%;
            height: auto;
        }

        /* Make elements with the HTML hidden attribute stay hidden by default */

        [hidden] {
            display: none;
        }

        *,
        ::before,
        ::after {
            --tw-border-spacing-x: 0;
            --tw-border-spacing-y: 0;
            --tw-translate-x: 0;
            --tw-translate-y: 0;
            --tw-rotate: 0;
            --tw-skew-x: 0;
            --tw-skew-y: 0;
            --tw-scale-x: 1;
            --tw-scale-y: 1;
            --tw-pan-x: ;
            --tw-pan-y: ;
            --tw-pinch-zoom: ;
            --tw-scroll-snap-strictness: proximity;
            --tw-ordinal: ;
            --tw-slashed-zero: ;
            --tw-numeric-figure: ;
            --tw-numeric-spacing: ;
            --tw-numeric-fraction: ;
            --tw-ring-inset: ;
            --tw-ring-offset-width: 0px;
            --tw-ring-offset-color: #fff;
            --tw-ring-color: rgb(59 130 246 / 0.5);
            --tw-ring-offset-shadow: 0 0 #0000;
            --tw-ring-shadow: 0 0 #0000;
            --tw-shadow: 0 0 #0000;
            --tw-shadow-colored: 0 0 #0000;
            --tw-blur: ;
            --tw-brightness: ;
            --tw-contrast: ;
            --tw-grayscale: ;
            --tw-hue-rotate: ;
            --tw-invert: ;
            --tw-saturate: ;
            --tw-sepia: ;
            --tw-drop-shadow: ;
            --tw-backdrop-blur: ;
            --tw-backdrop-brightness: ;
            --tw-backdrop-contrast: ;
            --tw-backdrop-grayscale: ;
            --tw-backdrop-hue-rotate: ;
            --tw-backdrop-invert: ;
            --tw-backdrop-opacity: ;
            --tw-backdrop-saturate: ;
            --tw-backdrop-sepia: ;
        }

        ::-webkit-backdrop {
            --tw-border-spacing-x: 0;
            --tw-border-spacing-y: 0;
            --tw-translate-x: 0;
            --tw-translate-y: 0;
            --tw-rotate: 0;
            --tw-skew-x: 0;
            --tw-skew-y: 0;
            --tw-scale-x: 1;
            --tw-scale-y: 1;
            --tw-pan-x: ;
            --tw-pan-y: ;
            --tw-pinch-zoom: ;
            --tw-scroll-snap-strictness: proximity;
            --tw-ordinal: ;
            --tw-slashed-zero: ;
            --tw-numeric-figure: ;
            --tw-numeric-spacing: ;
            --tw-numeric-fraction: ;
            --tw-ring-inset: ;
            --tw-ring-offset-width: 0px;
            --tw-ring-offset-color: #fff;
            --tw-ring-color: rgb(59 130 246 / 0.5);
            --tw-ring-offset-shadow: 0 0 #0000;
            --tw-ring-shadow: 0 0 #0000;
            --tw-shadow: 0 0 #0000;
            --tw-shadow-colored: 0 0 #0000;
            --tw-blur: ;
            --tw-brightness: ;
            --tw-contrast: ;
            --tw-grayscale: ;
            --tw-hue-rotate: ;
            --tw-invert: ;
            --tw-saturate: ;
            --tw-sepia: ;
            --tw-drop-shadow: ;
            --tw-backdrop-blur: ;
            --tw-backdrop-brightness: ;
            --tw-backdrop-contrast: ;
            --tw-backdrop-grayscale: ;
            --tw-backdrop-hue-rotate: ;
            --tw-backdrop-invert: ;
            --tw-backdrop-opacity: ;
            --tw-backdrop-saturate: ;
            --tw-backdrop-sepia: ;
        }

        ::backdrop {
            --tw-border-spacing-x: 0;
            --tw-border-spacing-y: 0;
            --tw-translate-x: 0;
            --tw-translate-y: 0;
            --tw-rotate: 0;
            --tw-skew-x: 0;
            --tw-skew-y: 0;
            --tw-scale-x: 1;
            --tw-scale-y: 1;
            --tw-pan-x: ;
            --tw-pan-y: ;
            --tw-pinch-zoom: ;
            --tw-scroll-snap-strictness: proximity;
            --tw-ordinal: ;
            --tw-slashed-zero: ;
            --tw-numeric-figure: ;
            --tw-numeric-spacing: ;
            --tw-numeric-fraction: ;
            --tw-ring-inset: ;
            --tw-ring-offset-width: 0px;
            --tw-ring-offset-color: #fff;
            --tw-ring-color: rgb(59 130 246 / 0.5);
            --tw-ring-offset-shadow: 0 0 #0000;
            --tw-ring-shadow: 0 0 #0000;
            --tw-shadow: 0 0 #0000;
            --tw-shadow-colored: 0 0 #0000;
            --tw-blur: ;
            --tw-brightness: ;
            --tw-contrast: ;
            --tw-grayscale: ;
            --tw-hue-rotate: ;
            --tw-invert: ;
            --tw-saturate: ;
            --tw-sepia: ;
            --tw-drop-shadow: ;
            --tw-backdrop-blur: ;
            --tw-backdrop-brightness: ;
            --tw-backdrop-contrast: ;
            --tw-backdrop-grayscale: ;
            --tw-backdrop-hue-rotate: ;
            --tw-backdrop-invert: ;
            --tw-backdrop-opacity: ;
            --tw-backdrop-saturate: ;
            --tw-backdrop-sepia: ;
        }

        .container {
            width: 90%;
        }

        .mx-auto {
            margin-left: auto;
            margin-right: auto;
        }

        .my-5 {
            margin-top: 1.25rem;
            margin-bottom: 1.25rem;
        }

        .mb-2 {
            margin-bottom: 0.5rem;
        }

        .mt-8 {
            margin-top: 2rem;
        }

        .mr-20 {
            margin-right: 5rem;
        }

        .mb-3 {
            margin-bottom: 0.75rem;
        }

        .mt-5 {
            margin-top: 1.25rem;
        }

        .mt-7 {
            margin-top: 1.75rem;
        }

        .mt-10 {
            margin-top: 2.5rem;
        }

        .flex {
            display: flex;
        }

        .table {
            display: table;
        }

        .h-70 {
            height: 70px;
        }

        .h-30 {
            height: 30px;
        }

        .w-700px {
            width: 700px;
        }

        .w-320px {
            width: 320px;
        }

        .w-200px {
            width: 200px;
        }

        .w-full {
            width: 100%;
        }

        .w-70px {
            width: 70px;
        }

        .w-165px {
            width: 165px;
        }

        .max-w-sm {
            max-width: 24rem;
        }

        .items-center {
            align-items: center;
        }

        .justify-end {
            justify-content: flex-end;
        }

        .justify-between {
            justify-content: space-between;
        }

        .break-words {
            overflow-wrap: break-word;
        }

        .border {
            border-width: 1px;
        }

        .border-b-1px {
            border-bottom-width: 1px;
        }

        .border-l {
            border-left-width: 1px;
        }

        .border-b-2px {
            border-bottom-width: 2px;
        }

        .border-black {
            --tw-border-opacity: 1;
            border-color: rgb(0 0 0 / var(--tw-border-opacity));
        }

        .bg-neutral-500 {
            --tw-bg-opacity: 1;
            background-color: rgb(115 115 115 / var(--tw-bg-opacity));
        }

        .bg-white {
            --tw-bg-opacity: 1;
            background-color: rgb(255 255 255 / var(--tw-bg-opacity));
        }

        .bg-lime-400 {
            --tw-bg-opacity: 1;
            background-color: rgb(163 230 53 / var(--tw-bg-opacity));
        }

        .bg-orange-400 {
            --tw-bg-opacity: 1;
            background-color: rgb(251 146 60 / var(--tw-bg-opacity));
        }

        .bg-red-400 {
            --tw-bg-opacity: 1;
            background-color: rgb(248 113 113 / var(--tw-bg-opacity));
        }

        .px-9 {
            padding-left: 3rem;
            padding-right: 3rem;
        }

        .px-6 {
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }

        .py-2 {
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
        }

        .px-2 {
            padding-left: 0.5rem;
            padding-right: 0.5rem;
        }

        .px-10 {
            padding-left: 2.5rem;
            padding-right: 2.5rem;
        }

        .px-14 {
            padding-left: 3.5rem;
            padding-right: 3.5rem;
        }

        .pt-16 {
            padding-top: 4rem;
        }

        .pb-3 {
            padding-bottom: 0.75rem;
        }

        .pr-3 {
            padding-right: 0.75rem;
        }

        .pl-2 {
            padding-left: 0.5rem;
        }

        .pr-0 {
            padding-right: 0px;
        }

        .pb-2 {
            padding-bottom: 0.5rem;
        }

        .pb-72 {
            padding-bottom: 18rem;
        }

        .pt-2 {
            padding-top: 0.5rem;
        }

        .pt-3 {
            padding-top: 0.75rem;
        }

        .pb-1 {
            padding-bottom: 0.25rem;
        }

        .pr-2 {
            padding-right: 0.5rem;
        }

        .text-left {
            text-align: left;
        }

        .text-center {
            text-align: center;
        }

        .text-end {
            text-align: end;
        }

        .align-middle {
            vertical-align: middle;
        }

        .align-bottom {
            vertical-align: bottom;
        }

        .text-20px {
            font-size: 20px;
        }

        .text-12px {
            font-size: 12px;
        }

        .text-30px {
            font-size: 30px;
        }

        .text-24px {
            font-size: 24px;
        }

        .font-bold {
            font-weight: 700;
        }

        .font-semibold {
            font-weight: 600;
        }

        .font-medium {
            font-weight: 500;
        }

        .text-black {
            --tw-text-opacity: 1;
            color: rgb(0 0 0 / var(--tw-text-opacity));
        }

        @media (prefers-color-scheme: dark) {
            .dark\:bg-slate-300 {
                --tw-bg-opacity: 1;
                background-color: rgb(203 213 225 / var(--tw-bg-opacity));
            }
        }

        .kolom {
            display: inline-block;
            margin-left: -4px;
        }
    </style>
    <div class="container mx-auto bg-white">
        <div class="page ">
            <header class="">
                <div class="logo flex" style="float: left;">
                    <img class="h-30 pr-1" src="<?= base_url() ?>assets/assets/img/invoice/amda.png" alt="">
                    <img class="h-30 pr-2" src="<?= base_url() ?>assets/assets/img/invoice/arkatama.svg" alt="">
                    <img class="h-30 pr-3" src="<?= base_url() ?>assets/assets/img/invoice/lsp.svg" alt="">
                </div>
                <div class="judul items-center" style="float: right;">
                    <h1 class="font-bold text-20px">INVOICE</h1>
                </div>
            </header>
            <div class="mt-8 baris">
                <div class="border-b-2px border-black pb-1"></div>
                <div class="w-320px kolom">
                    <div class="">
                        <div class="text-12px flex">
                            <p class="font-bold">Dari&emsp;&emsp;&emsp;<span>:</span></p>
                            <p class="pl-2">CV. Alfa Media Digital
                                Perumahan Joyoagung Greenland No. B4-B5, Tlogomas,
                                Kec. Lowokwaru, Kota Malang, Jawa Timur 65144</p>
                        </div>
                    </div>
                    <div class=" ">
                        <div class="text-12px flex">
                            <p class="font-bold">Telepon&emsp;&emsp13;<span>:</span></p>
                            <p class="pl-2">085607932782</p>
                        </div>
                    </div>
                    <div class=" ">
                        <div class="text-12px flex">
                            <p class="font-bold pb-3 mt-10">Kepada&emsp;&emsp13;&emsp13;<span>:</span></p>
                        </div>
                    </div>
                </div>
                <div class="w-200px kolom" style="float: right;">
                    <div class="">
                        <div class="text-12px flex ">
                            <p class="font-bold">Tgl Order&emsp;&emsp;&emsp;&emsp;&emsp13;<span>:</span></p>
                            <p class="pl-2"><?= date('j F Y', strtotime($order['time'])) ?></p>
                        </div>
                    </div>
                    <!-- <div class="">
                        <div class="text-12px flex ">
                            <p class="font-bold">Tgl Jatuh Tempo&emsp;<span>:</span></p>
                            <p class="pl-2">24 Maret 2022</p>
                        </div>
                    </div> -->
                </div>
            </div>
            </section>
            <section>
                <table class="text-left w-full">
                    <tbody class="text-12px">
                        <tr class="border border-black ">
                            <td rowspan="2" scope="row" class=" text-black px-6 pl-2 font-semibold">
                                <?= $peserta['nama'] ?> (<?= $peserta['instansi'] ?>)
                            </td>
                            <td class="py-2 pr-0 pl-2  text-black font-bold  border-black border-l">
                                No. Invoice
                            </td>
                            <td class="py-2 px-2  text-black">
                                :
                            </td>
                            <td class="py-2 pl-2 pr-3  text-black">
                                AMD/<?= $order['id_order'] ?>/<?= date('n/Y', strtotime($order['time'])) ?>
                            </td>
                        </tr>
                        <tr class="bg-white border border-black">
                            <th scope="row" class="py-2 px-2 pr-3 text-black border-black font-bold border-l">
                                Tanggal
                            </th>
                            <td class="py-2 px-2 text-black">
                                :
                            </td>
                            <td class="py-2 px-2 text-black">
                                <?= date('j - n - Y', strtotime($order['time'])) ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </section>
            <br>
            <section class="text-12px flex">
                <div class="judul font-bold w-70px">
                    <p>Invoice&emsp13;&emsp13;&emsp13;&emsp13;<span class="font-medium"> :</span></p>
                </div>
            </section>
            <section>
                <table class="text-12px text-left w-full">
                    <thead>
                        <tr class="border border-black text-center">
                            <th colspan="2" class="border border-black py-2  dark:bg-slate-300">Deskripsi</th>
                            <th class="border border-black px-2 dark:bg-slate-300">QTY</th>
                            <th class="border border-black px-14  dark:bg-slate-300">Biaya</th>
                            <th class="border border-black px-14 dark:bg-slate-300">Total</th>
                        </tr>
                        <tr class="border border-black max-w-sm text-center">
                            <td class="border border-black px-2 font-semibold">1.</td>
                            <td class="border border-black break-words text-left px-2 font-semibold">Registrasi Pelatihan <?= $user['nama_pelatihan'] ?> (<?= $biaya['jenis'] ?>) dan Sertifikasi BNSP
                            </td>
                            <td class="border border-black px-2 font-semibold"><?= $jmlhOrder ?></td>
                            <td class="border border-black font-semibold">Rp <?= number_format($biaya['harga'], 0, '', '.') ?>,00</td>
                            <td class="border border-black font-semibold">Rp <?= number_format($biaya['harga'] * $jmlhOrder, 0, '', '.') ?>,00</td>
                        </tr>
                        <tr class="border border-black">
                            <td colspan="4" class="text-end border border-black pr-2">Diskon</td>
                            <td class="text-center"><?= 'Rp' . number_format($biaya['diskon'] * $jmlhOrder, 0, '', '.') . ',00'; ?></td>
                        </tr>
                        <tr class="border border-black">
                            <td colspan="4" class="text-end border border-black pr-2">PPN 11%</td>
                            <td class="text-center">-</td>
                        </tr class="border border-black">
                        <tr class="border border-black font-bold">
                            <td colspan="4" class="text-end border border-black pr-2">Grand Total</td>
                            <td class="text-center">Rp <?= number_format($order['gross_amount'], 0, '', '.') ?>,00</td>
                        </tr>
                    </thead>
                </table>
            </section>
            <br>
            <section class="text-12px">
                <div class="judul">
                    <p class="font-bold pb-2">Cara pembayaran&emsp13;&emsp13;&emsp13;<span class="font-medium"> :</span></p>
                    <p class="font-semibold"><?php switch ($order['jenis']) {
                                                    case 'Manual':
                                                        echo 'Transfer via Bank Mandiri an. PT. Arkatama Multi Solusindo';
                                                        break;
                                                    case 'Midtrans':
                                                        echo 'Pembayaran melalui Midtrans sebagai pihak ketiga';
                                                        break;
                                                    default:
                                                        echo '';
                                                        break;
                                                } ?></p>
                    <p class="font-semibold"><?= ($order['jenis'] == 'Manual') ? 'No. Rekening: 144-00-5650000-9' : ''; ?></p>
                </div>
            </section>
        </div>
        <div class="">
            <section class="text-12px font-semibold" style="float: right;">
                <p>Malang, <?= date('j F Y', strtotime($order['time'])) ?></p>
                <p>AMD Academy</p>
                <img class="h-70 w-165px" src="<?= base_url() ?>assets/assets/img/invoice/ttd_amd.svg" alt="">
                <p>(Fauziah, S.E., M.M)</p>
            </section>
        </div>
    </div>
</body>

</html>