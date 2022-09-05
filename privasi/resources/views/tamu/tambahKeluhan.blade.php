@extends('template/templateBasic')

@section('contentUtama')
    <div class='d-flex justify-content-center align-items-center flex-column h-100'>
        <div class='d-flex justify-content-between w-100'>
            <div>
                <div><img src='{{ asset('Assets/img/icon_blue_tambah.svg') }}'></div>
                <div class='menuTitle'>Tambah Keluhan</div>
            </div>
        </div>
        <div class='d-flex justify-content-between w-100 flex-wrap my-4'>
            <div class='w-100' style='height: 65vh'>
                {!! Form::open(['url' => 'tamu/mainKeluhan/actiontambah_keluhan', 'class' => 'justify-content-center w-100']) !!}
                <div class='row'>
                    <div class='col-6'>
                        {!! Form::label('namaTamuLabel', 'Nama Tamu', ['style' => 'font-weight: 600; margin: 1em 0;']) !!}
                        {!! Form::text('namaTamu', null, ['class' => 'form-control', 'required']) !!}
                    </div>
                    <div class='col-6'>
                        {!! Form::label('no_kamarLabel', 'Nomor Kamar', ['style' => 'font-weight: 600; margin: 1em 0;']) !!}
                        <select name="no_kamar" class="form-control" required>
                            @foreach ($data as $data_b)
                                <option value="{{ $data_b->ID_KAMAR }}">
                                    {{ $data_b->NOMOR_KAMAR }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-12'>
                        {!! Form::label('detailKeluhanLabel', 'Keluhan', ['style' => 'font-weight: 600; margin: 1em 0;']) !!}
                        {!! Form::text('keluhan', null, ['class' => 'form-control', 'required']) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class='row w-100' style='bottom: 2em'>
            <div class='d-flex justify-content-end'>
                {!! Form::submit('Simpan', ['class' => 'btn btn-primary', 'style' => 'font-weight: 600; width: 14em;']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    </div>
@endsection

@section('buttons')
    <img style='margin: 0 0 0 1em; cursor: pointer; height: 2em;' src="{{ asset('Assets/img/button_kembali.svg') }}"
        onclick="window.location = '/ppsi_crystalguesthouse/tamu/mainKeluhan';">
@endsection
