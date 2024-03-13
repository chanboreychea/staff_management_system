@extends('frontend.layouts.master')

@section('contents')
    <section class="section-box mt-75">
        <div class="breacrumb-cover">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <h2 class="mb-20">Dashboard</h2>
                        <ul class="breadcrumbs">
                            <li><a class="home-icon" href="{{ url('/homepage') }}">Home</a></li>
                            <li>Dashboard</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-box mt-120">
        <div class="container">
            <div class="row">

                @include('frontend.company-dashboard.sidebar')

                <div class="col-lg-9 col-md-8 col-sm-12 col-12 mb-50">
                    <div class="content-single">
                        <h3 class="mt-0 mb-0 color-brand-1">Dashboard</h3>
                        <div class="dashboard_overview">
                            {{-- <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <div class="dash_overview_item bg-info-subtle">
                                        <h2><span>Pending Jobs</span></h2>
                                        <span class="icon"><i class="fas fa-briefcase"></i></span>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="dash_overview_item bg-danger-subtle">
                                        <h2><span>Total Jobs</span></h2>
                                        <span class="icon"><i class="fas fa-briefcase"></i></span>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="dash_overview_item bg-warning-subtle">
                                        <h2> <span>Total Orders</span></h2>
                                        <span class="icon"><i class="fas fa-cart-plus"></i></span>
                                    </div>
                                </div>
                            </div> --}}
                       
                            <br>
                            <div class="card">
                                <div class="card-body">
                                    <table class="table">

                                        <tbody>
                                          <tr>
                                            <th scope="row">1</th>
                                            <td><b>Current Package</b></td>
                                            <td> Package</td>
                                          </tr>
                                          <tr>
                                            <th scope="row">2</th>
                                            <td>Job Post Available</td>
                                            <td></td>
                                          </tr>
                                          <tr>
                                            <th scope="row">3</th>
                                            <td>Featured Post Available</td>
                                            <td></td>
                                          </tr>
                                          <tr>
                                            <th scope="row">4</th>
                                            <td>Highlight Post Available</td>
                                            <td></td>
                                          </tr>
                                        </tbody>
                                      </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="mt-120"></div>
@endsection
