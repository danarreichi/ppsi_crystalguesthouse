@extends('template/templateBasic')

@section('contentUtama')
    <div class='d-flex justify-content-center align-items-center flex-column h-100'>
        <div class='d-flex justify-content-between w-100'>
            <div>
                <div><img src='{{ asset('Assets/img/icon_daftar.svg') }}'></div>
                <div class='menuTitle'>Reservasi</div>
            </div>
        </div>
        <div class='d-flex justify-content-between w-100 flex-wrap my-4'>
            <div class='tableContainerCustom w-100 px-3 py-3' style='overflow-y: scroll;'>
                <table class='tableCustom'>
                    <thead>
                        <tr>
                            <th scope="col">Nama Tamu</th>
                            <th scope="col">Tipe Kamar</th>
                            <th scope="col">No Telp</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $count = 0;
                        @endphp
                        @foreach ($data as $data_b)
                            <tr class='trCustom' onclick='window.location = "./Edit/{{ $data_b->ID_RESERVASI }}"'>
                                <td>
                                    <div class='tableCustomContent'>{{ $data_b->NAMA_PEMESAN }}</div>
                                </td>
                                @foreach ($master_tipe_kamar as $master_tipe)
                                    @if ($master_tipe->ID_TIPE_KAMAR == $data_b->ID_TIPE_KAMAR)
                                        <td>
                                            <div class='tableCustomContent'>{{ $master_tipe->TIPE_KAMAR }}</div>
                                        </td>
                                    @endif
                                @endforeach
                                <td>
                                    <div class='tableCustomContent'>{{ $data_b->NOMOR_TELEPON }}</div>
                                </td>
                                <td style='text-transform: capitalize'>
                                    @if ($data_b->STATUS_DP == 'lunas')
                                        <div class='tableCustomContent'
                                            style='background-color: var(--greenL); color: var(--white); font-weight: 700'>
                                            {{ 'DP ' . $data_b->STATUS_DP }}</div>
                                    @elseif ($data_b->STATUS_DP == 'belum')
                                        <div class='tableCustomContent'
                                            style='background-color: var(--redvelvet); color: var(--white); font-weight: 700'>
                                            {{ 'DP ' . $data_b->STATUS_DP . ' lunas' }}</div>
                                    @endif
                                </td>
                            </tr>
                            @php
                                $count++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endsection

    @section('buttons')
        <img style='margin: 0 0 0 1em; cursor: pointer; height: 2em;' src="{{ asset('Assets/img/button_kembali.svg') }}"
            onclick="window.location = '../mainMenu';">
        <div class='sidebarButtons'>
            <div class='buttonSidebarSmall buttonSelected d-flex align-items-center'
                onclick="window.location = 'mainReservasi'">
                <img src='{{ asset('Assets/img/icon_white_daftar.svg') }}' style='margin: 0 0.25em 0 0'>Reservasi
            </div>
            <div class='buttonSidebarSmall d-flex align-items-center' onclick="window.location = 'tambahReservasi'">
                <img src='{{ asset('Assets/img/icon_black_tambah.svg') }}' style='margin: 0 0.25em 0 0'>Tambah Reservasi
            </div>
        </div>
    @endsection
