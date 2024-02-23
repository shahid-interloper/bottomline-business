@extends('layouts.frontend.master')

@section('page_title')
    {{ __('Login') }}
@endsection

@push('styles')
    <style>
        input[type="password"] {
            border-radius: 10px !important;
            width: 100% !important;
        }

        .parsley-errors-list li {
            color: red;
            list-style: none;
            margin: 0px !important;
            padding-bottom: 0.5rem !important;
        }

        .parsley-error,
        .parsley-errors-list {
            margin-bottom: 0px !important;
        }
    </style>
@endpush

@section('banner')
    <!-- banner start -->
    <section class="banner inner-banner">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center">
                    <h1><span>Login</span></h1>
                </div>
            </div>
        </div>
    </section>
    <!-- banner end -->
@endsection

@section('content')
    <section class="contact-us pt-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 mx-auto">
                    @include('dynamic.messages')
                    <div class="Leave-wrap">
                        <form method="POST" id="loginForm" action="{{ route('login') }}" class="custom-validation">
                            @csrf
                            <h3 class="text-center">Login to your account</h3>
                            <div class="row">
                                <div class="col-lg-12">
                                    <input type="email" name="email" placeholder="Email Address"
                                        value="{{ old('email') }}" required
                                        data-parsley-required-message="Enter email address" parsely-type="email"
                                        data-parsley-type-message="Enter valid email address" class="mb-2" />
                                </div>
                                <div class="col-lg-12">
                                    <input type="password" name="password" placeholder="Password" required
                                        data-parsley-required-message="Enter your password" />
                                </div>
                                <div class="col-lg-12 text-center">
                                    <button type="submit" class="btn-1">LOGIN</button>
                                </div>
                                <div class="col-lg-12">
                                    <div class="row text-center pt-3">
                                        <div class="col-12">
                                            <i class="text-dark">Forgot Password?</i> <a href="{{ route('front.password.request') }}">Reset Password</a>
                                        </div>
                                        <div class="col-12">
                                            {{-- <i class="text-dark">Not have an account?</i> <a href="{{ route('register') }}">Register</a> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('assets/backend/libs/parsleyjs/parsley.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/pages/form-validation.init.js') }}"></script>
@endpush
