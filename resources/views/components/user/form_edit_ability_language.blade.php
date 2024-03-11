

<div class="table-responsive-sm" style="overflow-x: auto;" >

    <table id="example1"  class="display nowrap table table-bordered">
    
    @if($langaugeSkill->isEmpty())
            <!-- If $workingHistoryPublicSector is empty, don't display the <thead> section -->
        @else
            <thead>
            
                <tr>
                 
                    <th class="nowrap text-sm">ភាសា</th>
                 
                    <th class="nowrap text-sm">អាន</th>
                 
                    <th class="nowrap text-sm">សរសេរ</th>
                 
                    <th class="nowrap text-sm">និយាយ</th>

                    <th class="nowrap text-sm">ស្តាប់</th> 
                 
                </tr>
            
            </thead>
        @endif

        <tbody>
           
            @foreach ($langaugeSkill as $index => $ls)
            
                <tr class="additon_current_job odd gradeX">

                    <td>
                        
                        <input type="hidden" value="{{ $ls['id']}}" name="id[]">
                        <div class="width">

                        
                            <input 
                                type="text" 
                                
                                class="form-control form-control-sm " 
                                
                                name="language[]" placeholder="ភាសា"  
                                
                                value="{{ $ls['language'] ?? old('level.' . $index) }}">
                    
                        </div>

                    </td>

                    <td  style=" vertical-align: middle;" >

                        <div class="width">
 
                            <select name="read[]" class="form-select form-select-sm numeral transaction_amount" id="status1">
                        
                                <option value="1" @if ($ls['read']=="1") {{ 'selected' }} @endif>ល្អណាស់</option>
                            
                                <option value="2" @if ($ls['read']=="2") {{ 'selected' }} @endif>ល្អបង្គួរ</option>

                                <option value="3" @if ($ls['read']=="3") {{ 'selected' }} @endif>ល្អ</option> 
                            
                            </select>    

                        </div>              

                    </td>
             
                    <td >
                        <div class="width">

                            <select name="write[]" class=" form-select form-select-sm numeral transaction_amount" id="status1">
                            
                                <option value="1" @if ($ls['write']=="1") {{ 'selected' }} @endif>ល្អណាស់</option>
                            
                                <option value="2" @if ($ls['write']=="2") {{ 'selected' }} @endif>ល្អបង្គួរ</option>

                                <option value="3" @if ($ls['write']=="3") {{ 'selected' }} @endif>ល្អ</option>
                            
                            
                            </select>     
                    
                        </div>
                    </td>

                    <td >
                            
                        <div class="width">

                            <select name="speak[]" class=" form-select form-select-sm numeral transaction_amount" id="status1">
                            
                                <option value="1" @if ($ls['speak']=="1") {{ 'selected' }} @endif>ល្អណាស់</option>
                            
                                <option value="2" @if ($ls['speak']=="2") {{ 'selected' }} @endif>ល្អបង្គួរ</option>

                                <option value="3" @if ($ls['speak']=="3") {{ 'selected' }} @endif>ល្អ</option>
                            
                            
                            </select>     

                        </div>    
                    </td>

                    <td  >
                        <div class="width">

                            <select name="listen[]" class="form-select form-select-sm numeral transaction_amount" id="status1">
                            
                                <option value="1" @if ($ls['listen']=="1") {{ 'selected' }} @endif>ល្អណាស់</option>
                            
                                <option value="2" @if ($ls['listen']=="2") {{ 'selected' }} @endif>ល្អបង្គួរ</option>

                                <option value="3" @if ($ls['listen']=="3") {{ 'selected' }} @endif>ល្អ</option>
                            
                            
                            </select> 

                        </div> 
                    </td>
                    
                    
                </tr>
  
            @endforeach
        
        </tbody>
    
    </table>
</div>

<style>
    .width{
        width:180px;
    }
</style>