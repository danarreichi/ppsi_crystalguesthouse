<html>

<link href="{{ asset('Assets/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('Assets/css/customCSS.css') }}" rel="stylesheet">
<script type="text/javascript" src="{{ asset('Assets/js/jquery.min.js') }}"></script>

<div style='font-size: 1em'>Crystal Guesthouse</div>
<div style='font-size: 2em; font-weight: 700'>Bukti Reservasi</div>
<div style='font-size: 1.4em; font-weight: 600; opacity: 40%'>#{{$data->ID_RESERVASI}}</div>

<style>
    .dataCetak {
        font-weight: 700;
        margin: 0 0 0 1em;
    }
    @media print{
        @page {
            size: 7.4cm 10.5cm potrait;
        }
    }

</style>
<body>
<table style='margin: 2em 0 0 0'>
    <tbody style='width: 4em'>
    <tr>
        <td>Atas Nama</td>
        <td>:</td>
        <td class='dataCetak'> {{ $data->NAMA_PEMESAN }}</td>
    </tr>
    <tr>
        <td>Tipe Kamar</td>
        <td>:</td>
        <td class='dataCetak'> {{ $kamar->TIPE_KAMAR }}</td>
    </tr>
    <tr>
        <td>Check In</td>
        <td>:</td>
        <td class='dataCetak'> {{ $data->TANGGAL_CHECK_IN }}</td>
    </tr>
    <tr>
        <td>Check Out</td>
        <td>:</td>
        <td class='dataCetak'> {{ $data->TANGGAL_CHECK_OUT }}</td>
    </tr>
</tbody>
</table>

<div style='margin: 2em 0 0 0'>
    <div style='font-size: 1.5em; font-weight: 400'>Total Pembayaran</div>
    <div class="uang" style='font-size: 2em; font-weight: 700'>{{ $data->TOTAL_PEMBAYARAN }}</div>
</div>
<div style='margin: 0.5em 0 0 0'>
    <div style='font-size: 1.5em; font-weight: 400'>Uang Muka 10%</div>
    <div class="uang" style='font-size: 2em; font-weight: 700'>{{ $data->TOTAL_PEMBAYARAN }}</div>
</div>
</body>
<script>
    $(document).ready(function() {

        var duit = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR'
        });

        harga = document.getElementsByClassName("uang")[0].innerHTML;
        dp = document.getElementsByClassName("uang")[1].innerHTML;

        console.log(harga);
        console.log(dp);

        document.getElementsByClassName("uang")[0].innerHTML = duit.format(harga);
        document.getElementsByClassName("uang")[1].innerHTML = duit.format(dp * 0.1);
        window.print();
    });
</script>

</html>
