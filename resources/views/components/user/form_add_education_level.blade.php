    <div class="form-row">
        
        <div class="form-group col-md-6">
        
            <label class="text-sm" >ថ្ងៃចាប់ផ្តើម</label>
            
            <input 
                
                type="date" class="form-control form-control-sm" 
                
                name="start_date1[]" 
            
                value="<?=old('start_date1.0')?>">
        
        </div>

        <div class="form-group col-md-6">
        
            <label class="text-sm" >ថ្ងៃបញ្ចប់</label>
            
            <input 
                type="date" 
                
                class="form-control form-control-sm" 
                
                name="end_date1[]" placeholder="ថ្ងៃបញ្ចប់"  
            
                value="<?= old('end_date1.0')?>">
        
        </div>
    
    </div>

    <div class="form-row">
    
        <div class="form-group col-md-6">
        
            <label class="text-sm" >វគ្គ ឫកម្រិតសិក្សា</label>
            
            <input 
                
                type="text" class="form-control form-control-sm" placeholder="វគ្គ ឫកម្រិតសិក្ស" 
                
                name="level1[]" 
            
                value="<?=old('level1.0')?>">
        
        </div>

        <div class="form-group col-md-6">
        
            <label class="text-sm" >គ្រឺះស្ថានសិក្សបណ្តុះបណ្តាល</label>
            
            <input 
                type="text" 
                
                class="form-control form-control-sm" 
                
                name="education_intitution1[]" placeholder="គ្រឺះស្ថានសិក្សបណ្តុះបណ្តាល"  
            
                value="<?= old('education_intitution1.0')?>">
        
        </div>
    
    </div>

    <div class="form-row">

        <div class="form-group col-md-6">
        
            <label class="text-sm" >សញ្ញាបត្រដែលទទួលបាន</label>
            
            <input type="type" class="form-control form-control-sm" name="cetificate1[]"  
            
            value="<?=old('cetificate1.0')?>"
            
            placeholder="សញ្ញាបត្រដែលទទួលបាន">
    
        </div>

        <div class="form-group col-md-6">
        
            <label class="text-sm" >សូមជ្រើសរើស</label>
            
            <select name="status1[]" class="form-select form-select-sm">
        
                <option value="1" {{ in_array('1', old('status1', [])) ? 'selected' : '' }}>កម្រិតវប្បធម៍ទូទៅ</option>
        
                <option value="2" {{ in_array('2', old('status1', [])) ? 'selected' : '' }}>កម្រិតសញ្ញាបត្រ</option>

                <option value="3" {{ in_array('3', old('status1', [])) ? 'selected' : '' }}>ជំនាញឯកទេស</option>
        
                <option value="4" {{ in_array('4', old('status1', [])) ? 'selected' : '' }}>វគ្គបណ្តុះបណ្តាលវិជ្ជាជីវៈ</option>
            
            </select>

        </div>

    </div>

        
     