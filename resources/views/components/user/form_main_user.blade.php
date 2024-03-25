<div class="card-body">
    <form action="/users/{{ $user->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_method" value="PATCH">
        {{-- img --}}
        <div class="row">
            <div class="col"></div>
            <div class="col d-flex flex-column justify-content-center align-items-center">
                <label for="image" id="im">
                    <input type="file" class="file-upload" name="img" id="image" style="display: none" />
                    <div class="circle">
                        @if ($user->image)
                            <img class="profile-pic" src="{{ asset('images/' . $user->image) }}" alt=""
                                width="100%">
                        @endif
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
           
            {{-- <div class="col-lg-3 col-md-6 col-sm-12 pb-2">
                <label for="roleId">តួនាទី</label>
                <div class="dropdown show">
                    <select id="active" class="form-control role" name="roleId">
                        <option value="{{ $user->roleId }}">{{ $user->role->roleNameKh }}</option>
                        @foreach ($roles as $key => $role)
                            <option value="{{ $role->id }}">{{ $role->roleNameKh }}</option>
                        @endforeach
                    </select>
                </div>
            </div> --}}
            <div id="roleW" class="col-lg-6 col-md-6 col-sm-12 pb-2">
                <label for="exampleFormControlInput1">សូមជ្រើសរើស</label>
                <div class="dropdown show" id="exampleFormControlInput1">
                    <select onchange="getValue()" id="role_action" class="form-control role" name="role_action">
                       
                        <option value="0"  {{ 0 == $user->roleAction ? 'selected':'' }}>មន្រ្តីមុខងារសារធារណៈ</option>
                        <option value="1"  {{ 1 == $user->roleAction ? 'selected' : '' }}>មន្រ្តីលក្ខន្តិកៈ</option>
                        
                    </select>
                    {{-- @error('role_action')
                        <div class="error-message">{{ $message }}</div>
                    @enderror --}}
                </div>
            </div>
            <input type="hidden" id="hidden_dev_state" name="hiddenDevState" value="{{ old('hiddenDevState', 'hidden') }}">
            {{-- <div id="departmentW" class="col-lg-3 col-md-6 col-sm-12 pb-2">
                <label for="department">នាយកដ្ឋាន</label>
                <div class="dropdown show" id="department">
                    <select id="department" class="form-control" name="departmentId">
                        @if ($user->departmentId)
                            <option value="{{ $user->departmentId }}">{{ $user->department->departmentNameKh }}
                            </option>
                        @endif
                        @foreach ($departments as $key => $department)
                            <option value="{{ $department->id }}">{{ $department->departmentNameKh }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div> --}}


            {{-- <div class="col-lg-3 col-md-6 col-sm-12 pb-2">
                <label for="officeId">ការិយាល័យ</label>
                <div class="dropdown show">
                    <select id="office" class="form-control" name="officeId">
                        @if ($user->officeId)
                            <option value="{{ $user->officeId }}">{{ $user->office->officeNameKh }}</option>
                        @endif
                        @foreach ($offices as $office)
                            <option value="{{ $office->id }}">{{ $office->officeNameKh }}</option>
                        @endforeach
                    </select>
                </div>
            </div> --}}
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="form-group">
                    <label for="idCard">អត្តលេខស្កេន</label>
                    <input type="text" name="idCard" value="{{ $user->idCard }}" class="form-control" id="idCard"
                        placeholder="អត្តលេខ">
                    @error('idCard')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>

        </div>
        <div class="form-row">

            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="firstNameKh">នាមខ្លួន</label>
                    <input type="text" name="firstNameKh" value="{{ $user->firstNameKh }}" class="form-control"
                        id="firstNameKh" placeholder="នាមខ្លួន">
                    @error('firstNameKh')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="lastNameKh">គោត្តនាម</label>
                    <input type="text" name="lastNameKh" value="{{ $user->lastNameKh }}" class="form-control"
                        id="lastNameKh" placeholder="នាមជីតា">
                    @error('lastNameKh')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-lg-3 col-sm-12">
                <div class="form-group">
                    <label for="exampleFormControlInput1">ជាអក្សរឡាតាំង</label>
                    <input type="text" name="engName" value="{{ $user->engName }}" class="form-control"
                       placeholder="ជាអក្សរឡាតាំង">
                   
                </div>
            </div>
            <div class="col-lg-3 col-sm-12">
                <div class="form-group">
                    <label for="email">អ៊ីម៉ែល</label>
                    <input type="email" name="email" value="{{ $user->email }}" class="form-control"
                        id="email" placeholder="អ៊ីម៉ែល">
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="form-row">

            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="gender">ភេទ</label>
                    <select name="gender" class="form-control" id="gender" value="{{ old('gender') }}">
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
                    <label for="phoneNumber">លេខទូរស័ព្ទ</label>
                    <input type="text" name="phoneNumber" value="{{ $user->phoneNumber }}" class="form-control"
                        id="phoneNumber" placeholder="លេខទូរស័ព្ទ">
                    @error('phoneNumber')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-lg-4 col-sm-12">
                <div class="form-group">
                    <label for="password">លេខកូដ</label>
                    <input type="password" name="password" value="{{ $user->password }}" class="form-control"
                        id="password" placeholder="លេខកូដ">
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="dateOfBirth">ថ្ងៃ-ខែ-ឆ្នាំ កំណើត</label>
                    <input type="date" name="dateOfBirth" value="{{ $user->dateOfBirth }}" class="form-control"
                        min="{{ now()->subYears(100)->format('Y-m-d') }}" max="{{ date('Y-m-d') }}"
                        id="dateOfBirth" placeholder="ថ្ងៃខែឆ្នាំកំណើត">
                    @error('dateOfBirth')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="nationality">សញ្ជាត្តិ</label>
                    <input type="text" name="nationality" value="{{ $user->nationality }}" class="form-control"
                        id="nationality" placeholder="សញ្ជាត្តិ">
                    @error('nationality')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-lg-4 col-sm-12 mb-2">
                <label for="status">ទំនាក់ទំនង</label>
                <div class="dropdown show">
                    <select id="active" class="form-control" name="status">
                        @if ($user->status == 1)
                            <option value="1" selected>នៅលីវ</option>
                            <option value="2">ភ្ជាប់ពាក្យ</option>
                            <option value="3">រៀបការ</option>
                        @elseif ($user->status == 2)
                            <option value="1">នៅលីវ</option>
                            <option value="2" selected>ភ្ជាប់ពាក្យ</option>
                            <option value="3">រៀបការ</option>
                        @else
                            <option value="1">នៅលីវ</option>
                            <option value="2">ភ្ជាប់ពាក្យ</option>
                            <option value="3" selected>រៀបការ</option>
                        @endif
                    </select>
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="pobAddress">ទីកន្លែងកំណើត</label>
                    <input type="text" name="pobAddress" value="{{ $user->pobAddress }}" class="form-control"
                        id="pobAddress" placeholder="ទីកន្លែងកំណើត">
                    @error('pobAddress')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="currentAddress">ទីកន្លែងបច្ចុប្បន្ន</label>
                    <input type="text" name="currentAddress" value="{{ $user->currentAddress }}"
                        class="form-control" id="currentAddress" placeholder="ទីកន្លែងបច្ចុប្បន្ន">
                    @error('currentAddress')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>

        </div>
        <div class="form-row" id="hidden_dev">
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="form-group" id="hideValue" >
                    <label for="exampleFormControlInput1">អត្តលេខមន្រី្តរាជការ</label>
                    <input type="text" name="civilServantId" value="{{$user->civilServantId}}" class="form-control"
                       placeholder="អត្តលេខមន្រី្តរាជការ">
                   
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="form-group" id="hideValue" >
                    <label for="currentAddress">លេខប័ណ្ណសម្គាល់មន្រ្តីសហវ</label>
                    <input type="text" name="referent" value="{{ $user->referent}}"
                        class="form-control" id="referent" placeholder="លេខប័ណ្ណសម្គាល់មន្រ្តីសហវ">
                   
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="form-group" id="hideValue" >
                    <label for="currentAddress">លេខកូដក្នុងអង្គភាព</label>
                    <input type="text" name="codeEconomy" value="{{$user->codeEconomy}}"
                        class="form-control" id="codeEconomy" placeholder="លេខកូដក្នុងអង្គភាព">
                   
                </div>
            </div>
           
        </div>
        {{-- <div class="form-row">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="currentAddress">លេខប័ណ្ណសម្គាល់មន្រ្តីសហវ</label>
                    <input type="text" name="referent" value="{{$user->referent}}"
                        class="form-control" id="referent" placeholder="លេខប័ណ្ណសម្គាល់មន្រ្តីសហវ">
                   
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="currentAddress">លេខកូដក្នុងអង្គភាព</label>
                    <input type="text" name="codeEconomy" value="{{ $user->codeEconomy }}"
                        class="form-control" id="codeEconomy" placeholder="លេខកូដក្នុងអង្គភាព">
                   
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="currentAddress">អត្តសញ្ញាណប័ណ្ណ</label>
                    <input type="text" name="identifyCard" value="{{ $user->identifyCard }}"
                        class="form-control" id="identifyCard" placeholder="អត្តសញ្ញាណប័ណ្ណ">
                   
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="currentAddress">ការបរិច្ឆេទផុតកំណត់</label>
                    <input type="date" name="exprireDateIdenCard" value="{{ $user->exprireDateIdenCard }}"
                        class="form-control" id="exprireDateIdenCard" placeholder="ការបរិច្ឆេទផុតកំណត់">
                 
                </div>
            </div>
        </div> --}}
        <div class="form-row">
              
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="currentAddress">អត្តសញ្ញាណប័ណ្ណ</label>
                    <input type="text" name="identifyCard" value="{{ $user->identifyCard}}"
                        class="form-control" id="identifyCard" placeholder="អត្តសញ្ញាណប័ណ្ណ">
                  
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="currentAddress">ការបរិច្ឆេទផុតកំណត់</label>
                    <input type="date" name="exprireDateIdenCard" value="{{ $user->exprireDateIdenCard }}"
                        class="form-control" id="exprireDateIdenCard" placeholder="ការបរិច្ឆេទផុតកំណត់">
                    
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="currentAddress">លិខិតឆ្លងដែន</label>
                    <input type="text" name="passport" value="{{ $user->passport }}"
                        class="form-control" id="passport" placeholder="លិខិតឆ្លងដែន">
                   
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="currentAddress">ការបរិច្ឆេទផុតកំណត់</label>
                    <input type="date" name="exprirePassport" value="{{ $user->exprirePassport }}"
                        class="form-control" id="exprirePassport" placeholder="ការបរិច្ឆេទផុតកំណត់">
                   
                </div>
            </div>
        </div>
       
        <br>
        <div class=" d-flex justify-between align-items-center">
            <input type="submit" class="btn btn-primary btn-sm" value="ធ្វើបច្ចុប្បន្នភាព">
            <div class="card-header">
                <h5 class="m-0"><a class="btn btn-dark btn-sm" href="/users">ថយក្រោយ</a></h5>
            </div>
        </div>

    </form>
</div>
