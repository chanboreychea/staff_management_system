<p style="font-family: khmer mef2;">១.ព័ត៍មានផ្ទាល់ខ្លួន</p>
<style>


</style>
@if (isset($user))

    <div class="table-responsive" style="font-size:11px">

        <table class="table borderless">

            <thead>
                @if ($user->roleAction==1)
        
                <p></p>
        
            @else
                <tr class="grid-row">

                    <td class="grid-cell">អត្តលេខមន្ត្រីរាជការ <span style="margin-left:11px;">:</span> {{ $user->civilServantId }}</td>

                    <td class="grid-cell">លេខប័ណ្ណសម្គាល់មន្ត្រីសហវ <span>:</span>   {{ $user->referent }}</td>

                    <td class="grid-cell">លេខកូដក្នុងអង្គភាព <span>:</span>   {{ $user->codeEconomy }}</td>

                </tr>
            @endif


                <tr class="grid-row">

                    <td class="grid-cell">គោត្តនាម​ និង នាម <span
                            style="margin-left:15px;">:</span>{{ $user->lastNameKh }} {{ $user->firstNameKh }}</td>

                    <td class="grid-cell">ជាអក្សរឡាតាំង <span>:</span>   {{ $user->engName }}</td>
                    <!-- Add an empty cell to match the number of cells in the first row -->
                </tr>

                <tr class="grid-row">

                    <td class="grid-cell">ភេទ<span style="margin-left:10px;">:</span>

                        @if ($user->gender == 'm')
                            ប្រុស
                        @else
                            ស្រី
                        @endif

                    </td>

                    <td class="grid-cell"> ថ្ងៃខែឆ្នាំកំណើត <span>:</span> {{ $user->dateOfBirth }} </td>

                    <td class="grid-cell">

                        ស្ថានភាពគ្រួសារ <span>:</span>

                        @if ($user->status == 1)
                            នៅលីវ
                        @elseif ($user->status == 2)
                            ភ្ជាប់ពាក្យ
                        @else
                            រៀបការ
                        @endif

                    </td>

                </tr>

                <tr class=" grid-row1">

                    <td class="grid-cell1">ទីកន្លែងកំណើត<span style="margin-left:33px;">:</span> {{ $user->pobAddress }}
                    </td>

                </tr>

                <tr class="grid-row1" width="100%">

                    <td class="grid-cell1">អាសយដ្ខានបច្ចុប្បន្ន<span style="margin-left:14px;">:</span>
                        {{ $user->pobAddress }}</td>

                </tr>

                <tr class="grid-row1">

                    <td class="grid-cell" width="100%">អ៊ីម៉ែល<span style="margin-left:67px;">:
                        </span>{{ $user->email }}</td>

                </tr>

                <tr class="grid-row1">

                    <td class="grid-cell1">លេខទូរសព្ទ<span style="margin-left:47px;">: </span>{{ $user->phoneNumber }}
                    </td>

                </tr>

                <tr class="grid-row">

                    <td class="grid-cell">អត្តសញ្ញាណប័ណ្ណ<span style="margin-left:23px;">:</span> {{ $user->identifyCard }} </td>

                    <td class="grid-cell">កាលបរិច្ឆេទផុតកំណត់<span>:</span> {{ $user->exprireDateIdenCard }}</td>

                </tr>

                <tr class="grid-row">

                    <td class="grid-cell">លិខិតឆ្លងដែន<span style="margin-left:39PX;">:</span> {{ $user->passport }}</td>

                    <td class="grid-cell">កាលបរិច្ឆេទផុតកំណត់ <span>:</span> {{ $user->exprirePassport }}</td>

                </tr>

                <thead>

        </table>

    </div>


<!-- --------------------------------ព័ត៍មានអំពីស្ថានភាព-------------------------------------- -->

<p style="font-family: khmer mef2;">២.ព័ត៍មានអំពីស្ថានភាព</p>
@if(isset($user_information))
    <p style="font-family: khmer mef2;margin-left:15px;">ក.ចូលបម្រើការងាររដ្ឋដំបូង</p>

    <div class="table-responsive" style="font-size:12px">

        <table class="table borderless">

            <thead>

                <tr class="grid-row">

                    <td class="grid-cell1">ការបរិច្ឆេទចូលបំរើការងាររដ្ឋដំបូង<span style="margin-left:10px;">:</span>
                        {{ $user_information->date_enteing_public_service }}

                    </td>

                    @if ($user->roleAction==1)
                
                    <p></p>
            
                    @else

                    <td class="grid-cell1">ការបរិច្ឆេទតាំងស៊ប់ <span>:</span> {{ $user_information->comfirm_date }}</td>

                    @endif
                </tr>

                <tr class="grid-row1">

                    <td class="grid-cell">ក្របខណ្ឌ ឋានន្តរស័ក្ត​ និងថ្នាក់<span
                            style="margin-left:26px;">:</span> {{ $user_information->constitution }}</td>

                </tr>

                <tr class="grid-row1">

                    <td class="grid-cell">មុខតំណែង<span
                            style="margin-left:112px;">:</span>
                             @foreach ($roles as $key => $role )
                                @if( $role->id == $user_information->position_enteing_public_service)
                                {{ $role->roleNameKh }}
                                @endif
                            @endforeach
                    </td>

                </tr>

                <tr class="grid-row1">

                    <td class="grid-cell">ក្រសួង/ស្ថាប័ន<span
                            style="margin-left:97px;">:</span> {{ $user_information->ministry_enteing_public_service }}
                    </td>

                </tr>

                <tr class="grid-row1">

                    <td class="grid-cell">អង្គភាព<span
                            style="margin-left:129px;">:</span> {{ $user_information->economy_enteing_public_service }}
                    </td>

                </tr>

                <tr class="grid-row1">

                    <td class="grid-cell">នាយកដ្ឋាន<span
                            style="margin-left:112px;">:</span> 
                            
                            @foreach ($departments as $key => $department)
                            
                                @if( $department->id == $user_information->department_enteing_public_service)
                                
                                    {{ $department->departmentNameKh }}
                                @endif
                            
                            @endforeach
                    </td>

                </tr>

                <tr class="grid-row1">

                    <td class="grid-cell">ការិយាល័យ<span
                            style="margin-left:110px;">:</span> 
                            
                            @foreach ($offices as $key => $office )
                            
                                @if( $office->id == $user_information->office_enteing_public_service)
                                
                                    {{ $office->officeNameKh }}
                                @endif
                            
                            @endforeach
                    </td>

                </tr>

                <thead>

        </table>

    </div>
  
    <p style="font-family: khmer mef2;margin-left:15px;">ខ.ស្ថានភាពមុខងារបច្ចុប្បន្ន</p>

    <div class="table-responsive" style="font-size:12px">

        <table class="table borderless">

            <thead>

                <tr class="grid-row">

                    <td class="grid-cell1">ក្របខណ្ឌ​​ ឋានន្តរស័ក្ត​ និងថ្នាក់<span style="margin-left:10px;">:</span>
                        {{ $user_information->constitution_misitry_rank }}</td>

                    <td class="grid-cell1 ">កាលបរិច្ឆេទប្តូរក្រខណ្ខ ឋានន្តរស័ក្ត និងថ្នាក់ចុងក្រោយ :
                        {{ $user_information->constitution_amendment_date }}</td>

                </tr>

                <tr class="grid-row1">

                    <td class="grid-cell">កាលបរិច្ឆេទទទូលមុខតំណែងចុងក្រោយ<span> :</span>
                        {{ $user_information->effective_date_of_last_promotion }}</td>

                </tr>
                <tr class="grid-row1">

                    <td class="grid-cell">មុខតំណែង<span style="margin-left:96.5px;">:</span>
                    
                        @foreach ($roles as $key => $role )
                            @if( $role->id == $user_information->position_current_job_situation)
                            {{ $role->roleNameKh }}
                            @endif
                        @endforeach
                    </td>

                </tr>

                <tr class="grid-row1">

                    <td class="grid-cell">អង្គភាព<span style="margin-left:112px;">:</span>
                        {{ $user_information->economy_current_job_situation }}</td>

                </tr>

                <tr class="grid-row1">

                    <td class="grid-cell">នាយកដ្ឋាន<span
                            style="margin-left:97px;">:</span> 
                            
                            @foreach ($departments as $key => $department)
                            
                                @if( $department->id == $user_information->department_current_job_situation)
                                
                                    {{ $department->departmentNameKh }}
                                @endif
                            
                            @endforeach
                    </td>

                </tr>

                <tr class="grid-row1">

                    <td class="grid-cell">ការិយាល័យ<span
                            style="margin-left:93px;">:</span> 
                            
                            @foreach ($offices as $key => $office )
                            
                                @if( $office->id == $user_information->office_current_job_situation)
                                
                                    {{ $office->officeNameKh }}
                                @endif
                            
                            @endforeach
                    </td>

                </tr>

            </thead>

        </table>

    </div>

    @if ($user->roleAction==1)
        
        <p></p>

    @else
        <p style="font-family: khmer mef2;margin-left:15px;">គ.តួនាទីបន្ថែមលើមុខងារបច្ចុប្បន្ន(ឋានៈស្មើ)</p>

        <div class="table-reponsive" style="overflow-x: auto">

            <table class="table table-bordered">

                <thead>
                    <tr>
                        <td class="nowrap" style="text-align:center;font-size:12px">ល.រ</td>

                        <td class="nowrap" style="text-align:center;font-size:12px">ថ្ងៃ-ខែ​​​-ឆ្នាំ​</td>

                        <td class="nowrap" style="text-align:center;font-size:12px">ឯកសារ</td>

                        <td class="nowrap" style="text-align:center;font-size:12px">មុខតំណែង</td>

                        <td class="nowrap" style="text-align:center;font-size:12px">ឋានៈស្មើ</td>

                        <td class="nowrap" style="text-align:center;font-size:12px">អង្គភាព</td>
                    </tr>
                </thead>

                <tbody>

                    @if (isset($additionalPCJ))
                        <?php $i = 1; ?>

                        @foreach ($additionalPCJ as $row)
                            <tr>

                                <td style="font-size:12px;text-align:center;">{{ $i++ }}</td>

                                <td style="font-size:12px">
                                    <div style="width:70px;">{{ $row->date }}</div>
                                </td>

                                <td>

                                    <link rel="stylesheet"
                                        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                                    @if (!empty($row->document) && $row->document != 'default.png')
                                        <center class="p-1">
                                            <a href="{{ asset('documents/' . $row->document) }}" target="_blank">
                                                <i class="fa fa-folder" aria-hidden="true"></i>
                                            </a>
                                        </center>
                                    @else
                                        <center class="p-1">
                                            <i class="fa fa-folder" style="color:#892727;" aria-hidden="true"></i>
                                        </center>
                                    @endif
                                </td>


                                <td style="font-size:12px">
                               
                                    
                                    @foreach ($roles as $key => $role )
                                        @if( $role->id == $row->position)
                                        {{ $role->roleNameKh }}
                                        @endif
                                    @endforeach

                                </td>

                                <td style="font-size:12px">
                                {{ $row->equivalent }}
                                </td>

                                <td style="font-size:12px">
                                {{ $row->economy }}
                                </td>
                            </tr>
                        @endforeach

                    @endif

                </tbody>

            </table>

        </div>
    @endif

@endif

@endif