@extends('template/templateBasic')

@section('contentUtama')
    <div class='d-flex justify-content-center align-items-center flex-column h-100'>
        <div class='d-flex justify-content-between w-100'>
            <div>
                <div><img src='{{ asset('Assets/img/icon_blue_detail.svg') }}'></div>
                <div class='menuTitle'>Detail Reservasi</div>
            </div>
            <div class='d-flex'>
                <div class='d-flex align-self-end linkCetak align-items-center' style='cursor: pointer; margin: 0 0.75em'
                    onclick='window.open("{{ $data_b->ID_RESERVASI }}/cetak")'>
                    <img src='{{ asset('Assets/img/icon_pink_printer.svg') }}' style='margin: 0 0.25em 0 0'>Cetak
                </div>
                <div class='d-flex align-self-end linkEdit align-items-center' style='cursor: pointer; margin: 0 0.75em'
                    onclick="enableForm()">
                    <img src='{{ asset('Assets/img/button_edit.svg') }}' style='margin: 0 0.25em 0 0'>Edit
                </div>
                <div class='d-flex align-self-end linkHapus align-items-center' style='cursor: pointer; margin: 0 0.75em'
                    onclick="hapusForm('{{ $data_b->ID_RESERVASI }}')">
                    <img src='{{ asset('Assets/img/button_hapus.svg') }}' style='margin: 0 0.25em 0 0'>Hapus
                </div>
            </div>
        </div>
        <div class='d-flex justify-content-between w-100 flex-wrap my-4'>
            <div class='w-100' style='height: 65vh'>
                {!! Form::open(['url' => 'reservasi/actionedit_reservasi', 'class' => 'justify-content-center w-100']) !!}
                <div class='row'>
                    <div class='col-4'>
                        {!! Form::label('idReservasiLabel', 'ID Reservasi', ['style' => 'font-weight: 600; margin: 1em 0;']) !!}
                        {!! Form::text('idReservasi', $data_b->ID_RESERVASI, ['class' => 'form-control', 'id' => 'Reservasi_id', 'readonly' => 'readonly', 'required']) !!}

                    </div>
                    <div class='col-8'>
                        {!! Form::label('NIKLabel', 'NIK', ['style' => 'font-weight: 600; margin: 1em 0;']) !!}
                        {!! Form::text('NIK', $data_b->NIK_RESERVASI, ['class' => 'form-control', 'maxlength' => '16', 'pattern' => '[0-9]{16}', 'readonly', 'required']) !!}

                    </div>
                </div>
                <div class='row'>
                    <div class='col-6'>
                        {!! Form::label('namaLabel', 'Nama', ['style' => 'font-weight: 600; margin: 1em 0;']) !!}
                        {!! Form::text('nama', $data_b->NAMA_PEMESAN, ['class' => 'form-control', 'readonly', 'required']) !!}
                        <div class='row'>
                            <div class='col-6'>
                                {!! Form::label('checkInLabel', 'Check In', ['style' => 'font-weight: 600; margin: 1em 0;']) !!}
                                {!! Form::text('checkIn', $data_b->TANGGAL_CHECK_IN, ['class' => 'form-control formDate', 'disabled', 'onchange' => 'cekHarga()', 'autocomplete' => 'off', 'style' => 'cursor: pointer;', 'required']) !!}
                            </div>
                            <div class='col-6'>
                                {!! Form::label('checkOutLabel', 'Check Out', ['style' => 'font-weight: 600; margin: 1em 0;']) !!}
                                {!! Form::text('checkOut', $data_b->TANGGAL_CHECK_OUT, ['class' => 'form-control formDate', 'disabled', 'onchange' => 'cekHarga()', 'autocomplete' => 'off', 'style' => 'cursor: pointer;', 'required']) !!}
                            </div>
                            {!! Form::hidden('hari_menginap', null, ['id' => 'idhari_menginap']) !!}
                            {!! Form::hidden('harga_menginap', null, ['id' => 'idharga_menginap']) !!}
                            {!! Form::hidden('tenggat_waktu', $data_b->TENGGAT_PEMBAYARAN, ['id' => 'idtenggat_pembayaran']) !!}
                        </div>
                    </div>
                    <div class='col-6'>
                        {!! Form::label('noTelpLabel', 'No Telepon', ['style' => 'font-weight: 600; margin: 1em 0;']) !!}
                        {!! Form::text('noTelp', $data_b->NOMOR_TELEPON, ['class' => 'form-control', 'readonly', 'required', 'maxlength' => '15']) !!}
                        {!! Form::label('tipeKamarLabel', 'Tipe Kamar', ['style' => 'font-weight: 600; margin: 1em 0;']) !!}
                        <select name="tipe_kamar" class="form-control" disabled required>
                            @foreach ($daftar_tipe_kamar as $data)
                                <option value="{{ $data->ID_TIPE_KAMAR }}" data-harga='{{ $data->HARGA_PER_MALAM }}' @if ($data_b->ID_TIPE_KAMAR == $data->ID_TIPE_KAMAR) {{ 'selected' }} @endif>
                                    {{ $data->TIPE_KAMAR }} </option>
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
            <div class='col-2'>
                <div class='smallTitle tenggatDiv'>Tenggat Pembayaran</div>
                <div class='smallTitle tenggatDiv' id='tenggatTimer' style='color: var(--bluebluean) !important'></div>
            </div>
            <div class='col-2'>
                <div class='row d-flex flex-row position-relative' style='bottom: 0.5em'>
                    <div>
                        @if ($data_b->STATUS_DP == 'lunas')
                            {!! Form::checkbox('lunas', 'lunas', true, ['disabled' => 'disabled', 'id' => 'checkbox_tgl', 'class' => 'form-check-input']) !!}
                        @elseif ($data_b->STATUS_DP == 'belum')
                            {!! Form::checkbox('lunas', 'belum', false, ['disabled' => 'disabled', 'id' => 'checkbox_tgl', 'class' => 'form-check-input']) !!}
                        @endif
                        {!! Form::label('lunasLabel', 'Bayar uang muka', ['style' => 'font-weight: 600', 'class' => 'form-check-label']) !!}
                    </div>
                </div>
                <div class='row d-flex'>
                    {!! Form::submit('Simpan', ['class' => 'btn btn-success position-relative', 'id' => 'btn_simpan', 'disabled', 'style' => 'font-weight: 600']) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

    </div>
    <script>
        function enableForm() {
            if (document.getElementById('checkbox_tgl').getAttribute('disabled') == "disabled") {
                document.getElementById('checkbox_tgl').removeAttribute('disabled');
                document.getElementById('btn_simpan').removeAttribute('disabled');
                document.getElementsByClassName('linkEdit')[0].setAttribute('style', 'display: none !important');
            }
        }

        function hapusForm(id) {
            if (confirm('Apakah yakin ingin menghapus reservasi ' + id + '?')) {
                window.location = '../Hapusact/' + id;
            };
        }

        function time_counter() {
            // Set the date we're counting down to
            var countDownDate = new Date(document.getElementById('idtenggat_pembayaran').value).getTime();

            // Update the count down every 1 second
            var x = setInterval(function() {

                // Get today's date and time
                var now = new Date().getTime();

                // Find the distance between now and the count down date
                var distance = countDownDate - now;

                // Time calculations for days, hours, minutes and seconds
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Output the result in an element with id="demo"
                document.getElementById("tenggatTimer").innerHTML = days + " hari " + hours + " jam " +
                    minutes + " menit " + seconds + " detik "

                // If the count down is over, write some text
                if (distance < 0) {
                    if (document.getElementById('checkbox_tgl').value == 'lunas') {
                        console.log('udah lunas gan');
                        document.getElementsByClassName("tenggatDiv")[0].setAttribute('style',
                            'display: none !important');
                        document.getElementsByClassName("tenggatDiv")[1].setAttribute('style',
                            'display: none !important');
                        clearInterval(x);
                    } else {
                        alert('Reservasi ini telah kadaluarsa');
                        clearInterval(x);
                        document.getElementById('Reservasi_id').removeAttribute('readonly');
                        var res = document.getElementById('Reservasi_id').value;
                        window.location = '../Hapusact/' + res;
                    }
                }
            }, 1000);
        }

        function date() {
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
            var duit = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR'
            });

            checkIn = new Date(document.getElementsByClassName('formDate')[0].value);
            checkOut = new Date(document.getElementsByClassName('formDate')[1].value);

            oneday = 1000 * 60 * 60 * 24;
            if (document.getElementsByClassName('formDate')[1].value != "" && document.getElementsByClassName(
                    'formDate')[0]
                .value != "") {
                different = (checkOut - checkIn) / oneday;
                document.getElementById("idhari_menginap").value = different;
                harga = Math.floor($('select[name="tipe_kamar"] :selected').data('harga') * different);
                document.getElementById("idharga_menginap").value = harga;
                dp = harga * 0.1;
                if (different < 0) {
                    document.getElementsByClassName('formDate')[1].value = document.getElementsByClassName(
                            'formDate')[0]
                        .value;
                } else {
                    document.getElementById("textHarga").innerHTML = duit.format(harga);
                    document.getElementById("textHarga_dp").innerHTML = duit.format(dp);
                }
            }
        }

        $(document).ready(function() {
            if (document.getElementById('checkbox_tgl').value != 'lunas') {
                time_counter();
            } else {
                document.getElementsByClassName("tenggatDiv")[0].setAttribute('style',
                    'display: none !important');
                document.getElementsByClassName("tenggatDiv")[1].setAttribute('style',
                    'display: none !important');
            }
            date();
        });
    </script>
@endsection

@section('buttons')
    <img style='margin: 0 0 0 1em; cursor: pointer; height: 2em;' src="{{ asset('Assets/img/button_kembali.svg') }}"
        onclick="window.location = '/ppsi_crystalguesthouse/reservasi/mainReservasi';">
@endsection
