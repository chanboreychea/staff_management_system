                <div class="form-row">
                    
                    <div class="form-group col-md-6">
                    
                        <label class="text-sm">ថ្ងៃខែឆ្នាំបំពេញការងារចូល</label>
                    
                        <!-- <input type="text" class="form-control-sm" placeholder="ការបរិច្ជេទចូលបំរើការងារដំបូង"> -->
                        <input  type="date"            
                                
                                name="start_date1[]" 
                                
                                value="<?=old('start_date1.0')?>"
                                
                                class="form-control-sm form-control"

                                required
                                
                                placeholder="ថ្ងៃ-ខែ​​​-ឆ្នាំ">                    
                    </div>
                    
                    <div class="form-group col-md-6">
                     
                        <label class="text-sm">ថ្ងៃខែឆ្នាំបំពេញការងារចេញ</label>
                     
                        <!-- <input type="text" class="form-control-sm" placeholder="ការបរិច្ជេទចូលបំរើការងារដំបូង"> -->
                        <input  type="date" 
                                
                                name="end_date1[]" 
                                
                                value="<?=old('end_date1.0')?>"
                                

                                class="form-control-sm form-control"
                                
                                placeholder="ថ្ងៃ-ខែ​​​-ឆ្នាំ">
                    </div>
                   
                </div>
                
                <div class="form-row">
                    
                    <div class="form-group col-md-6">
                    
                        <label class="text-sm">ក្រសួង/ស្ថាប័ន</label>
                    
                        <input  type="text" 
                                
                                class="form-control-sm form-control" 
                                
                                name="ministry1[]" 
                                
                                value="<?=old('ministry1.0')?>"

                                required

                                placeholder="ក្រសួង/ស្ថាប័ន">
                             
                    
                    </div>  
                    <div class="form-group col-md-6">
                        
                        <label class="text-sm">អង្គភាព</label>
                
                        <input  type="text" 
                                
                                class="form-control-sm form-control" 
                                
                                name="economy1[]" 
                                                    
                                value="<?=old('economy1.0')?>"

                                required
                                
                                placeholder="អង្គភាព">
                
                    </div>
                
                </div>
                
                <div class="form-row">

                    <div class="form-group col-md-6">
                    
                        <label class="text-sm">មុខតំណែង</label>
                
                        <input  type="text" 
                                
                                class="form-control-sm form-control" 
                                
                                name="position1[]" 
                                 
                                value="<?=old('position1.0')?>"

                                required
                                
                                placeholder="មុខតំណែង">
                
                    </div>
                    <div class="form-group col-md-6">
                    
                        <label class="text-sm">ផ្សេងៗ</label>
                    
                        <input  type="text" 
                        
                                class="form-control-sm form-control" 
                                
                                name="other1[]" 
                                
                                value="<?=old('other1.0')?>"

                                placeholder="ផ្សេងៗ">
                    
                    </div>
       
                </div>
            
