<h6 class="form-top-header">១.ព័ត៍មានផ្ទាល់ខ្លួន</h6>

@if(isset($user))
            
    <div class="table-responsive">
    

        <table class="table borderless" >
    
            <thead>
            
                <tr>
                
                    <td  class="nowrap text-size">អត្តលេខមន្ត្រីរាជការ : {{$user->idCard}}</td>
                    
                    <td  class="nowrap text-size">លេខប័ណ្ណសម្គាល់មន្ត្រីសហវ : </td>
                    
                    <td  class="nowrap text-size">លេខកូដក្នុងអង្គភាព​ : គ្មាន</td>
                
                </tr>
                
                <tr>
                
                    <td  class="nowrap text-size">គោត្តនាម​ និង នាម&nbsp;&nbsp;&nbsp;&nbsp;: {{$user->firstNameKh}}{{$user->lastNameKh}}</td>
                    
                    <td  class="nowrap text-size">ជាអក្សរឡាតាំង :</td>
                    
                </tr>

                <tr>
                
                    <td  class="nowrap text-size">ភេទ​​ : 
    
                        @if ($user->gender == 'm')
    
                            ប្រុស
        
                        @else 
        
                                ស្រី
            
                        @endif
                        
                        ថ្ងៃខែឆ្នាំកំណើត :{{ $user->dateOfBirth }} </td>
                    
                    <td  class="nowrap text-size">
                        ស្ថានភាពគ្រួសារ :    
                        @if ($user->status == 1)
                            នៅលីវ
                        @elseif ($user->status == 2)
                            ភ្ជាប់ពាក្យ
                        @else
                            រៀបការ
                        @endif
                        
                    </td>
                    
                </tr>
                
                <tr>
                
                    <td  class="nowrap text-size">ទីកន្លែងកំណើត&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $user->pobAddress }}</td>
                        
                </tr>

                <tr>
                
                    <td colspan="2" class="nowrap text-size">អាសយដ្ខានបច្ចុប្បន្ន&nbsp;&nbsp;: {{ $user->pobAddress }}</td>
                    
                </tr>

                <tr>
                
                    <td class="nowrap text-size">អ៊ីម៉ែល&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $user->email }}</td>
                    
                </tr>
            
                <tr>
                
                    <td class="nowrap text-size">លេខទូរសព្ទ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $user->phoneNumber }}</td>
                    
                </tr>

                <tr>
                
                    <td class="nowrap text-size">អត្តសញ្ញាណប័ណ្ណ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:N/A</td>

                    <td class="nowrap text-size">កាលបរិច្ឆេទផុតកំណត់: N/A</td>
                    
                </tr>

                <tr>
                
                    <td class="nowrap text-size">លិខិតឆ្លងដែន&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: N/A</td>

                    <td class="nowrap text-size">កាលបរិច្ឆេទផុតកំណត់ : N/A</td>
                    
                </tr>
                
            <thead>
            
        </table>
    
    </div>

@endif
    <!-- --------------------------------ព័ត៍មានអំពីស្ថានភាព-------------------------------------- -->
    <h6 class="form-top-header">២.ព័ត៍មានអំពីស្ថានភាព</h6>

    <h6 class="form-top-header tab1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ក.ចូលបម្រើការងាររដ្ឋដំបូង</h6>
    @if(isset($user_information))
        <div class="table-responsive">
        
            <table class="table borderless" >
        
                <thead>
                
                    <tr>
                    
                        <td  class="nowrap text-size">ការបរិច្ឆេទចូលបំរើការងាររដ្ឋដំបូង : {{$user_information->date_enteing_public_service}}

                        </td>
                        
                        <td  class="nowrap text-size">ការបរិច្ឆេទតាំងស៊ប់ : {{$user_information->comfirm_date}}</td>
                    
                    </tr>
                    
                    <tr>
                    
                        <td  class="nowrap text-size">ក្របខណ្ឌ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{$user_information->constitution}}</td>
                        
                    </tr>

                    <tr>
                        
                        <td  class="nowrap text-size">មុខតំណែង&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{$user_information->position_enteing_public_service}}</td>
                        
                    </tr>
                    
                    <tr>
                    
                        <td  class="nowrap text-size">ក្រសួង/ស្ថាប័ន&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{$user_information->ministry_enteing_public_service}}</td>
                            
                    </tr>

                    <tr>
                    
                        <td colspan="2" class="nowrap text-size">អង្គភាព&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{$user_information->economy_enteing_public_service}}</td>
                        
                    </tr>

                    <tr>
                    
                        <td class="nowrap text-size">ការិយាល័យ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{$user_information->office_enteing_public_service}}</td>
                        
                    </tr>
                    
                <thead>
                
            </table>
        
        </div>
    
        <h6 class="form-top-header tab1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ខ.ស្ថានភាពមុខងារបច្ចុប្បន្ន</h6>
    
        <div class="table-responsive">
        
            <table class="table borderless" >
        
                <thead>
                    
                    <tr>
                    
                        <td  class="nowrap text-size">ក្របខណ្ឌ​​ ឋានន្តរស័ក្ត​ និងថ្នាក់&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{$user_information->constitution_misitry_rank}}</td>
                        
                        <td  class="nowrap text-size">កាលបរិច្ឆេទប្តូរក្រខណ្ខ ឋានន្តរស័ក្ត និងថ្នាក់ចុងក្រោយ : {{$user_information->constitution_amendment_date}}</td>
                    
                    </tr>
                    
                    <tr>
                    
                        <td  class="nowrap text-size">មុខតំណែង&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{$user_information->position_current_job_situation}}</td>
                        
                    </tr>

                    <tr>
                        
                        <td  class="nowrap text-size">កាលបរិច្ឆេទទទូលមុខតំណែងចុងក្រោយ : {{$user_information->effective_date_of_last_promotion}}</td>
                        
                    </tr>
                    
                    <tr>
                    
                        <td  class="nowrap text-size">អង្គភាព&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{$user_information->economy_current_job_situation}}</td>
                                
                    </tr>

                    
                <thead>
                
            </table>
        
        </div>
    @endif
   
    <h6 class="form-top-header tab1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;គ.តួនាទីបន្ថែមលើមុខងារបច្ចុប្បន្ន(ឋានៈស្មើ)</h6>

    <div class="table-responsive">
    
        <table class="table table-bordered" >
    
            <thead>

                <th class="nowrap text-size">ល.រ</th>
                
                <th class="nowrap text-size">ថ្ងៃ-ខែ​​​-ឆ្នាំ​</th>
                
                <th class="nowrap text-size">ឯកសារ</th>
                
                <th class="nowrap text-size">មុខតំណែង</th>
                
                <th class="nowrap text-size">ឋានៈស្មើ</th>
                
                <th class="nowrap text-size">អង្គភាព</th>

            <thead>
            <tbody>
            @if(isset($additionalPCJ))
                <?php $i=1;?>
                @foreach($additionalPCJ as $row )
                <tr>

                    <td class="nowrap text-size">{{$i++}}</td>

                    <td class="nowrap text-size">{{$row->date}}</td>

                    <td class="nowrap text-size"> 
                        
                    @if(!empty($row['document']) && $row['document']!='default.png')

                        <center class="p-1"> <a href="{{ asset('documents/' .$row['document']) }}" target="_blank"><i class="fa fa-folder" aria-hidden="true"></i></a> </center> 
                    @else
                        <center class="p-1"> <i class="fa fa-folder" style="color:#892727;" aria-hidden="true"></i> </center> 
                    @endif
                    </td>

                    <td class="nowrap text-size">{{$row->position}}</td>

                    <td class="nowrap text-size">{{$row->equivalent}}</td>

                    <td class="nowrap text-size">{{$row->economy}}</td>
                </tr>
                @endforeach
            @endif
            <tbody>
            
        </table>  
    
    </div>