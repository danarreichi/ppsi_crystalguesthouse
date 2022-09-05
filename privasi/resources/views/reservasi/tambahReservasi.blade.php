@extends('template/templateBasic')

@section('contentUtama')
    <div class='d-flex justify-content-center align-items-center flex-column h-100'>
        <div class='d-flex justify-content-between w-100'>
            <div>
                <div><img src='{{ asset('Assets/img/icon_blue_tambah.svg') }}'></div>
                <div class='menuTitle'>Tambah Reservasi</div>
            </div>
        </div>
        <div class='d-flex justify-content-between w-100 flex-wrap my-4'>
            <div class='w-100' style='height: 65vh'>
                {!! Form::open(['url' => 'reservasi/tambahReservasi/actiontambah_reservasi', 'class' => 'justify-content-center w-100']) !!}
                <div class='row'>
                    <div class='col-4'>
                        {!! Form::label('idReservasiLabel', 'ID Reservasi', ['style' => 'font-weight: 600; margin: 1em 0;']) !!}
                        {!! Form::text('idReservasi', $id, ['class' => 'form-control', 'readonly', 'required']) !!}

                    </div>
                    <div class='col-8'>
                        {!! Form::label('NIKLabel', 'NIK', ['style' => 'font-weight: 600; margin: 1em 0;']) !!}
                        {!! Form::text('NIK', null, ['class' => 'form-control', 'maxlength' => '16', 'pattern' => '[0-9]{16}', 'required']) !!}

                    </div>
                </div>
                <div class='row'>
                    <div class='col-6'>
                        {!! Form::label('namaLabel', 'Nama', ['style' => 'font-weight: 600; margin: 1em 0;']) !!}
                        {!! Form::text('nama', null, ['class' => 'form-control', 'required']) !!}
                        <div class='row'>
                            <div class='col-6'>
                                {!! Form::label('checkInLabel', 'Check In', ['style' => 'font-weight: 600; margin: 1em 0;']) !!}
                                {!! Form::text('checkIn', null, ['class' => 'form-control formDate', 'onchange' => 'cekHarga()', 'autocomplete' => 'off', 'style' => 'cursor: pointer;', 'required']) !!}
                            </div>
                            <div class='col-6'>
                                {!! Form::label('checkOutLabel', 'Check Out', ['style' => 'font-weight: 600; margin: 1em 0;']) !!}
                                {!! Form::text('checkOut', null, ['class' => 'form-control formDate', 'onchange' => 'cekHarga()', 'autocomplete' => 'off', 'style' => 'cursor: pointer;', 'required']) !!}
                            </div>
                            {!! Form::hidden('hari_menginap', null, ['id' => 'idhari_menginap']) !!}
                            {!! Form::hidden('harga_menginap', null, ['id' => 'idharga_menginap']) !!}
                        </div>
                    </div>
                    <div class='col-6'>
                        {!! Form::label('noTelpLabel', 'No Telepon', ['style' => 'font-weight: 600; margin: 1em 0;']) !!}
                        {!! Form::text('noTelp', null, ['class' => 'form-control', 'required', 'maxlength' => '15']) !!}
                        {!! Form::label('tipeKamarLabel', 'Tipe Kamar', ['style' => 'font-weight: 600; margin: 1em 0;']) !!}
                        <select name="tipe_kamar" class="form-control" onchange="cekHarga()" required>
                            @foreach ($master_tipe_kamar as $data)
                                @if ($data->JUMLAH > $data->JUMLAH_RESERVASI)
                                    <option value="{{ $data->ID_TIPE_KAMAR }}"
                                        data-harga='{{ $data->HARGA_PER_MALAM }}'>
                                        {{ $data->TIPE_KAMAR }} </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class='row position-relative w-100' style='bottom: 2em'>
            <div class='col-4'>
                <div class='smallTitle'>Total Pembayaran</div>
                <div class='bigTitle' id='textHarga'>Rp</div>
            </div>
            <div class='col-4'>
                <div class='smallTitle'>Uang Muka 10%</div>
                <div class='bigTitle' id='textHarga_dp' style='color: var(--bluebluean) !important'>Rp</div>
            </div>
            <div class='col-2'></div>
            <div class='col-2'>
                <div class='row d-flex flex-row position-relative' style='bottom: 0.5em'>
                    <div>
                        {!! Form::checkbox('lunas', 'lunaskh', false, ['class' => 'form-check-input']) !!}
                        {!! Form::label('lunasLabel', 'Bayar uang muka', ['style' => 'font-weight: 600', 'class' => 'form-check-label']) !!}
                    </div>
                </div>
                <div class='row d-flex'>
                    {!! Form::submit('Simpan', ['class' => 'btn btn-primary position-relative', 'style' => 'font-weight: 600']) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

    </div>
    <script>
        function cekHarga() {

            var duit = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR'
            });

            checkIn = new Date(document.getElementsByClassName('formDate')[0].value);
            checkOut = new Date(document.getElementsByClassName('formDate')[1].value);

            oneday = 1000 * 60 * 60 * 24;
            if (document.getElementsByClassName('formDate')[1].value != "" && document.getElementsByClassName('formDate')[0]
                .value != "") {
                different = (checkOut - checkIn) / oneday;
                document.getElementById("idhari_menginap").value = different;
                harga = Math.floor($('select[name="tipe_kamar"] :selected').data('harga') * different);
                document.getElementById("idharga_menginap").value = harga;
                dp = harga * 0.1;
                if (different < 0) {
                    document.getElementsByClassName('formDate')[1].value = document.getElementsByClassName('formDate')[0]
                        .value;
                } else {
                    document.getElementById("textHarga").innerHTML = duit.format(harga);
                    document.getElementById("textHarga_dp").innerHTML = duit.format(dp);
                }
            }
        }

        $(document).ready(function() {
            var date_inputIn = $('input[name="checkIn"]');
            var date_inputOut = $('input[name="checkOut"]');

            var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
            var options = {
                format: 'yyyy-mm-dd',
                container: container,
                todayHighlight: true,
                autoclose: true,
            };

            date_inputIn.datepicker(options);
            date_inputOut.datepicker(options);
        });
    </script>
@endsection

@section('buttons')
    <img style='margin: 0 0 0 1em; cursor: pointer; height: 2em;' src="{{ asset('Assets/img/button_kembali.svg') }}"
        onclick="window.location = '../mainMenu';">
    <div class='sidebarButtons'>
        <div class='buttonSidebarSmall  d-flex align-items-center' onclick="window.location = 'mainReservasi'">
            <img src='{{ asset('Assets/img/icon_black_daftar.svg') }}' style='margin: 0 0.25em 0 0'>Reservasi
        </div>
        <div class='buttonSidebarSmall buttonSelected d-flex align-items-center'
            onclick="window.location = 'tambahReservasi'">
            <img src='{{ asset('Assets/img/icon_white_tambah.svg') }}' style='margin: 0 0.25em 0 0'>Tambah Reservasi
        </div>
    </div>
@endsection
