
<div class="form-row">
                    
                    <div class="form-group col-md-6">
                    
                        <label >ថ្ងៃ-ខែ​​​-ឆ្នាំ​</label>
                        
                        <input  type="date" 
                                
                                id="date_additional_position_on_current_job" 
                                
                                name="date_additional_position_on_current_job[]"

                                value="<?= !empty($user_information)?$user_information->date_additional_position_on_current_job:old('date_additional_position_on_current_job.0')?>"
                                
                                class="form-control form-control-sm" 
                                
                                required
                                
                                placeholder="ថ្ងៃ-ខែ​​​-ឆ្នាំ">
                    
                    </div>

                    <div class="form-group col-md-6">
                    
                        <label >ឯកសារ</label>
                    
                        <input type="file" class="form-control form-control-sm" name="document[]" id="document" value="<?= !empty($user_information)?$user_information->document:old('document.0')?>" >
                    
                    </div>
                
                </div>

                <div class="form-row">
                
                    <div class="form-group col-md-6">
                    
                        <label >មុខតំណែង</label>
                        
                        <input 
                            
                            type="text" class="form-control form-control-sm" placeholder="មុខតំណែង" 
                            
                            name="position_additional_position_on_current_job[]" 

                            required
                        
                            value="<?= !empty($user_information)?$user_information->position_additional_position_on_current_job:old('position_additional_position_on_current_job.0')?>">
                    
                    </div>

                    <div class="form-group col-md-6">
                    
                        <label >ឋានៈស្មើ</label>
                        
                        <input 
                            type="text" 
                            
                            class="form-control form-control-sm" 
                            
                            name="equivalent[]" id="equivalent" placeholder="ថានៈរស្មី"  

                            required
                        
                            value="<?= !empty($user_information)?$user_information->equivalent:old('equivalent.0')?>">
                    
                    </div>
                
                </div>

                <div class="form-row">

                    <div class="form-group col-md-6">
                    
                        <label >អង្គភាព</label>
                        
                        <input type="text" class="form-control form-control-sm" name="economy_additional_position_on_current_job[]"  
                        
                        value="<?= !empty($user_information)?($user_information->economy_additional_position_on_current_job):old('economy_additional_position_on_current_job.0')?>"
                        
                        required

                        id="economy_additional_position_on_current_job"  placeholder="អង្គភាព">
                
                    </div>

                </div>

        
     