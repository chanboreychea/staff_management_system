<p  style="font-family: khmer mef2;">៥.កម្រិតវប្បធម៍ទូទៅ ការបណ្តុះបណ្តាលវិជ្ជាជីវៈ និងការបណ្តុះបណ្តាលបន្ត</p>
    
    <div class="table-responsive">
    
        <table class="table table-bordered" >

            <thead>

                <td class="nowrap" style="text-align:center;font-size:12px">វគ្គ ឬ​កម្រិតសិក្សា</td>
                
                <td class="nowrap" style="text-align:center;font-size:12px">គ្រឺស្ថានសិក្សាបណ្តោះបណ្តាល</td>
                
                <td class="nowrap" style="text-align:center;font-size:12px">សញ្ញាបត្រដែលទទួលបាន</td>
                
                <td class="nowrap" style="text-align:center;font-size:12px">ថ្ងៃខែឆ្នាំចូលសិក្សា</td>
                
                <td class="nowrap" style="text-align:center;font-size:12px">ថ្ងៃខែឆ្នាំបញ្ចប់ការសិក្សា</td>

            <thead>
            
            <tbody>
                
                @if(isset($userEducationLevel))
                
                <tr>
                    <td style="text-align:left;font-size:12px" colspan="5">កម្រិតវប្បធម៍ទូទៅ</td>
                </tr>
                    @foreach($userEducationLevel as $row )

                    @if($row->status==1)
                   
                    <tr>
                        
                        <td  style="font-size:12px" ><div class="container">{{$row->level}}</div></td>
                        
                        <td  style="font-size:12px" ><div class="container">{{$row->education_intitution}}</div></td>
                        
                        <td  style="font-size:12px" ><div class="container">{{$row->cetificate}}</div></td>
                        
                        <td  style="font-size:12px" ><div>{{$row->start_date}}</div></td>
                        
                        <td  style="font-size:12px" ><div>{{$row->end_date}}</div></td>
                    
                    </tr>  
                    @endif 
                    @endforeach
                    <tr>
                     <td style="text-align:left;font-size:12px"colspan="5">កម្រិតសញ្ញាបត្រ</td>
                </tr>
                    @foreach($userEducationLevel as $row )

                    @if($row->status==2)
                   
                    <tr>
                        
                        <td  style="font-size:12px" ><div class="container" >{{$row->level}}</div></td>
                        
                        <td  style="font-size:12px" ><div class="container" >{{$row->education_intitution}}</div></td>
                        
                        <td  style="font-size:12px" ><div class="container" >{{$row->cetificate}}</div></td>
                        
                        <td  style="font-size:12px" ><div >{{$row->start_date}}</div></td>
                        
                        <td  style="font-size:12px" ><div>{{$row->end_date}}</div></td>

                    </tr>   
                    @endif 
                    @endforeach
                    <tr>
                     <td style="text-align:left;font-size:12px" colspan="5">ជំនាញឯករទេស</td>
                </tr>
                    @foreach($userEducationLevel as $row )

                    @if($row->status==1)
                   
                    <tr>
                        
                        <td  style="font-size:12px" ><div class="container" >{{$row->level}}</div></td>
                        
                        <td  style="font-size:12px" ><div class="container" >{{$row->education_intitution}}</div></td>
                        
                        <td  style="font-size:12px" ><div class="container" >{{$row->cetificate}}</div></td>
                        
                        <td  style="font-size:12px" ><div >{{$row->start_date}}</div></td>
                        
                        <td  style="font-size:12px" ><div >{{$row->end_date}}</div></td>
                    
                    </tr>   
                    @endif 
                    @endforeach
                    <tr>
                     <td style="text-align:left;font-size:12px" colspan="5">គ្រឿងឥស្សរិយយស ប័ណ្ណសរសើរ</td>
                </tr>
                    @foreach($userEducationLevel as $row )

                    @if($row->status==3)
                   
                    <tr>
                        
                        <td  style="font-size:12px" ><div class="container">{{$row->level}}</div></td>
                        
                        <td  style="font-size:12px" ><div class="container" >{{$row->education_intitution}}</div></td>
                        
                        <td  style="font-size:12px" ><div class="container" >{{$row->cetificate}}</div></td>
                        
                        <td  style="font-size:12px" ><div >{{$row->start_date}}</div></td>
                        
                        <td  style="font-size:12px" ><div>{{$row->end_date}}</div></td>
                    
                    </tr>   
                    @endif 
                    @endforeach
                    <tr>
                     <td style="text-align:left;font-size:12px" colspan="5">វគ្គបណ្តុះបណ្តាលវិជ្ជាជីវៈ</td>
                </tr>
                    @foreach($userEducationLevel as $row )

                    @if($row->status==4)
                   
                    <tr>
                        
                        <td  style="font-size:12px" ><div class="container">{{$row->level}}</div></td>
                        
                        <td  style="font-size:12px" ><div class="container">{{$row->education_intitution}}</div></td>
                        
                        <td  style="font-size:12px" ><div class="container">{{$row->cetificate}}</div></td>
                        
                        <td  style="font-size:12px" ><div>{{$row->start_date}}</div></td>
                        
                        <td  style="font-size:12px" ><div>{{$row->end_date}}</div></td>
                    
                    </tr>   
                    @endif 
                    @endforeach
                
                @endif
            
            <tbody>
            
        </table>  

    </div>