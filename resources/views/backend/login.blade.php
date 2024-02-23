<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>.::. Login | {{ config('app.name') }} .::.</title>
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

        .login-btn:hover {
            background: #090e46;
        }

        .my-bg-2 {
            background-color: rgb(253, 248, 247);
        }

        /* a,
        .text-primary {
            color: #ff8000 !important;
        } */

        .form-check-input.is-valid~.form-check-label,
        .was-validated .form-check-input:valid~.form-check-label {
            color: black !important;
        }

        .btn-link {
            padding: 0px;
        }
    </style>
</head>

<body>
    <div class="mybg"></div>
    <div class="account-pages pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">
                        <div class="my-bg-2">
                            <div class="row">
                                <div class="col-7">
                                    <div class="text-primary p-4">
                                        <h5 class="text-primary">LOGIN</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="p-2">

                                @include('dynamic.messages')

                                <form class="form-horizontal needs-validation" method="POST"
                                    action="{{ route('login.process') }}" novalidate>
                                    @csrf
                                    <div class="mb-3">
                                        <label for="email" class="form-label">{{ __('Email') }}</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email" placeholder="Enter email here" required />
                                        <div class="invalid-feedback">
                                            Please Enter Email ddress .
                                        </div>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group auth-pass-inputgroup">
                                            <input type="password" class="form-control" placeholder="Enter password"
                                                aria-label="Password" aria-describedby="password-addon"
                                                id="passwordInput" name="password" />
                                            <button class="btn btn-light showPassword " type="button"
                                                id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                        </div>
                                        <div class="invalid-feedback">
                                            Please Enter Password .
                                        </div>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="remember-check">
                                        <label class="form-check-label" for="remember-check">
                                            Remember me
                                        </label>
                                    </div>

                                    <div class="mt-3 d-grid">
                                        <button class="btn btn-primary" type="submit">Log
                                            In</button>
                                    </div>
                                    <div class="mt-4 text-center">
                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                <i class="mdi mdi-lock me-1"></i>{{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                        OR<a href="{{ route('register') }}" class=""><i
                                                class="bx bx-user font-size-16 align-middle me-1"></i>REGISTER</a>
                                    </div>
                                </form>
                            </div>

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
    <!-- end account-pages -->
    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/backend/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/backend/libs/parsleyjs/parsley.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/pages/form-validation.init.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <!-- App js -->
    <script src="{{ asset('assets/backend/js/app.js') }}"></script>

    <script>
        $(document).ready(function(res) {
            $('.showPassword').click(function() {
                $('#passwordInput').attr('type', function(_, attr) {
                    return attr === 'password' ? 'text' : 'password';
                });
            });
        });
    </script>

</body>

</html>
