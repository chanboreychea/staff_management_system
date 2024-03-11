<div class="form-row">
                    
                    <div class="form-group col-md-6">
                    
                        <label class="text-sm">ថ្ងៃខែឆ្នាំបំពេញការងារចូល</label>
                    
                        <!-- <input type="text" class="form-control form-control-sm" placeholder="ការបរិច្ជេទចូលបំរើការងារដំបូង"> -->
                        <input  type="date"            
                                
                                name="start_date_ps1[]" 
                                
                                value="<?=old('start_date_ps1.0')?>"
                                
                                class="form-control form-control-sm"

                                required
                                
                                placeholder="ថ្ងៃ-ខែ​​​-ឆ្នាំ">                    
                    </div>
                    
                    <div class="form-group col-md-6">
                     
                        <label class="text-sm">ថ្ងៃខែឆ្នាំបំពេញការងារចេញ</label>
                     
                        <!-- <input type="text" class="form-control form-control-sm" placeholder="ការបរិច្ជេទចូលបំរើការងារដំបូង"> -->
                        <input  type="date" 
                                
                                name="end_date_ps1[]" 
                                
                                value="<?=old('end_date_ps1.0')?>"
                                
                                required

                                class="form-control form-control-sm"
                                
                                placeholder="ថ្ងៃ-ខែ​​​-ឆ្នាំ">
                    </div>
                   
                </div>
                
                <div class="form-row">
                    
                    <div class="form-group col-md-6">
                    
                    <label class="text-sm">មុខតំណែង</label>
                
                        <input  type="text" 
                        
                        class="form-control form-control-sm" 
                        
                        name="position_ps1[]" 
                         
                        value="<?=old('position_ps1.0')?>"

                        required
                        
                        placeholder="មុខតំណែង">
                    
                    </div>  
                    <div class="form-group col-md-6">
                        
                        <label class="text-sm">អង្គភាព</label>
                
                        <input  type="text" 
                                
                                class="form-control form-control-sm" 
                                
                                name="economy_ps1[]" 
                                                    
                                value="<?=old('economy_ps1.0')?>"

                                required
                                
                                placeholder="អង្គភាព">
                
                    </div>
                
                </div>
                
                <div class="form-row">

                    <div class="form-group col-md-6">
                    
                       
                        <label class="text-sm">បច្ចេកទេស</label>
                    
                        <input  type="text" 
                            
                            class="form-control form-control-sm" 
                            
                            name="tecnology_ps1[]" 
                            
                            value="<?=old('tecnology_ps1.0')?>"

                            required

                            placeholder="បច្ចេកទេស">
                
                    </div>
                    <div class="form-group col-md-6">
                    
                        <label class="text-sm">ផ្សេងៗ</label>
                    
                        <input  type="text" 
                        
                                class="form-control form-control-sm" 
                                
                                name="other_ps1[]" 
                                
                                value="<?=old('other_ps1.0')?>"

                                
                                placeholder="ផ្សេងៗ">
                    
                    </div>
       
                </div>
            
