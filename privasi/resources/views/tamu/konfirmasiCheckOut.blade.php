@extends('template/templateBasic')

@section('contentUtama')
    <div class='d-flex justify-content-center align-items-center flex-column h-100'>
        <div class='d-flex justify-content-between w-100'>
            <div>
                <div><img src='{{ asset('Assets/img/icon_blue_detail.svg') }}'></div>
                <div class='menuTitle'>Detail Reservasi</div>
            </div>
        </div>
        <div class='d-flex justify-content-between w-100 flex-wrap my-4'>
            <div class='w-100' style='height: 65vh'>
                {!! Form::open(['url' => 'tamu/konfirmasiCheckOut_Act', 'class' => 'justify-content-center w-100']) !!}
                <div class='row'>
                    <div class='col-8'>
                        {!! Form::label('namaTamuLabel', 'Nama Tamu', ['style' => 'font-weight: 600; margin: 1em 0;']) !!}
                        {!! Form::text('namaTamu', $data_b->NAMA_TAMU, ['class' => 'form-control', 'id' => 'Reservasi_id', 'readonly' => 'readonly', 'required']) !!}
                        {!! Form::hidden('idTamu', $data_b->ID_TAMU) !!}
                    </div>
                    <div class='col-4'>
                        {!! Form::label('nomorKamarLabel', 'Nomor Kamar', ['style' => 'font-weight: 600; margin: 1em 0;']) !!}
                        {!! Form::text('nomorKamar', $daftar_tipe_kamar->NOMOR_KAMAR, ['class' => 'form-control', 'maxlength' => '16', 'pattern' => '[0-9]{16}', 'readonly', 'required']) !!}
                    </div>
                </div>
                <div class='row'>
                    <div class='col-8'>
                        <div class='row'>
                            <div class='col-6'>
                                {!! Form::label('checkInLabel', 'Check In', ['style' => 'font-weight: 600; margin: 1em 0;']) !!}
                                {!! Form::text('checkIn', $data_b->TANGGAL_CHECK_IN, ['class' => 'form-control formDate', 'disabled', 'onchange' => 'cekHarga()', 'autocomplete' => 'off', 'style' => 'cursor: pointer;', 'required']) !!}
                            </div>
                            <div class='col-6'>
                                {!! Form::label('checkOutLabel', 'Check Out', ['style' => 'font-weight: 600; margin: 1em 0;']) !!}
                                {!! Form::text('checkOut', $data_b->TANGGAL_CHECK_OUT, ['class' => 'form-control formDate', 'disabled', 'onchange' => 'cekHarga()', 'autocomplete' => 'off', 'style' => 'cursor: pointer;', 'required']) !!}
                                {!! Form::hidden('harga', $daftar_tipe_kamar->HARGA_PER_MALAM, ['id' => 'hargaMalam']) !!}
                            </div>
                        </div>
                    </div>
                    <div class='col-4'>
                        {!! Form::label('keterlambatanLabel', 'Keterlambatan (malam)', ['style' => 'font-weight: 600; margin: 1em 0;']) !!}
                        {!! Form::number('keterlambatan', null, ['class' => 'form-control', 'id' => 'terlambat', 'readonly']) !!}
                        {!! Form::hidden('denda', null, ['id' => 'bayarDenda']) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class='row position-relative w-100' style='bottom: 2em'>
            <div class='col-9'>
                <div class='smallTitle'>Total Denda</div>
                <div class='bigTitle' id='textHarga'>Rp</div>
            </div>
            <div class='col-3 d-flex'>
                <div class='row d-flex align-self-end w-100'>
                    {!! Form::submit('Simpan', ['class' => 'btn btn-primary position-relative', 'id' => 'btn_simpan', 'style' => 'font-weight: 600']) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

    </div>
    <script>
        $(document).ready(function() {
            checkLatest();
        });

        function checkLatest() {
            var today = new Date().getTime();
            var out = new Date(document.getElementsByClassName('formDate')[1].value + ' 12:00:00').getTime();
            var harga = document.getElementById('hargaMalam').value;

            oneday = 1000 * 60 * 60 * 24;

            different = Math.floor((today - out) / oneday);

            var duit = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR'
            });

            if (different < 0) {
                document.getElementById('terlambat').value = 0;
                document.getElementById('bayarDenda').value = 0;
                document.getElementById("textHarga").innerHTML = duit.format(0);
            } else {
                document.getElementById('terlambat').value = different;
                document.getElementById('bayarDenda').value = different * harga;
                document.getElementById("textHarga").innerHTML = duit.format(different * harga);
            }
        }
    </script>
@endsection

@section('buttons')
    <img style='margin: 0 0 0 1em; cursor: pointer; height: 2em;' src="{{ asset('Assets/img/button_kembali.svg') }}"
        onclick="window.location = '/ppsi_crystalguesthouse/tamu/mainCheckOut';">
@endsection
