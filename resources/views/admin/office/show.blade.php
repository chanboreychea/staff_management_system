@extends('template.master')
@section('title', 'Office')
@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="m-0"><a class="btn btn-dark btn-sm" href="/offices">ថយក្រោយ</a></h5>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>លរ</th>
                        <th>ការិយាល័យ</th>
                        <th>នាយកដ្ឋាន</th>
                        <th>មតិ</th>
                        <th>ស្ថានភាព</th>
                        <th>សកម្មភាព</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scope="row">{{ $office->id }}</td>
                        <td>{{ $office->officeNameKh }}</td>
                        <td>{{ $office->department->departmentNameKh }}</td>
                        <td>{{ $office->description }}</td>

                        @if ($office->active == 1)
                            <td style="color: green">សកម្ម</td>
                        @elseif ($office->active == 2)
                            <td style="color: red">អសកម្ម</td>
                        @else
                            <td style="color: blue">ព្យួរ</td>
                        @endif
                        <td>
                            <form action="/offices/{{ $office->id }}" method="POST">
                                @csrf
                                {{ method_field('delete') }}
                                {{-- <input type="hidden" name="_method" value="DELETE"> --}}
                                <input class="btn btn-danger btn-sm" type="submit" value="Delete">
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
