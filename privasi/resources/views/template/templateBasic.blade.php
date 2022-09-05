@extends('template/template')

{{-- @if (Session::get('success'))

@else
    <script>
        window.location = "/ppsi_crystalguesthouse";
    </script>
@endif --}}

@section('content')
    <div class='col-3 vh-100 d-flex align-items-center justify-content-end flex-column' style='background-color: var(--grey)'>
        <div class='mb-auto' style='width:90%'>
            <div class='mt-5 w-100'>
                @yield('buttons')
            </div>
        </div>
        @include('template/sidebar')
    </div>

    <div class='col-9 vh-100 px-5'>
        @yield('contentUtama')
    </div>
@endsection
