@extends('template/templateBasic')

@section('contentUtama')
    @if ($message = Session::get('warning'))
    <script>
        alert('Data telah digunakan, tidak bisa dihapus');
    </script>
    @endif
    <div class='d-flex justify-content-center align-items-center flex-column h-100'>
        <div class='d-flex justify-content-between w-100'>
            <div>
                <div><img src='{{ asset('Assets/img/icon_daftar.svg') }}'></div>
                <div class='menuTitle'>Detail Tipe Kamar</div>
            </div>
            <div class='d-flex'>
                <div class='d-flex align-self-end linkEdit align-items-center' style='cursor: pointer; margin: 0 0.75em'
                    onclick="enableForm()">
                    <img src='{{ asset('Assets/img/button_edit.svg') }}' style='margin: 0 0.25em 0 0'>Edit
                </div>
                @foreach ($data_b as $data)
                    <div class='d-flex align-self-end linkHapus align-items-center'
                        style='cursor: pointer; margin: 0 0.75em' onclick="bukaKonfirmasi('{{ $data->ID_TIPE_KAMAR }}')">
                        <img src='{{ asset('Assets/img/button_hapus.svg') }}' style='margin: 0 0.25em 0 0'>Hapus
                    </div>
            </div>
        </div>
        <div class='d-flex justify-content-between w-100 flex-wrap my-4'>
            <div class='w-100' style='height: 65vh'>
                {!! Form::open(['url' => 'master/TipeKamar/Edit', 'class' => 'justify-content-center w-100']) !!}
                <div class='row'>
                    <div class='col-8'>
                        {!! Form::label('idTipeKamarLabel', 'ID Kamar', ['style' => 'font-weight: 600; margin: 1em 0;']) !!}
                        {!! Form::text('idtipekamar', $data->ID_TIPE_KAMAR, ['class' => 'form-control', 'id' => 'idtipekamar_field', 'readonly' => 'readonly', 'required']) !!}

                        {!! Form::label('deskripsiTipeKamarLabel', 'Deskripsi Kamar', ['style' => 'font-weight: 600; margin: 1em 0;']) !!}
                        {!! Form::text('deskripsitipekamar', $data->DESKRIPSI_TIPE_KAMAR, ['class' => 'form-control', 'id' => 'deskripsitipekamar_field', 'readonly' => 'readonly', 'required']) !!}
                    </div>
                    <div class='col-4'>
                        {!! Form::label('TipeKamarLabel', 'Tipe Kamar', ['style' => 'font-weight: 600; margin: 1em 0;']) !!}
                        {!! Form::text('tipekamar', $data->TIPE_KAMAR, ['class' => 'form-control', 'id' => 'tipekamar_field', 'readonly' => 'readonly', 'required']) !!}

                        {!! Form::label('hargatipekamarLabel', 'Harga Per Malam', ['style' => 'font-weight: 600; margin: 1em 0;']) !!}
                        {!! Form::number('hargatipekamar', $data->HARGA_PER_MALAM, ['class' => 'form-control', 'id' => 'hargatipekamar_field', 'readonly' => 'readonly', 'min' => '0', 'required']) !!}
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
        onclick="window.location='/ppsi_crystalguesthouse/master/TipeKamar'">
@endsection

<script>
    function enableForm() {
        if (document.getElementById('deskripsitipekamar_field').getAttribute('readonly') == "readonly") {
            document.getElementById('deskripsitipekamar_field').removeAttribute('readonly');
            document.getElementById('tipekamar_field').removeAttribute('readonly');
            document.getElementById('hargatipekamar_field').removeAttribute('readonly');
            document.getElementsByClassName('linkEdit')[0].setAttribute('style', 'display: none !important');
            document.getElementsByClassName('btnSimpan')[0].style.visibility = 'visible';
            document.getElementsByClassName('menuTitle')[0].innerHTML = "Edit Tipe Kamar";
        }
    }

    function bukaKonfirmasi(id) {
        if (confirm('Apakah yakin ingin menghapus user ' + id + '?')) {
            window.location = '../Hapusact/' + id;
        };
    }

</script>
