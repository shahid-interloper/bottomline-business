<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title> Create an Account | {{ config('app.name') }}</title>
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
                <div class="col-sm-6">
                    <div class="card overflow-hidden">
                        <div class="my-bg-2">
                            <div class="row">
                                <div class="col-7">
                                    <div class="text-primary p-4">
                                        <h5 class="text-primary">CREATE AN ACCOUNT</h5>
                                    </div>
                                </div>
                                

                                @if (Session::has('error'))
                                    <div class="col-sm-12">
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <i class="mdi mdi-block-helper me-2"></i>
                                            {{ __(Session::get('error')) }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="p-2">

                                @include('dynamic.messages')

                                <form class="form-horizontal needs-validation" method="POST"
                                    action="{{ route('front.register.process') }}" enctype="multipart/form-data"
                                    id="registerForm" novalidate>
                                    @csrf
                                    <div class="row">

                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="company_name"
                                                    class="form-label">{{ __('Company Name') }}</label>
                                                <input type="text" class="form-control" placeholder="Company name"
                                                    name="company_name" value="{{ old('company_name') }}" required
                                                    autofocus>

                                                <div class="invalid-feedback">
                                                    Please enter Company name.
                                                </div>
                                                @error('company_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>


                                        
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="address"
                                                    class="form-label">{{ __('Address') }}</label>
                                                <input type="text" class="form-control" placeholder="Address"
                                                    name="address" value="{{ old('address') }}" required
                                                    autofocus>

                                                <div class="invalid-feedback">
                                                    Please enter address.
                                                </div>
                                                @error('address')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>



                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="first_name"
                                                    class="form-label">{{ __('First Name') }}</label>
                                                <input type="text" class="form-control" placeholder="First Name"
                                                    name="first_name" value="{{ old('first_name') }}" required
                                                    autofocus>

                                                <div class="invalid-feedback">
                                                    Please enter First name.
                                                </div>
                                                @error('first_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">

                                            <div class="mb-3">
                                                <label for="last_name" class="form-label">{{ __('Last Name') }}</label>
                                                <input type="text" class="form-control" placeholder="Last Name"
                                                    name="last_name" value="{{ old('last_name') }}" autofocus>


                                                @error('last_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                                <label for="phone" class="form-label">{{ __('Phone') }}</label>
                                                <input type="number" class="form-control"
                                                    placeholder="Enter Phone Number" name="phone"
                                                    value="{{ old('phone') }}" autofocus>


                                                @error('phone')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                                <label for="email" class="form-label">{{ __('Email') }}</label>
                                                <input type="email" class="form-control" data-parsley-type="email"
                                                    placeholder="Email" name="email" value="{{ old('email') }}"
                                                    required autofocus>


                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Password</label>
                                                <div class="input-group auth-pass-inputgroup">
                                                    <input type="password" class="form-control"
                                                        placeholder="Enter password" aria-label="Password"
                                                        aria-describedby="password-addon" id="passwordInput"
                                                        name="password" required />
                                                </div>

                                                <div class="invalid-feedback">
                                                    Please enter First name.
                                                </div>
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <br />
                                                <input class="form-check-input" type="checkbox"
                                                    id="showPasswordCheckbox" value=""> Show Password
                                            </div>
                                        </div>

                                        <div class="col-sm-8">
                                            <div class="my-auto">
                                                <button class="btn btn-primary" type="submit">
                                                    REGISTER
                                                </button>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="mt-4 text-center">
                                        <i class="mdi mdi-lock me-1"></i>{{ __('Already have account?') }}
                                        <a href="{{ route('login') }}" class=""><i
                                                class="bx bx-user font-size-16 align-middle me-1"></i>LOGIN</a>
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
    <script src="{{ asset('assets/backend/libs/parsleyjs/parsley.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/pages/form-validation.init.js') }}"></script>
    <script src="{{ asset('assets/backend/libs/jquery/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>


    <script>
        $(document).ready(function() {
            $('#showPasswordCheckbox').click(function() {
                $('#passwordInput').attr('type', $(this).is(':checked') ? 'text' : 'password');
            });

        })
    </script>

</body>

</html>
