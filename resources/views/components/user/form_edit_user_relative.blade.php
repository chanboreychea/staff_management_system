

<div class="table-responsive-sm" style="overflow-x: auto;">

    <!-- <table id="example1"  class="display nowrap table table-bordered"> -->
    <table id="example" class="display table  table-bordered" style="width:100%">        
                  
        <tbody>
             
            @if(isset($userFamily) && !is_null($userFamily))
            <?php
                        $relative_name = unserialize($userFamily->relative_name);

                        $count_relative_name = is_array($relative_name) ? count($relative_name) : 0;

                        $relative_name_in_english = unserialize($userFamily->relative_name_in_english);

                        $count_relative_name_in_english = is_array($relative_name_in_english) ? count($relative_name_in_english) : 0;

                        $relative_gender = unserialize($userFamily->relative_gender);

                        $count_relative_gender = is_array($relative_gender) ? count($relative_gender) : 0;

                        $relative_job = unserialize($userFamily->relative_job);
                        
                        $count_relative_job = is_array($relative_job) ? count($relative_job) : 0;

                        $relative_date = unserialize($userFamily->relative_date);

                        $count_relative_date = is_array($relative_date) ? count($relative_date) : 0;

                        $counts=[
                        
                            $count_relative_name ,
                        
                            $count_relative_name_in_english,
                        
                            $count_relative_gender,
                        
                            $count_relative_job, 
                        
                            $count_relative_date
                        
                        ];
                      
                        $max_count = max($counts);

                        // echo 'Maximum count: ' . $max_count;

                        ?>
                @if ($max_count>0 && $userFamily->relative_name!="N;" )
                    <tr>
                        
                        <th class="nowrap text-sm">គោត្តនាម និង នាម</th>
                        
                        @if($userFamily->relative_name)
                            
                            @foreach(unserialize($userFamily->relative_name) as $relative)
                            
                                <td>
                                
                                    <div class="width">
                                    
                                        <input 
                                        
                                            type="text" 
                                    
                                            class="form-control form-control-sm" 
                                    
                                            name="name_relative[]" 
                                    
                                            placeholder="គ្គ ឫកម្រិតសិក្សា"  
                                    
                                            value="{{ $relative }}">
                                    </div>
                                                    
                                </td>
                            
                            @endforeach
                        
                        @endif
                        @for($i=$count_relative_name;$i<$max_count;$i++)
                                
                            <td>
                                    <div class="width">
                                    
                                        <input 
                                        
                                        type="text" 
                                        
                                        class="form-control form-control-sm" 
                                        
                                        name="name_relative[]" 
                                        
                                        placeholder="គោត្តនាម ឫកម្រិតសិក្សា"  

                                        required
                                        
                                        value="<?= old('name_relative')?>">
                                    
                                    
                                    </div>
                                                    
                                </td>
                        @endfor 
                        
                    </tr>
                    <tr>
                        <th class="nowrap text-sm">ជាអក្សរឡាតាំង</th>
                        @if($userFamily->relative_name_in_english)
                            @foreach(unserialize($userFamily->relative_name_in_english) as $relative)
                            
                                <td>
                                
                                    <div class="width">
                                    
                                        <input 
                                        
                                            type="text" 
                                            
                                            class="form-control form-control-sm" 
                                            
                                            name="eng_name_relative[]" 
                                            
                                            placeholder=" ជាអក្សរឡាតាំង"  
                                            
                                            value="{{ $relative }}">     
                                    </div>           
                                
                                </td>
                            
                            @endforeach
                        
                        @endif
                        @for($i=$relative_name_in_english;$i<$max_count;$i++)
                                
                                <td>
                                        <div class="width">
                                        
                                        <input 
                                        
                                        type="text" 
                                        
                                        class="form-control form-control-sm" 
                                        
                                        name="eng_name_relative[]" 
                                        
                                        placeholder="ជាអក្សរឡាតាំង"  
                                        
                                        value="<?= old('eng_name_relative')?>"> 
                                        
                                        
                                        </div>
                                                        
                                    </td>
                            @endfor 
                    
                    </tr>
                    
                    <tr>
                    
                        <th class="nowrap text-sm">ភេទ</th>
                        @if($userFamily->relative_gender)
                            
                            @foreach(unserialize($userFamily->relative_gender) as $relative)
                                
                                <td>
                                    
                                    <div class="width">
                                        <input 
                                            
                                            type="text" 
                                        
                                            class="form-control form-control-sm" 
                                        
                                            name="relative_gender[]" 
                                        
                                            placeholder="ភេទ"  
                                        
                                            value="{{ $relative }}">    
                                    </div>            
                                </td>
                        
                            @endforeach
                        
                        @endif
                        @for($i=$count_relative_gender;$i<$max_count;$i++)
                                
                                <td>
                                        <div class="width">
                                        <input 
                                            
                                            type="text" 
                                        
                                            class="form-control form-control-sm" 
                                        
                                            name="relative_gender[]" 
                                        
                                            placeholder="ភេទ"  
                                        
                                            value="<?= old('relative_gender')?>">    
                                        
                                        
                                        </div>
                                                        
                                    </td>
                            @endfor 
                    </tr>
                    
                    <tr>
                        <th class="nowrap text-sm">មុខរបរ</th>
                    
                        @if($userFamily->relative_job)
                    
                            @foreach(unserialize($userFamily->relative_job) as $relative)
                                <td>
                                    
                                    <div class="width">
                                        
                                        <input 
                                        
                                            type="text" 
                                            
                                            class="form-control form-control-sm" 
                                            
                                            name="relative_job[]" 
                                            
                                            placeholder="មុខរបរ"  
                                            
                                            value="{{ $relative }}">    
                                
                                    </div>            
                    
                                </td>
                    
                            @endforeach
                
                        @endif
                        @for($i=$count_relative_job;$i<$max_count;$i++)
                                
                                <td>
                                        <div class="width">
                                        <input 
                                        
                                        type="text" 
                                        
                                        class="form-control form-control-sm" 
                                        
                                        name="relative_job[]" 
                                        
                                        placeholder="មុខរបរ"  
                                        
                                        value="{{ $relative }}">    
                                        
                                        
                                        </div>
                                                        
                                    </td>
                            @endfor 
            
                    </tr>
            
                    <tr>
            
                        <th class="nowrap text-sm">ថ្ងៃខែឆ្នាំកំណើត</th>
                
                        @if($userFamily->relative_date)
                
                            @foreach(unserialize($userFamily->relative_date) as $relative)
                               
                                    <td>
                                        <div class="width">     
                                        <input 
                                            type="date" 
                                            
                                            class="form-control form-control-sm" 
                                            
                                            name="relative_date_of_birth[]" 
                                            
                                            value="{{ $relative }}">    
                                                
                                        </div>
                                    </td>
                               
                            @endforeach
                        @endif  
                        @for($i=$count_relative_date;$i<$max_count;$i++)
                                
                                <td>
                                        <div class="width">

                                        <input 
                                        type="date" 
                                        
                                        class="form-control form-control-sm" 
                                        
                                        name="relative_date_of_birth[]" 
                                        
                                        value="{{ $relative }}">     
                                        
                                        
                                        </div>
                                                        
                                    </td>
                            @endfor 
                    </tr>
                    
                    @else
                    {{''}}
                @endif
            @endif


        
          
        
        </tbody>
    
    </table>
  
</div>
<style>
    .width{
        width:250px;
    }
</style>