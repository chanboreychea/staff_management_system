
                <div class="form-row">
                    
                    <div class="form-group col-md-6">
                    
                        <label class="text-sm">គោត្តនាម និង នាម</label>
                        
                        <input  type="text" 
                                
                                name="c_name[]"

                                value="<?=old('c_name.0')?>"
                                
                                class="form-control form-control-sm" 
                                
                                required
                                
                                placeholder="គោត្តនាម និង នាម">
                    
                    </div>

                    <div class="form-group col-md-6">
                    
                        <label class="text-sm">ជាអក្សរឡាតាំង</label>
                        
                        <input type="text" placehorder="ជាអក្សរឡាតាំង" class="form-control form-control-sm" name="c_eng_name[]" value="<?= empty(old('c_eng_name.0')) ? null : old('c_eng_name.0') ?>" >

                    </div>
                
                </div>

                <div class="form-row">
                
                    <div class="form-group col-md-6">
                    
                        <label class="text-sm">ភេទ</label>
                        
                        <input 
                            
                            type="text" class="form-control form-control-sm" placeholder="ភេទ" 
                            
                            name="c_gender[]" 

                            required
                        
                            value="<?=old('c_gender.0')?>">
                    
                    </div>

                    <div class="form-group col-md-6">
                    
                        <label class="text-sm">ថ្ងៃខែឆ្នាំកំណើត</label>
                        
                        <input 
                            type="date" 
                            
                            class="form-control form-control-sm" 
                            
                            name="c_date[]" 

                            value="<?= empty(old('c_date.0')) ? null : old('c_date.0') ?>">
                    
                    </div>
                
                </div>

                <div class="form-row">

                    <div class="form-group col-md-6">
                    
                        <label class="text-sm">មុខរបរ</label>
                        
                        <input type="text" class="form-control form-control-sm" name="c_job[]"  
                        
                        value="<?=old('c_job.0')?>"
                        
                        required

                        placeholder="មុខរបរ">
                
                    </div>
                    <div class="form-group col-md-6">
                    
                        <label class="text-sm">ប្រាក់ឧបត្ថម្ភ</label>
                        
                        <input type="text" class="form-control form-control-sm" name="c_allowance[]"  
                        
                        value="<?=old('c_job.0')?>"
                        
                        required

                        placeholder="មុខរបរ">
                
                    </div>
                    

                </div>

                