<p  style="font-family: khmer mef2;">៤.គ្រឿងឥស្សរិយយស ប័ណ្ណសរសើរ ឬទណ្ណកម្មវិន័យ</p>
    
    <div  class="table-reponsive">
    
        <table class="table table-bordered" >
        
            <thead>

                <td style="text-align:center;font-size:14px">លេខឯកសារ</td>
                
                <td style="text-align:center;font-size:14px">ការបរិច្ឆេទ</td>
                
                <td style="text-align:center;font-size:14px">ស្ថាប័ន/អង្គភាព(ស្នើសុំ)</td>
                
                <td style="text-align:center;font-size:14px">ខ្លឺមសារ</td>
                
                <td style="text-align:center;font-size:14px">ប្រភេទ</td>

            <thead>
            
            <tbody>
            @if(isset($userModalCertificate))
                
                
                <tr>
                    <td style="text-align:left;font-size:14px" colspan="5">គ្រឿងឥស្សរិយយស ប័ណ្ណសរសើរ</td>
                </tr>
                @foreach($userModalCertificate as $row )
                    @if($row->status==1)
                 
                        <tr>
                            
                            <td>
                                      
                                @if(!empty($row['document']) && $row['document']!='default.png')

                                <center class="p-1"> <a href="{{ asset('documents/' .$row['document']) }}" target="_blank"><i class="fa fa-folder" aria-hidden="true"></i></a> </center> 
                                @else
                                <center class="p-1"> <i class="fa fa-folder" style="color:#892727;" aria-hidden="true"></i> </center> 
                                @endif
                            </td>
                            
                            <td  style="font-size:12px" ><div style="width:70px;">{{$row->date}}</div></td>

                            <td  style="font-size:12px" ><div style="width:130px;">{{$row->economy}}</div></td>
                            
                            <td  style="font-size:12px" ><div style="width:150px;">{{$row->decription}}</div></td>
                            
                            <td  style="font-size:12px" ><div style="width:120px;">{{$row->type}}</div></td>
                        
                        </tr>
                    @endif
                @endforeach
                <tr>
                    <td style="text-align:left;font-size:14px" colspan="5">ទណ្ណកម្មវិន័យ</td>
                </tr>
                @foreach($userModalCertificate as $row )
                    @if($row->status==2)
                    <tr>
                        <td class="text-center">
                            
                            @if(!empty($row['document']) && $row['document']!='default.png')

                            <center class="p-1"> <a href="{{ asset('document_cetificates/' .$row['document']) }}" target="_blank"><i class="fa fa-folder" aria-hidden="true"></i></a> </center> 
                            @else
                            <center class="p-1"> <i class="fa fa-folder" style="color:#892727;" aria-hidden="true"></i> </center> 
                            @endif
                        </td>
                        
                        <td  style="font-size:12px" ><div style="width:70px;">{{$row->date}}</div></td>

                        <td  style="font-size:12px" ><div style="width:130px;">{{$row->economy}}</div></td>
                        
                        <td  style="font-size:12px" ><div style="width:150px;">{{$row->decription}}</div></td>
                        
                        <td  style="font-size:12px" ><div style="width:120px;">{{$row->type}}</div></td>
                    
                    </tr>
                    @endif
                @endforeach
            @endif
            
            <tbody>
            
        </table>  

    </div>