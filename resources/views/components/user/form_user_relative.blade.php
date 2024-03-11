
<div class="form-row">
                    
                    <div class="form-group col-md-6">
                    
                        <label class="text-sm">គោត្តនាម និង នាម </label>
                        
                        <input  type="text" 
                                
                                name="name_relative[]"

                                value="<?=old('name_relative.0')?>"
                                
                                class="form-control form-control-sm" 
                                
                                required
                                
                                placeholder="គោត្តនាម និង នាម">
                    
                    </div>

                    <div class="form-group col-md-6">
                    
                        <label class="text-sm">ជាអក្សរឡាតាំង</label>
                    
                        <input type="text" class="form-control form-control-sm" name="eng_name_relative[]" require="ជាអក្សរឡាតាំង"  value="<?= old('name_relative.0')?>" >
                    
                    </div>
                
                </div>

                <div class="form-row">
                
                    <div class="form-group col-md-6">
                    
                        <label class="text-sm">ភេទ</label>
                        
                        <input 
                            
                            type="text" class="form-control form-control-sm" placeholder="ភេទ" 
                            
                            name="relative_gender[]" 

                            required
                        
                            value="<?=old('relative_gender.0')?>">
                    
                    </div>

                    <div class="form-group col-md-6">
                    
                        <label class="text-sm">ថ្ងៃខែឆ្នាំកំណើត</label>
                        
                        <input 
                            type="date" 
                            
                            class="form-control form-control-sm" 
                            
                            name="relative_date_of_birth[]" 
                        
                            value="<?= old('relative_date_of_birth.0')?>">
                    
                    </div>
                
                </div>

                <div class="form-row">

                    <div class="form-group col-md-6">
                    
                        <label class="text-sm">មុខរបរ</label>
                        
                        <input type="text" class="form-control form-control-sm" name="relative_job[]"  
                        
                        value="<?=old('relative_job.0')?>"
                        
                        required

                          placeholder="មុខរបរ">
                
                    </div>

                </div>

        
     