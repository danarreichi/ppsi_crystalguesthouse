<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script type="text/javascript" src="{{ asset('Assets/js/jquery.min.js') }}"></script>
    <link href="{{ asset('Assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('Assets/css/customCSS.css') }}" rel="stylesheet">
</head>

<body style='margin: 2em; height: 297mm; width: 210mm'>

    <div style='font-size: 1em; text-align: center'> Crystal Guesthouse </div>
    <div style='font-size: 3em; text-align: center; font-weight: 700'> Laporan Tamu </div>

    @if ($tanggal->tgl_awal != null)
        <div style='text-align: center'>Periode <span style='font-weight: 600'> {{ $tanggal->tgl_awal }} </span> -
            <span style='font-weight: 600'> {{ $tanggal->tgl_akhir }} </span>
        </div>
    @else
        <div style='text-align: center'>Periode <span style='font-weight: 600'> Keseluruhan</span></div>
    @endif

    <table style='width: 100%; margin: 4em 0 0 0'>
        <tr style='text-align: center'>
            <th>Tanggal Pemesanan</th>
            <th>Nama Tamu</th>
            <th>Tipe Kamar</th>
            <th>Nomor Kamar</th>
            <th>Check In</th>
            <th>Check Out</th>
            <th>Denda</th>
        </tr>
        @php
            $count = 0;
            $total = 0;
        @endphp
        @foreach ($data as $data_b)
            <tr style='text-align: center'>
                @foreach ($history_reservasi as $data_c)
                    @if ($data_c->ID_HISTORY_RESERVASI == $data_b->ID_HISTORY_RESERVASI)
                        <td>{{ $data_c->HISTORY_TANGGAL_PEMESANAN }}</td>
                    @endif
                @endforeach
                <td>{{$data_b->HISTORY_NAMA_TAMU}}</td>
                <td>{{$data_b->ID_KAMAR}}</td>
                <td>{{$data_b->ID_KAMAR}}</td>
                <td>{{$data_b->HISTORY_TANGGAL_CHECK_IN}}</td>
                <td>{{$data_b->HISTORY_TANGGAL_CHECK_OUT}}</td>
                <td>@php echo 'Rp '.number_format($data_b->HISTORY_DENDA,2,',','.'); @endphp</td>
            </tr>
            @php
                $count++;
                $total = $total + $data_b->HISTORY_DENDA;
            @endphp
        @endforeach
    </table>

    <div style='display: flex; flex-direction: column; margin: 6em 0 0 0;'>
        <div style='display: flex; justify-content: space-between; width: 100%'>
            <div style='font-size: 1.5em; font-weight: 600'>Jumlah Tamu</div>
            <div style='font-size: 1.5em'>{{$count}} Tamu</div>
        </div>
        <div style='display: flex; justify-content: space-between; width: 100%'>
            <div style='font-size: 1.5em; font-weight: 600'>Total Pembayaran Denda</div>
            <div style='font-size: 1.5em'>@php echo 'Rp '.number_format($total,2,',','.'); @endphp</div>
        </div>
    </div>

</body>

<script>
    $(document).ready(function() {
        window.onafterprint = window.close;
        window.print();
    });
</script>

</html>
