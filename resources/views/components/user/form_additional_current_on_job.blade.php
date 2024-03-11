
                <div class="form-row">
                    
                    <div class="form-group col-md-6">
                    
                        <label class="text-sm">ថ្ងៃ-ខែ​​​-ឆ្នាំ​</label>
                        
                        <input  type="date" 
                                
                                
                                name="date_additional_position_on_current_job1[]"

                                value="<?=old('date_additional_position_on_current_job1.0')?>"
                                
                                class="form-control form-control-sm" 
                            
                                placeholder="ថ្ងៃ-ខែ​​​-ឆ្នាំ">
                    
                    </div>

                    <div class="form-group col-md-6">
                    
                        <label class="text-sm">ឯកសារ</label>
                    
                        <input type="file" class="form-control form-control-sm" name="document1[]" id="document" value="<?= old('document1.0')?>" >
                    
                    </div>
                
                </div>

                <div class="form-row">
                
                    <div class="form-group col-md-6">
                    
                        <label class="text-sm">មុខតំណែង</label>
                        
                        <input 
                            
                            type="text" class="form-control form-control-sm" placeholder="មុខតំណែង" 
                            
                            name="position_additional_position_on_current_job1[]" 

                            required 

                            value="<?=old('position_additional_position_on_current_job1.0')?>">
                    
                    </div>

                    <div class="form-group col-md-6">
                    
                        <label class="text-sm">ឋានៈស្មើ</label>
                        
                        <input 
                            type="text" 
                            
                            class="form-control form-control-sm" 
                            
                            name="equivalent1[]" placeholder="ថានៈរស្មី"  

                        
                            value="<?= old('equivalent1.0')?>">
                    
                    </div>
                
                </div>

                <div class="form-row">

                    <div class="form-group col-md-6">
                    
                        <label class="text-sm">អង្គភាព</label>
                        
                        <input type="text" class="form-control form-control-sm" name="economy_additional_position_on_current_job1[]"  
                        
                        value="<?=old('economy_additional_position_on_current_job1.0')?>"

                          placeholder="អង្គភាព">
                
                    </div>

                </div>

        
     