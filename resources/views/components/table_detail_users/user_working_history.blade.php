
<p  style="font-family: khmer mef2;">៣.ប្រវត្តិការងារ</p>
    
    <p style="font-family: khmer mef2;margin-left:15px;">ក.ក្នុងវិស័យមុខងារសាធារណៈ</p>
    
    <div class="table-reponsive"  style="overflow-x: auto">
    
        <table class="table-bordered table">

            <thead>
                <tr>
                    
                    <td  class="nowrap"  style="text-align:center;font-size:12px" colspan="2" >

                        ថ្ងៃខែឆ្នាំបំពេញការងារ

                    </td>
                    
                    <td  class="nowrap" style="text-align:center;font-size:12px"  rowspan="2">ក្រសួង/ស្ថាប័ន</td>
                    
                    <td  class="nowrap" style="text-align:center;font-size:12px" rowspan="2">អង្គភាព</td>
                    
                    <td  class="nowrap" style="text-align:center;font-size:12px" rowspan="2"><div class="width">មុខតំណែង</div></td>
                    
                    <td  class="nowrap" style="text-align:center;font-size:12px" rowspan="2">ផ្សេងៗ</td>
            
                </tr>

            </thead>
            
            <tbody>
            
                <tr>
                    
                    <td style="text-align:center;font-size:12px">ចូល</td>
                    
                    <td style="text-align:center;font-size:12px">បញ្ខប់</td>

                    <td class="text-center" colspan="4"></td>
                
                </tr>
                
                @if(isset($userWoringHistoryPublicSetor))
                
                    @foreach($userWoringHistoryPublicSetor as $row )
                
                    <tr>
                        
                     
                        <td  style="font-size:12px" ><div style="width:70px;">{{$row->start_date}}</div></td>
                            
                        <td  style="font-size:12px" ><div style="width:70px;">{{$row->end_date}}</div></div></td>
                        
                        <td  style="font-size:12px" >{{$row->ministry}}</td>
                        
                        <td  style="font-size:12px" >{{$row->economy}}</td>

                        <td  style="font-size:12px" >{{$row->position}}</td>
                        
                        <td  style="font-size:12px" >{{$row->other}}</td>
                    </tr>  
                    
                    @endforeach
                
                @endif
            
            </tbody>
        
        </table>  

    </div>
<!-- -------------------------------------------------------------------------------- -->
<p style="font-family: khmer mef2;margin-left:15px;">ខ.ក្នុងវិស័យឯកជន</p>
    
    <div class="table-reponsive">
    
        <table class="table table-bordered ">

            <thead>
                <tr>

                    <td class="nowrap" style="text-align:center;font-size:12px" colspan="2"><center>ថ្ងៃខែឆ្នាំបំពេញការងារ</center></td>
                    
                    <td class="nowrap" style="text-align:center;font-size:12px" rowspan="2"><center>គ្រឺះស្ថាន/អង្គភាព</center></td>
                    
                    <td class="nowrap" style="text-align:center;font-size:12px" rowspan="2"><center>មុខតំណែង</center></td>
                    
                    <td class="nowrap" style="text-align:center;font-size:12px" rowspan="2"><center>ជំនាញ/បច្ចេកទេស</center></td>
                    
                    <td class="nowrap" style="text-align:center;font-size:12px" rowspan="2"><center>ផ្សេងៗ</center></td>
                
                </tr>
            </thead>
                
                <tbody>
                
                    <tr>
                        
                        <td style="text-align:center;font-size:12px">ចូល</td>
                        
                        <td style="text-align:center;font-size:12px">បញ្ខប់</td>

                        <td class="text-center" colspan="4"></td>
                    
                    </tr>
                    
                    @if(isset($userWoringHistoryPrivateSetor))
                    
                        @foreach($userWoringHistoryPrivateSetor as $row )
                    
                        <tr>
                            
                            <td  style="font-size:12px" ><div style="width:70px;">{{$row->start_date}}</div></td>
                            
                            <td  style="font-size:12px" ><div style="width:70px;">{{$row->end_date}}</div></div></td>
                            
                            <td  style="font-size:12px" >{{$row->economy}}</td>
                            
                            <td  style="font-size:12px" >{{$row->position}}</td>

                            <td  style="font-size:12px" >{{$row->tecnology}}</td>
                            
                            <td  style="font-size:12px" >{{$row->other}}</td>
                        
                        </tr>  
                        
                        @endforeach
                    
                    @endif
                
                </tbody>
                
        </table>  

    </div>