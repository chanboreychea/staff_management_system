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
            <div class="col-8">

                <div class="container-fluid" id="myGroup">
                    <div class="row">
                        <div class="col-lg-6">
                            <button id="room1" class="btn btn-lg btn-primary w-100" data-toggle="collapse"
                                value="1" href="#collapseExample" role="button" aria-expanded="false"
                                aria-controls="collapseExample">Room 1
                            </button>

                        </div>
                        <div class="col-lg-6">
                            <button id="room2" class="btn btn-lg btn-primary w-100" type="button"
                                data-toggle="collapse" value="2" data-target="#collapseExample2"
                                aria-expanded="false" aria-controls="collapseExample2">Room 2
                            </button>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <div class="collapse" id="collapseExample" data-parent="#myGroup">
                                <div class="card card-body">
                                    <div class="container">
                                        <div class="row">
                                            @for ($i = 8; $i < 12; $i++)
                                                
                                                <div class="col">
                                                    <button type="button"
                                                        value="{{ $i }}-{{ $i + 1 }}"
                                                        data-value="{{ $i }}-{{ $i + 1 }}"
                                                        class="items btn btn-sm btn-secondary w-100 times mt-2">
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
                                                        class="items btn btn-sm btn-secondary w-100 times mt-2">
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
                            <div class="collapse" id="collapseExample2" data-parent="#myGroup">
                                <div class="card card-body">
                                    <div class="container">
                                        <div class="row">
                                            @for ($i = 8; $i < 12; $i++)
                                                <div class="col">
                                                    <button type="button"
                                                        value="{{ $i }}-{{ $i + 1 }}"
                                                        data-value="{{ $i }}-{{ $i + 1 }}"
                                                        class="items btn btn-sm btn-secondary w-100 times mt-2">
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
                                                        class="items btn btn-sm btn-secondary w-100 times mt-2">
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

            </div>
            <div class="col-4">
                <div class="card">
                    <h5 class="card-header bg-danger text-light">SUMMARY</h5>
                    <form action="/booking" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="container">
                                <input type="hidden" value="{{ $date }}" id="dateInput" name="date">
                                <input type="hidden" id="roomInput" name="room">
                                <input type="hidden" id="timeInput" name="times">

                                <div class="form-group row text-muted">
                                    <label for="inputEmail3" class="form-label col-lg-4 text-lg">Date:</label>
                                    <div class="col-lg-8">
                                        <u>
                                            <h5 id="inputEmail3">{{ $date }}</h5>
                                        </u>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row text-muted">
                                    <label for="roomDiv" class="form-label col-lg-4">Room:</label>
                                    <div class="col-lg-8">
                                        <h5 id="roomDiv"></h5>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row text-muted">
                                    <label for="timeDiv" class="form-label col-lg-4">Time:</label>
                                    <div class="col-lg-8">
                                        <h5 id="timeDiv"></h5>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row text-muted">
                                    <label for="description" class="form-label col-lg-4">Description:</label>
                                    <div class="col-lg-8">
                                        <textarea name="description" id="description" class="form-control" cols="30" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-muted">
                            <input type="submit" class="btn btn-success" value="Save">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // var room1 = document.querySelectorAll('.room1');
        // var room2 = document.querySelectorAll('.room2');
        // var roomIndex = 0;
        // var room = 0;
        var room1 = document.getElementById("room1");
        var room2 = document.getElementById("room2");
        var times = document.querySelectorAll('.times');
        var timeArray = [];

        room1.addEventListener('click', function() {
            const value = room1.value;

            timeArray.length = 0;
            document.getElementById("timeDiv").innerHTML = timeArray.join(', ');
            document.getElementById("timeInput").value = timeArray.join(', ');
            for (let i = 0; i < times.length; i++) {
                times[i].classList.remove("btn-success");
            }

            if (room1.classList.contains('btn-success')) {
                room1.classList.remove("btn-success");
                if (timeArray.length == 0) {
                    document.getElementById("roomInput").value = '';
                    document.getElementById("roomDiv").innerHTML = '';
                }
            } else {
                room1.classList.add("btn-success");
                room2.classList.remove("btn-success");
                document.getElementById("roomDiv").innerHTML = value;
                document.getElementById("roomInput").value = value;
            }
        });

        room2.addEventListener('click', function() {
            const value = room2.value;
            timeArray.length = 0;
            document.getElementById("timeDiv").innerHTML = timeArray.join(', ');
            document.getElementById("timeInput").value = timeArray.join(', ');
            for (let i = 0; i < times.length; i++) {
                times[i].classList.remove("btn-success");
            }
            if (room2.classList.contains('btn-success')) {
                room2.classList.remove("btn-success");
                if (timeArray.length == 0) {
                    document.getElementById("roomInput").value = '';
                    document.getElementById("roomDiv").innerHTML = '';
                }
            } else {
                room2.classList.add("btn-success");
                room1.classList.remove("btn-success");
                document.getElementById("roomDiv").innerHTML = value;
                document.getElementById("roomInput").value = value;
            }
        });

        // for (let i = 0; i < room1.length; i++) {
        //     room1[i].addEventListener('click', function(event) {
        //         const value = event.target.value;
        //         roomIndex = i;
        //         room = value;
        //         if (room1[i].classList.contains('btn-success')) {
        //             room1[i].classList.remove("btn-success");
        //             if (timeArray.length == 0) {
        //                 document.getElementById("roomInput").value = '';
        //                 document.getElementById("roomDiv").innerHTML = '';
        //             }
        //         } else {
        //             room1[i].classList.add("btn-success");
        //             room2[roomIndex].classList.remove("btn-success");
        //             document.getElementById("roomDiv").innerHTML = value;
        //             document.getElementById("roomInput").value = value;
        //         }
        //     });
        // }

        // for (let i = 0; i < room2.length; i++) {
        //     room2[i].addEventListener('click', function(event) {
        //         const value = event.target.value;
        //         roomIndex = i;
        //         room = value;
        //         if (room2[i].classList.contains('btn-success')) {
        //             room2[i].classList.remove("btn-success");
        //             if (timeArray.length == 0) {
        //                 document.getElementById("roomInput").value = '';
        //                 document.getElementById("roomDiv").innerHTML = '';
        //             }
        //         } else {
        //             room2[i].classList.add("btn-success");
        //             room1[roomIndex].classList.remove("btn-success");
        //             document.getElementById("roomInput").value = value;
        //             document.getElementById("roomDiv").innerHTML = value;
        //         }
        //     });
        // }

        for (let i = 0; i < times.length; i++) {
            times[i].addEventListener('click', function(event) {
                const value = event.target.value;
                var index = timeArray.indexOf(value);
                if (index !== -1) {
                    timeArray.splice(index, 1);
                } else {
                    timeArray.push(value);
                }
                document.getElementById("timeDiv").innerHTML = timeArray.join(', ');
                document.getElementById("timeInput").value = timeArray.join(', ');
                times[i].classList.toggle("btn-success");

                // if (timeArray.length > 0) {
                //     if (room == 1)
                //         room2[roomIndex].disabled = true;
                //     else
                //         room1[roomIndex].disabled = true;
                // } else {
                //     if (room == 1)
                //         room2[roomIndex].disabled = false;
                //     else
                //         room1[roomIndex].disabled = false;
                //     document.getElementById("roomInput").value = '';
                // }
            });
        }

        //message
        $('#success-alert, #error-alert').fadeIn('slow');
        setTimeout(function() {
            $('#success-alert, #error-alert').fadeOut('slow');
        }, 5000);
    </script>
</body>

</html>
