@extends('template/templateBasic')

@section('contentUtama')
    <div class='d-flex justify-content-center align-items-center flex-column h-100'>
        <div class='d-flex justify-content-between w-100'>
            <div>
                <div><img src='{{ asset('Assets/img/icon_daftar.svg') }}'></div>
                <div class='menuTitle'>Tambah Karyawan</div>
            </div>
        </div>
        <div class='d-flex justify-content-between w-100 flex-wrap my-4'>
            <div class='w-100' style='height: 65vh'>
                {!! Form::open(['url' => 'master/Karyawan/tambah/actiontambah_karyawan', 'class' => 'justify-content-center w-100']) !!}
                <div class='row'>
                    <div class='col-8'>
                        {!! Form::label('usernameLabel', 'Username', ['style' => 'font-weight: 600; margin: 1em 0;']) !!}
                        {!! Form::text('username', null, ['class' => 'form-control', 'required']) !!}
                        {!! Form::label('passwordLabel', 'Password', ['style' => 'font-weight: 600; margin: 1em 0;']) !!}
                        <br>
                        {!! Form::password('password', ['class' => 'form-control', 'required']) !!}
                    </div>
                    <div class='col-4'>
                        {!! Form::label('tipeuser', 'Tipe User', ['style' => 'font-weight: 600; margin: 1em 0;']) !!}
                        <select name="tipeuser" class="form-control" required>
                            <option value=""> --Pilih-- </option>
                            <option value="ADMIN"> Admin </option>
                            <option value="USER"> User </option>
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
