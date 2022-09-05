@extends('template/templateBasic')

@section('contentUtama')
    <div class='d-flex justify-content-center align-items-center flex-column h-100'>
        <div class='d-flex justify-content-between w-100'>
            <div>
                <div><img src='{{ asset('Assets/img/icon_daftar.svg') }}'></div>
                <div class='menuTitle'>Check-In</div>
            </div>
        </div>
        <div class='d-flex justify-content-between w-100 flex-wrap my-4'>
            <div class='tableContainerCustom w-100 px-3 py-3' style='overflow-y: scroll;'>
                <table class='tableCustom'>
                    <thead>
                        <tr>
                            <th scope="col">Nama Tamu</th>
                            <th scope="col">ID Reservasi</th>
                            <th scope="col">No Telp</th>
                            <th scope="col">Kekurangan</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $count = 0;
                        @endphp
                        @foreach ($data as $data_b)
                            @if ($data_b->STATUS_DP == 'lunas')
                                <tr class='trCustom' style='cursor: default'>
                                    <td>
                                        <div class='tableCustomContent'>{{ $data_b->NAMA_PEMESAN }}</div>
                                    </td>
                                    <td>
                                        <div class='tableCustomContent'>{{ $data_b->ID_RESERVASI }}</div>
                                    </td>
                                    <td>
                                        <div class='tableCustomContent'>{{ $data_b->NOMOR_TELEPON }}</div>
                                    </td>
                                    <td>
                                        <div class='tableCustomContent'>@php echo "Rp".number_format($data_b->TOTAL_PEMBAYARAN-($data_b->TOTAL_PEMBAYARAN * 0.1),2,',','.'); @endphp</div>
                                    </td>
                                    <td>
                                        <div class='tableCustomContent'
                                            style='font-weight: 600; background-color: var(--greenL); color: var(--white); cursor: pointer'
                                            onclick="window.location = 'konfirmasi/{{ $data_b->ID_RESERVASI }}'">
                                            Konfirmasi</div>
                                    </td>
                                </tr>
                                @php
                                    $count++;
                                @endphp
                            @endif
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
            <div class='buttonSidebarSmall d-flex align-items-center' onclick="window.location = 'mainTamu'">
                <img src='{{ asset('Assets/img/icon_black_daftar.svg') }}' style='margin: 0 0.25em 0 0'>Daftar Tamu
            </div>
            <div class='buttonSidebarSmall buttonSelected d-flex align-items-center'
                onclick="window.location = 'mainCheckIn'">
                <img src='{{ asset('Assets/img/icon_white_tambah.svg') }}' style='margin: 0 0.25em 0 0'>Check-In
            </div>
            <div class='buttonSidebarSmall d-flex align-items-center' onclick="window.location = 'mainCheckOut'">
                <img src='{{ asset('Assets/img/icon_black_kurang.svg') }}' style='margin: 0 0.25em 0 0'>Check-Out
            </div>
            <div class='buttonSidebarSmall d-flex align-items-center' onclick="window.location = 'mainKeluhan'">
                <img src='{{ asset('Assets/img/icon_black_alert.svg') }}' style='margin: 0 0.25em 0 0'>Keluhan
            </div>
        </div>
    @endsection
