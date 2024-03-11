
                <div class="form-row">

                    <div class="form-group col-md-6">
                        
                        <label class="text-sm" >លេខឯកសារ</label>
                    
                        <input type="file" class="form-control form-control-sm" name="document1[]" id="document" value="<?= old('document1.0')?>" >
                    
                    </div>

                    <div class="form-group col-md-6">
                    
                        <label class="text-sm" >កាលបរិច្ឋេទ</label>
                        
                        <input  type="date" 
                                                            
                                name="date1[]"

                                value="<?=old('date1.0')?>"
                                
                                class="form-control form-control-sm" 
                                
                                placeholder="ថ្ងៃ-ខែ​​​-ឆ្នាំ">
                    
                    </div>
                
                </div>

                <div class="form-row">
                
                    <div class="form-group col-md-6">
                    
                        <label class="text-sm" >ស្ថាប័ន/អង្គភាព</label>
                        
                        <input 
                            
                            type="text" class="form-control form-control-sm" placeholder="ស្ថាប័ន/អង្គភាព" 
                            
                            name="economy1[]" 
                        
                            value="<?=old('economy1.0')?>">
                    
                    </div>

                    <div class="form-group col-md-6">
                    
                        <label class="text-sm" >ខ្លឺមសារ</label>
                        
                        <input 
                            type="text" 
                            
                            class="form-control form-control-sm" 
                            
                            name="decription1[]" placeholder="ខ្លឺមសារ"  
                        
                            value="<?= old('decription1.0')?>">
                    
                    </div>
                
                </div>

                <div class="form-row">

                    <div class="form-group col-md-6">
                    
                        <label class="text-sm" >ប្រភេទ</label>
                        
                        <input type="type" class="form-control form-control-sm" name="type1[]"  
                        
                        value="<?=old('type1.0')?>"
                        
                        placeholder="ប្រភេទ">
                
                    </div>

                    <div class="form-group col-md-6">
                    
                    <label class="text-sm" >សូមជ្រើសរើស</label>
                    
                    <select name="status1[]" class="form-select form-select-sm">
               
                         <option value="1" {{ in_array('1', old('status1', [])) ? 'selected' : '' }}>គ្រឿងឥស្សរិយយស ប័ណ្ណសរសើរ</option>
                    
                         <option value="2" {{ in_array('2', old('status1', [])) ? 'selected' : '' }}>ទ័ណ្ខកម្មវិន័យ</option>
                    </select>

                    <!-- <select name="status1[]" class="form-control form-control-sm">
                
                    
                        <option value="1" @if (old('status1') == "1") {{ 'selected' }} @endif>គ្រឿងឥស្សរិយយស ប័ណ្ណសរសើរ</option>
                    
                        <option value="2" @if (old('status1') == "2") {{ 'selected' }} @endif>ទ័ណ្ខកម្មវិន័យ</option>
                    
                    </select> -->
                
                    </div>

                </div>

        
     