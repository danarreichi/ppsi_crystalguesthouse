@extends('template/templateBasic')

@section('contentUtama')
    <div class='d-flex justify-content-center align-items-center flex-column h-100'>
        <div class='d-flex justify-content-between w-100'>
            <div>
                <div><img src='{{ asset('Assets/img/icon_daftar.svg') }}'></div>
                <div class='menuTitle'>Tipe Kamar</div>
            </div>
            <div class='d-flex'>
                <div class='d-flex align-self-end linkTambah align-items-center' style='cursor: pointer;'
                    onclick="window.location = 'TipeKamar/tambah'">
                    <img src='{{ asset('Assets/img/icon_tambah.svg') }}' style='margin: 0 0.25em 0 0'>Tambah data
                </div>
            </div>
        </div>
        <div class='d-flex justify-content-between w-100 flex-wrap my-4'>
            <div class='tableContainerCustom w-100 px-3 py-3' style='overflow-y: scroll;'>
                <table class='tableCustom'>
                    <thead>
                        <tr>
                            <th scope="col" class='col-2'>ID Tipe Kamar</th>
                            <th scope="col" class='col-2'>Tipe Kamar</th>
                            <th scope="col" class='col-2'>Harga Per Malam</th>
                            <th scope="col" class='col-4'>Deskripsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $data_b)
                            <tr class='trCustom' onclick='window.location = "./TipeKamar/Edit/{{ $data_b->ID_TIPE_KAMAR }}"' style='vertical-align: top;'>
                                <td>
                                    <div class='tableCustomContent'>{{ $data_b->ID_TIPE_KAMAR }}</div>
                                </td>
                                <td>
                                    <div class='tableCustomContent'>{{ $data_b->TIPE_KAMAR }}</div>
                                </td>
                                <td>
                                    <div class='tableCustomContent' style='text-align: right'>@php echo 'Rp '.number_format($data_b->HARGA_PER_MALAM,2,',','.'); @endphp</div>
                                </td>
                                <td>
                                    <div class='tableCustomContent'>{{ $data_b->DESKRIPSI_TIPE_KAMAR }}</div>
                                </td>
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
            <div class='buttonSidebarSmall d-flex align-items-center' onclick="window.location = 'Kamar'">
                <img src='{{ asset('Assets/img/icon_black_bed.svg') }}' style='margin: 0 0.25em 0 0'>Kamar
            </div>
            <div class='buttonSidebarSmall buttonSelected d-flex align-items-center' onclick="window.location = 'TipeKamar'">
                <img src='{{ asset('Assets/img/icon_white_tipe.svg') }}' style='margin: 0 0.25em 0 0'>Tipe Kamar
            </div>
        </div>
    @endsection
