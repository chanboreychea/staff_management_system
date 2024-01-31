@extends('template.master')
@section('title', 'Office')
@section('content')

    <div class="card">
        <div class="card-header">
            <h5 class="m-0"><a href="/offices/create" class="btn btn-success btn-sm">បន្ថែមការិយាល័យ</a></h5>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-sm table-bordered">
                <thead class="thead-dark ">
                    <tr>
                        <th>លរ</th>
                        <th>ការិយាល័យ</th>
                        <th>នាយកដ្ឋាន</th>
                        <th>មតិ</th>
                        <th>សកម្ម</th>
                        <th>សកម្មភាព</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @foreach ($offices as $key => $item)
                        <tr>
                            <td scope="row">{{ $key + 1 }}</td>
                            <td>{{ $item->officeNameKh }}</td>
                            <td>{{ $item->department->departmentNameKh }}</td>
                            <td>{{ $item->description }}</td>

                            @if ($item->active == 1)
                                <td style="color: green">សកម្ម</td>
                            @elseif ($item->active == 2)
                                <td style="color: red">អសកម្ម</td>
                            @else
                                <td style="color: blue">ព្យួរ</td>
                            @endif
                            <td>
                                <div class="d-flex justify-content-center align-items-center">
                                    <form class="me-2" action="/offices/{{ $item->id }}/edit" class=""
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input class="btn btn-dark btn-sm" type="submit" value="Edit">
                                    </form>
                                    <form action="/offices/{{ $item->id }}">
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
