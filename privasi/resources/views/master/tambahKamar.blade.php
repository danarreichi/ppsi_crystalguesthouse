@extends('template/templateBasic')

@section('contentUtama')
    <div class='d-flex justify-content-center align-items-center flex-column h-100'>
        <div class='d-flex justify-content-between w-100'>
            <div>
                <div><img src='{{ asset('Assets/img/icon_daftar.svg') }}'></div>
                <div class='menuTitle'>Tambah Kamar</div>
            </div>
        </div>
        <div class='d-flex justify-content-between w-100 flex-wrap my-4'>
            <div class='w-100' style='height: 65vh'>
                {!! Form::open(['url' => 'master/Kamar/tambah/actiontambah_kamar', 'class' => 'justify-content-center w-100']) !!}
                <div class='row'>
                    <div class='col-8'>
                        {!! Form::label('idKamarLabel', 'ID Kamar', ['style' => 'font-weight: 600; margin: 1em 0;']) !!}
                        {!! Form::text('idKamar', $id_kamar->MAX_ID_NUMBER, ['class' => 'form-control', 'readonly', 'required']) !!}
                        {!! Form::label('deskripsiLabel', 'Deskripsi', ['style' => 'font-weight: 600; margin: 1em 0;']) !!}
                        {!! Form::text('deskripsiKamar', null, ['class' => 'form-control', 'required']) !!}
                    </div>
                    <div class='col-4'>
                        {!! Form::label('deskripsiLabel', 'Nomor Kamar', ['style' => 'font-weight: 600; margin: 1em 0;']) !!}
                        {!! Form::number('nomorKamar', $nomor_kamar, ['class' => 'form-control', 'readonly', 'min' => '1', 'required']) !!}
                        {!! Form::label('availability', 'Availability', ['style' => 'font-weight: 600; margin: 1em 0;']) !!}
                        <select name="kamar_avail" class="form-control" required>
                            <option value="A"> Available </option>
                            <option value="U"> Unavailable </option>
                        </select>
                        {!! Form::label('tipeKamarLabel', 'TipeKamar', ['style' => 'font-weight: 600; margin: 1em 0;']) !!}
                        <select name="tipe_kamar" class="form-control" required>
                            @foreach($daftar_tipe_kamar as $data)
                                <option value="{{ $data->ID_TIPE_KAMAR }}"> {{ $data->TIPE_KAMAR }} </option>
                            @endforeach
                        </select>
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
