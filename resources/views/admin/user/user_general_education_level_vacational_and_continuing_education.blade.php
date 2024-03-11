@extends('template.master')
@section('title', 'User')
@section('content')

    <div class="form-main">
        
        <div class="form-content">
                    <!-- ​​ព័ត៍មានអំពីស្ថានភាព -->
            <center> <h2 class="form-top-header"><u> កម្រិតវប្បធម៍ទូទៅ ការបណ្តុះបណ្តាលវិជ្ជាជីវ និងការបណ្តុះបណ្តាលបន្ត</u></h2> <br></center>
            <!-- <h4 class="form-header"><i class="fas fa-address-book"></i>  គ្រឿងឥស្សរិយយស ប័ណ្ណសរសើរ ឬទណ្ខកម្មវិន័យ</h4> <br> -->
            
            <form class="form-horizontal">
                
                <div class="form-row">
                    
                    <div class="form-group col-md-6">
                    
                        <label>វគ្គឫកម្រិតសិក្សា</label>
                    
                        <input type="text" class="form-control" placeholder="វគ្គឫកម្រិតសិក្សា">
                                      
                    </div>
                    
                    <div class="form-group col-md-6">
                     
                        <label>គ្រឺះស្ថានសិក្សាបណ្តុះបណ្តាល</label>
                     
                        <input type="text" class="form-control" placeholder="គ្រឺះស្ថានសិក្សាបណ្តុះបណ្តាល">
                       
                    </div>
                   
                </div>
                
                <div class="form-row">
                    
                    <div class="form-group col-md-6">
                    
                        <label>សញ្ញាបត្រដែលទទូលបាន</label>
                    
                        <input type="email" class="form-control" placeholder="សញ្ញាបត្រដែលទទូលបាន">
                    
                    </div>  
                    
                    <div class="form-group col-md-6">
                
                        <label>ថ្ងៃខែឆ្នាំចូលសិក្សា</label>
                
                        <input type="password" class="form-control" placeholder="ថ្ងៃខែឆ្នាំចូលសិក្សា">
                
                    </div>
                   
                </div>
                
                <div class="form-row">
                    
                    <div class="form-group col-md-6">
                    
                        <label>ថ្ងៃខែឆ្នាំបញ្ចប់ការសិក្សា</label>
                    
                        <input type="text" class="form-control" placeholder="ថ្ងៃខែឆ្នាំបញ្ចប់ការសិក្សា">
                    
                    </div>
                    
                    <div class="form-group col-md-6">

                    <label>សូមធ្វើការជ្រើសរើស</label>
                    <select class="form-select" aria-label="Default select example">
                        <option value="0">កម្រិតវប្បធម៍ទូទៅ</option>
                        <option value="1">កម្រិតសញ្ញាបត្រ</option>
                        <option value="2">ជំនាញឯកទេស</option>
                        <option value="2">វគ្គបណ្តុះបណ្តាលវិជ្ជាជីវៈ</option>

                        
                    </select>
                
                    </div>
                  
                </div>
                
               
               
                <br>
                <!-- ស្ថានភាពមុខងារបច្ចុប្បន្ន -->

              
                
                <button type="submit" class="btn btn-submit ">Create Account</button> 
                
            </form>
        <div>
    </div>
  

@endsection