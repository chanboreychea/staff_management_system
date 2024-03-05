<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
        }

        body {
            font-family: "Khmer", sans-serif;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: center;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>

    <div class="w-100 bg-info mb-2" style="height: 100px;">
        @if ($message = Session::get('message'))
            <div class="container position-relative" id="success-alert" style="z-index:999;">

                <div class="position-absolute top-0 end-0 p-2 success-alert">

                    <div class="toast show ">

                        <div class="toast-header">

                            <strong class="me-auto">Booking</strong>

                        </div>

                        <div class="toast-body text-success">

                            <b>{{ $message }}</b>

                        </div>

                    </div>

                </div>

            </div>
        @endif
    </div>

    <div class="container-fluid">

        <div class="row pe-5 px-5 mt-5">


            <table class="table">
                <thead>
                    <tr>
                        <th>Sun</th>
                        <th>Mon</th>
                        <th>Tue</th>
                        <th>Wed</th>
                        <th>Thu</th>
                        <th>Fri</th>
                        <th>Sat</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($calendar as $week)
                        <tr>
                            @foreach ($week as $day)
                                <td>
                                    @if ($day == '')
                                    @elseif ($day >= $dday)
                                    
                                        <a href="/rooms/{{ $day }}" class="btn btn-info btn-sm days w-100">
                                            {{ $day }}
                                        </a>
                                    @else
                                        <div>{{ $day }}</div>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        //message
        $('#success-alert, #error-alert').fadeIn('slow');
        setTimeout(function() {
            $('#success-alert, #error-alert').fadeOut('slow');
        }, 5000);
    </script>

</body>

</html>
