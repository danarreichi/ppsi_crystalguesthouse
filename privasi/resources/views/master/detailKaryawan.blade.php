@extends('template/templateBasic')

@section('contentUtama')
    <div class='d-flex justify-content-center align-items-center flex-column h-100'>
        <div class='d-flex justify-content-between w-100'>
            <div>
                <div><img src='{{ asset('Assets/img/icon_daftar.svg') }}'></div>
                <div class='menuTitle'>Detail Karyawan</div>
            </div>
            <div class='d-flex'>
                <div class='d-flex align-self-end linkEdit align-items-center' style='cursor: pointer; margin: 0 0.75em'
                    onclick="enableForm()">
                    <img src='{{ asset('Assets/img/button_edit.svg') }}' style='margin: 0 0.25em 0 0'>Edit
                </div>
                @foreach ($data_b as $data)
                    @if ($jumlah->jumlah > 1)
                        <div class='d-flex align-self-end linkHapus align-items-center'
                            style='cursor: pointer; margin: 0 0.75em'
                            onclick="bukaKonfirmasi('{{ $data->ID_USER_GUESTHOUSE }}')">
                            <img src='{{ asset('Assets/img/button_hapus.svg') }}' style='margin: 0 0.25em 0 0'>Hapus
                        </div>
                    @endif
            </div>
        </div>
        <div class='d-flex justify-content-between w-100 flex-wrap my-4'>
            <div class='w-100' style='height: 65vh'>
                {!! Form::open(['url' => 'master/Karyawan/Edit', 'class' => 'justify-content-center w-100']) !!}
                <div class='row'>
                    <div class='col-8'>
                        {!! Form::label('usernameLabel', 'Username', ['style' => 'font-weight: 600; margin: 1em 0;']) !!}
                        {!! Form::text('username', $data->ID_USER_GUESTHOUSE, ['class' => 'form-control', 'id' => 'username_field', 'readonly' => 'readonly', 'required']) !!}
                        {!! Form::label('passwordLabel', 'Password', ['style' => 'font-weight: 600; margin: 1em 0;']) !!}
                        <br>
                        {!! Form::text('password', $data->PASSWORD, ['class' => 'form-control', 'id' => 'password_field', 'readonly' => 'readonly', 'required']) !!}
                    </div>
                    <div class='col-4'>
                        {!! Form::label('tipeuser', 'Tipe User', ['style' => 'font-weight: 600; margin: 1em 0;']) !!}
                        <select id='tipeuser_select' name="tipeuser" class="form-control" disabled>
                            <option value="ADMIN" @if ($data->JABATAN == 'ADMIN') {{ 'selected' }} @endif> Admin </option>
                            <option value="USER" @if ($data->JABATAN == 'USER') { {{ 'selected' }} @endif> User </option>
                        </select>
                    </div>
                </div>
                @endforeach
            </div>
            <div class='d-flex w-100 justify-content-end'>
                {!! Form::submit('Simpan', ['class' => 'btn btn-primary position-relative btnSimpan', 'style' => 'width: 14em; bottom: 1em; font-weight: 600; visibility: hidden;']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('buttons')
    <img style='margin: 0 0 0 1em; cursor: pointer; height: 2em;' src="{{ asset('Assets/img/button_kembali.svg') }}"
        onclick="window.location='/ppsi_crystalguesthouse/master/Karyawan'">
@endsection

<script>
    function enableForm() {
        if (document.getElementById('password_field').getAttribute('readonly') == "readonly") {
            document.getElementById('password_field').removeAttribute('readonly');
            document.getElementById('tipeuser_select').removeAttribute('disabled');
            document.getElementsByClassName('linkEdit')[0].setAttribute('style', 'display: none !important');
            document.getElementsByClassName('btnSimpan')[0].style.visibility = 'visible';
            document.getElementsByClassName('menuTitle')[0].innerHTML = "Edit Karyawan";
        }
    }

    function bukaKonfirmasi(id) {
        if (confirm('Apakah yakin ingin menghapus user ' + id + '?')) {
            window.location = '../Hapusact/' + id;
        };
    }

</script>
