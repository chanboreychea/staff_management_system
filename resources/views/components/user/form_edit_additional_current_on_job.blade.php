


<div class="table-responsive-sm"  style="overflow-x: auto;">

    <table class="table table-bordered">
        @if($AdditionalPositionCurrentJob->isEmpty())
                <!-- If $workingHistoryPublicSector is empty, don't display the <thead> section -->
        @else
            <thead>
                <tr>
                    
                <th class="text-sm">ថ្ងៃ-ខែ​​​-ឆ្នាំ</th>

                <th class="text-sm">មុខតំណែង</th>

                <th class="text-sm">ឋានៈស្មើ</th>

                <th class="text-sm">អង្គភាព</th>

                <th class="text-sm">ឯកសារ</th>
                </tr>
            </thead>
        
         @endif
        

        <tbody>
           
            @foreach ($AdditionalPositionCurrentJob as $index => $job)
            
                <tr class="additon_current_job">
                    <td>     
                            <input  type="date" 
                                        
                                    name="date_additional_position_on_current_job[]" 
                                    
                                    value="{{ $job['date'] ?? old('date_additional_position_on_current_job.' . $index) }}"
                                    
                                    class="form-control form-control-sm"
                                    
                                    placeholder="ថ្ងៃ-ខែ​​​-ឆ្នាំ">    
                        
            
                    </td>
                    <td>
                        <div class="input_width">

                            <input type="hidden" value="{{ $job['id']}}" name="additional_current_job_id[]">
                            
                            <input type="text" class=" form-control-sm  form-control" 
                            
                            placeholder="មុខតំណែង" name="position_additional_position_on_current_job[]" 
                            
                            value="{{ $job['position'] ?? old('position_additional_position_on_current_job.' . $index) }}">
                        
                        </div>
                    </td>
                    
                    <td>
                        <div class="input_width">

                       
                            <input type="text" class=" form-control-sm  form-control" 
                            
                            placeholder="ឋានៈស្មើ" name="equivalent[]" 
                            
                            value="{{ $job['equivalent'] ?? old('equivalent.' . $index) }}">
                        
                        </div>
                    </td>
                    
                    <td>
                        <div class="input_width">

                            <input type="text" class=" form-control-sm  form-control" 
                        
                            placeholder="អង្គភាព" name="economy_additional_position_on_current_job[]" 
                            
                            value="{{ $job['economy'] ?? old('economy_additional_position_on_current_job.' . $index) }}">
                        
                        </div> 
                    </td>
                    
                    <td class="d-flex nowrap " style=" vertical-align: middle;">
                       <div class="input_width">

                            <input type="file" class=" form-control-sm  form-control" 
                        
                            placeholder="ឯកសារ" name="document[]">
                         
                        </div>  
                        <div>
                         
                            @if(!empty($job['document']) && $job['document']!='default.png')

                                <center class="p-1"> <a href="{{ asset('documents/' .$job['document']) }}" target="_blank"><i class="fa fa-folder" aria-hidden="true"></i></a> </center> 
                            @else
                                <center class="p-1"> <i class="fa fa-folder" style="color:#892727;" aria-hidden="true"></i> </center> 
                            @endif
    
                        </div>
                            <input type="hidden" name="old_document[]" value="{{$job['document']}}">
                                  
                    </td>
                
                </tr>
  
            @endforeach
        
        </tbody>
    
    </table>
</div>
<style>
    .input_width{
        width:250px;
    }
</style>
