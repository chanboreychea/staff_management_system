   

    <div class="form-row">
    
        <div class="form-group col-md-6">
        
            <label class="text-sm">ភាសា</label>
            
            <input 
                
                type="text" class="form-control form-control-sm" placeholder="ភាសា" 
                
                name="language1[]" 

                required
            
                value="<?=old('language1.0')?>">
        
        </div>

        <div class="form-group form-group-sm col-md-6">
        
            <label class="text-sm">អាន</label>
            
           
            @component('components.user_select_form.select_ablity_language',['name'=>'read1'])
                            <!-- select -->
             @endcomponent
           
        
        </div>
    
    </div>

    <div class="form-row">

        <div class="form-group col-md-6">
        
            <label class="text-sm">សរសេរ</label>
            
               
            @component('components.user_select_form.select_ablity_language',['name'=>'write1'])
                            <!-- select -->
             @endcomponent
           
    
        </div>

        <div class="form-group col-md-6">
        
            <label class="text-sm">និយាយ</label>
            
                
            @component('components.user_select_form.select_ablity_language',['name'=>'speak1'])
                            <!-- select -->
             @endcomponent
           

        </div>


    </div>
    <div class="form-row">

        <div class="form-group col-md-6">

            <label class="text-sm">ស្តាប់</label>
            
            @component('components.user_select_form.select_ablity_language',['name'=>'listen1'])
                            <!-- select -->
            @endcomponent
        

        </div>

    </div>

        
     