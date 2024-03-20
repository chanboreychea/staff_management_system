



<div class="table-responsive-sm" style="overflow-x: auto;">

    <table id="example1"  class="display nowrap table table-bordered">
    @if($modalCertificate->isEmpty())
            <!-- If $workingHistoryPublicSector is empty, don't display the <thead> section -->
        @else
            <thead>
                <tr>
                    <th class="nowrap text-sm">ការបរិច្ឆេទ</th>
                    <th class="nowrap text-sm">ស្ថាប័ន/អង្គភាព</th>
                    <th class="nowrap text-sm">ខ្លឹមសារ</th>
                    <th class="nowrap text-sm">ប្រភេទ</th>
                    <th class="nowrap text-sm">ស្ថានការ</th>
                    <th class="nowrap text-sm">ឯកសារ</th>
                
                </tr>
            </thead>
        @endif

        <tbody>
           
            @foreach ($modalCertificate as $index => $cerificate)
            
                <tr class="additon_current_job odd gradeX">
                    <td>
                    
                    <input type="hidden" value="{{ $cerificate['id']}}" name="id[]">

                    <input  type="date" 
                                      
                                name="date[]" 
                                
                                value="{{ $cerificate['date'] ?? old('date.' . $index) }}"
                                
                                class="form-control form-control-sm"

                                required
                                
                                placeholder="ថ្ងៃ-ខែ​​​-ឆ្នាំ">    
                    
                    </td>
        
                    <td >
                        <div class="width">

                            <input type="text" class="form-control form-control-sm" 
                        
                            placeholder="គ្រឺះស្ថាន/អង្គភាព" name="economy[]" 
                            
                            value="{{ $cerificate['economy'] ?? old('economy.' . $index) }}">

                        </div>
                    
                    </td>
                    <td >
                        <div class="width">
                        
                            <input type="text" class="form-control form-control-sm" 
                            
                            placeholder="មុខតំណែង" name="decription[]" 
                            
                            value="{{ $cerificate['decription'] ?? old('decription.' . $index) }}">
                            
                        </div>
                    </td>
                    
                   
                    
                    <td style=" vertical-align: middle;" >

                       <div class="width">

                            <input type="text" class="form-control form-control-sm" 
                            
                            placeholder="ជំនាញ/បច្ចេកទេស" name="type[]" 
                            
                            value="{{ $cerificate['type'] ?? old('type.' . $index) }}">

                        </div>
                                          
                    </td>

                    <td  style=" vertical-align: middle;" >
                       <div class="width">

                        
                            <select name="status[]" class="form-select form-select-sm numeral transaction_amount" id="status1">
                        
                                <option value="1" @if ($cerificate['status']=="1") {{ 'selected' }} @endif>គ្រឿងឥស្សរិយយស ប័ណ្ណសរសើរ</option>
                            
                                <option value="2" @if ($cerificate['status']=="2") {{ 'selected' }} @endif>ទ័ណ្ខកម្មវិន័យ</option>
                            
                            </select>    
                        </div>
                        
                                          
                    </td>

                   
                      
                    {{-- <td class="d-flex " style=" vertical-align: middle;" >
                        <div class="width">

                            <input type="file" class="form-control form-control-sm" 
                        
                            placeholder="ឯកសារ" name="document[]">

                        </div>

                        <div>
                       
                            @if(!empty($cerificate['document']) && $cerificate['document']!='default.png')

                                <center class="p-1"> <a href="{{ asset('document_cetificates/' .$cerificate['document']) }}" target="_blank"><i class="fa fa-folder" aria-hidden="true"></i></a> </center> 
                            @else
                                <center class="p-1"> <i class="fa fa-folder" style="color:#892727;" aria-hidden="true"></i> </center> 
                            @endif

                        </div>

                        <input type="hidden" name="old_document[]" value="{{$cerificate['document']}}">
                                          
                    </td> --}}
                    
                    <td style=" vertical-align: middle;" >

                        <div class="width">
 
                             <input type="text" class="form-control form-control-sm" 
                             
                             placeholder="លេខឯកសារ" name="document[]" 
                             
                             value="{{ $cerificate['document'] ?? old('document.' . $index) }}">
 
                         </div>
                                           
                     </td>
                    
                    
                </tr>
  
            @endforeach
        
        </tbody>
    
    </table>
</div>

<style>
    .width{
        width:250px
    }
</style>