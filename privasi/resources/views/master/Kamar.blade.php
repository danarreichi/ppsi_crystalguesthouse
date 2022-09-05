@extends('template/templateBasic')

@section('contentUtama')
    <div class='d-flex justify-content-center align-items-center flex-column h-100'>
        <div class='d-flex justify-content-between w-100'>
            <div>
                <div><img src='{{ asset('Assets/img/icon_daftar.svg') }}'></div>
                <div class='menuTitle'>Kamar</div>
            </div>
            <div class='d-flex'>
                <div class='d-flex align-self-end linkTambah align-items-center' style='cursor: pointer;'
                    onclick="window.location = 'Kamar/tambah'">
                    <img src='{{ asset('Assets/img/icon_tambah.svg') }}' style='margin: 0 0.25em 0 0'>Tambah data
                </div>
            </div>
        </div>
        <div class='d-flex justify-content-between w-100 flex-wrap my-4'>
            <div class='tableContainerCustom w-100 px-3 py-3' style='overflow-y: scroll;'>
                <table class='tableCustom'>
                    <thead>
                        <tr>
                            <th scope="col" class='col-2'>ID Kamar</th>
                            <th scope="col" class='col-2'>Nomor Kamar</th>
                            <th scope="col" class='col-4'>Tipe Kamar</th>
                            <th scope="col" class='col-4'>Availability</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $data_b)
                            <tr class='trCustom' onclick='window.location = "./Kamar/Edit/{{ $data_b->ID_KAMAR }}"'
                                style='vertical-align: top;'>
                                <td>
                                    <div class='tableCustomContent'>{{ $data_b->ID_KAMAR }}</div>
                                </td>
                                <td>
                                    <div class='tableCustomContent'>{{ $data_b->NOMOR_KAMAR }}</div>
                                </td>
                                @foreach ($table2 as $tipe)
                                    @if($tipe->ID_TIPE_KAMAR == $data_b->ID_TIPE_KAMAR)
                                        <td>
                                            <div class='tableCustomContent'>{{ $tipe->TIPE_KAMAR }}</div>
                                        </td>
                                    @endif
                                @endforeach
                                @php
                                    if ($data_b->AVAILABILITY == 'A') {
                                        echo "  <td style='color: var(--greenL) !important; font-weight: 700'>
                                                                                    <div class='tableCustomContent'>Available</div>
                                                                                </td>";
                                    } elseif ($data_b->AVAILABILITY == 'U') {
                                        echo "  <td style='color: var(--redvelvet) !important; font-weight: 700'>
                                                                                    <div class='tableCustomContent'>Unavailable</div>
                                                                                </td>";
                                    }
                                @endphp
                            </tr>
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
            <div class='buttonSidebarSmall d-flex align-items-center' onclick="window.location = 'Karyawan'">
                <img src='{{ asset('Assets/img/icon_black_daftar.svg') }}' style='margin: 0 0.25em 0 0'>Karyawan
            </div>
            <div class='buttonSidebarSmall buttonSelected d-flex align-items-center' onclick="window.location = 'Kamar'">
                <img src='{{ asset('Assets/img/icon_white_bed.svg') }}' style='margin: 0 0.25em 0 0'>Kamar
            </div>
            <div class='buttonSidebarSmall d-flex align-items-center' onclick="window.location = 'TipeKamar'">
                <img src='{{ asset('Assets/img/icon_black_tipe.svg') }}' style='margin: 0 0.25em 0 0'>Tipe Kamar
            </div>
        </div>
    @endsection
