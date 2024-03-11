


<div class="table-responsive-sm"  style="overflow-x: auto;">

    <table class="table table-bordered">
    @if($workingHistoryPrivateSector->isEmpty())
            <!-- If $workingHistoryPublicSector is empty, don't display the <thead> section -->
        @else
            <thead>
                <tr>
                    <th class="text-sm">ថ្ងៃ-ខែ​​​-ឆ្នាំ​ ចូល</th>
                    <th class="text-sm">ថ្ងៃ-ខែ​​​-ឆ្នាំ ចេញ</th>
                    <th class="text-sm">គ្រឺះស្ថាន/អង្គភាព</th>
                    <th class="text-sm">មុខតំណែង</th>
                    <th class="text-sm">ជំនាញ/បច្ចេកទេស</th>
                    <th class="text-sm">ផ្សេងៗ</th>
                </tr>
            </thead>
        @endif

        <tbody>
           
            @foreach ($workingHistoryPrivateSector as $index => $working_histroy_private_sector)
            
                <tr class="additon_current_job">
                    <td>
                    
                    <input type="hidden" value="{{ $working_histroy_private_sector['id']}}" name="ids[]">
                        

                            <input  type="date" 
                                      
                                name="start_date_ps[]" 
                                
                                value="{{ $working_histroy_private_sector['start_date'] ?? old('start_date_ps.' . $index) }}"
                                
                                class="form-control-sm form-control"
  
                                placeholder="ថ្ងៃ-ខែ​​​-ឆ្នាំ">    
                    
                    
                    </td>
                    <td>
                      
                            <input type="date" class="form-control form-control-sm" 
                            
                            name="end_date_ps[]" 
                                                        
                            value="{{ $working_histroy_private_sector['end_date'] ?? old('end_date_ps.' . $index) }}">
                    
                    </td>
                    <td>
                        <div class="container">
                            
                            <input type="text" class="form-control form-control-sm" 
                        
                            placeholder="គ្រឺះស្ថាន/អង្គភាព" name="economy_ps[]" 
                            
                            
                            value="{{ $working_histroy_private_sector['economy'] ?? old('economy_ps.' . $index) }}">
                        </div>
                    </td>
                    <td>
                        <div class="container">
                            <input type="text" class="form-control form-control-sm" 
                            
                            placeholder="មុខតំណែង" name="position_ps[]" 
                            
                            value="{{ $working_histroy_private_sector['position'] ?? old('position_ps.' . $index) }}">
                        </div>
                    </td>
                    
                   
                    
                    <td style=" vertical-align: middle;">

                        <div class="container">

                            <input type="text" class="form-control form-control-sm" 
                            
                            placeholder="ជំនាញ/បច្ចេកទេស" name="tecnology_ps[]" 
                            
                            value="{{ $working_histroy_private_sector['tecnology'] ?? old('tecnology_ps.' . $index) }}">
                        </div>                   
    
                    </td>

                    <td  style=" vertical-align: middle;">

                       <div class="container">

                            <input type="text" class="form-control form-control-sm" 
                            
                            placeholder="ផ្សេងៗ" name="other_ps[]" 
                            
                            value="{{ $working_histroy_private_sector['other'] ?? old('other_ps.' . $index) }}">
                        </div>            
                    
                    </td>
                
                </tr>
  
            @endforeach
        
        </tbody>
    
    </table>
</div>
<style>
     .container {
      /* margin: 50px auto; */
      width: 250px;
    }
</style>