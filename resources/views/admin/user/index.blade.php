@extends('template.master')
@section('title', 'User')
@section('content')

    <div class="card">
        <div class="card-header">
            <h5 class="m-0"><a href="/users/create" class="btn btn-success btn-sm">បន្ថែមមន្ត្រី</a></h5>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-sm table-bordered">
                <thead class="thead-dark ">
                    <tr>
                        <th>ល.រ</th>
                        <th>ឈ្មោះ</th>
                        <th>តួនាទី</th>
                        <th>ភេទ</th>
                        <th>លេខទូរស័ព្ទ</th>
                        <th>អ៊ីម៉ែល</th>
                        <th>រូបភាព</th>
                        <th>សកម្មភាព</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @foreach ($users as $key => $user)
                        <tr>
                            <td scope="row">{{ $key + 1 }}</td>
                            <td>{{ $user->lastNameKh }} {{ $user->firstNameKh }}</td>
                            <td>{{ $user->role->roleNameKh }}</td>
                            <td>
                                @if ($user->gender == 'f')
                                    ស្រី
                                @elseif ($user->gender == 'm')
                                    ប្រុស
                                @else
                                    ផ្សេងៗ
                                @endif
                            </td>
                            <td>{{ $user->phoneNumber }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <div class="box-img">
                                    <img class="img-responsive" src="{{ asset('images/' . $user->image) }}" alt="">
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center align-items-center">
                                    <form class="me-2" action="/users/{{ $user->id }}/edit" class=""
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input class="btn btn-dark btn-sm" type="submit" value="Edit">
                                    </form>
                                    <form action="/users/{{ $user->id }}">
                                        @csrf
                                        <input class="btn btn-primary btn-sm" type="submit" value="Show">
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
