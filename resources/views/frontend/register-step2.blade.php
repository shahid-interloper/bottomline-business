<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title> Register | {{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Admin Login" name="description" />
    <meta content="#" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="180x180"
        href="{{ asset('assets/frontend/img/favicon/apple-touch-icon.png') }}" />
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
    {{-- <script src="https://secure.networkmerchants.com/token/Collect.js" data-tokenization-key="ntucz5-P5CFbx-75j6tw-MCJz8h"></script> --}}
    @routes
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


    .login-btn:hover {
        background: #090e46;
    }

    .my-bg-2 {
        background-color: rgb(253, 248, 247);
    }

    label {
        font-weight: 900;
        margin-bottom: 0.5rem;
    }

    .alert-danger {
        margin: 10px;
    }

    .alert-success {
        margin: 10px;
    }

    .btn-dashboard {
        margin: 3px;
    }

    .back-dashboard {
        margin: 3px;
    }
</style>
</head>

<body>
    <div class="mybg"></div>
    <section class="contact-us pt-1">
        <div class="container my-auto">
            <div class="row mt-5 mb-5">
                <div class="col-lg-8 offset-md-2">
                    <form class="custom-validation repeater" method="POST"
                        action="{{ route('front.register.step2.process') }}" novalidate>
                        @csrf
                        <div class="card">
                            <h3 class="text-center mt-3"> Add Students

                                ( Total 50 )

                                {{-- {{ @$remainingStudents ? @$remainingStudents : Session::get('remainingStudents') }} ) --}}



                            </h3>
                            <h5 class="text-center"> {{ 'Company name : ' . Auth::user()->company_name }} </h5>
                            <div class="row">
                                <div class="col-sm-6 offset-md-3 text-center">
                                    <input type="number" min="1" name="number_of_students" id="number_of_students"
                                        class="form-control" onkeyup="checkStudents()" onkeydown="checkStudents()"
                                        placeholder="How many students you want to add" />
                                    <h5 class="mt-3" id="studentsCount"> </h5>
                                </div>
                            </div>

                            @include('dynamic.messages')
                            <div class="card-body" data-repeater-list="student">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <u>
                                            <h5 id="total_student"> Total Students #1 </h5>
                                        </u>
                                    </div>
                                </div>
                                <div class="row mb-3 student" data-repeater-item>
                                    <h5 class="mt-3 fw-bold">Attendees:</h5>
                                    <div class="form-group col-md-4">
                                        <label for="first_name">First Name</label>
                                        <input type="text" class="form-control" id="first_name" name="first_name"
                                            placeholder="First Name" value="{{ old('first_name') }}" required
                                            data-parsley-required-message="Enter first name">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name"
                                            placeholder="Last Name" value="{{ old('last_name') }}" required
                                            data-parsley-required-message="Enter last name">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="phone">Phone</label>
                                        <input type="text" class="form-control" id="phone" name="phone"
                                            placeholder="phone eg: 202-555-0126" value="{{ old('phone') }}" required
                                            data-parsley-required-message="Enter phone number eg: 202-555-0126">
                                    </div>
                                    <div class="form-group col-md-6 mt-3">
                                        <label for="email">Email</label>
                                        <input type="email" value="{{ old('email') }}" class="form-control"
                                            id="email" name="email" placeholder="Email" required
                                            data-parsley-required-message="Enter email addreess">
                                    </div>



                                    <div class="form-group col-md-5 mt-3">
                                        <label for="job_responsibilities"> Job responsibilities </label>
                                        <input type="text" class="form-control" id="job_responsibilities"
                                            name="job_responsibilities" value="{{ old('job_responsibilities') }}"
                                            placeholder="Job responsibilities" required
                                            data-parsley-required-message="Enter Job responsibilities">
                                    </div>

                                    <div class="form-group col-md-1 my-auto mb-1">
                                        <i data-repeater-delete class="fas fa-trash-alt fa-2x text-danger"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 mb-4">
                                        <button type="submit" id="payButton" class="btn btn-success btn-sm">
                                            Continue to Payment
                                        </button>
                                        <button type="button" data-repeater-create class="btn btn-primary btn-sm">
                                            Add Registrant
                                            &plus; </button>
                                    </div>

                                    <div class="col-lg-6">
                                        <a href="{{ route('user.dashboard') }}" target="_blank">
                                            <button type="button"
                                                class="btn btn-primary btn-sm float-end btn-dashboard">
                                                Dashboard
                                            </button>
                                        </a>
                                        <a href="{{ route('front.register.step1') }}">
                                            <button type="button"
                                                class="btn btn-primary btn-sm float-end back-dashboard">
                                                Back
                                            </button>
                                        </a>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="{{ asset('assets/backend/libs/parsleyjs/parsley.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/pages/form-validation.init.js') }}"></script>
    <script src="{{ asset('assets/frontend/jquery.repeater/jquery.repeater.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <script>
        $('.repeater').repeater({
            show: function() {
                if ($('.student').length > 50) {
                    // Display an error message or take any other action
                    alert("You can Only add 50 students in a class Kindly Book to another Class");
                    return;
                }
                $(this).slideDown();
                $('#total_student').html("Total Students #" + $('.student').length);

            },
            hide: function(deleteElement) {
                $(this).slideUp(deleteElement);
                $('#total_student').html("Total Students #" + ($('.student').length - 1));
            },
            isFirstItemUndeletable: true,
            repeaters: [{
                selector: '.inner-repeater'
            }]
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function checkStudents() {
            var number_of_students = $('#number_of_students').val();

            if (number_of_students) {
                $.ajax({
                    url: route('front.checkStudents'),
                    type: 'POST',
                    data: {
                        number_of_students: number_of_students
                    },
                    success: function(result) {
                        $('#studentsCount').html(result.replace(/['"]+/g, ''));
                        $('#studentsCount').css('color', 'red');
                    },
                    error: function(error) {

                    }
                })
            } else {
                $('#studentsCount').html('');

        }


        }
    </script>
</body>

</html>
