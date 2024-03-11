<p  style="font-family: khmer mef2;">៦.សមត្ថភាពភាសាបរទេស</p>
    
    <div class="table-responsive">
    
        <table class="table table-bordered" >

            <thead>

                <td class="nowrap" style="text-align:center;font-size:14px" >ល.រ</td>
                
                <td class="nowrap" style="text-align:center;font-size:14px" >ភាសា</td>
                
                <td class="nowrap" style="text-align:center;font-size:14px" >អាន</td>
                
                <td class="nowrap" style="text-align:center;font-size:14px" >សរសេរ</td>
                
                <td class="nowrap" style="text-align:center;font-size:14px" >និយាយ</td>

                <td class="nowrap" style="text-align:center;font-size:14px" >ស្តាប់</td>

            <thead>
            
            <tbody>

            @if(isset($userAbilityLanguage))
                
                <?php $i=1;?>
             
                @foreach($userAbilityLanguage as $row )
                
                 
                        <tr>
                            
                            <td style="text-align:center;font-size:12px">{{$i++}}</td>

                            <td style="text-align:left;font-size:12px">  {{$row->language == 1 ? 'ល្អណាស់' : ($row->language == 2 ? 'ល្អបង្គួរ' : 'ល្អ')}}</td>

                            <td style="text-align:left;font-size:12px">{{$row->read == 1 ? 'ល្អណាស់' : ($row->read== 2 ? 'ល្អបង្គួរ' : 'ល្អ')}}</td>
                            
                            <td style="text-align:left;font-size:12px">{{$row->write == 1 ? 'ល្អណាស់' : ($row->write== 2 ? 'ល្អបង្គួរ' : 'ល្អ')}}</td>
                            
                            <td style="text-align:left;font-size:12px">{{$row->speak == 1 ? 'ល្អណាស់' : ($row->speak== 2 ? 'ល្អបង្គួរ' : 'ល្អ')}}</td>

                            <td style="text-align:left;font-size:12px">{{$row->listen == 1 ? 'ល្អណាស់' : ($row->listen== 2 ? 'ល្អបង្គួរ' : 'ល្អ')}}</td>

                        </tr>
                
                @endforeach
               
            @endif
            
            <tbody>
            
        </table>  

    </div>
