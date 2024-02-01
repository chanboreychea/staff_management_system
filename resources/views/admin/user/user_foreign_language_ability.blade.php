@extends('template.master')
@section('title', 'User')
@section('content')

    <div class="form-main">
        
        <div class="form-content">
                    <!-- ​​ព័ត៍មានអំពីស្ថានភាព -->
            <center> <h2 class="form-top-header"><u>សមត្តភាពភាសាបរទេស</u></h2> <br></center>
            <!-- <h4 class="form-header"><i class="fas fa-address-book"></i>  គ្រឿងឥស្សរិយយស ប័ណ្ណសរសើរ ឬទណ្ខកម្មវិន័យ</h4> <br> -->
            
            <form class="form-horizontal">
                
                <div class="form-row">
                    
                    <div class="form-group col-md-6">
                    
                        <label>ភាសា</label>
                    
                        <input type="text" class="form-control" placeholder="ភាសា">
                                      
                    </div>
                    
                    <div class="form-group col-md-6">
                     
                        <label>អាន</label>
                     
                        <input type="text" class="form-control" placeholder="អាន">
                       
                    </div>
                   
                </div>
                
                <div class="form-row">
                    
                    <div class="form-group col-md-6">
                    
                        <label>សរសេរ</label>
                    
                        <input type="email" class="form-control" placeholder="សរសេរ">
                    
                    </div>  
                    
                    <div class="form-group col-md-6">
                
                        <label>និយាយ</label>
                
                        <input type="password" class="form-control" placeholder="និយាយ">
                
                    </div>
                   
                </div>
                
                <div class="form-row">
                    
                    <div class="form-group col-md-6">
                    
                        <label>ស្តាប់</label>
                    
                        <input type="text" class="form-control" placeholder="ស្តាប់">
                    
                    </div>
                  
                </div>
                          
                <br>
                <!-- ស្ថានភាពមុខងារបច្ចុប្បន្ន -->
                <button type="submit" class="btn btn-submit ">Create Account</button> 
                
            </form>
        <div>
    </div>
  

@endsection