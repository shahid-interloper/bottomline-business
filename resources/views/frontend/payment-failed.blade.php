<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment Failed</title>

    <style>
        body {
            background-image: url("{{ asset('assets/frontend/images/payment-failed.jpg') }}");
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            /* Optionally, you can add more CSS properties to style the background image */
        }

        .button-container {
            position: fixed;
            bottom: 20px; /* Adjust the distance from the bottom as needed */
            left: 50%;
            transform: translateX(-50%);
        }

        .button {
            background-color: #1375ba;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>

</head>

<body>
    <!-- Your content here -->

    <div class="button-container">
        <a class="button" href="{{ @$register_route }}"> {{ @$button_tex }} </a>
    </div>
</body>

</html>
