@extends('template.master')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

@section('content')
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

            <h5 class="card-title" style="width:100%">
                <form action="/attendances" action="get">
                    @csrf
                    <div class="row">
                        {{-- user --}}
                        <div class="col-lg-1">
                            <div class="btn-group" style="width: 100%">
                                <button type="button" class="btn btn-secondary">មន្ត្រី</button>
                                <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu">
                                    @foreach ($departments as $department)
                                        <li class="dropdown-item">
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
                            </div>
                        </div>
                        {{-- from date --}}
                        <div class="col-lg-3">
                            <div class="input-group mb-3">

                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">From</span>
                                </div>
                                <input type="date" name="fromDate" min="{{ now()->subMonths(3)->format('Y-m-d') }}"
                                    max="{{ now()->format('Y-m-d') }}" class="form-control" placeholder=""
                                    aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        {{-- to date --}}
                        <div class="col-lg-3">
                            <div class="input-group mb-3">

                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">To</span>
                                </div>
                                <input type="date" name="toDate" max="{{ now()->format('Y-m-d') }}" class="form-control"
                                    placeholder="" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="row">
                                <div class="col"><input class="btn btn-success" type="submit" value="Filter"></div>
                                <div class="col"><a href="attendaces/export/excel" class="btn btn-danger">Export</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <!-- Button trigger modal -->
                            <div class="col d-flex justify-content-end align-items-center">
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#exampleModal">
                                    ទាញយកវត្តមាន
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </h5>
        </div>
        <!-- Modal -->
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
                    <form action="/getAtt" method="">
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

                            <input type="submit" type="button" class="btn btn-secondary" name="testConnection"
                                value="Test Connection">
                            {{-- data-dismiss="modal" use to hide module form --}}
                            <input type="submit" class="btn btn-primary" name="getAtt" value="ទាញយកវត្តមាន">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        </h5>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ល.រ</th>
                    <th scope="col">ឈ្មោះមន្ត្រី</th>
                    <th scope="col">អត្តលេខ</th>
                    <th scope="col">កាលបរិច្ឆេទ</th>
                    <th scope="col">ម៉ោងចូល</th>
                    <th scope="col">ម៉ោងចេញ</th>
                    <th scope="col">សរុប</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($attendances as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            {{ $item->lastNameKh }} {{ $item->firstNameKh }}
                        </td>
                        <td>{{ $item->userId }}</td>
                        <td>{{ $item->date }}</td>
                        @php
                            $late = '(យឺតយ៉ាវ)';
                        @endphp
                        <td>
                            @if ($item->checkIn)
                                @if ($item->checkIn > '09:00:00')
                                    {{ $item->checkIn }}​ {{ $late }}
                                @else
                                    {{ $item->checkIn }}
                                @endif
                            @else
                                --:--:--
                            @endif
                        </td>
                        <td>
                            @if ($item->checkOut)
                                @if ($item->checkOut < '04:00:00' && $item->checkOut > '17:30:00')
                                    {{ $item->checkOut }}​ {{ $late }}
                                @else
                                    {{ $item->checkOut }}
                                @endif
                            @else
                                --:--:--
                            @endif
                        </td>
                        <td>
                            @if ($item->total)
                                {{ $item->total }}
                            @else
                                --:--:--
                            @endif
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

    </div>
    </div>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $('.departmentId').bind('click', function() {
                $('input[type=checkbox]', $(this).parent('li')).attr('checked', $(this).is(':checked'));

            });

        });
    </script>
@endsection
