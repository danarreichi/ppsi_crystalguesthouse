@extends('template/templateBasic')

@section('contentUtama')
    <div class='d-flex justify-content-center align-items-center flex-column h-100'>
        <div class='d-flex justify-content-between w-100'>
            <div>
                <div><img src='{{ asset('Assets/img/icon_daftar.svg') }}'></div>
                <div class='menuTitle'>History Tamu</div>
            </div>
            {!! Form::open(['url' => 'historylaporan/historyTamu/filter', 'id' => 'range']) !!}
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
        {!! Form::open(['url' => 'historylaporan/historyTamu/cetak', 'id' => 'tanggal_temp', 'target' => '_blank']) !!}
        @php
            if (isset($tanggal->tgl_awal) && isset($tanggal->tgl_akhir)) {
                $tgl_awal = $tanggal->tgl_awal;
                $tgl_akhir = $tanggal->tgl_akhir;
            } else {
                $tgl_awal = null;
                $tgl_akhir = null;
            }
        @endphp
        {!! Form::hidden('tgl_awal_tempt', $tgl_awal, ['id' => 'tgl_awal_temp']) !!}
        {!! Form::hidden('tgl_akhir_tempt', $tgl_akhir, ['id' => 'tgl_akhir_temp']) !!}
        {!! Form::close() !!}
        <div class='d-flex justify-content-between w-100 flex-wrap my-2'>
            <div class='tableContainerCustom w-100 px-3 py-3' style='overflow-y: scroll;'>
                <table class='tableCustom'>
                    <thead>
                        <tr>
                            <th scope="col">ID History</th>
                            <th scope="col">Nama Tamu</th>
                            <th scope="col">Total Denda</th>
                            <th scope="col">Tipe Kamar</th>
                            <th scope="col">Check-In</th>
                            <th scope="col">Check-Out</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $data_b)
                            <tr class='trCustom' style='cursor: default'>
                                <td>
                                    <div class='tableCustomContent'> {{ $data_b->ID_HISTORY_TAMU }} </div>
                                </td>
                                <td>
                                    <div class='tableCustomContent'> {{ $data_b->HISTORY_NAMA_TAMU }} </div>
                                </td>
                                <td>
                                    <div class='tableCustomContent'> @php echo 'Rp '.number_format($data_b->HISTORY_DENDA,2,',','.'); @endphp </div>
                                </td>
                                @foreach ($master_kamar as $master_kamarb)
                                    @if ($data_b->ID_KAMAR == $master_kamarb->ID_KAMAR)
                                        @foreach ($master_tipe_kamar as $master_tipe_kamarb)
                                            @if ($master_kamarb->ID_TIPE_KAMAR == $master_tipe_kamarb->ID_TIPE_KAMAR)
                                                <td>
                                                    <div class='tableCustomContent'> {{ $master_tipe_kamarb->TIPE_KAMAR }}
                                                    </div>
                                                </td>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach

                                <td>
                                    <div class='tableCustomContent'> {{ $data_b->HISTORY_TANGGAL_CHECK_IN }} </div>
                                </td>
                                <td>
                                    <div class='tableCustomContent'> {{ $data_b->HISTORY_TANGGAL_CHECK_OUT }} </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <button class="btn btn-primary w-100 mt-4" style="font-weight: 600" onclick="submit_cetak()"> Cetak Laporan Tamu
            </button>
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

            function submit_cetak() {
                document.getElementById('tanggal_temp').submit();
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
            <div class='buttonSidebarSmall buttonSelected d-flex align-items-center'
                onclick="window.location = '/ppsi_crystalguesthouse/historylaporan/historyTamu'">
                <img src='{{ asset('Assets/img/icon_white_bed.svg') }}' style='margin: 0 0.25em 0 0'>History Tamu
            </div>
            <div class='buttonSidebarSmall d-flex align-items-center'
                onclick="window.location = '/ppsi_crystalguesthouse/historylaporan/historyKeluhan'">
                <img src='{{ asset('Assets/img/icon_black_alert.svg') }}' style='margin: 0 0.25em 0 0'>History Keluhan
            </div>
        </div>
    @endsection
