<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Checkout | {{ config('app.name') }}</title>
    <link href="{{ asset('assets/backend/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet"
        type="text/css" />

    <style>
        .cards_image {
            width: 250px;
        }

        .parsley-custom-error-message {
            color: red;
            margin-left: -29px;
            list-style: none;
            margin-top: 5px;
        }

        #payButton {
            width: 100%;
        }
        
        .parsley-errors-list li {
            color: red;
            list-style: none;
            margin: 0px !important;
            margin-left: -30px !important;
            padding-bottom: 0.5rem !important;

        }

        .parsley-error,
        .parsley-errors-list {
            margin-bottom: 0px !important;
        }
    </style>

</head>

<body>
    <div class="container card mt-5 p-5">

        <form action="{{ route('front.add.students') }}" method="POST" id="the-form">
            <div class="row">
                <div class="col-sm-7">
                    <h5> All Fields Are required <small class="text-danger"> * </small> </h5>
                    @csrf
                    <input type="hidden" name="totalPayment" value="{{ @$amount }}">

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input input-text half-width">
                                <input type="text" class="form-control" data-parsley-error-message="please enter first name" placeholder="First name" name="fname" required />
                            </div>
                        </div>
                        <div class="col-sm-6">

                            <div class="input input-text half-width">
                                <input type="text" class="form-control" data-parsley-error-message="please enter last name" placeholder="Last name" name="lname" required />

                            </div>
                        </div>

                        <div class="row mt-2">
                            <h4 class="mt-2">Billing Address</h4>

                            <div class="col-sm-12">
                                <label for="Line_one" class="mt-2"> Line 1 </label>
                                <input type="text" data-parsley-error-message="This field is required" class="form-control" placeholder="Line 1" name="line_one"
                                    required="">
                            </div>

                            <div class="col-sm-12">
                                <label for="Line_two" class="mt-2"> Line 2 </label>
                                <input type="text" class="form-control" placeholder="Line 2" name="line_two"/>
                            </div>

                            <div class="row mt-2">
                                <div class="col-sm-4">
                                    <label for="city"> City </label>
                                    <input type="text" data-parsley-error-message="please enter city" class="form-control" placeholder="City" name="city"
                                        required="">
                                </div>

                                <div class="col-sm-4">
                                    <label for="state"> State </label>
                                    <input type="text" data-parsley-error-message="please enter state" class="form-control" placeholder="State" name="state"
                                        required="">
                                </div>
                                <div class="col-sm-4">
                                    <label for="zip"> Zip </label>
                                    <input type="text" data-parsley-error-message="please zipcode" class="form-control" placeholder="Zip" name="zip"
                                        required="">
                                </div>
                            </div>

                            <div class="row">
                                
                                <div class="col-sm-12">
                                    <label for="phone"> phone </label>
                                    <input type="text" class="form-control" placeholder="phone" name="phone"
                                        data-parsley-error-message="please enter phone number" required="">
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-sm-12">
                                    <label for="Email"> Email </label>
                                    <div class="input input-text half-width">
                                        <input type="text" data-parsley-error-message="please enter email address" class="form-control"
                                            placeholder="Email eg : someone@example.com" name="email" required="">

                                    </div>
                                </div>
                            </div>


                            <div class="row mt-3">
                                <h4>Card Details</h4>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <img src="{{ asset('assets/frontend/images/cards.png') }}" class="cards_image"
                                            alt="..">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" placeholder="Name On Card" id="name_on_card" name="name_on_card"
                                            />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-5">
                                        <input type="text" placeholder="Card Number" name="card_number" placeholder="Name on Card"  class="form-control" required data-parsley-trigger="keyup" data-parsley-pattern="\d{16}" required
                                        data-parsley-error-message="Please enter a valid 16-digit card number." >
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" placeholder="Expiry Date" id="expiration_date"
                                            name="expiration_date" data-parsley-trigger="keyup"
                                            data-parsley-pattern="\d{2}/\d{2}" required
                                            data-parsley-error-message="Please enter a valid expiration date in MM/YY format (e.g., 10/24).">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" placeholder="Cvv" id="cvv" name="cvv"
                                            data-parsley-trigger="keyup" data-parsley-pattern="\d{3}" required
                                            data-parsley-error-message="Please enter a valid 3-digit CVV number.">
                                    </div>
                                </div>


                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-sm-5">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Total Students</th>
                                <th>Total Amount</th>
                                <th>Course Dates</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Students : {{ count(Session::get('students')) }}
                                </td>
                                <td>
                                    {{ 'Total Payment Amount' . ' $' . $amount }}
                                </td>
                                <td> {{ Session::get('dates') }} </td>
                            </tr>
                        </tbody>
                    </table>

                    <div>
                        <button class="btn btn-success btn-lg" id="payButton" type="submit">Pay</button>
                    </div>

                </div>

        </form>
    </div>
    </div>
    </div>
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#the-form').parsley();
        });
    </script>


    <script>
        // Add an event listener to the form submit button
        // document.getElementById('payButton').addEventListener('click', function(event) {
        //     // Get the form element
        //     var form = document.getElementById('the-form');
        //     // Validate the required fields
        //     if (!form.checkValidity()) {
        //         // Prevent form submission
        //         event.preventDefault();
        //         event.stopPropagation();
        //         // Display an error message using Swal.fire
        //         Swal.fire({
        //             icon: 'error',
        //             title: 'Validation Error',
        //             text: 'Please fill in all required fields.',
        //         });
        //     } else {
        //         $('#payButton').text('Processing ...')
        //         $('#payButton').attr('disabled', true)
        //     }

        //     // Add more validation logic as needed
        //     // If the form is valid, it will be submitted as usual
        // });
    </script>



</body>

</html>
