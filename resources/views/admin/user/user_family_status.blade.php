@extends('template.master')
@section('title', 'User')
@section('content')

    <div class="form-main">
        
        <div class="form-content">
                    <!-- ​​ព័ត៍មានអំពីស្ថានភាព -->
            <center> <h2 class="form-top-header"><u>ស្ថានភាពគ្រួសារ</u></h2> <br></center>
            <h4 class="form-header"><i class="fas fa-address-book"></i> ព័ត៍មានឪពុកម្តាយ</h4> <br>
            
            <form class="form-horizontal">
                
                <div class="form-row">
                    
                    <div class="form-group col-md-6">
                    
                        <label>ឈ្មោះឪពុក</label>
                    
                        <input type="text" class="form-control" placeholder="វគ្គឫកម្រិតសិក្សា">
                                      
                    </div>
                    
            
                    <div class="form-group col-md-6">
                    
                        <label>ថ្ងៃខែឆ្នាំកំណើត</label>
                    
                        <input type="email" class="form-control" placeholder="សញ្ញាបត្រដែលទទូលបាន">
                    
                    </div>  
                   
                </div>
                
                <div class="form-row">
                       
                    <div class="form-group col-md-6">
                        
                        <label>ទីលំនៅបច្ចុប្បន្ន</label>
                
                        <input type="password" class="form-control" placeholder="ថ្ងៃខែឆ្នាំចូលសិក្សា">
                
                    </div>
                    <div class="form-group col-md-6">
                    
                        <label>មុខរបរ</label>
                    
                        <input type="text" class="form-control" placeholder="ថ្ងៃខែឆ្នាំបញ្ចប់ការសិក្សា">
                    
                    </div>
                  
                </div>
               
                <br>
                <div class="form-row">
                    
                    <div class="form-group col-md-6">
                    
                        <label>ឈ្មោះម្តាយ</label>
                    
                        <input type="text" class="form-control" placeholder="វគ្គឫកម្រិតសិក្សា">
                                      
                    </div>
                    
                    <div class="form-group col-md-6">
                    
                        <label>ថ្ងៃខែឆ្នាំកំណើត</label>
                    
                        <input type="email" class="form-control" placeholder="សញ្ញាបត្រដែលទទូលបាន">
                    
                    </div>  
                   
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-6">
                    
                        <label>ទីលំនៅបច្ចុប្បន្ន</label>
                
                        <input type="password" class="form-control" placeholder="ថ្ងៃខែឆ្នាំចូលសិក្សា">
                
                    </div>
                    <div class="form-group col-md-6">
                    
                        <label>មុខរបរ</label>
                    
                        <input type="text" class="form-control" placeholder="ថ្ងៃខែឆ្នាំបញ្ចប់ការសិក្សា">
                    
                    </div>
                  
                </div>
                <h4 class="form-header"><i class="fas fa-address-book"></i> ព័ត៍មានបងប្អូន</h4> <br>
                <div class="form-row">
                    
                    <div class="form-group col-md-6">
                    
                        <label>គោត្តនាម​ និង​ នាម</label>
                    
                        <input type="email" class="form-control" placeholder="សញ្ញាបត្រដែលទទូលបាន">
                    
                    </div>  
                    
                    <div class="form-group col-md-6">
                
                        <label>ទីលំនៅបច្ចុប្បន្ន</label>
                
                        <input type="password" class="form-control" placeholder="ថ្ងៃខែឆ្នាំចូលសិក្សា">
                
                    </div>
                   
                </div>
                <div class="form-row">
                    
                    <div class="form-group col-md-6">
                    
                        <label>ភេទ</label>
                    
                        <input type="email" class="form-control" placeholder="សញ្ញាបត្រដែលទទូលបាន">
                    
                    </div>  
                    
                    <div class="form-group col-md-6">
                
                        <label>ថ្ងៃខែឆ្នាំកំណើត</label>
                
                        <input type="password" class="form-control" placeholder="ថ្ងៃខែឆ្នាំចូលសិក្សា">
                
                    </div>
                   
                </div>
                <div class="form-row">
                    
                    <div class="form-group col-md-6">
                    
                        <label>មុខរបរ</label>
                    
                        <input type="email" class="form-control" placeholder="សញ្ញាបត្រដែលទទូលបាន">
                    
                    </div>  
                    
                </div>
                <h4 class="form-header"><i class="fas fa-address-book"></i> ព័ត៍មានសហព័ន្ធ</h4> <br>
                <div class="form-row">
                    
                    <div class="form-group col-md-6">
                    
                        <label>ឈ្មោះប្តី​ ឫ​ ប្រពន្ធ</label>
                    
                        <input type="email" class="form-control" placeholder="សញ្ញាបត្រដែលទទូលបាន">
                    
                    </div>  
                    
                    <div class="form-group col-md-6">
                
                        <label>ថ្ងៃខែឆ្នាំកំណើត</label>
                
                        <input type="password" class="form-control" placeholder="ថ្ងៃខែឆ្នាំចូលសិក្សា">
                
                    </div>
                   
                </div>
                <div class="form-row">
                    
                    <div class="form-group col-md-6">
                    
                        <label>ភេទ</label>
                    
                        <input type="email" class="form-control" placeholder="សញ្ញាបត្រដែលទទូលបាន">
                    
                    </div>  
                    
                    <div class="form-group col-md-6">
                
                        <label>ថ្ងៃខែឆ្នាំកំណើត</label>
                
                        <input type="password" class="form-control" placeholder="ថ្ងៃខែឆ្នាំចូលសិក្សា">
                
                    </div>
                   
                </div>
                <div class="form-row">
                    
                    <div class="form-group col-md-6">
                    
                        <label>មុខរបរ</label>
                    
                        <input type="email" class="form-control" placeholder="សញ្ញាបត្រដែលទទូលបាន">
                    
                    </div>  
                    
                </div>

              
                
                <button type="submit" class="btn btn-submit ">Create Account</button> 
                
            </form>
        <div>
    </div>
  

@endsection