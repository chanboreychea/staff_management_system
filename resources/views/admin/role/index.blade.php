@extends('template.master')
@section('title', 'Role')
@section('content')

    <div class="card">
        <div class="card-header">
            <h5 class="m-0"><a href="/roles/create" class="btn btn-success btn-sm">បន្ថែមតួនាទី</a></h5>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-sm table-bordered">
                <thead class="thead-dark ">
                    <tr>
                        <th>លរ</th>
                        <th>តួនាទី</th>
                        <th>មតិ</th>
                        <th>ស្ថានភាព</th>
                        <th>សកម្មភាព</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @foreach ($roles as $key => $role)
                        <tr>
                            <td scope="row">{{ $key + 1 }}</td>
                            <td>{{ $role->roleNameKh }}</td>
                            <td>{{ $role->description }}</td>
                            @if ($role->active == 1)
                                <td style="color: green">សកម្ម</td>
                            @elseif ($role->active == 2)
                                <td style="color: red">អសកម្ម</td>
                            @else
                                <td style="color: blue">ព្យួរ</td>
                            @endif
                            <td>
                                <div class="d-flex justify-content-center align-items-center">
                                    <form class="me-2" action="/roles/{{ $role->id }}/edit" class=""
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input class="btn btn-dark btn-sm" type="submit" value="Edit">
                                    </form>
                                    <form action="/roles/{{ $role->id }}">
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
