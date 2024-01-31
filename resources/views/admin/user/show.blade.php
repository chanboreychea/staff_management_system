@extends('template.master')
@section('title', 'User')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h5 class="m-0"><a class="btn btn-dark btn-sm" href="/users">ថយក្រោយ</a></h5>

                </div>
                <div class="col d-flex justify-content-end">
                    <h5 class="m-0 mr-2"><a class="btn btn-success btn-sm" href="/attendances/{{ $user->id }}">វត្តមាន</a>
                    </h5>
                    <button onclick="window.print()" class="btn btn-primary btn-sm">Print</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="/users/{{ $user->id }}" method="POST" enctype="multipart/form-data" disabled>
                @csrf
                {{-- img --}}
                <input type="hidden" name="_method" value="DELETE">
                <div class="row">
                    <div class="col"></div>
                    <div class="col d-flex justify-content-center">
                        <label for="image">
                            {{-- <input type="file" class="file-upload" name="img" id="image" style="display: none" /> --}}
                            <div class="circle">
                                <img class="profile-pic" src="{{ asset('images/' . $user->image) }}" width="100%" />
                            </div>
                        </label><br />
                    </div>
                    <div class="col"></div>
                </div>
                <br>
                <div class="form-row">
                    <div id="idCardWw" class="col-lg-3 col-sm-12">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">អត្តលេខ</label>
                            <input type="text" name="idCard" value="{{ $user->idCard }}" class="form-control"
                                id="exampleFormControlInput1" placeholder="អត្តលេខ" disabled>
                            @error('idCard')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div id="roleWw" class="col-lg-3 col-sm-12 pb-2">
                        <label for="exampleFormControlInput1">តួនាទី</label>
                        <div class="dropdown show">
                            <select id="active" class="form-control" name="roleId" disabled>
                                <option value="{{ $user->roleId }}">{{ $user->role->roleNameKh }}</option>
                            </select>
                        </div>
                    </div>

                    @if ($user->departmentId)
                        <div id="departmentWw" class="col-lg-3 col-md-6 col-sm-12 pb-2">
                            <label for="exampleFormControlInput1">នាយកដ្ឋាន</label>
                            <div class="dropdown show" id="exampleFormControlInput1">
                                <select id="department" class="form-control" name="departmentId" disabled>
                                    <option value="{{ $user->departmentId }}">{{ $user->department->departmentNameKh }}
                                    </option>
                                </select>
                            </div>
                        </div>
                    @endif

                    @if ($user->officeId)
                        <div class="col-lg-3 col-sm-12 pb-2">
                            <label for="exampleFormControlInput1">ការិយាល័យ</label>
                            <div class="dropdown show">
                                <select id="office" class="form-control" name="officeId" disabled>
                                    <option value="{{ $user->officeId }}">{{ $user->office->officeNameKh }}</option>
                                </select>
                            </div>
                        </div>
                    @endif

                    @if ($user->role->roleNameKh == 'ប្រធានអង្គភាព' || $user->role->roleNameKh == 'អនុប្រធានអង្គភាព')
                        <script>
                            var roleWw = document.getElementById("roleWw");
                            var idCardWw = document.getElementById("idCardWw");

                            roleWw.className = "col-lg-6 col-md-6 col-sm-12 pb-2";
                            idCardWw.className = "col-lg-6 col-md-6 col-sm-12 pb-2";
                        </script>
                    @elseif ($user->role->roleNameKh == 'ប្រធាននាយកដ្ឋាន' || $user->role->roleNameKh == 'អនុប្រធាននាយកដ្ឋាន')
                        <script>
                            var roleWw = document.getElementById("roleWw");
                            var idCardWw = document.getElementById("idCardWw");
                            var departmentWw = document.getElementById("departmentWw");

                            roleWw.className = "col-lg-4 col-md-6 col-sm-12 pb-2";
                            idCardWw.className = "col-lg-4 col-md-6 col-sm-12 pb-2";
                            departmentWw.className = "col-lg-4 col-md-6 col-sm-12 pb-2";
                        </script>
                    @endif

                </div>
                <div class="form-row">
                    <div class="col-lg-3 col-sm-12">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">នាមខ្លួន</label>
                            <input type="text" name="firstNameKh" value="{{ $user->firstNameKh }}" class="form-control"
                                id="exampleFormControlInput1" placeholder="នាមខ្លួន" disabled>
                            @error('firstNameKh')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-12">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">គោត្តនាម</label>
                            <input type="text" name="lastNameKh" value="{{ $user->lastNameKh }}" class="form-control"
                                id="exampleFormControlInput1" placeholder="នាមជីតា" disabled>
                            @error('lastNameKh')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">អ៊ីម៉ែល</label>
                            <input type="email" name="email" value="{{ $user->email }}" class="form-control"
                                id="exampleFormControlInput1" placeholder="អ៊ីម៉ែល" disabled>
                            @error('email')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-row">

                    <div class="col-lg-4 col-sm-12">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">ភេទ</label>
                            <select name="gender" class="form-control" id="exampleFormControlInput1"
                                value="{{ old('gender') }}" disabled>
                                @if ($user->gender == 'f')
                                    <option value="f" selected>ស្រី</option>
                                @elseif ($user->gender == 'm')
                                    <option value="m" selected>ប្រុស</option>
                                @else
                                    <option value="o" selected>ផ្សេងៗ</option>
                                @endif
                            </select>
                            @error('gender')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">លេខទូរស័ព្ទ</label>
                            <input type="text" name="phoneNumber" value="{{ $user->phoneNumber }}"
                                class="form-control" id="exampleFormControlInput1" placeholder="លេខទូរស័ព្ទ" disabled>
                            @error('phoneNumber')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">លេខកូដ</label>
                            <input type="password" name="password" value="{{ $user->password }}" class="form-control"
                                id="exampleFormControlInput1" placeholder="លេខកូដ" disabled>
                            @error('password')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">ថ្ងៃ-ខែ-ឆ្នាំ កំណើត</label>
                            <input type="date" name="dob" value="{{ $user->dateOfBirth }}" class="form-control"
                                id="exampleFormControlInput1" placeholder="ថ្ងៃខែឆ្នាំកំណើត" disabled>
                            @error('dob')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">សញ្ជាត្តិ</label>
                            <input type="text" name="national" value="{{ $user->nationality }}" class="form-control"
                                id="exampleFormControlInput1" placeholder="សញ្ជាត្តិ" disabled>
                            @error('nationality')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <label for="exampleFormControlInput1">ទំនាក់ទំនង</label>
                        <div class="dropdown show">
                            <select id="active" class="form-control" name="status" disabled>
                                @if ($user->status == 1)
                                    <option value="1">នៅលីវ</option>
                                @else
                                    <option value="2">រៀបការ</option>
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">ទីកន្លែងកំណើត</label>
                            <input type="text" name="pobAddress" value="{{ $user->pobAddress }}"
                                class="form-control" id="exampleFormControlInput1" placeholder="ទីកន្លែងកំណើត" disabled>
                            @error('pobAddress')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">ទីកន្លែងបច្ចុប្បន្ន</label>
                            <input type="text" name="currentAddress" value="{{ $user->pobAddress }}"
                                class="form-control" id="exampleFormControlInput1" placeholder="ទីកន្លែងបច្ចុប្បន្ន"
                                disabled>
                            @error('currentAddress')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <br>
                <input type="submit" class="btn btn-danger btn-sm" value="លុប">
            </form>
        </div>
    </div>
@endsection
