<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title> thank you | {{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Admin Login" name="description" />
    <meta content="#" name="author" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/frontend/img/favicon/apple-touch-icon.png') }}" />
    @if (isset($favicon))
        <link rel="icon" type="image/png" sizes="16x16"
            href="{{ asset('assets/frontend/images/logos/' . $favicon['favicon']) }}">
    @else
        <link rel="icon" type="image/png" sizes="16x16"
            href="{{ asset('assets/frontend/img/favicon/favicon-16x16.png') }}">
    @endif

    <link rel="mask-icon" href="{{ asset('assets/frontend/img/favicon/safari-pinned-tab.svg') }}" color="#5bbad5">
    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/backend/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet"
        type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/backend/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/backend/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />


    <link rel="stylesheet" type="text/css" href="{{ asset('assets\frontend\js\datepicker\css/mdp.css') }}">
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('assets\frontend\js\datepicker\css/prettify.css')}}"> --}}


</head>
<style>
    .mybg {
        background: lightgray;
        /* background-image: url('{{ asset('assets/backend/images/background/admin-login-bg.jpg') }}'); */
        background-position: left;
        position: absolute;
        content: '';
        height: 100%;
        width: 100%;
        top: 0;
        left: 0;
        opacity: 1;
        z-index: -1;
    }

    .login-btn {
        background: lightgray;
        color: #ffffff;
        padding: 10px 20px;
        display: inline-block;
        font-size: 14px;
        border: 0px;
    }

    .login-btn:hover {
        background: #090e46;
    }

    .my-bg-2 {
        background-color: rgb(253, 248, 247);
    }
</style>
</head>

<body>
    <div class="mybg"></div>
    <div class="account-pages pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-8">
                    <div class="card overflow-hidden">
                        <div class="my-bg-2">
                            <div class="row">
                                <div class="col-12">
                                    <div class="text-primary p-4">
                                        <h5 class="text-primary text-center">
                                            {{ Session::get('type') == 'success' ? 'THANK YOU' : '' }} </h5>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-body pt-0 my-auto">
                            <div class="p-2">
                                @include('dynamic.messages')
                                @if (Session::has('message'))
                                    <div class="my-auto">
                                        <a href="{{ route('user.dashboard') }}">
                                            <button class="btn btn-primary">
                                                GOTO DASHBOARD
                                            </button> </a>
                                @endif
                                <div class="my-auto float-end">
                                    <a href="{{ route('front.register.step1') }}">
                                        <button class="btn btn-primary">
                                            Add students
                                        </button> </a>

                                </div>

                            </div>
                            <div class="mt-1 text-center">
                                <div>
                                    <p>&copy; {{ date('Y', time()) }} {{ config('app.name') }}</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>

</body>

</html>
