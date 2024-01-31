@extends('template.master')

<style>
    .today {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }
</style>
@section('content')
    <div class="card">
        <div class="card-header card bg-primary text-white m-2 d-flex justify-content-center"
            style="height: 50px;font-size: 18px">
            <div class="row">
                <div class="col">វត្តមានលម្អិតមន្ត្រី</div>
                <div class="col d-flex justify-content-end">
                    <a href="/users/{{ $user->id }}" class="btn btn-dark btn-sm" style="color: white">ថយក្រោយ</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            {{-- <center>
                <h3 class="card-title​​ mb-3">វត្តមានលម្អិតមន្ត្រី</h3>
            </center> --}}
            <div class="row ">
                <div class="col-lg-12 col-sm-12">
                    <table class="table table-sm table-bordered">
                        <tbody>
                            <tr>
                                <th scope="row">អត្តលេខ</th>
                                <th>{{ $user->idCard }}</th>
                            </tr>
                            <tr>
                                <th scope="row">គោត្តនាម​ នាម</th>
                                <th>{{ $user->lastNameKh }} {{ $user->firstNameKh }}</th>
                            </tr>
                            <tr>
                                <th scope="row">មុខដំណែង</th>
                                <th>{{ $user->role->roleNameKh }}</th>
                            </tr>
                            <tr>
                                <th scope="row">ការិយាល័យ</th>
                                @if (!$user->officeId)
                                    <th>-----</th>
                                @else
                                    <th>{{ $user->office->officeNameKh }}</th>
                                @endif
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                        type="button" role="tab" aria-controls="nav-home" aria-selected="true">ថ្ងៃនេះ</button>
                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                        type="button" role="tab" aria-controls="nav-profile" aria-selected="false">សប្ដាហ៍មុន</button>
                    <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact"
                        type="button" role="tab" aria-controls="nav-contact" aria-selected="false">ខែមុន</button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="row">
                        <table class="table table-sm table-bordered">
                            <tbody>
                                <tr>
                                    <th rowspan="5" style="text-align: center;">
                                        ទិន្នន័យស្គេន
                                        <div class="today">
                                            <span>
                                                today
                                            </span>
                                            <span style="font-size: 18px">
                                                total
                                            </span>
                                        </div>
                                    </th>
                                </tr>
                                <tr>
                                    <th style="text-align: center">ការស្គេនពេលព្រឹក</th>
                                    <th style="text-align: center">ការស្គេនពេលថ្ងៃ </th>
                                </tr>
                                <tr>
                                    <th style="text-align: center">(ម៉ោងចូល)</th>
                                    <th style="text-align: center">(ម៉ោងចេញ)</th>
                                </tr>
                                <tr>
                                    <th style="text-align: center">
                                        morning
                                    </th>
                                    <th style="text-align: center">
                                        evening
                                    </th>
                                </tr>

                            </tbody>
                        </table>

                    </div>
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <div class="row">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">ល.រ</th>
                                    <th scope="col">កាលបរិច្ឆេទ</th>
                                    <th scope="col">ម៉ោងចូល</th>
                                    <th scope="col">ម៉ោងចេញ</th>
                                    <th scope="col">សរុប</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>

                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <div class="row">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">ល.រ</th>
                                    <th scope="col">កាលបរិច្ឆេទ</th>
                                    <th scope="col">ម៉ោងចូល</th>
                                    <th scope="col">ម៉ោងចេញ</th>
                                    <th scope="col">សរុប</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
