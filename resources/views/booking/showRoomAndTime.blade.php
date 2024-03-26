@extends('frontend.layouts.master')

@section('contents')
<script>
    var bootstrapCSS = document.createElement('link');
       bootstrapCSS.href = 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css';
       bootstrapCSS.rel = 'stylesheet';
       bootstrapCSS.integrity = 'sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH';
       bootstrapCSS.crossOrigin = 'anonymous';

       // Append the link element to the document body
       document.body.appendChild(bootstrapCSS);
</script>
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

    <section class="section-box mt-120">
        <div class="container fontKef1" >
            <div class="row pe-5 px-5 mt-5">
                <div class="col-lg-8 col-sm-12">
                    <div class="card">
                        <h6 class="card-header bg-default text-light fontKef2" >
                            ការកក់បន្ទប់ប្រជុំ
                        </h6>
                        <div class="card-body">
                            <div class="container-fluid" id="myGroup">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <button id="room1" class="btn btn-sm btn-primary w-100" data-toggle="collapse"
                                            value="A" href="#collapseExample" role="button" aria-expanded="false"
                                            aria-controls="collapseExample">បន្ទប់ A
                                        </button>
                                    </div>
                                    <div class="col-lg-6">
                                        <button id="room2" class="btn btn-sm btn-primary w-100" data-toggle="collapse"
                                            value="B" data-target="#collapseExample2" aria-expanded="false"
                                            aria-controls="collapseExample2">បន្ទប់ B
                                        </button>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col">
                                        <div class="collapse" id="collapseExample" data-parent="#myGroup">
                                            <div class="card card-body">
                                                <div class="container" id="room1">
                                                    <div class="row ">
                                                        @for ($i = 8; $i < 12; $i++)
                                                            <div class="col nowrap">
                                                                <button type="button"
                                                                    value="A {{ $i }}-{{ $i + 1 }}"
                                                                    data-value="A {{ $i }}-{{ $i + 1 }}"
                                                                    class="items btn btn-sm btn-secondary w-100 times mt-2">
                                                                    {{ $i }}-{{ $i + 1 }}
                                                                </button>
                                                            </div>
                                                        @endfor
                                                    </div>

                                                    <div class="row">
                                                        @for ($i = 1; $i < 5; $i++)
                                                            <div class="col nowrap">
                                                                <button type="button"
                                                                    value="A {{ $i }}-{{ $i + 1 }}"
                                                                    data-value="A {{ $i }}-{{ $i + 1 }}"
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
                                                            <div class="col nowrap">
                                                                <button type="button"
                                                                    value="B {{ $i }}-{{ $i + 1 }}"
                                                                    data-value="B {{ $i }}-{{ $i + 1 }}"
                                                                    class="items btn btn-sm btn-secondary w-100 times mt-2">
                                                                    {{ $i }}-{{ $i + 1 }}
                                                                </button>
                                                            </div>
                                                        @endfor
                                                    </div>
                                                    <div class="row">
                                                        @for ($i = 1; $i < 5; $i++)
                                                            <div class="col nowrap">
                                                                <button type="button"
                                                                    value="B {{ $i }}-{{ $i + 1 }}"
                                                                    data-value="B {{ $i }}-{{ $i + 1 }}"
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
                                <div class="row mt-2">
                                    <table class="table table-sm table-bordered fontKef1">
                                        <thead style="font-size:12px">
                                            <th class="text-center">ល.រ</th>
                                            <th class="text-center">ប្រធានបទ</th>
                                            <th class="text-center">ដឹកនាំដោយ</th>
                                            <th class="text-center">កម្រិតប្រជុំ</th>
                                            <th class="text-center">បន្ទប់</th>
                                            <th class="text-center">ម៉ោង</th>
                                            <th class="text-center">ឈ្មោះអ្នកកក់</th>
                                        </thead>
                                        <tbody style="font-size:12px">
                                            @foreach ($booking as $key => $item)
                                                <tr>
                                                    <td class="text-center">{{ $key + 1 }}</td>
                                                    <td class="text-center">{{ $item->topicOfMeeting }}</td>
                                                    <td class="text-center">{{ $item->directedBy }}</td>
                                                    <td class="text-center">{{ $item->meetingLevel }}</td>
                                                    <td class="text-center">{{ $item->room }}</td>
                                                    <td class="text-center">{{ $item->time }}</td>
                                                    <td class="text-center">{{ $item->lastNameKh }}
                                                        {{ $item->firstNameKh }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-12">
                    <div class="card">
                        <h6 class="card-header bg-danger text-light fontKef2" >ព័ត៌មានលម្អិត</h6>
                        <form action="/booking" method="POST" style="font-size:13px;font-weight: bold">
                            @csrf
                            <div class="card-body fontKef1">
                                <div class="container">
                                    <input type="hidden" value="{{ $now }}" id="dateInput" name="date">
                                    <input type="hidden" name="userId" value="">
                                    <input type="hidden" id="roomInput" name="room">
                                    <input type="hidden" id="timeInput" name="times">

                                    <div class="form-group text-muted m-0">
                                        <label for="inputEmail3" class="fontKef1">កាលបរិច្ឆេទ:</label>
                                        <h6 id="inputEmail3" class="fontKef1 text-success" style="font-size:13px;font-weight: bold" >{{ $date }}</h6>
                                    </div>
                                    <hr>
                                    <div class="form-group row text-muted">
                                        <label for="roomDiv" class="col-form-label col-lg-3 ">បន្ទប់:</label>
                                        <div class="col-lg-9 d-flex align-items-center p-0">
                                            <div id="roomDiv"></div>
                                            {{-- @error('room')
                                                <small id="emailHelp"
                                                    class="form-text text-muted">{{ $message }}</small>
                                            @enderror --}}
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row text-muted">
                                        <label for="timeDiv" class="col-form-label col-lg-3 ">ម៉ោង:</label>
                                        <div class="col-lg-9 d-flex align-items-center p-0">
                                            <div class="mb-0" id="timeDiv"></div>
                                            {{-- @error('times')
                                                <small id="emailHelp"
                                                    class="form-text text-muted">{{ $message }}</small>
                                            @enderror --}}
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row text-muted align-middle">
                                        <label for="topic" class="col-form-label col-lg-5" style="vertical-align: middle;">ប្រធានបទ:</label>
                                        <div class="col-lg-7">
                                            <input type="text" class="form-control-sm" name="topic" id="topic"
                                                placeholder="ប្រធានបទ">
                                            @error('topic')
                                                <small id="emailHelp"
                                                    class="form-text text-muted">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- <hr> --}}
                                    <div class="form-group row text-muted align-middle">
                                        <label for="directedBy"
                                            class="col-form-label col-lg-5  "  style="vertical-align: middle;">ដឹកនាំដោយ:</label>
                                        <div class="col-lg-7">
                                            <input type="text" class="form-control-sm" name="directedBy" id="directedBy"
                                                placeholder="ឈ្មោះ">
                                            @error('directedBy')
                                                <small id="emailHelp"
                                                    class="form-text text-muted">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- <hr> --}}
                                    <div class="form-group row text-muted align-middle">
                                        <label for="meetingLevel"
                                            class="col-form-label col-lg-5 ">កម្រិតប្រជុំ:</label>
                                        <div class="col-lg-7">
                                            <select name="meetingLevel" id="meetingLevel" class="form-select form-select-sm">
                                                <option value="ការិយាល័យ">ការិយាល័យ</option>
                                                <option value="អន្តរការិយាល័យ">អន្តរការិយាល័យ</option>
                                                <option value="នាយកដ្ឋាន">នាយកដ្ឋាន</option>
                                                <option value="អន្តរនាយកដ្ឋាន">អន្តរនាយកដ្ឋាន</option>
                                                <option value="អង្គភាព">អង្គភាព</option>
                                                <option value="ផ្សេងៗ">ផ្សេងៗ</option>
                                            </select>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row text-muted align-middle">
                                        <label for="member"
                                            class="col-form-label col-lg-5 "  style="vertical-align: middle;">ចំនួនសមាជិក:</label>
                                        <div class="col-lg-7">
                                            <input type="number" min="2" max="50"
                                                class="form-control-sm borderNone w-100" name="member" id="member"
                                                placeholder="ចំនួន">
                                            @error('member')
                                                <small id="emailHelp"
                                                    class="form-text text-muted">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row text-muted align-middle">
                                        <label for="description" class="form-label col-lg-4 " style="vertical-align: middle;" >គោលបំណង:</label>
                                        <div class="col-lg-8">
                                            <textarea name="description" id="description" class="form-control-sm" cols="30" rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-muted d-flex justify-content-between">
                                <a href="/c" class="btn btn-secondary">Cancel</a>
                                <input type="submit" class="btn btn-success" value="Save">
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        var room1 = document.getElementById("room1");
        var room2 = document.getElementById("room2");
        var times = document.querySelectorAll('.times');
        var timeArray = [];
        var dataFromBookingController = {!! json_encode($verifyTimesBooking) !!};

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

        for (let i = 0; i < times.length; i++) {
            // for (let j = 0; j < dataFromBookingController.length; j++) {
            //     if (times[i].value == dataFromBookingController[j]['time']) {
            //         times[i].classList.add("btn-danger");
            //         times[i].disabled = true;
            //     }
            // }
            for (let j = 0; j < dataFromBookingController.length; j++) {
                var explodedArray = dataFromBookingController[j]['time'].split(', ');
                // Output each substring
                explodedArray.forEach(function(substring) {
                    if (times[i].value == substring) {
                        times[i].classList.add("btn-danger");
                        times[i].disabled = true;
                    }
                });
            }
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
            });
        }

        //message
        $('#success-alert, #error-alert').fadeIn('slow');
        setTimeout(function() {
            $('#success-alert, #error-alert').fadeOut('slow');
        }, 5000);
    </script>
@endsection
