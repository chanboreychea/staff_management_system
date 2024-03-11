<h6 class="form-top-header">៥.កម្រិតវប្បធម៍ទូទៅ ការបណ្តុះបណ្តាលវិជ្ជាជីវៈ និងការបណ្តុះបណ្តាលបន្ត</h6>
    
    <div class="table-responsive">
    
        <table class="table table-bordered" >

            <thead>

                <th class="nowrap text-size">វគ្គ ឬ​កម្រិតសិក្សា</th>
                
                <th class="nowrap text-size">គ្រឺស្ថានសិក្សាបណ្តោះបណ្តាល</th>
                
                <th class="nowrap text-size">សញ្ញាបត្រដែលទទួលបាន</th>
                
                <th class="nowrap text-size">ថ្ងៃខែឆ្នាំចូលសិក្សា</th>
                
                <th class="nowrap text-size">ថ្ងៃខែឆ្នាំបញ្ចប់ការសិក្សា</th>

            <thead>
            
            <tbody>
                
                @if(isset($userEducationLevel))
                
                <tr>
                    <th class="text-size" colspan="5">កម្រិតវប្បធម៍ទូទៅ</th>
                </tr>
                    @foreach($userEducationLevel as $row )

                    @if($row->status==1)
                   
                    <tr>
                        
                        <td  class="nowrap text-size">{{$row->level}}</td>
                        
                        <td  class="nowrap text-size">{{$row->education_intitution}}</td>
                        
                        <td  class="text-size">{{$row->cetificate}}</td>
                        
                        <td  class="text-size">{{$row->start_date}}</td>
                        
                        <td  class="text-size">{{$row->end_date}}</td>
                    
                    </tr>  
                    @endif 
                    @endforeach
                    <tr>
                    <th class="text-size" colspan="5">កម្រិតសញ្ញាបត្រ</th>
                </tr>
                    @foreach($userEducationLevel as $row )

                    @if($row->status==2)
                   
                    <tr>
                        
                        <td  class="nowrap text-size">{{$row->level}}</td>
                        
                        <td  class="nowrap text-size">{{$row->education_intitution}}</td>
                        
                        <td  class="text-size">{{$row->cetificate}}</td>
                        
                        <td  class="text-size">{{$row->start_date}}</td>
                        
                        <td  class="text-size">{{$row->end_date}}</td>
                    
                    </tr>   
                    @endif 
                    @endforeach
                    <tr>
                    <th class="text-size" colspan="5">ជំនាញឯករទេស</th>
                </tr>
                    @foreach($userEducationLevel as $row )

                    @if($row->status==1)
                   
                    <tr>
                        
                        <td  class="nowrap text-size">{{$row->level}}</td>
                        
                        <td  class="nowrap text-size">{{$row->education_intitution}}</td>
                        
                        <td  class="text-size">{{$row->cetificate}}</td>
                        
                        <td  class="text-size">{{$row->start_date}}</td>
                        
                        <td  class="text-size">{{$row->end_date}}</td>
                    
                    </tr>   
                    @endif 
                    @endforeach
                    <tr>
                    <th class="text-size" colspan="5">គ្រឿងឥស្សរិយយស ប័ណ្ណសរសើរ</th>
                </tr>
                    @foreach($userEducationLevel as $row )

                    @if($row->status==3)
                   
                    <tr>
                        
                        <td  class="nowrap text-size">{{$row->level}}</td>
                        
                        <td  class="nowrap text-size">{{$row->education_intitution}}</td>
                        
                        <td  class="text-size">{{$row->cetificate}}</td>
                        
                        <td  class="text-size">{{$row->start_date}}</td>
                        
                        <td  class="text-size">{{$row->end_date}}</td>
                    
                    </tr>   
                    @endif 
                    @endforeach
                    <tr>
                    <th class="text-size" colspan="5">វគ្គបណ្តុះបណ្តាលវិជ្ជាជីវៈ</th>
                </tr>
                    @foreach($userEducationLevel as $row )

                    @if($row->status==4)
                   
                    <tr>
                        
                        <td  class="nowrap text-size">{{$row->level}}</td>
                        
                        <td  class="nowrap text-size">{{$row->education_intitution}}</td>
                        
                        <td  class="text-size">{{$row->cetificate}}</td>
                        
                        <td  class="text-size">{{$row->start_date}}</td>
                        
                        <td  class="text-size">{{$row->end_date}}</td>
                    
                    </tr>   
                    @endif 
                    @endforeach
                
                @endif
            
            <tbody>
            
        </table>  

    </div>