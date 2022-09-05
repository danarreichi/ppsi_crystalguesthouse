<html>

<head>
    <title> Crystal GuestHouse </title>
    <link rel="icon" href="{{ asset('Assets/img/logo.svg') }}">
    <link href="{{ asset('Assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('Assets/css/customCSS.css') }}" rel="stylesheet">
    <script type="text/javascript" src="{{ asset('Assets/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('Assets/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" />
</head>

<body>
    <div class='container-fluid d-flex justify-content-center align-items-center vh-100 px-0'>
        @yield('content')
    </div>
</body>

</html>
