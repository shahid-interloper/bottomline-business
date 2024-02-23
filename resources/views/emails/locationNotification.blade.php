<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Class Location</title>
    <style>
        body, h1, p, b {
            margin: 5px !important;
        }
    </style>
</head>

<body>

    <h1> Hi {{ $data['first_name'] }}</h1>
    <p>
        Congratulations! <br /> You are registered to attend a 2-day Customer Service Training event with the Bottomline
        Business Solutions team on
        <br />
        <b>{{ $dates }}</b>
        You are registered to attend this important workshop for professional development or because your employer
        values you as an employee.
        <b>The Specifics of your training day is noted below: </b>
        <br />
        *Each registrant must bring examples of good and bad customer service experiences!
        <br />
        Class: - 2-day Good ‘Ole Fashioned Customer Service Training
        <br />
        <b>Dates: {{ $dates }}  </b>
        <br />
        <b>Time: 9:00 a.m. to 4:00 p.m</b>
        <br />
        <br />

        <b>Location:</b> {{ @$locations[0]['location'] }}
        <br/>
        <b>Event Address : </b>{{ @$locations[0]['event_address'] }}
        <br/>
        <b>City : </b>{{ @$locations[0]['city'] }}
        <br/>
        <b>State : </b>{{ @$locations[0]['state'] }}


        <br />
        <br />
        If you have questions, please feel free to contact us by phone or email.
        <br />
        <b>Regards :</b>
        <br/>
        <br/>
        <img src="https://bottomlinebizsolutions.com/wp-content/uploads/2022/11/Logo_FF-1-2-1-2048x1046.png" width="200"
            height="100" alt="...">

    </p>

</body>

</html>
