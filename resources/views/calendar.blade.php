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

        {{-- <div class="row pe-5 px-5 mt-5">
            <div class="col-8"> --}}

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
                                @else
                                    <button type="button" class="btn btn-info btn-sm w-100" data-toggle="modal"
                                        data-target="#myModal{{ $day }}">
                                        {{ $day }}
                                    </button>

                                    <div class="modal fade" id="myModal{{ $day }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h4 class="modal-title">Meeting Room</h4>
                                                    <button type="button" class="close"
                                                        data-dismiss="modal">&times;</button>
                                                </div>
                                                <form action="/booking" method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <input type="hidden" name="day"
                                                            value="{{ $day }}">

                                                        <input type="hidden" name="day"
                                                            value="{{ $day }}">

                                                        <div class="row">
                                                            <p class="demo"></p>
                                                            <div class="col"><button type="button" value="1"
                                                                    class="btn btn-primary w-100 input"
                                                                    data-toggle="collapse"
                                                                    data-target="#multiCollapseExample1"
                                                                    aria-expanded="false"
                                                                    aria-controls="multiCollapseExample1">Room
                                                                    1</button>
                                                            </div>
                                                            <div class="col"> <button type="button" value="2"
                                                                    class="btn btn-primary w-100 input"
                                                                    data-toggle="collapse"
                                                                    data-target="#multiCollapseExample2"
                                                                    aria-expanded="false"
                                                                    aria-controls="multiCollapseExample2">Room
                                                                    2</button>
                                                            </div>
                                                        </div>
                                                        {{-- <div class="row mt-2 collapse multi-collapse"
                                                            id="multiCollapseExample1">
                                                            <div class="col">
                                                                <div class="mb-3">
                                                                    <label for="exampleInputEmail1"
                                                                        class="form-label">ម៉ោងចាប់ផ្ដើម</label>
                                                                    <input type="time" class="form-control"
                                                                        value="" name="startTime"
                                                                        id="exampleInputEmail1"
                                                                        aria-describedby="emailHelp">
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="mb-3">
                                                                    <label for="exampleInputPassword1"
                                                                        class="form-label">ម៉ោងបញ្ចប់</label>
                                                                    <input type="time" class="form-control"
                                                                        value="" name="endTime"
                                                                        id="exampleInputPassword1">
                                                                </div>
                                                            </div>
                                                        </div> --}}
                                                        <div class="row mt-2">
                                                            <div class="col">
                                                                <div class="collapse multi-collapse"
                                                                    id="multiCollapseExample1">
                                                                    <div class="card card-body">
                                                                        <div class="container">
                                                                            <div class="row">
                                                                                @for ($i = 8; $i < 12; $i++)
                                                                                    <div class="col">
                                                                                        <button type="button"
                                                                                            value="{{ $i }}-{{ $i + 1 }}"
                                                                                            data-value="{{ $i }}-{{ $i + 1 }}"
                                                                                            class="items btn btn-sm btn-secondary w-100 changeColorBtn mt-2">
                                                                                            {{ $i }}-{{ $i + 1 }}
                                                                                        </button>
                                                                                    </div>
                                                                                @endfor
                                                                            </div>
                                                                            <div class="row">
                                                                                @for ($i = 1; $i < 5; $i++)
                                                                                    <div class="col">
                                                                                        <button type="button"
                                                                                            value="{{ $i }}-{{ $i + 1 }}"
                                                                                            data-value="{{ $i }}-{{ $i + 1 }}"
                                                                                            class="items btn btn-sm btn-secondary w-100 changeColorBtn mt-2">
                                                                                            {{ $i }}-{{ $i + 1 }}
                                                                                        </button>
                                                                                    </div>
                                                                                @endfor
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="collapse multi-collapse"
                                                                    id="multiCollapseExample2">
                                                                    <div class="card card-body">
                                                                        <div class="container">
                                                                            <div class="row">
                                                                                @for ($i = 8; $i < 12; $i++)
                                                                                    <div class="col">
                                                                                        <button type="button"
                                                                                            value="{{ $i }}-{{ $i + 1 }}"
                                                                                            data-value="{{ $i }}-{{ $i + 1 }}"
                                                                                            class="items btn btn-sm btn-secondary w-100 changeColorBtn mt-2">
                                                                                            {{ $i }}-{{ $i + 1 }}
                                                                                        </button>
                                                                                    </div>
                                                                                @endfor
                                                                            </div>
                                                                            <div class="row">
                                                                                @for ($i = 1; $i < 5; $i++)
                                                                                    <div class="col">
                                                                                        <button type="button"
                                                                                            value="{{ $i }}-{{ $i + 1 }}"
                                                                                            data-value="{{ $i }}-{{ $i + 1 }}"
                                                                                            class="items btn btn-sm btn-secondary w-100 changeColorBtn mt-2">
                                                                                            {{ $i }}-{{ $i + 1 }}
                                                                                        </button>
                                                                                    </div>
                                                                                @endfor
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <input type="submit" class="btn btn-success" value="Save">
                                                    </div>

                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- <div class="row mt-2 collapse multi-collapse" id="multiCollapse">
                    <div class="container">
                        <div class="row">
                            <div class="col"><button class="btn btn-primary w-100" data-toggle="collapse"
                                    aria-expanded="false" data-target="#multiCollapseExample1"
                                    aria-controls="multiCollapseExample1">Room 1</button>
                            </div>
                            <div class="col"> <button class="btn btn-primary w-100" type="button"
                                    data-toggle="collapse" data-target="#multiCollapseExample2" aria-expanded="false"
                                    aria-controls="multiCollapseExample2">Room 2</button>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <div class="collapse multi-collapse" id="multiCollapseExample1">
                                    <div class="card card-body">
                                        <div class="container">
                                            <div class="row">
                                                @for ($i = 8; $i < 12; $i++)
                                                    <div class="col">
                                                        <button type="button"
                                                            data-value="{{ $i }}-{{ $i + 1 }}"
                                                            class="items btn btn-sm btn-secondary w-100 changeColorBtn mt-2">
                                                            {{ $i }}-{{ $i + 1 }}
                                                        </button>
                                                    </div>
                                                @endfor
                                            </div>
                                            <div class="row">
                                                @for ($i = 1; $i < 5; $i++)
                                                    <div class="col">
                                                        <button type="button"
                                                            data-value="{{ $i }}-{{ $i + 1 }}"
                                                            class="items btn btn-sm btn-secondary w-100 changeColorBtn mt-2">
                                                            {{ $i }}-{{ $i + 1 }}
                                                        </button>
                                                    </div>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="collapse multi-collapse" id="multiCollapseExample2">
                                    <div class="card card-body">
                                        <div class="container">
                                            <div class="row">
                                                @for ($i = 8; $i < 12; $i++)
                                                    <div class="col">
                                                        <button type="button"
                                                            data-value="{{ $i }}-{{ $i + 1 }}"
                                                            class="items btn btn-sm btn-secondary w-100 changeColorBtn mt-2">
                                                            {{ $i }}-{{ $i + 1 }}
                                                        </button>
                                                    </div>
                                                @endfor
                                            </div>
                                            <div class="row">
                                                @for ($i = 1; $i < 5; $i++)
                                                    <div class="col">
                                                        <button type="button"
                                                            data-value="{{ $i }}-{{ $i + 1 }}"
                                                            class="items btn btn-sm btn-secondary w-100 changeColorBtn mt-2">
                                                            {{ $i }}-{{ $i + 1 }}
                                                        </button>
                                                    </div>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
        {{-- </div>
            <div class="col-4">
                <div class="container">

                </div>
            </div>
        </div> --}}
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        var inputs = document.querySelectorAll('.input');
        for (let i = 0; i < inputs.length; i++) {
            inputs[i].addEventListener('click', function(event) {
                const value = event.target.value;
                console.log('Clicked input value:', value);
            });
        }

        $('#success-alert, #error-alert').fadeIn('slow');

        setTimeout(function() {

            $('#success-alert, #error-alert').fadeOut('slow');

        }, 5000);

        $(document).ready(function() {
            $(".changeColorBtn").click(function() {
                var myArray = [];
                $(this).toggleClass('btn-success');

                if ($(this).hasClass('btn-success')) {
                    var value = $(this).data("value");
                    myArray.push(value);
                    myArray.join(", ");
                } else {
                    myArray.pop();
                    myArray.join(", ");
                }
                console.log(value);
            });
        });
    </script>
</body>

</html>
