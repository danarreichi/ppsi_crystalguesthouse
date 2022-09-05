@extends('template/templateBasic')

@section('contentUtama')
    <div class='d-flex justify-content-center align-items-center flex-column h-100'>
        <div class='d-flex justify-content-between w-100'>
            <div>
                <div><img src='{{ asset('Assets/img/icon_daftar.svg') }}'></div>
                <div class='menuTitle'>History Keluhan</div>
            </div>
            {!! Form::open(['url' => 'historylaporan/historyKeluhan/filter', 'id' => 'range']) !!}
            <div class='d-flex row'>
                <div class='col-6'>
                    {!! Form::label('checkInLabel', 'Tanggal Awal', ['style' => 'font-weight: 600; margin: 1em 0;']) !!}
                    {!! Form::text('tgl_awal', null, ['class' => 'form-control formDate', 'onchange' => 'chk_range()', 'autocomplete' => 'off', 'style' => 'cursor: pointer;', 'required']) !!}
                </div>
                <div class='col-6'>
                    {!! Form::label('checkOutLabel', 'Tanggal Akhir', ['style' => 'font-weight: 600; margin: 1em 0;']) !!}
                    {!! Form::text('tgl_akhir', null, ['class' => 'form-control formDate', 'onchange' => 'chk_range()', 'autocomplete' => 'off', 'style' => 'cursor: pointer;', 'required']) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
        <div class='d-flex justify-content-between w-100 flex-wrap my-4'>
            <div class='tableContainerCustom w-100 px-3 py-3' style='overflow-y: scroll;'>
                <table class='tableCustom'>
                    <thead>
                        <tr>
                            <th scope="col">Nama Tamu</th>
                            <th scope="col">Nomor Kamar</th>
                            <th scope="col">Keluhan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $data_b)
                            <tr class='trCustom' style='cursor: default'>
                                <td>
                                    <div class='tableCustomContent'> {{ $data_b->NAMA_TAMU }} </div>
                                </td>
                                <td>
                                    @foreach ($master_tipe_kamar as $data_c)
                                        @if ($data_b->ID_KAMAR == $data_c->ID_KAMAR)
                                            <div class='tableCustomContent'> {{ $data_c->NOMOR_KAMAR }} </div>
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    <div class='tableCustomContent'> {{ $data_b->KELUHAN }} </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <script>
            function form_tanggal() {
                var date_inputIn = $('input[name="tgl_awal"]');
                var date_inputOut = $('input[name="tgl_akhir"]');

                var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
                var options = {
                    format: 'yyyy-mm-dd',
                    container: container,
                    todayHighlight: true,
                    autoclose: true,
                };

                date_inputIn.datepicker(options);
                date_inputOut.datepicker(options);
            }

            function chk_range() {
                awal = new Date(document.getElementsByClassName('formDate')[0].value);
                akhir = new Date(document.getElementsByClassName('formDate')[1].value);

                oneday = 1000 * 60 * 60 * 24;
                if (document.getElementsByClassName('formDate')[1].value != "" && document.getElementsByClassName('formDate')[0]
                    .value != "") {
                    different = (akhir - awal) / oneday;
                    if (different <= 0) {
                        // document.getElementsByClassName('formDate')[1].value = document.getElementsByClassName('formDate')[0]
                        //     .value;
                        document.getElementsByClassName('formDate')[1].value = "";
                        document.getElementsByClassName('formDate')[0].value = "";
                        alert('Tanggal tidak boleh sama atau kurang dari tanggal awal');
                    } else {
                        document.getElementById('range').submit();
                    }
                }
            }

            $(document).ready(function() {
                form_tanggal();
            });
        </script>
    @endsection

    @section('buttons')
        <img style='margin: 0 0 0 1em; cursor: pointer; height: 2em;' src="{{ asset('Assets/img/button_kembali.svg') }}"
            onclick="window.location = '/ppsi_crystalguesthouse/mainMenu';">
        <div class='sidebarButtons'>
            <div class='buttonSidebarSmall d-flex align-items-center'
                onclick="window.location = '/ppsi_crystalguesthouse/historylaporan/historyReservasi'">
                <img src='{{ asset('Assets/img/icon_black_daftar.svg') }}' style='margin: 0 0.25em 0 0'>History Reservasi
            </div>
            <div class='buttonSidebarSmall d-flex align-items-center'
                onclick="window.location = '/ppsi_crystalguesthouse/historylaporan/historyTamu'">
                <img src='{{ asset('Assets/img/icon_black_bed.svg') }}' style='margin: 0 0.25em 0 0'>History Tamu
            </div>
            <div class='buttonSidebarSmall buttonSelected d-flex align-items-center'
                onclick="window.location = '/ppsi_crystalguesthouse/historylaporan/historyKeluhan'">
                <img src='{{ asset('Assets/img/icon_white_alert.svg') }}' style='margin: 0 0.25em 0 0'>History Keluhan
            </div>
        </div>
    @endsection
