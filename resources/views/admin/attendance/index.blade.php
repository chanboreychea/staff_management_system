@extends('template.master')
@section('title', 'Attendance')

@section('content')

    <style>
        .dropdown-menu {
            max-height: 400px;
            /* Set your desired max height */
            overflow-y: auto;
            /* Enable vertical scrolling */
        }

        ul {
            list-style-type: none;
        }
    </style>

    @if ($errors->any())
        <div class="container position-relative" id="success-alert">

            <div class="position-absolute top-0 end-0 p-3 success-alert" style="z-index:999;margin-top:-90px; ">

                <div class="toast show ">

                    <div class="toast-header">

                        <strong class="me-auto">នាំចូលនូវវត្តមាន</strong>

                        <button type="button" class="btn-close text-white" data-bs-dismiss="toast"></button>

                    </div>

                    <div class="toast-body text-success">

                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>

                    </div>

                </div>

            </div>

        </div>
    @endif

    @if ($message = Session::get('message'))
        <div class="container position-relative" id="success-alert">

            <div class="position-absolute top-0 end-0 p-3 success-alert" style="z-index:999;margin-top:-90px; ">

                <div class="toast show ">

                    <div class="toast-header">

                        <strong class="me-auto">វត្តមានមន្រ្តី</strong>

                        <button type="button" class="btn-close text-white" data-bs-dismiss="toast"></button>

                    </div>

                    <div class="toast-body text-success">

                        <b>{{ $message }}</b>

                    </div>

                </div>

            </div>

        </div>
    @endif


    <div class="card" style="margin-top: -30px">
        <div class="card-header card bg-primary text-white m-2 d-flex justify-content-center"
            style="height: 50px;font-size: 18px">
            <div class="row">
                <div class="col justify-content-start align-items-center">
                    <div>វត្តមានលម្អិតមន្ត្រី</div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <h5 class="card-title w-100">
                <form action="/attendances" action="get">
                    @csrf
                    <div class="row">
                        <!-- add attendances -->
                        <div class="col-lg-1 col-sm-12">
                            <button type="button" class="btn btn-primary w-100" data-toggle="modal"
                                data-target="#addAttendance">
                                Add
                            </button>
                        </div>
                        {{-- user --}}
                        <div class="col-lg-1 col-sm-12">
                            <div class="dropdown w-100" style="position: relative;">
                                <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    មន្ត្រី
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li class="dropdown-item">
                                        <input type="checkbox" id="parent1" />
                                        <label for="parent1">ជ្រើសទាំងអស់</label>
                                        <ul>
                                            <li>
                                                <input type="checkbox" class="departmentId">
                                                ថ្នាក់ដឹកនាំ
                                                <ul>
                                                    @foreach ($users as $user)
                                                        @if ($user->departmentId == null && $user->officeId == null)
                                                            <li class="dropdown-item">
                                                                <input type="checkbox" class="uid" name="uid[]"
                                                                    value="{{ $user->idCard }}" id="">
                                                                {{ $user->lastNameKh }} {{ $user->firstNameKh }}
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </li>
                                            @foreach ($departments as $department)
                                                <li>
                                                    <input type="checkbox" class="departmentId">
                                                    {{ $department->departmentNameKh }}
                                                    <ul>
                                                        @foreach ($users as $user)
                                                            @if ($department->id == $user->departmentId)
                                                                <li class="dropdown-item">
                                                                    <input type="checkbox" class="uid" name="uid[]"
                                                                        value="{{ $user->idCard }}" id="">
                                                                    {{ $user->lastNameKh }} {{ $user->firstNameKh }}
                                                                </li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        {{-- from date --}}
                        <div class="col-lg-2 col-sm-12">
                            <div class="input-group mb-3 w-100">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">From</span>
                                </div>
                                <input type="date" name="fromDate" min="{{ now()->subMonths(3)->format('Y-m-d') }}"
                                    max="{{ now()->format('Y-m-d') }}" class="form-control" placeholder=""
                                    aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        {{-- to date --}}
                        <div class="col-lg-2 col-sm-12">
                            <div class="input-group mb-3 w-100">

                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">To</span>
                                </div>
                                <input type="date" name="toDate" max="{{ now()->format('Y-m-d') }}"
                                    class="form-control" placeholder="" aria-label="Username"
                                    aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="row">
                                <div class="col-lg-2"><input class="btn btn-warning w-100" type="submit" value="Filter">
                                </div>
                                <div class="col-lg-2"><a href="attendaces/export/excel"
                                        class="btn btn-danger w-100">Export</a>
                                </div>
                                <div class="col-lg-2"><button type="button" class="btn btn-success w-100"
                                        data-toggle="modal" data-target="#importAttendance">
                                        Import
                                    </button>
                                </div>
                                <div class="col">
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#exampleModal">
                                        ទាញយកវត្តមាន
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </h5>

            <div class="modal fade" id="addAttendance" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">វត្តមាន
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="/attendances" method="post">
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="exampleInputPassword1" class="form-label">មន្រ្តី</label>
                                            <div id="exampleInputPassword1" class="dropdown w-100"
                                                style="position: relative;">
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    មន្ត្រី
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <li class="dropdown-item">
                                                        <input type="checkbox" id="parent1" />
                                                        <label for="parent1">ជ្រើសទាំងអស់</label>
                                                        <ul>
                                                            <li>
                                                                <input type="checkbox" class="departmentId">
                                                                ថ្នាក់ដឹកនាំ
                                                                <ul>
                                                                    @foreach ($users as $user)
                                                                        @if ($user->departmentId == null && $user->officeId == null)
                                                                            <li class="dropdown-item">
                                                                                <input type="checkbox" class="uid"
                                                                                    name="uid[]"
                                                                                    value="{{ $user->idCard }}"
                                                                                    id="">
                                                                                {{ $user->lastNameKh }}
                                                                                {{ $user->firstNameKh }}
                                                                            </li>
                                                                        @endif
                                                                    @endforeach
                                                                </ul>
                                                            </li>
                                                            @foreach ($departments as $department)
                                                                <li>
                                                                    <input type="checkbox" class="departmentId">
                                                                    {{ $department->departmentNameKh }}
                                                                    <ul>
                                                                        @foreach ($users as $user)
                                                                            @if ($department->id == $user->departmentId)
                                                                                <li class="dropdown-item">
                                                                                    <input type="checkbox" class="uid"
                                                                                        name="uid[]"
                                                                                        value="{{ $user->idCard }}"
                                                                                        id="">
                                                                                    {{ $user->lastNameKh }}
                                                                                    {{ $user->firstNameKh }}
                                                                                </li>
                                                                            @endif
                                                                        @endforeach
                                                                    </ul>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="exampleInputPassword1" class="form-label">កាលបរិច្ឆេទ</label>
                                            <input type="date" class="form-control" name="date"
                                                value="{{ now()->format('Y-m-d') }}" id="exampleInputPassword1">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">ម៉ោងចូល</label>
                                            <input type="time" class="form-control" min="06:00:00" max="12:00:00"​
                                                name="checkIn" step="1" id="exampleInputEmail1"
                                                aria-describedby="emailHelp">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="exampleInputPassword1" class="form-label">ម៉ោងចេញ</label>
                                            <input type="time" class="form-control" min="13:00:00" name="checkOut"
                                                step="1" id="exampleInputPassword1">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="radio2"
                                                name="leave" value="1">
                                            <label class="form-check-label" for="radio2">ច្បាប់</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="radio2"
                                                name="mission" value="1">
                                            <label class="form-check-label" for="radio2">បេសកកម្ម</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">ថយក្រោយ</button>
                                <button type="submit" class="btn btn-primary">រក្សាទុក</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="importAttendance" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">វត្តមាន
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="/attendances/import/excel" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">

                                <label for="exampleInputEmail1" class="form-label">Attendances</label>
                                <input type="file" class="form-control" name="attendanceExcel"
                                    id="exampleInputEmail1" aria-describedby="emailHelp">

                            </div>
                            <div class="modal-footer">
                                <input type="submit" class="btn btn-primary" name="getAtt" value="រក្សាទុក">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Connection
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="/getAttendances" method="GET" id="yourForm">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">IP Address</label>
                                    <input type="text" class="form-control" name="ip" value="172.16.15.184"
                                        id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Port</label>
                                    <input type="text" class="form-control" name="port" value="4370"
                                        id="exampleInputPassword1">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" class="btn btn-primary" value="ទាញយកវត្តមាន">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <table class="table table-sm table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th style="text-align: center;" scope="col">ល.រ</th>
                        <th style="text-align: center;" scope="col">ឈ្មោះមន្ត្រី</th>
                        <th style="text-align: center;" scope="col">អត្តលេខ</th>
                        <th style="text-align: center;" scope="col">កាលបរិច្ឆេទ</th>
                        <th style="text-align: center;" scope="col">ច្បាប់</th>
                        <th style="text-align: center;" scope="col">ម៉ោងចូល</th>
                        <th style="text-align: center;" scope="col">ចូលយឺត</th>
                        <th style="text-align: center;" scope="col">ម៉ោងចេញ</th>
                        <th style="text-align: center;" scope="col">ចេញយឺត</th>
                        <th style="text-align: center;" scope="col">បេសកកម្ម</th>
                        <th style="text-align: center;" scope="col">សរុប</th>
                        <th style="text-align: center;" scope="col">សកម្មភាព</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($attendances as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>
                                {{ $item->lastNameKh }} {{ $item->firstNameKh }}
                            </td>
                            <td style="text-align: center;">{{ $item->userId }}</td>
                            <td style="text-align: center;">{{ $item->date }}</td>
                            <td style="color: red; text-align: center;">{{ $item->leave }}</td>

                            @if ($item->checkIn)
                                @if ($item->checkIn > '09:00:00')
                                    <td style="color: red; text-align: center;">{{ $item->checkIn }}</td>
                                @else
                                    <td style="text-align: center;">{{ $item->checkIn }}</td>
                                @endif
                            @else
                                <td style="text-align: center;">--:--:--</td>
                            @endif

                            <td style="color: red; text-align: center;">{{ $item->lateIn }}</td>

                            @if ($item->checkOut)
                                @if ($item->checkOut < '04:00:00' && $item->checkOut > '17:30:00')
                                    <td style="color: red; text-align: center;">{{ $item->checkOut }}</td>
                                @elseif ($item->checkOut > '17:30:00')
                                    <td style="color: red; text-align: center;">{{ $item->checkOut }}</td>​
                                @else
                                    <td style="text-align: center;">{{ $item->checkOut }}</td>
                                @endif
                            @else
                                <td style="text-align: center;">--:--:--</td>
                            @endif

                            <td style="color: red; text-align: center;">{{ $item->lateOut }}</td>

                            <td style="color: red; text-align: center;">{{ $item->mission }}</td>

                            <td style="text-align: center;">
                                @if ($item->total)
                                    {{ $item->total }}
                                @else
                                    --:--:--
                                @endif
                            </td>

                            <th style="text-align: center;">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                    data-target="#exampleModal{{ $item->id }}">
                                    កែប្រែ
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">លិខិតចេញ​-ចូលយឺត</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="/attendances/{{ $item->id }}" method="POST">
                                                <div class="modal-body">
                                                    @csrf
                                                    <input type="hidden" name="_method" value="PATCH">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="mb-3">
                                                                <label for="exampleInputEmail1"
                                                                    class="form-label">ម៉ោងចូល</label>
                                                                <input type="time" class="form-control" min="06:00:00"
                                                                    max="12:00:00"​ value="{{ $item->checkIn }}"
                                                                    name="checkIn" step="1" id="exampleInputEmail1"
                                                                    aria-describedby="emailHelp">
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="mb-3">
                                                                <label for="exampleInputPassword1"
                                                                    class="form-label">ម៉ោងចេញ</label>
                                                                <input type="time" class="form-control" min="13:00:00"
                                                                    value="{{ $item->checkOut }}" name="checkOut"
                                                                    step="1" id="exampleInputPassword1">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="mb-3">
                                                                <label for="exampleInputEmail1"
                                                                    class="form-label">លិខិតចូលយឺត</label>
                                                                <input type="time" class="form-control" name="lateIn"
                                                                    step="1" min="06:00:00" max="12:00:00"
                                                                    id="exampleInputEmail1" aria-describedby="emailHelp">
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="mb-3">
                                                                <label for="exampleInputPassword1"
                                                                    class="form-label">លិខិតចេញយឺត</label>
                                                                <input type="time" class="form-control" name="lateOut"
                                                                    step="1" min="16:00:00"
                                                                    id="exampleInputPassword1">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">ថយក្រោយ</button>
                                                    <button type="submit"
                                                        class="btn btn-primary">ធ្វើបច្ចុប្បន្នភាព</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        $('#success-alert, #error-alert').fadeIn('slow');

        setTimeout(function() {

            $('#success-alert, #error-alert').fadeOut('slow');

        }, 5000);

        document.addEventListener("DOMContentLoaded", function() {
            let checkboxes = document.querySelectorAll('input[type="checkbox"]');

            checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener("click", function() {
                    let isChecked = this.checked;
                    let children = this.parentElement.querySelectorAll(
                        'input[type="checkbox"]'
                    );
                    children.forEach(function(child) {
                        child.checked = isChecked;
                    });
                });
            });
        });
    </script>

@endsection
