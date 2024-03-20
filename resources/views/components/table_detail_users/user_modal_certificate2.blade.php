<p  style="font-family: khmer mef2;">៤.គ្រឿងឥស្សរិយយស ប័ណ្ណសរសើរ ឬទណ្ណកម្មវិន័យ</p>
    
    <div  class="table-reponsive">
    
        <table class="table table-bordered" >
        
            <thead>

                <td style="text-align:center;font-size:12px">លេខឯកសារ</td>
                
                <td style="text-align:center;font-size:12px">ការបរិច្ឆេទ</td>
                
                <td style="text-align:center;font-size:12px">ស្ថាប័ន/អង្គភាព(ស្នើសុំ)</td>
                
                <td style="text-align:center;font-size:12px">ខ្លឺមសារ</td>
                
                <td style="text-align:center;font-size:12px">ប្រភេទ</td>

            <thead>
            
            <tbody>
            @if(isset($userModalCertificate))
                
                
                <tr>
                    <td style="text-align:left;font-size:12px" colspan="5">គ្រឿងឥស្សរិយយស ប័ណ្ណសរសើរ</td>
                </tr>
                @foreach($userModalCertificate as $row )
                    @if($row->status==1)
                 
                        <tr>
                            
                           
                            <td  style="font-size:12px" ><div class="container" >{{$row->document}}</div></td>

                            <td  style="font-size:12px" ><div class="container" >{{$row->date}}</div></td>

                            <td  style="font-size:12px" ><div class="container">{{$row->economy}}</div></td>
                            
                            <td  style="font-size:12px" ><div class="container">{{$row->decription}}</div></td>
                            
                            <td  style="font-size:12px" ><div class="container">{{$row->type}}</div></td>
                        
                        </tr>
                    @endif
                @endforeach
                <tr>
                    <td style="text-align:left;font-size:12px" colspan="5">ទណ្ណកម្មវិន័យ</td>
                </tr>
                @foreach($userModalCertificate as $row )
                    @if($row->status==2)
                    <tr>
                      
                        <td  style="font-size:12px" ><div class="container" >{{$row->document}}</div></td>

                        <td  style="font-size:12px" ><div class="container" >{{$row->date}}</div></td>

                        <td  style="font-size:12px" ><div class="container">{{$row->economy}}</div></td>
                        
                        <td  style="font-size:12px" ><div class="container">{{$row->decription}}</div></td>
                        
                        <td  style="font-size:12px" ><div class="container">{{$row->type}}</div></td>
                    
                    </tr>
                    @endif
                @endforeach
            @endif
            
            <tbody>
            
        </table>  

    </div>