@extends('template.master')
@section('title', 'User')
@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="m-0"><a class="btn btn-dark btn-sm" href="/users">ថយក្រោយ</a></h5>
        </div>
        <div class="card-body">
            <form action="/users" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- img --}}
                <div class="row">
                    <div class="col"></div>
                    <div class="col d-flex flex-column justify-content-center align-items-center">
                        <label for="image" id="im">
                            <input type="file" class="file-upload" name="img" id="image" style="display: none" />
                            <div class="circle" id="im">
                                <img class="profile-pic"
                                    src="https://t3.ftcdn.net/jpg/03/46/83/96/360_F_346839683_6nAPzbhpSkIpb8pmAwufkC7c5eD7wYws.jpg"
                                    width="100%" />
                            </div>
                        </label>
                        @error('img')
                            <div class="error-message">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col"></div>
                </div>
                <br>
                <div class="form-row">
                    <div id="cardIdW" class="col-lg-4 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">អត្តលេខ</label>
                            <input type="text" name="idCard" value="{{ old('idCard') }}" class="form-control"
                                id="exampleFormControlInput1" placeholder="អត្តលេខ">
                            @error('idCard')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div id="roleW" class="col-lg-4 col-md-6 col-sm-12 pb-2">
                        <label for="exampleFormControlInput1">តួនាទី</label>
                        <div class="dropdown show" id="exampleFormControlInput1">
                            <select onchange="getValue()" id="role" class="form-control" name="roleId">
                                @foreach ($roles as $key => $role)
                                    <option value="{{ $role->id }}">{{ $role->roleNameKh }}
                                    </option>
                                @endforeach
                            </select>
                            @error('roleId')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <script>
                        var myRole = @json($roles);

                        function getValue() {
                            var roleIdHtml = document.getElementById("role").value;
                            var roleIdheadOfUnit = 0;
                            var roleIddeputyHeadOfUnit = 0;
                            var roleIddeputyHeadOfUnit = 0;
                            var roleIddirctorOfDepartment = 0;
                            var roleIddeputyDirctorOfDepartment = 0;
                            var roleIdheadOfOffice = 0;
                            var roleIddeputyHeadOfOffice = 0;
                            var roleIdofficer = 0;

                            myRole.forEach(element => {
                                if (element.roleNameKh == "ប្រធានអង្គភាព") {
                                    roleIdheadOfUnit = element.id;
                                } else if (element.roleNameKh == "អនុប្រធានអង្គភាព") {
                                    roleIddeputyHeadOfUnit = element.id;
                                } else if (element.roleNameKh == "ប្រធាននាយកដ្ឋាន") {
                                    roleIddirctorOfDepartment = element.id;
                                } else if (element.roleNameKh == "អនុប្រធាននាយកដ្ឋាន") {
                                    roleIddeputyDirctorOfDepartment = element.id;
                                } else if (element.roleNameKh == "ប្រធានការិយាល័យ") {
                                    roleIdheadOfOffice = element.id;
                                } else if (element.roleNameKh == "អនុប្រធានការិយាល័យ") {
                                    roleIddeputyHeadOfOffice = element.id;
                                } else {
                                    roleIdofficer = element.id;
                                }
                            });

                            var cardId = document.getElementById('cardIdW');
                            var role = document.getElementById('roleW');
                            var department = document.getElementById('departmentW');
                            var office = document.getElementById('officeW');

                            if (roleIdHtml == roleIdheadOfUnit || roleIdHtml == roleIddeputyHeadOfUnit) {
                                office.style.display = "none";
                                department.style.display = "none";
                                cardId.className = "col-lg-6 col-md-6 col-sm-12 pb-2";
                                role.className = "col-lg-6 col-md-6 col-sm-12 pb-2";
                            } else if (roleIdHtml == roleIddirctorOfDepartment || roleIdHtml == roleIddeputyDirctorOfDepartment) {
                                office.style.display = "none";
                                department.style.display = "block";
                                cardId.className = "col-lg-4 col-md-6 col-sm-12 pb-2";
                                role.className = "col-lg-4 col-md-6 col-sm-12 pb-2";
                                department.className = "col-lg-4 col-md-6 col-sm-12 pb-2";
                            } else if (roleIdHtml == roleIdheadOfOffice || roleIdHtml == roleIddeputyHeadOfOffice || roleIdHtml ==
                                roleIdofficer) {
                                office.style.display = "block";
                                department.style.display = "none";
                                cardId.className = "col-lg-4 col-md-6 col-sm-12 pb-2";
                                role.className = "col-lg-4 col-md-6 col-sm-12 pb-2";
                                office.className = "col-lg-4 col-md-6 col-sm-12 pb-2";
                            } else {
                                office.style.display = "block";
                                department.style.display = "none";
                                cardId.className = "col-lg-4 col-md-6 col-sm-12 pb-2";
                                role.className = "col-lg-4 col-md-6 col-sm-12 pb-2";
                                office.className = "col-lg-4 col-md-6 col-sm-12 pb-2";
                            }
                        }
                    </script>

                    <div id="departmentW" style="display: none" class="col-lg-3 col-md-6 col-sm-12 pb-2">
                        <label for="exampleFormControlInput1">នាយកដ្ឋាន</label>
                        <div class="dropdown show" id="exampleFormControlInput1">
                            <select id="department" class="form-control" name="departmentId">
                                @foreach ($departments as $key => $department)
                                    <option value="{{ $department->id }}">{{ $department->departmentNameKh }}
                                    </option>
                                @endforeach
                            </select>
                            @error('departmentId')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div id="officeW" class="col-lg-4 col-md-6 col-sm-12 pb-2">
                        <label for="exampleFormControlInput1">ការិយាល័យ</label>
                        <div class="dropdown show">
                            <select id="office" id="office" class="form-control" name="officeId">
                                @foreach ($offices as $office)
                                    <option value="{{ $office->id }}">{{ $office->officeNameKh }}</option>
                                @endforeach
                            </select>
                            @error('officeId')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="form-row">

                    <div class="col-lg-3 col-sm-12">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">នាមខ្លួន</label>
                            <input type="text" name="firstNameKh" value="{{ old('firstNameKh') }}" class="form-control"
                                id="exampleFormControlInput1" placeholder="នាមខ្លួន">
                            @error('firstNameKh')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-12">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">គោត្តនាម</label>
                            <input type="text" name="lastNameKh" value="{{ old('lastNameKh') }}" class="form-control"
                                id="exampleFormControlInput1" placeholder="នាមជីតា">
                            @error('lastNameKh')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">អ៊ីម៉ែល</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control"
                                id="exampleFormControlInput1" placeholder="អ៊ីម៉ែល">
                            @error('email')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="form-row">

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">ភេទ</label>
                            <select name="gender" class="form-control" id="exampleFormControlInput1"
                                value="{{ old('gender') }}">
                                <option value="m">ប្រុស</option>
                                <option value="f">ស្រី</option>
                                <option value="o">ផ្សេងៗ</option>
                            </select>
                            @error('gender')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">លេខទូរស័ព្ទ</label>
                            <input type="text" name="phoneNumber" value="{{ old('phoneNumber') }}"
                                class="form-control" id="exampleFormControlInput1" placeholder="លេខទូរស័ព្ទ">
                            @error('phoneNumber')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">លេខសម្ងាត់</label>
                            <input type="password" name="password" value="{{ old('password') }}" class="form-control"
                                id="exampleFormControlInput1" placeholder="លេខសម្ងាត់">
                            @error('password')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="form-row">
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="dateOfBirth">ថ្ងៃ-ខែ-ឆ្នាំ កំណើត</label>
                            <input type="date" id="dateOfBirth" name="dateOfBirth" value="{{ old('dateOfBirth') }}"
                                class="form-control" max="{{ now()->subYears(18)->format('Y-m-d') }}"
                                {{-- max="{{ date('Y-m-d') }}" --}} placeholder="ថ្ងៃខែឆ្នាំកំណើត">
                            @error('dateOfBirth')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">សញ្ជាត្តិ</label>
                            <input type="text" name="nationality" value="{{ old('nationality') }}"
                                class="form-control" id="exampleFormControlInput1" placeholder="សញ្ជាត្តិ">
                            @error('nationality')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <label for="exampleFormControlInput1">ទំនាក់ទំនង</label>
                        <div class="dropdown show">
                            <select id="active" class="form-control" name="status">
                                <option value="1">នៅលីវ</option>
                                <option value="2">ភ្ជាប់ពាក្យ</option>
                                <option value="3">មានគ្រួសារ</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">ទីកន្លែងកំណើត</label>
                            <input type="text" name="pobAddress" value="{{ old('pobAddress') }}"
                                class="form-control" id="exampleFormControlInput1" placeholder="ទីកន្លែងកំណើត">
                            @error('pobAddress')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">ទីកន្លែងបច្ចុប្បន្ន</label>
                            <input type="text" name="currentAddress" value="{{ old('pobAddress') }}"
                                class="form-control" id="exampleFormControlInput1" placeholder="ទីកន្លែងបច្ចុប្បន្ន">
                            @error('currentAddress')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <br>
                <input type="submit" class="btn btn-primary btn-sm" value="រក្សាទុក">
            </form>
        </div>
    </div>
@endsection
