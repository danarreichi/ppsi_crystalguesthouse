@extends('template/templateBasic')

@section('contentUtama')
    <div class='d-flex justify-content-center align-items-center flex-column h-100'>
        <div class='d-flex justify-content-between w-100'>
            <div>
                <div><img src='{{ asset('Assets/img/icon_daftar.svg') }}'></div>
                <div class='menuTitle'>Tambah Tipe Kamar</div>
            </div>
        </div>
        <div class='d-flex justify-content-between w-100 flex-wrap my-4'>
            <div class='w-100' style='height: 65vh'>
                {!! Form::open(['url' => 'master/TipeKamar/tambah/actiontambah_karyawan', 'class' => 'justify-content-center w-100']) !!}
                <div class='row'>
                    <div class='col-8'>
                        {!! Form::label('idTipeKamarLabel', 'ID Kamar', ['style' => 'font-weight: 600; margin: 1em 0;']) !!}
                        {!! Form::text('idtipekamar', $id_kamar->MAX_ID_NUMBER, ['class' => 'form-control', 'id' => 'idtipekamar_field', 'readonly', 'required']) !!}

                        {!! Form::label('deskripsiTipeKamarLabel', 'Deskripsi Kamar', ['style' => 'font-weight: 600; margin: 1em 0;']) !!}
                        {!! Form::text('deskripsitipekamar', null, ['class' => 'form-control', 'id' => 'deskripsitipekamar_field', 'required']) !!}
                    </div>
                    <div class='col-4'>
                        {!! Form::label('TipeKamarLabel', 'Tipe Kamar', ['style' => 'font-weight: 600; margin: 1em 0;']) !!}
                        {!! Form::text('tipekamar', null, ['class' => 'form-control', 'id' => 'tipekamar_field', 'required']) !!}

                        {!! Form::label('hargatipekamarLabel', 'Harga Per Malam', ['style' => 'font-weight: 600; margin: 1em 0;']) !!}
                        {!! Form::number('hargatipekamar', 0, ['class' => 'form-control', 'id' => 'hargatipekamar_field', 'min' => '0', 'required']) !!}
                    </div>
                </div>
            </div>
            <div class='d-flex w-100 justify-content-end'>
                {!! Form::submit('Simpan', ['class' => 'btn btn-primary position-relative', 'style' => 'width: 14em; bottom: 1em; font-weight: 600']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('buttons')
    <img style='margin: 0 0 0 1em; cursor: pointer; height: 2em;' src="{{ asset('Assets/img/button_kembali.svg') }}"
        onclick="window.history.back();">
@endsection
