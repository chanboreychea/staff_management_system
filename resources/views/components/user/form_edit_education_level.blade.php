

<div class="table-responsive-sm" style="overflow-x: auto;">

    <!-- <table id="example1"  class="display nowrap table table-bordered"> -->
    <table id="example" class="display table  table-bordered" style="width:100%">
    
    @if($eductionLevel->isEmpty())
            <!-- If $workingHistoryPublicSector is empty, don't display the <thead> section -->
        @else
            <thead>
            
                <tr>
                 
                    <th class="nowrap text-sm">វគ្គ ឫកម្រិតសិក្សា</th>
                 
                    <th class="nowrap text-sm">គ្រឺះស្ថានសិក្សបណ្តុះបណ្តាល</th>
                 
                    <th class="nowrap text-sm">សញ្ញាបត្រដែលទទួលបាន</th>
                 
                    <th class="nowrap text-sm">ស្ថានការ</th>

                    <th class="nowrap text-sm">ថ្ងៃខែឆ្នាំចូលសិក្សា</th>
                 
                    <th class="nowrap text-sm" >ថ្ងៃខែឆ្នាំបញ្ចប់ការសិក្សា</th>
                 
                 
                </tr>
            
            </thead>
        @endif

        <tbody>
           
            @foreach ($eductionLevel as $index => $el)
            
                <tr class="additon_current_job odd gradeX">

                    <td >
                        <input type="hidden" value="{{ $el['id']}}" name="id[]">
                        
                        <div class="width">

                            <input 
                                type="text" 
                                
                                class="form-control form-control-sm" 
                                
                                name="level[]" placeholder="គ្គ ឫកម្រិតសិក្សា"  
                                
                                value="{{ $el['level'] ?? old('level.' . $index) }}">

                        </div>
                    </td>
                 
                    <td >
                        <div class="width">

                       
                        <input 
                            type="text" 
                            
                            class="form-control form-control-sm" 
                            
                            name="education_intitution[]" placeholder="គ្រឺះស្ថានសិក្សបណ្តុះបណ្តាល"  
                            
                            value="{{ $el['education_intitution'] ?? old('education_intitution.' . $index) }}">
                            </div>
                    </td>
                   
                    <td >
                        <div class="width">

                       
                        <input type="type" class="form-control form-control-sm" name="cetificate[]"  
                
                            value="{{ $el['cetificate'] ?? old('cetificate.' . $index) }}"
                            
                            placeholder="សញ្ញាបត្រដែលទទួលបាន">
                            </div>
                    </td>
                    

                    <td  style=" vertical-align: middle;" class="col-md-12">
                       <div class="width">

                     
                        <select name="status[]" class="  form-select form-select-sm numeral transaction_amount" id="status1">
                    
                            <option value="1" @if ($el['status']=="1") {{ 'selected' }} @endif>កម្រិតវប្បធម៍ទូទៅ</option>
                        
                            <option value="2" @if ($el['status']=="2") {{ 'selected' }} @endif>កម្រិតសញ្ញាបត្រ</option>

                            <option value="3" @if ($el['status']=="3") {{ 'selected' }} @endif>ជំនាញឯកទេស</option>
                        
                            <option value="4" @if ($el['status']=="4") {{ 'selected' }} @endif>វគ្គបណ្តុះបណ្តាលវិជ្ជាជីវៈ</option>
                        
                        </select>    
                        </div>                     
                    </td>
             
                    <td>
                    <div>

                  
                        <input  type="date" 
                                        
                                    name="start_date[]" 
                                    
                                    value="{{ $el['start_date'] ?? old('start_date.' . $index) }}"
                                    
                                    class="form-control form-control-sm"
                                    
                                    placeholder="ថ្ងៃ-ខែ​​​-ឆ្នាំ">    
                    
                    </td>

                    <td >
                     
                            <input  type="date" 
                                            
                                        name="end_date[]" 
                                        
                                        value="{{ $el['end_date'] ?? old('end_date.' . $index) }}"
                                        
                                        class="form-control form-control-sm"
                                        
                                        placeholder="ថ្ងៃ-ខែ​​​-ឆ្នាំ">    
                       
                    </td>
                    
                    
                </tr>
  
            @endforeach
        
        </tbody>
    
    </table>
  
</div>
<style>
    .width{
        width:250px;
    }
</style>