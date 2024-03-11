<h6 class="form-top-header">៦.សមត្ថភាពភាសាបរទេស</h6>
    
    <div class="table-responsive">
    
        <table class="table table-bordered" >

            <thead>

                <th class="nowrap text-size" >ល.រ</th>
                
                <th class="nowrap text-size" >ភាសា</th>
                
                <th class="nowrap text-size" >អាន</th>
                
                <th class="nowrap text-size" >សរសេរ</th>
                
                <th class="nowrap text-size" >និយាយ</th>

                <th class="nowrap text-size" >ស្តាប់</th>

            <thead>
            
            <tbody>
            @if(isset($userAbilityLanguage))
                
                <?php $i=1;?>
             
                @foreach($userAbilityLanguage as $row )
                
                 
                        <tr>
                            
                            <td>{{$i++}}</td>

                            <td class="text-size text-center">  {{$row->language == 1 ? 'ល្អណាស់' : ($row->language == 2 ? 'ល្អបង្គួរ' : 'ល្អ')}}</td>

                            <td class="text-size text-center">{{$row->read == 1 ? 'ល្អណាស់' : ($row->read== 2 ? 'ល្អបង្គួរ' : 'ល្អ')}}</td>
                            
                            <td class="text-size text-center">{{$row->write == 1 ? 'ល្អណាស់' : ($row->write== 2 ? 'ល្អបង្គួរ' : 'ល្អ')}}</td>
                            
                            <td class="text-size text-center">{{$row->speak == 1 ? 'ល្អណាស់' : ($row->speak== 2 ? 'ល្អបង្គួរ' : 'ល្អ')}}</td>

                            <td class="text-size text-center">{{$row->listen == 1 ? 'ល្អណាស់' : ($row->listen== 2 ? 'ល្អបង្គួរ' : 'ល្អ')}}</td>

                        </tr>
                
                @endforeach
               
            @endif
            
            <tbody>
            
        </table>  

    </div>
