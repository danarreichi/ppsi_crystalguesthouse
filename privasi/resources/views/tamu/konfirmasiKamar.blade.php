@extends('template/templateBasic')

@section('contentUtama')
    <div class='d-flex justify-content-center align-items-center flex-column h-100'>
        <div class='d-flex justify-content-between w-100'>
            <div>
                <div><img src='{{ asset('Assets/img/icon_daftar.svg') }}'></div>
                <div class='menuTitle'>Konfirmasi Kamar</div>
            </div>
            <div class='d-flex'>
                <div class='d-flex align-self-end align-items-center' style='font-weight:700; font-size:1.25em'>
                    Tipe Kamar: {{$nama_tipe_kamar->TIPE_KAMAR}}
                </div>
            </div>
        </div>
        <div class='d-flex justify-content-between w-100 flex-wrap my-4'>
            <div class='tableContainerCustom w-100 px-3 py-3' style='overflow-y: scroll;'>
                <table class='tableCustom'>
                    <thead>
                        <tr>
                            <th scope="col" class='col-5'>ID Kamar</th>
                            <th scope="col" class='col-5'>Nomor Kamar</th>
                            <th scope="col" class='col-2'></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($daftar_kamar as $data_b)
                            <tr class='trCustom' style='vertical-align: top; cursor: default'>
                                <td>
                                    <div class='tableCustomContent'>{{ $data_b->ID_KAMAR }}</div>
                                </td>
                                <td>
                                    <div class='tableCustomContent'>{{ $data_b->NOMOR_KAMAR }}</div>
                                </td>
                                <td>
                                    <div class='tableCustomContent'
                                    style='font-weight: 600; background-color: var(--greenL); color: var(--white); cursor: pointer'
                                    onclick="window.location = '{{$id_reservasi}}/{{$data_b->ID_KAMAR}}/berhasil'">Konfirmasi</div>
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
            onclick="window.location = '../mainCheckIn';">
    @endsection
