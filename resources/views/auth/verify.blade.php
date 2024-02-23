<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>verify email | {{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Admin Login" name="description" />
    <meta content="#" name="author" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/frontend/img/favicon/apple-touch-icon.png') }}" />
    <link rel="shortcut icon" type="image/png" sizes="32x32"
        href="{{ asset('assets/frontend/img/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ asset('assets/frontend/images/favicon/favicon-16x16.png') }}">
    <link rel="mask-icon" href="{{ asset('assets/frontend/img/favicon/safari-pinned-tab.svg') }}" color="#5bbad5">
    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/backend/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet"
        type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/backend/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/backend/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
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
            background: #ff8000;
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

        a,
        .text-primary {
            color: #ff8000 !important;
        }
    </style>
</head>

<body>
    <div class="mybg"></div>
    <!-- Verify Email Address Section Start -->
    <div class="signin-section ptb-100">
        <div class="container">
            <div class="row pt-4 pb-5 my-auto">

                <div class="col-lg-6 col-md-8 offset-md-2 offset-lg-3">
                    <h3 class="mb-0">
                        {{ __('Before proceeding, please check your email for a verification link.') }}
                        {{ __('If you did not receive the email') }},
                    </h3>
                    <hr class="mt-0" />

                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <div class="text-center">
                            <button type="submit"
                                class="btn-1 login-btn">{{ __('Click Here to Request Another') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/backend/libs/parsleyjs/parsley.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/pages/form-validation.init.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>


</body>

</html>
