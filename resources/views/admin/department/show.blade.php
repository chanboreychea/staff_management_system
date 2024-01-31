@extends('template.master')
@section('title', 'Department')
@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="m-0"><a class="btn btn-dark btn-sm" href="/departments">ថយក្រោយ</a></h5>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>លរ</th>
                        <th>នាយកដ្ឋាន</th>
                        <th>មតិ</th>
                        <th>ស្ថានភាព</th>
                        <th>សកម្មភាព</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scope="row">{{ $department->id }}</td>
                        <td>{{ $department->departmentNameKh }}</td>
                        <td>{{ $department->description }}</td>

                        @if ($department->active == 1)
                            <td style="color: green">សកម្ម</td>
                        @elseif ($department->active == 2)
                            <td style="color: red">អសកម្ម</td>
                        @else
                            <td style="color: blue">ព្យួរ</td>
                        @endif
                        <td>
                            <form action="/departments/{{ $department->id }}" method="POST">
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
