

<div class="table-responsive-sm" style="overflow-x: auto;">

    <!-- <table id="example1"  class="display nowrap table table-bordered"> -->
    <table id="example" class="display table  table-bordered" style="width:100%">

        <tbody>
            <tr>
             
            @if(isset($userFamily) )
            
                    <?php
                        $children_name = unserialize($userFamily->children_name);

                        $count_children_name = is_array($children_name) ? count($children_name) : 0;

                        $children_name_in_english = unserialize($userFamily->children_name_in_english);

                        $count_children_name_in_english = is_array($children_name_in_english) ? count($children_name_in_english) : 0;

                        $children_gender = unserialize($userFamily->children_gender);

                        $count_children_gender = is_array($children_gender) ? count($children_gender) : 0;

                        $children_job = unserialize($userFamily->children_job);
                        
                        $count_children_job = is_array($children_job) ? count($children_job) : 0;

                        $children_allowance = unserialize($userFamily->children_allowance);

                        $count_children_allowance = is_array($children_allowance) ? count($children_allowance) : 0;

                        $children_date = unserialize($userFamily->children_date);

                        $count_children_date = is_array($children_date) ? count($children_date) : 0;

                        $counts=[
                        
                            $count_children_name ,
                        
                            $count_children_name_in_english,
                        
                            $count_children_gender,
                        
                            $count_children_job,
                            
                            $count_children_allowance,
                        
                            $count_children_date
                        
                        ];
                      
                        $max_count = max($counts);

                        // echo 'Maximum count: ' . $max_count;

                        ?>
                  
                @if ($max_count>0)
                          
                    <tr>
                        <th class="nowrap text-sm">គោត្តនាម និង នាម</th>
                        @if($userFamily->children_name)
                            @foreach(unserialize($userFamily->children_name) as $relative)
                                <td>
                                    <div class="width">
                                    
                                        <input 
                                        
                                        type="text" 
                                        
                                        class="form-control form-control-sm" 
                                        
                                        name="c_name[]" 
                                        
                                        placeholder="គោត្តនាម ឫកម្រិតសិក្សា"  
                                        
                                        value="{{ $relative }}">
                                    
                                    
                                    </div>
                                                    
                                </td>
                            @endforeach              
                        @endif
                        @for($i=$count_children_name;$i<$max_count;$i++)
                                
                                <td>
                                        <div class="width">
                                        
                                            <input 
                                            
                                            type="text" 
                                            
                                            class="form-control form-control-sm" 
                                            
                                            name="c_name[]" 
                                            
                                            placeholder="គោត្តនាម ឫកម្រិតសិក្សា"  

                                            required
                                            
                                            value="<?= old('c_name')?>">
                                        
                                        
                                        </div>
                                                        
                                    </td>
                            @endfor 
                        
                    </tr>
                
                    <tr>
                        <th class="nowrap text-sm">ជាអក្សរឡាតាំង</th>
                        
                        @if($userFamily->children_name_in_english)
                        
                            @foreach(unserialize($userFamily->children_name_in_english) as $relative)
                            
                                <td>
                                
                                    <div class="width">
                                    
                                        <input 
                                            
                                            type="text" 
                                            
                                            class="form-control form-control-sm" 
                                            
                                            name="c_eng_name[]" 
                                            
                                            placeholder="ជាអក្សរឡាតាំង"  
                                            
                                            value="{{ $relative }}">     
                                    </div>       
                                
                                </td>
                        
                            @endforeach
                        
                        @endif
                        @for($i=$count_children_name_in_english;$i<$max_count;$i++)
                            <td>
                                
                                <div class="width">
                                
                                        <input 
                                        
                                        type="text" 
                                        
                                        class="form-control form-control-sm" 
                                        
                                        name="c_eng_name[]" 
                                        
                                        placeholder="ជាអក្សរឡាតាំង"  
                                        
                                        name="c_eng_name[]" value="<?= empty(old('c_eng_name.0')) ? null : old('c_eng_name.0') ?>" 

                                        value="{{ $relative }}">     
                                </div>       
                            
                            </td>
                        @endfor
                    </tr>
                    
                    <tr>
                    <th class="nowrap text-sm">ភេទ</th>
                        @if($userFamily->children_gender)

                            @foreach(unserialize($userFamily->children_gender) as $relative)
                                <td>
                                
                                    <div class="width">
                                    
                                        <input 
                                            type="text" 
                                        
                                            class="form-control form-control-sm" 
                                        
                                            name="c_gender[]" 
                                        
                                            placeholder=" ភេទ"  

                                            required

                                            value="{{ $relative }}">    
                                    </div>            
                                
                                </td>

                            @endforeach
                        
                        @endif
                        @for($i=$count_children_gender;$i<$max_count;$i++)
                            <td>
                                
                                <div class="width">
                                
                                    <input 
                                        type="text" 
                                    
                                        class="form-control form-control-sm" 
                                    
                                        name="c_gender[]" 
                                    
                                        placeholder="ភេទ"  
                                    
                                        value="<?= old('c_gender')?>">    
                                </div>            
                            
                            </td>
                        @endfor
                    </tr>
                    
                    <tr>
                        
                        <th class="nowrap text-sm">មុខរបរ</th>
                        
                        @if($userFamily->children_job)
                        
                            @foreach(unserialize($userFamily->children_job) as $relative)
                            
                                <td>
                                
                                    <div class="width">
                                    
                                        <input 
                                            type="text" 
                                        
                                            class="form-control form-control-sm" 
                                        
                                            name="c_job[]" 
                                        
                                            placeholder="មុខរបរ"  
                                        
                                            value="{{ $relative }}">    
                                    </div>            
                                </td>
                            
                                @endforeach

                            @endif
                            @for($i=$count_children_job;$i<$max_count;$i++)
                            <td>
                                
                                    <div class="width">
                                    
                                        <input 
                                            type="text" 
                                        
                                            class="form-control form-control-sm" 
                                        
                                            name="c_job[]" 
                                        
                                            placeholder="មុខរបរ"  
                                        
                                            value="<?= old('c_job')?>">    
                                    </div>            
                                </td>
                        @endfor
                    </tr>

                    <tr>
                        
                        <th class="nowrap text-sm">ថ្ងៃខែឆ្នាំកំណើត</th>

                        @if($userFamily->children_date)
                            
                            @foreach(unserialize($userFamily->children_date) as $relative)
                            
                                <td>
                            
                                <div class="width">
                                        <input 
                                            type="date" 
                                        
                                            class="form-control form-control-sm" 
                                        
                                            name="c_date[]" 
                                        
                                            placeholder="គ្គ ឫកម្រិតសិក្សា"  
                                        
                                            value="{{ $relative }}">   
                                    </div> 
                                            
                                </td>
                            
                            @endforeach
                        
                        @endif
                        @for($i=$count_children_date;$i<$max_count;$i++)
                            <td>
                                
                                    <div class="width">
                                        <input 
                                            type="date" 
                                        
                                            class="form-control form-control-sm" 
                                        
                                            name="c_date[]" 
                                        
                                            placeholder="គ្គ ឫកម្រិតសិក្សា"  
                                        
                                            value="{{ $relative }}">   
                                    </div>        
                                </td>
                        @endfor
                        @for($i=$count_children_allowance;$i<$max_count;$i++)
                            <td>
                                
                                    <div class="width">
                                        <input 
                                            type="date" 
                                        
                                            class="form-control form-control-sm" 
                                        
                                            name="c_allowance[]" 
                                        
                                            placeholder="ប្រាក់ឧបត្ថម្ភ"  
                                        
                                            value="{{ $relative }}">   
                                    </div>        
                                </td>
                        @endfor
                            
                    </tr>
                @else
                    {{''}}
                @endif
            @endif


        
            </tr>   
           
        
        </tbody>
    
    </table>
  
</div>
<style>
    .width{
        width:250px;
    }
</style>