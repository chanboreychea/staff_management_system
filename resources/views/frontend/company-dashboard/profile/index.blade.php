@extends('frontend.layouts.master')

@section('contents')
    <section class="section-box mt-75">
        <div class="breacrumb-cover">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <h2 class="mb-20" style="font-family: khmer mef1">ប្រវត្តិរូបមន្រ្តី</h2>
                        <ul class="breadcrumbs">
                            <li><a class="home-icon" href="index.html">Home</a></li>
                            <li>Company Profile</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-box mt-120" >
        <div class="container">
            <div class="row">
                @include('frontend.company-dashboard.sidebar')
                <div class="col-lg-9 col-md-8 col-sm-12 col-12 mb-50">

                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                aria-selected="true">Company Info</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                                aria-selected="false">Founding Info</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact"
                                aria-selected="false">Account Settings</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                            aria-labelledby="pills-home-tab">
                            {{-- <form action="{{ route('company.profile.company-info') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">

                                    <div class="col-md-6">
                                        <x-image-preview :height="200" :width="200" :source="$companyInfo?->logo" />
                                        <div class="form-group">
                                            <label class="font-sm color-text-mutted mb-10">Logo *</label>
                                            <input class="form-control {{ $errors->has('logo') ? 'is-invalid' : '' }}"
                                                type="file" value="" name="logo">
                                            <x-input-error :messages="$errors->get('logo')" class="mt-2" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <x-image-preview :height="200" :width="500" :source="$companyInfo?->banner" />
                                        <div class="form-group">
                                            <label class="font-sm color-text-mutted mb-10">Banner *</label>
                                            <input class="form-control {{ $errors->has('banner') ? 'is-invalid' : '' }}"
                                                type="file" value="" name="banner">
                                            <x-input-error :messages="$errors->get('banner')" class="mt-2" />
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="font-sm color-text-mutted mb-10">Company Name *</label>
                                            <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                type="text" value="{{ $companyInfo?->name }}" name="name">
                                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="font-sm color-text-mutted mb-10">Company Bio *</label>
                                            <textarea id="editor" class="{{ $errors->has('bio') ? 'is-invalid' : '' }}" name="bio">{{ $companyInfo?->bio }}</textarea>
                                            <x-input-error :messages="$errors->get('bio')" class="mt-2" />
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="font-sm color-text-mutted mb-10">Company Vision *</label>
                                            <textarea class="{{ $errors->has('vision') ? 'is-invalid' : '' }}" name="vision">{{ $companyInfo?->vision }}</textarea>
                                            <x-input-error :messages="$errors->get('vision')" class="mt-2" />
                                        </div>
                                    </div>

                                </div>
                                <div class="box-button mt-15">
                                    <button class="btn btn-apply-big font-md font-bold">Save All Changes</button>
                                </div>
                            </form> --}}
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" >
                            <form action="/user/profile/userInfo/{{ $userInformation->id }}" method="GET"  enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group select-style">
                                            <label class="font-sm color-text-mutted mb-10"  style="font-family: khmer mef1">អត្តលេខមន្ត្រីរាជការ</label>
                                            <input type="text" name="idCard" disabled
                                                class="form-control"
                                                value="{{$userInformation->idCard}}">
                                            {{-- <x-input-error :messages="$errors->get('industry_type')" class="mt-2" /> --}}
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group select-style">
                                            <label class="font-sm color-text-mutted mb-10"  style="font-family: khmer mef1">លេខប័ណ្ណសម្គាល់មន្ត្រីសហវ</label>
                                            <input type="text" name="referent" disabled
                                                class="form-control "
                                                value="{{$userInformation->referent}}">
                                            {{-- <x-input-error :messages="$errors->get('$messages')" class="mt-2" /> --}}

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group select-style">
                                            <label class="font-sm color-text-mutted mb-10"  style="font-family: khmer mef1">លេខកូដក្នុងអង្គភាព</label>
                                            <input type="text" name="codeEconomy" disabled
                                                class="form-control "
                                                value="{{$userInformation->codeEconomy}}">
                                            {{-- <x-input-error :messages="$errors->get('$messages')" class="mt-2" /> --}}

                                        </div>
                                    </div>

                                   

                                    <div class="col-md-4">
                                        <div class="form-group select-style">
                                            <label class="font-sm color-text-mutted mb-10"  style="font-family: khmer mef1">គោត្តនាម​</label>
                                            <input type="text" name="establishment_date"
                                                class="form-control"
                                                value="{{$userInformation->firstNameKh}} ">
                                            {{-- <x-input-error :messages="$errors->get('team_size')" class="mt-2" /> --}}

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group select-style">
                                            <label class="font-sm color-text-mutted mb-10"  style="font-family: khmer mef1">គោត្តនាម​ និង នាមត្រកូល</label>
                                            <input type="text" name="establishment_date"
                                                class="form-control"
                                                value="{{$userInformation->lastNameKh}} ">
                                            {{-- <x-input-error :messages="$errors->get('team_size')" class="mt-2" /> --}}

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group select-style" >
                                            <label class="font-sm color-text-mutted mb-10"  style="font-family: khmer mef1">ជាអក្សរឡាតាំង</label>
                                            <input  type="text" name="engName"
                                                class="form-control "
                                                value="{{$userInformation->engName}}">
                                            {{-- <x-input-error :messages="$errors->get('team_size')" class="mt-2" /> --}}

                                        </div>
                                    </div>

                                  

                                  
                                </div>
                                <div class="box-button mt-15">
                                    <button type="submit" class="btn btn-apply-big font-md font-bold">Save All Changes</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                            aria-labelledby="pills-contact-tab">
                            <div class="row">

                                {{-- <form action="{{ route('company.profile.account-info') }}" method="POST">
                                    @csrf
                                    <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-sm color-text-mutted mb-10">User Name *</label>
                                            <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                value="{{ auth()->user()->name }}" name="name">
                                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-sm color-text-mutted mb-10">Email *</label>
                                            <input type="text" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                                value="{{ auth()->user()->email }}" name="email">
                                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <button class="btn btn-default btn-shadow">Save</button>
                                        </div>
                                    </div>
                                </div>
                                </form> --}}

                                <br>

{{-- 
                               <form action="{{ route("company.profile.password-update") }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-sm color-text-mutted mb-10">Password *</label>
                                            <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password">
                                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-sm color-text-mutted mb-10">Confirm Password *</label>
                                            <input type="password" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" name="password_confirmation">
                                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <button class="btn btn-default btn-shadow">Save</button>
                                        </div>
                                    </div>
                                   </div>
                               </form> --}}

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
{{-- <script>
    $(document).ready(function() {
        $('.country').on('change', function() {
            let country_id = $(this).val();
            // remove all previous cities
            $('.city').html("");

            $.ajax({
                mehtod: 'GET',
                url: '{{ route("get-states", ":id") }}'.replace(":id", country_id),
                data: {},
                success: function(response) {
                    let html = '';

                    $.each(response, function(index, value) {
                        html += `<option value="${value.id}" >${value.name}</option>`
                    });

                    $('.state').html(html);
                },
                error: function(xhr, status, error) {}
            })
        })

        // get cities
        $('.state').on('change', function() {
            let state_id = $(this).val();

            $.ajax({
                mehtod: 'GET',
                url: '{{ route("get-cities", ":id") }}'.replace(":id", state_id),
                data: {},
                success: function(response) {
                    let html = '';

                    $.each(response, function(index, value) {
                        html += `<option value="${value.id}" >${value.name}</option>`
                    });

                    $('.city').html(html);
                },
                error: function(xhr, status, error) {}
            })
        })
    })
</script> --}}
@endpush
