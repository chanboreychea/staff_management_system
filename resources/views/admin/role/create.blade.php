@extends('template.master')
@section('title', 'Role')
@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="m-0"><a class="btn btn-dark btn-sm" href="/roles">ថយក្រោយ</a></h5>
        </div>
        <div class="card-body">
            <form action="/roles" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- <input type="hidden" name="active" value="1"> --}}
                <div class="form-row">

                    <div class="col-lg-12 col-sm-12">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">តួនាទី</label>
                            <input type="text" name="roleNameKh" class="form-control" id="exampleFormControlInput1"
                                placeholder="ឈ្មោះតួនាទី">
                            @error('roleNameKh')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">មតិ</label>
                    <textarea placeholder="ពិព័ណ៌នា" name="description" class="form-control" id="exampleFormControlTextarea1"
                        rows="3"></textarea>
                    @error('description')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <input type="submit" class="btn btn-primary btn-sm" value="រក្សាទុក">
            </form>
        </div>
    </div>
@endsection
