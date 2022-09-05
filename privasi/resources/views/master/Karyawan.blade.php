@extends('template/templateBasic')

@section('contentUtama')
    <div class='d-flex justify-content-center align-items-center flex-column h-100'>
        <div class='d-flex justify-content-between w-100'>
            <div>
                <div><img src='{{ asset('Assets/img/icon_daftar.svg') }}'></div>
                <div class='menuTitle'>Karyawan</div>
            </div>
            <div class='d-flex'>
                <div class='d-flex align-self-end linkTambah align-items-center' style='cursor: pointer;'
                    onclick="window.location = 'Karyawan/tambah'">
                    <img src='{{ asset('Assets/img/icon_tambah.svg') }}' style='margin: 0 0.25em 0 0'>Tambah data
                </div>
            </div>
        </div>
        <div class='d-flex justify-content-between w-100 flex-wrap my-4'>
            <div class='tableContainerCustom w-100 px-3 py-3' style='overflow-y: scroll;'>
                <table class='tableCustom'>
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Password</th>
                            <th scope="col">Jabatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $count = 0;
                        @endphp
                        @foreach ($data as $data_b)
                            <tr class='trCustom' onclick='window.location = "./Karyawan/Edit/{{ $data_b->ID_USER_GUESTHOUSE }}"'>
                                <td>
                                    <div class='tableCustomContent'>{{ $data_b->ID_USER_GUESTHOUSE }}</div>
                                </td>
                                <td>
                                    <div class='tableCustomContent'>{{ $data_b->PASSWORD }}</div>
                                </td>
                                <td>
                                    <div class='tableCustomContent'>{{ $data_b->JABATAN }}</div>
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
            <div class='buttonSidebarSmall buttonSelected d-flex align-items-center' onclick="window.location = 'Karyawan'">
                <img src='{{ asset('Assets/img/icon_white_daftar.svg') }}' style='margin: 0 0.25em 0 0'>Karyawan
            </div>
            <div class='buttonSidebarSmall d-flex align-items-center' onclick="window.location = 'Kamar'">
                <img src='{{ asset('Assets/img/icon_black_bed.svg') }}' style='margin: 0 0.25em 0 0'>Kamar
            </div>
            <div class='buttonSidebarSmall d-flex align-items-center' onclick="window.location = 'TipeKamar'">
                <img src='{{ asset('Assets/img/icon_black_tipe.svg') }}' style='margin: 0 0.25em 0 0'>Tipe Kamar
            </div>
        </div>
    @endsection
