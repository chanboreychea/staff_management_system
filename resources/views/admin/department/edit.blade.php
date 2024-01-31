@extends('template.master')
@section('title', 'Role')
@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="m-0"><a class="btn btn-dark btn-sm" href="/departments">ថយក្រោយ</a></h5>
        </div>
        <div class="card-body">
            <form action="/departments/{{ $department->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">នាយកដ្ឋាន</label>
                            <input type="text" value="{{ $department->departmentNameKh }}" name="departmentNameKh"
                                class="form-control" id="exampleFormControlInput1" placeholder="ឈ្មោះនាយកដ្ឋាន">
                            @error('departmentNameKh')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1">ស្ថានភាព</label>
                        <div class="dropdown show">
                            <select id="active" class="form-control" name="active">
                                @if ($department->active == 1)
                                    <option value="1" selected>សកម្ម</option>
                                    <option value="2">អសកម្ម</option>
                                    <option value="3">ព្យួរ</option>
                                @elseif ($department->active == 2)
                                    <option value="1">សកម្ម</option>
                                    <option value="2" selected>អសកម្ម</option>
                                    <option value="3">ព្យួរ</option>
                                @else
                                    <option value="1">សកម្ម</option>
                                    <option value="2">អសកម្ម</option>
                                    <option value="3" selected>ព្យួរ</option>
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">មតិ</label>
                    <textarea placeholder="ពិព័ណ៌នា" name="description" class="form-control" id="exampleFormControlTextarea1"
                        rows="3">{{ $department->description }}</textarea>
                    @error('description')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <input type="submit" class="btn btn-primary btn-sm" value="ធ្វើបច្ចុប្បន្នភាព">
            </form>
        </div>
    </div>
@endsection
