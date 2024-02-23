@extends('layouts.backend.master')
@section('title')
    {{ __($page_title ?? '-') }}
@endsection
@push('styles')
    {{-- <link rel="stylesheet" href="{{ asset('/assets/backend/datatable/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/backend/datatable/dataTables.bootstrap4.min.css') }}">

    <link href="{{ asset('assets/backend/css/app.mi n.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets\frontend\js\datepicker\css/mdp.css') }}"> --}}

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
    <!--<link href="{{ asset('assets/backend/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet"-->
    <!--    type="text/css" />-->
    <!-- Icons Css -->
    <link href="{{ asset('assets/backend/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    {{-- <link href="{{ asset('assets/backend/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" /> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets\frontend\js\datepicker\css/mdp.css') }}">


    <style>
        .avatar-sm {
            width: auto !important;
        }

        body {
            background: none;
        }
    </style>
@endpush

@section('page-content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">{{ __($page_title ?? '-') }}</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __($section ?? '-') }}</a>
                                </li>
                                <li class="breadcrumb-item active">{{ __($page_title ?? '-') }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            
                
                 @if (isset($message))
                        <div class="col-sm-12">
                            <div class="alert alert-{{ $type }} alert-dismissible fade show" role="alert">
                                @if (isset($type) == 'danger')
                                    <i class="mdi mdi-block-helper me-2"></i>
                                @else
                                    <i class="mdi mdi-check-all me-2"></i>
                                @endif
                                {{ __($message) }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                </div>
            @endif
            

            <div class="row">
                @if (Session::has('message'))
                    <div class="col-sm-12">
                        <div class="alert alert-{{ Session::get('type') }} alert-dismissible fade show" role="alert">
                            @if (Session::get('type') == 'danger')
                                <i class="mdi mdi-block-helper me-2"></i>
                            @else
                                <i class="mdi mdi-check-all me-2"></i>
                            @endif
                            {{ __(Session::get('message')) }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif
                <div class="col-sm-12 message"></div>
                <div class="col-sm-12 mb-2">
                    @if (Auth::user()->hasRole('Super Admin') || Auth::user()->hasRole('Admin'))
                        {!! $shortcut_buttons !!}
                    @endif
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-sm-12">
                            <form action="{{ route('admin.add.student.location') }}" method="POST">
                                @csrf
                                <div class="row mt-3 p-3">
                                    <h3>Add Location</h3>
                                    <div class="col-sm-2">
                                        <label for="user"> <b> Select Student </b> </label>
                                        <select class="form-select select2" data-placeholder="Choose Students" multiple
                                            id="students" name="students[]" required focus>
                                            @forelse ($students as $student)
                                                <option value="{{ $student->id }}">{{ $student->first_name . ' ' . $student->last_name  }} </option>
                                            @empty
                                                <option disabled value="">No Player Found!</option>
                                            @endforelse
                                        </select>
                                    </div>

                                    <div class="col-sm-3">
                                        <label for="event address"> <b> Event Address </b> </label>
                                        <input type="text" placeholder="Event Address" name="event_address"
                                            class="form-control">
                                    </div>

                                    <div class="col-sm-2">
                                        <label for="location"> <b> Location</b> </label>
                                        <input type="text" placeholder="Location" name="location" class="form-control">
                                    </div>

                                    <div class="col-sm-3">
                                        <label for="city"> <b> City </b> </label>
                                        <input type="text" placeholder="City" name="city" class="form-control">
                                    </div>

                                    <div class="col-sm-2">
                                        <label for="state"> <b> State </b> </label>
                                        <input type="text" placeholder="state" name="state" class="form-control">
                                    </div>

                                    <div class="col-sm-2 mt-3 p-3">
                                        <button type="submit" class="btn btn-primary"> Submit </button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>

                    <div>
                        <form action="{{ route('admin.change.course.dates') }}" method="POST">
                            @csrf
                            <div class="row">
                                <h3>Change Course Dates</h3>

                                <div class="col-sm-6">
                                    <label for="user"> <b> Select Student </b> </label>
                                    <select class="form-select select2" data-placeholder="Choose Students" multiple
                                        id="studentsCourse" name="studentsCourse[]" required focus>
                                        @forelse ($students as $student)
                                            <option value="{{ $student->id }}">{{ $student->first_name }} </option>
                                        @empty
                                            <option disabled value="">No Player Found!</option>
                                        @endforelse
                                    </select>
                                </div>

                                <div class="col-sm-6">
                                    <label for="dates" class="form-label">{{ __('Change Class Date') }}</label>
                                    <input type="text" id="classdate" placeholder="Select Date" name="dates"
                                        class="form-control" autocomplete="Off" required>
                                    <div class="invalid-feedback">
                                        Please Select Date.
                                    </div>
                                </div>

                            </div>

                            <div class="row mt-3 p-3">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary"> Submit </button>

                                </div>
                            </div>

                        </form>
                    </div>


                    <div class="card">
                        <form action="{{ route('admin.find.students') }}" method="POST">
                            @csrf
                            <div class="row mt-3 p-3">
                                <h3>Filter</h3>

                                <div class="col-sm-6">
                                    <label for="user"> <b>Select User</b> </label>
                                    <select name="user" id="user" class="form-control" required>
                                        <option value="">Select User</option>
                                        @forelse ($users as $user)
                                            <option value="{{ $user->id }}">
                                                {{ $user->first_name . ' ' . $user->last_name }}
                                            </option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>

                                <div class="col-sm-6">
                                    <label for="course"> <b>Select Course Date</b> </label>
                                    <input type="text" id="date" placeholder="Click to SelectDate"
                                        name="dates" class="form-control" autocomplete="Off" required>
                                </div>
                            </div>

                            <div class="row mt-3 p-3">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary"> Submit </button>

                                </div>
                            </div>

                        </form>
                        @if (isset($courseStudents) && count(($courseStudents)) > 0)
                            <div class="card-body table-scroll">
                                <table class="table table-bordered data-table wrap" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Course</th>
                                            <th>Created At</th>
                                            <th>Status(is active?)</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @forelse ($courseStudents as $student)
                                            <tr>
                                                <td> {{ $student->id }} </td>
                                                <td> {{ $student->first_name }} </td>
                                                <td> {{ $student->email }} </td>
                                                <td>
                                                    <b class="text-primary"> wednesday </b>
                                                    {{ @$student->class_start_date ? $student->class_start_date : $student->courses->start_date }}
                                                    <br />
                                                    <b class="text-primary"> Thursday </b>
                                                    {{ @$student->class_end_date ? $student->class_end_date : $student->courses->end_date }}
                                                </td>

                                                <td>
                                                    <strong class="text-primary">
                                                        {{ date('d-M-Y', strtotime($student->created_at)) . ' ' . \Carbon\Carbon::parse($student->created_at)->diffForHumans() }};
                                                    </strong>

                                                </td>
                                                <td>
                                                    @if ($student->is_active === 1)
                                                        <span _ngcontent-mqs-c179=""
                                                            class="badge font-size-10 bg-success p-2"> Active </span>
                                                    @else
                                                        <span _ngcontent-mqs-c179=""
                                                            class="badge font-size-10 bg-danger p-2"> Deactive </span>
                                                    @endif
                                                </td>

                                            </tr>
                                        @empty
                                        @endforelse


                                    </tbody>
                                </table>
                            </div>
                        @endif

                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/backend/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/backend/libs/parsleyjs/parsley.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/pages/form-validation.init.js') }}"></script>

    <script type="text/javascript" src="{{ asset('assets/frontend/js/datepicker/js/jquery-1.11.1.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/frontend/js/datepicker/js/jquery-ui-1.11.1.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/frontend/js/datepicker/jquery-ui.multidatespicker.js') }}">
    </script>

    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script> --}}

    <script type="text/javascript">
        // $(document).ready(function() {
        //     var selectedStartDate = null;

        //     $('#date').multiDatesPicker({
        //         defaultDate: new Date(2024, 0, 1),
        //         beforeShowDay: function(date) {
        //             var today = new Date();
        //             today.setHours(0, 0, 0, 0);

        //             var day = date.getDay();

        //             // Check if the date is a Wednesday or Thursday
        //             var isWednesday = day === 3;
        //             var isThursday = day === 4;

        //             // Check if the date is a future date or the current Wednesday or Thursday
        //             var isFutureDate = date > today;

        //             // Enable current and future Wednesday and Thursday dates, disable others
        //             var isSelectable = (isWednesday || isThursday) && isFutureDate;

        //             return [isSelectable, ''];
        //         },
        //         onSelect: function(dateText, inst) {
        //             var selectedDate = new Date(dateText);

        //             // Check if the selected date is a Wednesday
        //             if (selectedDate.getDay() === 3) {
        //                 // Automatically select the Thursday date
        //                 var thursdayDate = new Date(selectedDate);
        //                 thursdayDate.setDate(selectedDate.getDate() + 1);

        //                 // Reset the previous selection and add the new pair of consecutive dates
        //                 $('#date').multiDatesPicker('resetDates');
        //                 $('#date').multiDatesPicker('addDates', [$.datepicker.formatDate('mm/dd/yy',
        //                     selectedDate), $.datepicker.formatDate('mm/dd/yy',
        //                     thursdayDate)]);
        //             } else {
        //                 // If a non-Wednesday date is selected, reset the selection to only that date
        //                 $('#date').multiDatesPicker('resetDates');
        //                 $('#date').multiDatesPicker('addDates', dateText);
        //             }
        //         }
        //     });
        // });

        // $(document).ready(function() {
        //     var selectedStartDate = null;

        //     $('#classdate').multiDatesPicker({
        //         defaultDate: new Date(2024, 0, 1),
        //         beforeShowDay: function(date) {
        //             var today = new Date();
        //             today.setHours(0, 0, 0, 0);

        //             var day = date.getDay();

        //             // Check if the date is a Wednesday or Thursday
        //             var isWednesday = day === 3;
        //             var isThursday = day === 4;

        //             // Check if the date is a future date or the current Wednesday or Thursday
        //             var isFutureDate = date > today;

        //             // Enable current and future Wednesday and Thursday dates, disable others
        //             var isSelectable = (isWednesday || isThursday) && isFutureDate;

        //             return [isSelectable, ''];
        //         },
        //         onSelect: function(dateText, inst) {
        //             var selectedDate = new Date(dateText);

        //             // Check if the selected date is a Wednesday
        //             if (selectedDate.getDay() === 3) {
        //                 // Automatically select the Thursday date
        //                 var thursdayDate = new Date(selectedDate);
        //                 thursdayDate.setDate(selectedDate.getDate() + 1);

        //                 // Reset the previous selection and add the new pair of consecutive dates
        //                 $('#classdate').multiDatesPicker('resetDates');
        //                 $('#classdate').multiDatesPicker('addDates', [$.datepicker.formatDate(
        //                     'mm/dd/yy',
        //                     selectedDate), $.datepicker.formatDate('mm/dd/yy',
        //                     thursdayDate)]);
        //             } else {
        //                 // If a non-Wednesday date is selected, reset the selection to only that date
        //                 $('#classdate').multiDatesPicker('resetDates');
        //                 $('#classdate').multiDatesPicker('addDates', dateText);
        //             }
        //         }
        //     });
        // });


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


        $(document).ready(function() {
            var selectedDates = [];

            $('#classdate').multiDatesPicker({
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
@endpush
