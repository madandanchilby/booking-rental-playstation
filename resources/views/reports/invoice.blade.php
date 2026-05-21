<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('layouts/sections/styles')
    <title>Invoice</title>

    <style>
        * {
            margin: 0;
        }
        .paper-size {
            width: 219px;
        }

        .w-23 {
            width: 23%;
        }

        .text-black {
            color: black !important;
        }
    </style>
</head>

<body class="paper-size">
    <div class="text-black">
        <div>
            <p class="m-0 fs-4 fw-bold">Kopi Raya</p>
            <p class="w-50 m-0">Jl. Ring Road Utara No.11, Yogyakarta</p>
        </div>
        <div class="d-flex justify-content-between gap-2">
            <span class="w-50">Kasir:</span>
            <span class="w-50">Nico</span>
        </div>
        <div class="d-flex justify-content-between gap-2">
            <span class="w-50">Tanggal:</span>
            <span class="w-50">26/08/2024 10:30:45</span>
        </div>
        <table class="w-100">
            <thead>
                <th class="fw-bold">Produk</th>
                <th class="fw-bold text-center">Harga</th>
                <th class="fw-bold text-center">Qty</th>
                <th class="fw-bold text-center">Total</th>
            </thead>
            <tbody>
                <tr>
                    <td>Kopi Sanger</td>
                    <td>25.000</td>
                    <td class="text-center">10</td>
                    <td>250.000</td>
                </tr>
                <tr>
                    <td>Kopi Sanger</td>
                    <td>25.000</td>
                    <td class="text-center">10</td>
                    <td>250.000</td>
                </tr>
                <tr>
                    <td>Kopi Sanger</td>
                    <td>25.000</td>
                    <td class="text-center">10</td>
                    <td>250.000</td>
                </tr>
                <tr>
                    <td>Kopi Sanger</td>
                    <td>25.000</td>
                    <td class="text-center">10</td>
                    <td>250.000</td>
                </tr>
                <tr>
                    <td>Kopi Sanger</td>
                    <td>25.000</td>
                    <td class="text-center">10</td>
                    <td>250.000</td>
                </tr>
                <tr>
                    <td>Kopi Sanger</td>
                    <td>25.000</td>
                    <td class="text-center">10</td>
                    <td>250.000</td>
                </tr>
                <tr>
                    <td>Kopi Sanger</td>
                    <td>25.000</td>
                    <td class="text-center">10</td>
                    <td>250.000</td>
                </tr>
                <tr>
                    <td>Kopi Sanger</td>
                    <td>25.000</td>
                    <td class="text-center">10</td>
                    <td>250.000</td>
                </tr>
            </tbody>
        </table>

        <div class="d-flex flex-wrap fw-bold">
            <span class="w-50">Grand Total</span>
            <span class="w-50 text-end">250.000.000</span>

            <span class="w-50">Bayar</span>
            <span class="w-50 text-end">275.000.000</span>

            <span class="w-50">Kembali</span>
            <span class="w-50 text-end">25.000.000</span>
        </div>

        <br>
        <br>

        <p class="text-center">Terima Kasih Telah Berkunjung</p>
    </div>
</body>

</html>
