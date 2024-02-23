<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title> Reset Password | {{ config('app.name') }} </title>
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
                                        <h5 class="text-primary">RESET YOUR PASSWORD !</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="p-2">
                                @include('dynamic.messages')
                                <form class="form-horizontal" method="POST" id="loginForm"
                                    action="{{ route('password.update') }}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $token }}">
                                    <div>
                                        <label for="first_name" class="form-label">{{ __('Email') }}</label>
                                        <input type="email" class="form-control" name="email"
                                            placeholder="Email Address" value="{{ $email ?? old('email') }}" required
                                            data-parsley-required-message="Enter email address" parsely-type="email"
                                            data-parsley-type-message="Enter valid email address"
                                            class="mb-3"autofocus />
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mt-2">
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group auth-pass-inputgroup">
                                            <input id="password" placeholder="password" type="password"
                                                class="form-control show-password w-100 @error('password') is-invalid @enderror"
                                                name="password" required autocomplete="new-password">
                                        </div>
                                        <br />
                                    </div>
                                    <div>
                                        <label for="password" class="form-label">Confirm Password</label>
                                        <div class="input-group auth-pass-inputgroup">
                                            <input id="password-confirm" placeholder="confirm password" type="password"
                                                class="form-control show-password mb-3 w-100"
                                                name="password_confirmation" required autocomplete="new-password" />
                                        </div>
                                        <input class="form-check-input showPassword" type="checkbox"
                                            id="showPasswordCheckbox" value=""> Show Password
                                    </div>
                                    <div class="col-lg-12 text-center mt-3">
                                        <button type="submit" class="btn btn-primary"
                                            style="visibility: visible; animation-name: fadeInUp;">
                                            {{ __('Reset Password') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
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
    <script src="{{ asset('assets/backend/libs/parsleyjs/parsley.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/pages/form-validation.init.js') }}"></script>
    <script src="{{ asset('assets/backend/libs/jquery/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>

    <script>
        $('.showPassword').click(function() {
            $('input[type="password"]').each(function() {
                var $input = $(this);
                $input.attr('type', $input.attr('type') === 'password' ? 'text' : 'password');
            });
        });
    </script>
</body>

</html>
