@extends('template/template')
@section('content')

    <div class='col-md-8 overflow-hidden'>
        <img src="{{ asset('Assets/img/foto_bg.png') }}"
            style='height: 100%; position:relative; left: 8em;transform: scale(1.25)'>
    </div>
    <div class='col-md d-flex justify-content-center align-items-center'>
        <div class='flex-row justify-content-center w-75 flex-column' id='formLogin'>

            <div style='position: relative; bottom: 2em'>
                <img src="{{ asset('Assets/img/login_icon.svg') }}">
                <h1>Login</h1>
            </div>

            @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-block">
                    <strong>{{ $message }}</strong>
                </div>
            @endif

            <div class='flex-column'>
                {!! Form::open(['url' => '/periksalogin', 'class' => 'justify-content-center w-100']) !!}

                {!! Form::label('usernameLabel', 'Username', ['style' => 'font-weight: 600']) !!}
                {!! Form::text('username', null, ['class' => 'form-control']) !!}

                {!! Form::label('passwordLabel', 'Password', ['style' => 'font-weight: 600']) !!}
                <br>
                {!! Form::password('password', ['class' => 'form-control']) !!}
                <div class='d-flex w-100 justify-content-end'>
                    {!! Form::submit('Login', ['class' => 'btn btn-primary position-relative', 'style' => 'width: 12em; top: 1em; font-weight: 600']) !!}
                </div>
                {!! Form::close() !!}
            </div>
            <p style="color: #939393; font-size: 0.85em; margin-top: 2em">@2021 Crystal Guesthouse</p>
        </div>
    </div>

@endsection
