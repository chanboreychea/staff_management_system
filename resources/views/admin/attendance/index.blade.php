@extends('template.master')



@section('content')
    <div class="card" style="margin-top: -30px">
        <div class="card-header card bg-primary text-white m-2 d-flex justify-content-center"
            style="height: 50px;font-size: 18px">
            <div class="row">
                <div class="col">វត្តមានលម្អិតមន្ត្រី</div>
            </div>
        </div>
        <div class="card-body">

            <h5 class="card-title">
                <form action="/attendances">
                    <div class="row">

                        {{-- user --}}
                        <div class="col">
                            <div class="btn-group" style="width: 100%">
                                <button type="button" class="btn btn-secondary">មន្ត្រី</button>
                                <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu">
                                    @foreach ($departments as $department)
                                        <li class="dropdown-item">
                                            <input type="checkbox" name="departmentId[]" class="departmentId"
                                                value="{{ $department->id }}">
                                            {{ $department->departmentNameKh }}
                                            <ul>
                                                @foreach ($users as $user)
                                                    @if ($department->id == $user->departmentId)
                                                        <li class="dropdown-item">
                                                            <input type="checkbox" class="uid" name="uid[]"
                                                                value="{{ $user->id }}" id="">
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
                        {{-- search --}}
                        <div class="col">

                            <input type="text" name="search" class="form-control" placeholder="អត្តលេខ"
                                aria-label="Username" aria-describedby="basic-addon1">
                        </div>

                        {{-- from date --}}
                        <div class="col">
                            <div class="input-group mb-3">

                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">From</span>
                                </div>
                                <input type="date" name="fromDate" class="form-control" placeholder=""
                                    aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        {{-- to date --}}
                        <div class="col">
                            <div class="input-group mb-3">

                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">To</span>
                                </div>
                                <input type="date" name="toDate" class="form-control" placeholder=""
                                    aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <div class="col">
                            <input class="btn btn-success" type="submit" value="Save">
                        </div>
                    </div>

                </form>
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
                        <th scope="col">ពិនិត្យ</th>
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
            $('input[name="departmentId[]"]').bind('click', function() {
                $('input[type=checkbox]', $(this).parent('li')).attr('checked', ($(this).is(':checked')));
            });
        });
    </script>
@endsection
