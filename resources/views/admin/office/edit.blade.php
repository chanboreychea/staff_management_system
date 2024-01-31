@extends('template.master')
@section('title', 'Office')
@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="m-0"><a class="btn btn-dark btn-sm" href="/offices">ថយក្រោយ</a></h5>
        </div>
        <div class="card-body">
            <form action="/offices/{{ $office->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="form-row">
                    <div class="col-lg-4 col-md-6 col-sm-12 pb-2">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">ការិយាល័យ</label>
                            <input type="text" value="{{ $office->officeNameKh }}" name="officeNameKh"
                                class="form-control" id="exampleFormControlInput1" placeholder="ឈ្មោះការិយាល័យ">
                            @error('officeNameKh')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 pb-2">
                        <label for="exampleFormControlInput1">នាយកដ្នាន</label>
                        <div class="dropdown show">
                            <select id="department" class="form-control" name="departmentId">
                                <option value="{{ $office->departmentId }}">{{ $office->department->departmentNameKh }}
                                </option>
                                @foreach ($departments as $key => $department)
                                    <option value="{{ $department->id }}">{{ $department->departmentNameKh }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12 pb-2">
                        <label for="exampleFormControlInput1">ស្ថានភាព</label>
                        <div class="dropdown show">
                            <select id="active" class="form-control" name="active">
                                @if ($office->active == 1)
                                    <option value="1" selected>សកម្ម</option>
                                    <option value="2">អសកម្ម</option>
                                    <option value="3">ព្យួរ</option>
                                @elseif ($office->active == 2)
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
                        rows="3">{{ $office->description }}</textarea>
                    @error('description')
                        <p style="color: red">{{ $message }}</p>
                    @enderror
                </div>
                <input type="submit" class="btn btn-primary btn-sm" value="ធ្វើបច្ចុប្បន្នភាព">
            </form>
        </div>
    </div>
@endsection
