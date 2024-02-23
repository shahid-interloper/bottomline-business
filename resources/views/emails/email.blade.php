<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Class Reminder</title>
    <style>
        body,
        h1,
        p,
        b {
            margin: 5px !important;
        }
    </style>
</head>

<body>

    <h1> Hello {{ $data->first_name }} </h1>
    <p>
        Your scheduled 2-day Customer Service Training will be held in two weeks!!
        <br />
        <strong>
            This important event will be held from 9:00 a.m. to 4:00 p.m. at:
            <i> {{ @$classLocation->classLocation }} </i>
        </strong>
    <p> <i style="color:red">* *</i> Please bring an example of a good and a bad customer service experience for class
        discussion and a chance to win prizes! </p>
    <br />
    <p>If you have questions, please feel free to contact us by phone or the email noted below.</p>
    <b>Best Regards,</b>
    <br />
    <br />
    <img src="https://bottomlinebizsolutions.com/wp-content/uploads/2022/11/Logo_FF-1-2-1-2048x1046.png" width="200"
        height="100" alt="...">

    <br />
    <p>855-(TRY-BBSC) / {{ @$contact->number1 }}</p>
    <a href="mailto:{{ @$contact->email1 }}">
        {{ @$contact->email1 }}
    </a>
    </p>
    </p>

</body>

</html>
