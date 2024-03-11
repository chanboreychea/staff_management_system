<h6 class="form-top-header">៤.គ្រឿងឥស្សរិយយស ប័ណ្ណសរសើរ ឬទណ្ណកម្មវិន័យ</h6>
    
    <div  class="table-wrapper">
    
        <table class="table table-bordered" >
        
            <thead>

                <th  class="text-size">លេខឯកសារ</th>
                
                <th class="text-size">ការបរិច្ឆេទ</th>
                
                <th class="text-size">ស្ថាប័ន/អង្គភាព(ស្នើសុំ)</th>
                
                <th class="text-size">ខ្លឺមសារ</th>
                
                <th class="text-size">ប្រភេទ</th>

            <thead>
            
            <tbody>
            @if(isset($userModalCertificate))
                
                
                <tr>
                    <th style="text-align:left" colspan="5">គ្រឿងឥស្សរិយយស ប័ណ្ណសរសើរ</th>
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
                            
                            <td >{{$row->date}}</td>

                            <td >{{$row->economy}}</td>
                            
                            <td >{{$row->decription}}</td>
                            
                            <td >{{$row->type}}</td>
                        
                        </tr>
                    @endif
                @endforeach
                <tr>
                    <th style="text-align:left" colspan="5">ទណ្ណកម្មវិន័យ</th>
                </tr>
                @foreach($userModalCertificate as $row )
                    @if($row->status==2)
                    <tr>
                        <td class="text-size text-center">
                            
                            @if(!empty($row['document']) && $row['document']!='default.png')

                            <center class="p-1"> <a href="{{ asset('document_cetificates/' .$row['document']) }}" target="_blank"><i class="fa fa-folder" aria-hidden="true"></i></a> </center> 
                            @else
                            <center class="p-1"> <i class="fa fa-folder" style="color:#892727;" aria-hidden="true"></i> </center> 
                            @endif
                        </td>
                        
                        <td style="font-size:12px">{{$row->date}}</td>

                        <td style="font-size:12px" >{{$row->economy}}</td>
                        
                        <td style="font-size:12px" >{{$row->decription}}</td>
                        
                        <td style="font-size:12px" >{{$row->type}}</td>
                    
                    </tr>
                    @endif
                @endforeach
            @endif
            
            <tbody>
            
        </table>  

    </div>