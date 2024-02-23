<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Class Location</title>
</head>

<body>

    <p style="margin:5px">
        Congratulations, {{ $data['first_name'] }}
    <p style="margin:5px"> you are registered to attend a 2-day Customer Service Training event hosted by Bottomline
        Business Solutions on
        <br/>
        <b>{{ $dates }}</b>
    </p>
    <b>The Specifics of your training day is noted below: </b>
    <br/>
    <b>This important event will be held from 9:00 a.m. to 4:00 p.m. at <i> Location: {{ @$classLocation->classLocation }} </i> </b>
    <p style="margin:5px"> <i style="color:red">* *</i> Please bring an example of a good and a bad customer service
        experience for class discussion and a chance to win prizes! </p>
    <p style="margin:5px">If you have questions, please feel free to contact us by phone or the email noted below.</p>
    <b style="margin:5px">Best Regards,</b>
    {{-- <p style="margin:5px">{{ config('app.name') }}</p> --}}
    <br/>
    <br/>
    <img src="https://bottomlinebizsolutions.com/wp-content/uploads/2022/11/Logo_FF-1-2-1-2048x1046.png" width="200"
        height="100" alt="...">

    <p style="margin:5px">855-(TRY-BBSC) / {{ @$contact->number1 }}</p>
    <a href="mailto:{{ @$contact->email1 }}">
        {{ @$contact->email1 }}
    </a>
    </p>

</body>

</html>
