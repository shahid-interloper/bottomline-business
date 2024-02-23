<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title> Register | {{ config('app.name') }}</title>
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

    /* a,
    .text-primary {
        color: #ff8000 !important;
    } */
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
                                        <h5> REGISTER NOW
                                            <a href="{{ route('user.dashboard') }}" target="_blank">
                                                <button class="btn btn-primary float-end">
                                                    Dashboard
                                                </button>
                                            </a>
                                        </h5>
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
                                    action="{{ route('front.register.step1Process') }}" id="registerForm" novalidate>
                                    @csrf
                                    <div class="row">
                                        <div id="mdp-demo"></div>

                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                                <label for="dates"
                                                    class="form-label">{{ __('Please select Date') }}</label>
                                                <input type="text" id="date" placeholder="Select Date"
                                                    name="dates" class="form-control" autocomplete="Off">

                                                <div class="invalid-feedback">
                                                    Please Select Date.
                                                </div>
                                                @error('dates')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <button class="btn btn-primary float-end" type="submit">
                                                    NEXT
                                                </button>
                                            </div>
                                        </div>


                                </form>

                            </div>
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
    <script src="{{ asset('assets/backend/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/backend/libs/parsleyjs/parsley.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/pages/form-validation.init.js') }}"></script>

    <script type="text/javascript" src="{{ asset('assets/frontend/js/datepicker/js/jquery-1.11.1.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/frontend/js/datepicker/js/jquery-ui-1.11.1.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/frontend/js/datepicker/jquery-ui.multidatespicker.js') }}">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>



    <script>
        $(document).ready(function() {
            var selectedDates = [];

            $('#date').multiDatesPicker({
                defaultDate: new Date(new Date().getFullYear(), new Date().getMonth()),
                beforeShowDay: function(date) {
                    var today = new Date();
                    today.setHours(0, 0, 0, 0);

                    var day = date.getDay();

                    // Check if the date is a Wednesday or Thursday
                    var isWednesday = day === 3;
                    var isThursday = day === 4;

                    // Check if the date is a future date and a Wednesday or Thursday
                    var isFutureDate = date > today && (isWednesday || isThursday);

                    return [isFutureDate, ''];
                },
                onSelect: function(dateText, inst) {
                    var selectedDate = new Date(dateText);

                    // Check if the selected date is a Wednesday or Thursday
                    if ((selectedDate.getDay() === 3 || selectedDate.getDay() === 4)) {
                        // If the date is already selected, remove it from the array
                        if (selectedDates.includes(dateText)) {
                            selectedDates = selectedDates.filter(date => date !== dateText);
                        } else {
                            // Check if two dates are already selected
                            if (selectedDates.length < 2) {
                                // Add the selected date to the array
                                selectedDates.push(dateText);
                            } else {
                                // If two dates are already selected, reset the dates with the newly selected date
                                selectedDates = [dateText];
                            }
                        }
                    }

                    // If more than two dates are selected, reset the dates with the newly selected date
                    if (selectedDates.length > 2) {
                        selectedDates = [dateText];
                    }

                    // Update the selected dates on the multiDatesPicker
                    $('#date').multiDatesPicker('resetDates');
                    $('#date').multiDatesPicker('addDates', selectedDates);
                }
            });
        });
    </script>

</body>

</html>
