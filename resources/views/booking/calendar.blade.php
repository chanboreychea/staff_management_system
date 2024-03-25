@extends('frontend.layouts.master')

@section('contents')
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
        <div class="container" style="font-family: Khmer, sans-serif">
            <div class="row">
                <div class="col-lg-12 mb-50">
                    <div class="content-single">
                        <div class="row pe-5 px-5 mt-2">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="text-align: center">Sun</th>
                                        <th style="text-align: center">Mon</th>
                                        <th style="text-align: center">Tue</th>
                                        <th style="text-align: center">Wed</th>
                                        <th style="text-align: center">Thu</th>
                                        <th style="text-align: center">Fri</th>
                                        <th style="text-align: center">Sat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($calendar as $week)
                                        <tr>
                                            @foreach ($week as $key => $day)
                                                @if ($key == 0 || $key == 6)
                                                    <td style="text-align: center">
                                                        {{ $day }}
                                                    </td>
                                                @else
                                                    <td>
                                                        @if ($day == '')
                                                        @elseif ($day >= $dday)
                                                            <a href="/rooms/{{ $day }}"
                                                                class="btn btn-info btn-sm days w-100">
                                                                {{ $day }}
                                                            </a>
                                                        @else
                                                            <div style="text-align: center">{{ $day }}</div>
                                                        @endif
                                                    </td>
                                                @endif
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row pe-5 px-5 mt-2">
                            <table class="table table-bordered">
                                <thead>
                                    <th class="text-center">ល.រ</th>
                                    <th class="text-center">កាលបរិច្ឆេទ</th>
                                    <th class="text-center">ប្រធានបទ</th>
                                    <th class="text-center">ដឹកនាំដោយ</th>
                                    <th class="text-center">កម្រិតប្រជុំ</th>
                                    <th class="text-center">បន្ទប់</th>
                                    <th class="text-center">ម៉ោង</th>
                                    <th class="text-center">ឈ្មោះអ្នកកក់</th>
                                    <th class="text-center">គោលបំណង</th>
                                    <th class="text-center">កែប្រែ</th>
                                </thead>
                                <tbody>
                                    @foreach ($booking as $key => $item)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td class="text-center">{{ $item->date }}</td>
                                            <td class="text-center">{{ $item->topicOfMeeting }}</td>
                                            <td class="text-center">{{ $item->directedBy }}</td>
                                            <td class="text-center">{{ $item->meetingLevel }}</td>
                                            <td class="text-center">{{ $item->room }}</td>
                                            <td class="text-center">{{ $item->time }}</td>
                                            <td class="text-center">{{ $item->lastNameKh }}
                                                {{ $item->firstNameKh }}</td>
                                            <td class="text-center">{{ $item->description }}</td>
                                            @if ($item->userId == Session::get('user_id'))
                                                <td class="text-center">
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                        data-target="#exampleModal{{ $item->id }}">
                                                        Cencel
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="exampleModal{{ $item->id }}"
                                                        tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                                        លុបចោលការកក់</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <form action="/booking/{{ $item->id }}" method="POST">
                                                                    @csrf
                                                                    {{ method_field('delete') }}

                                                                    <div class="modal-footer">
                                                                        <button type="submit"
                                                                            class="btn btn-primary">យល់ព្រម</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
@endsection
