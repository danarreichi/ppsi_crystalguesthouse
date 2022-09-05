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
                <div class='menuTitle'>Detail Kamar</div>
            </div>
            <div class='d-flex'>
                <div class='d-flex align-self-end linkEdit align-items-center' style='cursor: pointer; margin: 0 0.75em'
                    onclick="enableForm()">
                    <img src='{{ asset('Assets/img/button_edit.svg') }}' style='margin: 0 0.25em 0 0'>Edit
                </div>
                @foreach ($data_b as $data)
                <div class='d-flex align-self-end linkHapus align-items-center' style='cursor: pointer; margin: 0 0.75em'
                    onclick="bukaKonfirmasi('{{ $data->ID_KAMAR }}')">
                    <img src='{{ asset('Assets/img/button_hapus.svg') }}' style='margin: 0 0.25em 0 0'>Hapus
                </div>
            </div>
        </div>
        <div class='d-flex justify-content-between w-100 flex-wrap my-4'>
            <div class='w-100' style='height: 65vh'>
                {!! Form::open(['url' => 'master/Kamar/Edit', 'class' => 'justify-content-center w-100']) !!}
                <div class='row'>
                    <div class='col-8'>
                        {!! Form::label('idKamarLabel', 'ID Kamar', ['style' => 'font-weight: 600; margin: 1em 0;']) !!}
                        {!! Form::text('idKamar', $data->ID_KAMAR, ['class' => 'form-control', 'readonly', 'required']) !!}
                        {!! Form::label('deskripsiLabel', 'Deskripsi', ['style' => 'font-weight: 600; margin: 1em 0;']) !!}
                        {!! Form::text('deskripsiKamar', $data->DESKRIPSI_KAMAR, ['class' => 'form-control', 'readonly' => 'readonly', 'id' => 'deskripsikamar', 'required']) !!}
                    </div>
                    <div class='col-4'>
                        {!! Form::label('deskripsiLabel', 'Nomor Kamar', ['style' => 'font-weight: 600; margin: 1em 0;']) !!}
                        {!! Form::number('nomorKamar', $data->NOMOR_KAMAR, ['class' => 'form-control', 'readonly', 'min' => '1', 'required']) !!}
                        {!! Form::label('availability', 'Availability', ['style' => 'font-weight: 600; margin: 1em 0;']) !!}
                        <select id="KamarAvail_d" name="kamar_avail" class="form-control" required disabled>
                            <option value="A" @if($data->AVAILABILITY == "A"){{'selected'}}@endif> Available </option>
                            <option value="U" @if($data->AVAILABILITY == "U"){{'selected'}}@endif> Unavailable </option>
                        </select>
                        {!! Form::label('tipeKamarLabel', 'Tipe Kamar', ['style' => 'font-weight: 600; margin: 1em 0;']) !!}
                        <select id="tipe_kamar_d" name="tipe_kamar" class="form-control" required disabled>
                            @foreach ($daftar_tipe_kamar as $data_b)
                                <option value="{{ $data_b->ID_TIPE_KAMAR }}" @if($data_b->ID_TIPE_KAMAR == $data->ID_TIPE_KAMAR){{'selected'}}@endif> {{ $data_b->TIPE_KAMAR }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @endforeach
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
        onclick="window.location='/ppsi_crystalguesthouse/master/Kamar'">
@endsection

<script>
    function enableForm() {
        if (document.getElementById('deskripsikamar').getAttribute('readonly') == "readonly") {
            document.getElementById('deskripsikamar').removeAttribute('readonly');
            document.getElementById('KamarAvail_d').removeAttribute('disabled');
            document.getElementById('tipe_kamar_d').removeAttribute('disabled');
            document.getElementsByClassName('linkEdit')[0].setAttribute('style', 'display: none !important');
            document.getElementsByClassName('btnSimpan')[0].style.visibility = 'visible';
            document.getElementsByClassName('menuTitle')[0].innerHTML = "Edit Karyawan";
        }
    }

    function bukaKonfirmasi(id) {
        if (confirm('Apakah yakin ingin menghapus kamar ' + id + '?')) {
            window.location = '../Hapusact/' + id;
        };
    }

</script>
