@extends('frontend.layouts.master')

@section('contents')

    <section class="section-box mt-120">
        
        <div class="container">
            
            <div class="row">

                <style>
                    .box {
                        width: 30%;
                        /* height:30%; */
                        /* background:red; */
                    }

                    .box_img_detail img {
                        width: 35%;
                        height: 35%;
                    }

                    .gallary {
                        width: 40%;
                        height: 40%;
                        /* background:blue; */

                    }

                    .gallary img {
                        width: 100%;
                        height: auto;
                        object-fit: cover;
                    }

                    .text_logo,
                    .form-top-header {
                        font-size: 1vw;
                    }

                    .text-size {
                        font-size: .9vw;
                    }

                    .borderless td,
                    .borderless th {
                        border: none;
                    }

                    .tab1 {
                        tab-size: 2;
                    }

                    .grid-row {
                        display: grid;
                        grid-template-columns: repeat(3, 1fr);
                        /* Create three equal columns */
                        gap: 20px;
                        /* Adjust the gap between cells */

                    }

                    .grid-cell {
                        padding: 5px;
                        /* Adjust the padding as needed */
                        box-sizing: border-box;
                        /* Include padding in the width calculation */
                        width: 100%;
                        /* Prevents content from overflowing */
                        text-overflow: ellipsis;
                        /* Adds an ellipsis (...) when content overflows */
                        white-space: nowrap;

                    }

                    .grid-row1 {
                        width: 100%;
                    }

                    .grid-cell1 {

                        box-sizing: border-box;

                        padding: 5px;

                        width: 100%;

                    }

                    /* Add custom CSS for responsiveness */
                    .table-wrapper {
                        overflow-x: auto;
                    }

                    .table-bordered {
                        border-collapse: collapse;
                        width: 100%;
                        max-width: 100%;
                    }

                    .table-bordered th,
                    .table-bordered td {
                        border: 1px solid #ddd;
                        padding: 8px;
                        /* white-space: nowrap; */
                        /* text-align: center; */
                    }

                    .nowrap {
                        white-space: nowrap;
                    }

                    @media screen and (max-width: 600px) {

                        /* Adjust table layout for smaller screens */
                        .table-bordered thead {
                            display: none;
                        }

                        .table-bordered,
                        .table-bordered tbody,
                        .table-bordered tr,
                        .table-bordered td {
                            display: block;
                            width: 100%;
                        }

                        .table-bordered tr {
                            margin-bottom: 15px;
                        }

                        .table-bordered td {
                            text-align: right;
                            padding-left: 50%;
                            text-align: right;
                            position: relative;
                        }

                        .table-bordered td::before {
                            content: attr(data-label);
                            position: absolute;
                            left: 0;
                            width: 50%;
                            padding-left: 15px;
                            font-weight: bold;
                        }
                    }
                </style>


                <div style="font-family: khmer mef1;color: #2F5496;">





                    @if (isset($user))
                        <!-- ​​ព័ត៍មានអំពីស្ថានភាព -->
                        <center style="font-family: khmer mef2;color: #2F5496;">ព្រះរាជាណាច្រកម្ពជា</center>

                        <center style="font-family: khmer mef2;color: #2F5496;"> ជាតិ សាសនា​ ព្រះមហាក្សត្រ<br></center>

                        <div style="display: flex;justify-content: space-between;align-items: center;">

                            <div class="box box_img_detail">

                                <center><img src="{{ asset('images/logo2.png') }}" alt=""></center>


                                <center style="font-family: khmer mef2;color: #2F5496;font-size:13px;">
                                    អាជ្ញាធរនៃសេវាហិរញ្ញវត្ថុមិនមែនធនាគា</center>
                                <center style="font-family: khmer mef2;color: #2F5496;font-size:14px;">
                                    អង្គភាពសវនកម្មផ្ទៃក្នុង</center>

                            </div>

                            <div class="box box_img_detail">

                                <center>

                                    <div class="gallary border">

                                        <img class=" border" src="{{ asset('images/' . $user->image) }}" alt="">


                                    </div>

                                </center>

                            </div>

                        </div>

                        <center style="font-family: khmer mef2;">ប្រវត្តិរូបមន្ត្រី</center>

                        <center style="font-family: khmer mef2;">
                            បម្រើការងារនៅអង្គភាពសវនកម្មផ្ទៃក្នុងនៃអាជ្ញាធរសេវាហិរញ្ញវត្ថុមិនមែនធនាគារ <br></center>

                        <!-- -------------------------------ព័ត៍មានផ្ទាល់ខ្លួន-------------------------------- -->
                        @component('components.table_detail_users.user_information2', [
                            'user' => $user,
                            'user_information' => $user_information,
                            'additionalPCJ' => $additionalPCJ,
                            'departments' => $departments,
                            'roles' => $roles,
                            'offices' => $offices,
                        ])
                            <!-- button -->
                        @endcomponent

                        <!-- -----------------------------------------ប្រវត្តិការងារ--------------------------------------------- -->

                        @component('components.table_detail_users.user_working_history2', [
                            'userWoringHistoryPublicSetor' => $userWoringHistoryPublicSetor,
                            'userWoringHistoryPrivateSetor' => $userWoringHistoryPrivateSetor,
                        ])
                            <!-- button -->
                        @endcomponent

                        <!-- -----------------------------------------គ្រឿងឥស្សរិយយស ប័ណ្ណសរសើរ ឬទណ្ណកម្មវិន័យ--------------------------------------------- -->

                        @component('components.table_detail_users.user_modal_certificate2', [
                            'userModalCertificate' => $userModalCertificate,
                        ])
                            <!-- button -->
                        @endcomponent

                        <!-- -----------------------------------------៥.កម្រិតវប្បធម៍ទូទៅ ការបណ្តុះបណ្តាលវិជ្ជាជីវៈ និងការបណ្តុះបណ្តាលបន្ត--------------------------------------------- -->

                        @component('components.table_detail_users.user_education_level2', ['userEducationLevel' => $userEducationLevel])
                            <!-- button -->
                        @endcomponent

                        <!-- -----------------------------------------៥.សមត្ថភាពភាសាបរទេស--------------------------------------------- -->
                        @component('components.table_detail_users.user_language2', ['userAbilityLanguage' => $userAbilityLanguage])
                            <!-- button -->
                        @endcomponent

                        @component('components.table_detail_users.user_families2', ['userFamily' => $userFamily])
                            <!-- button -->
                        @endcomponent
                    @endif





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
