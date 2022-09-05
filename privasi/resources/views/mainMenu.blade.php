@extends('template/templateBasic')

@section('contentUtama')
    <div class='d-flex justify-content-center align-items-center flex-column h-100'>
        <div class='d-flex justify-content-between w-100'>
            <div>
                <div><img src='{{ asset('Assets/img/mainmenu_icon.svg') }}'></div>
                <div class='menuTitle'>Main menu</div>
            </div>
            <div>
                <img src='{{ asset('Assets/img/logo_wide.svg') }}' style='height: 5em'>
            </div>
        </div>
        <div class='d-flex justify-content-between w-100 flex-wrap'>
            @if (Session::get('tipe_user') == 'ADMIN')
                <div class='menuCard' onclick='window.location="./master/Karyawan"'>
                    <img src="{{ asset('Assets/img/icon_datamaster.svg') }}">
                </div>
                <div class='menuCard' onclick='window.location="./reservasi/mainReservasi"'>
                    <img src="{{ asset('Assets/img/icon_reservasi.svg') }}">
                </div>
                <div class='menuCard' onclick='window.location="./tamu/mainTamu"'>
                    <img src="{{ asset('Assets/img/icon_tamu.svg') }}">
                </div>
                <div class='menuCard' onclick='window.location="./historylaporan/historyReservasi"'>
                    <img src="{{ asset('Assets/img/icon_historylaporan.svg') }}">
                </div>
            @else
                <div class='menuCard' style='height: 35em;' onclick='window.location="./reservasi/mainReservasi"'>
                    <img src="{{ asset('Assets/img/icon_reservasi.svg') }}">
                </div>
                <div class='menuCard' style='height: 35em;' onclick='window.location="./tamu/mainTamu"'>
                    <img src="{{ asset('Assets/img/icon_tamu.svg') }}">
                </div>
            @endif
        </div>
    </div>
    @if ($message = Session::get('warning'))
        <script>
            alert('Anda tidak memiliki hak akses');
        </script>
    @endif
@endsection
