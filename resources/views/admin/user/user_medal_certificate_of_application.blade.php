@extends('template.master')
@section('title', 'User')
@section('content')

    <div class="form-main">
        
        <div class="form-content">
                    <!-- ​​ព័ត៍មានអំពីស្ថានភាព -->
            <center> <h2 class="form-top-header"><u> គ្រឿងឥស្សរិយយស ប័ណ្ណសរសើរ ឬទណ្ខកម្មវិន័យ</u></h2> <br></center>
            <!-- <h4 class="form-header"><i class="fas fa-address-book"></i>  គ្រឿងឥស្សរិយយស ប័ណ្ណសរសើរ ឬទណ្ខកម្មវិន័យ</h4> <br> -->
            
            <form class="form-horizontal">
                
                <div class="form-row">
                    
                    <div class="form-group col-md-6">
                    
                        <label>លេខឯកសារ</label>
                    
                        <input type="file" class="form-control" placeholder="ការបរិច្ជេទចូលបំរើការងារដំបូង">
                                      
                    </div>
                    
                    <div class="form-group col-md-6">
                     
                        <label>ការបរិច្ឆេទ</label>
                     
                        <!-- <input type="text" class="form-control" placeholder="ការបរិច្ជេទចូលបំរើការងារដំបូង"> -->
                        <input type="date" id="dateOfBirth" name="dateOfBirth" value="{{ old('dateOfBirth') }}"
                                class="form-control" max="{{ now()->subYears(18)->format('Y-m-d') }}"
                                {{-- max="{{ date('Y-m-d') }}" --}} placeholder="ថ្ងៃ-ខែ​​​-ឆ្នាំ">
                    </div>
                   
                </div>
                
                <div class="form-row">
                    
                    <div class="form-group col-md-6">
                    
                        <label>ស្ថាប័ន/អង្គភាព(ស្នើសុំ)</label>
                    
                        <input type="email" class="form-control" placeholder="ក្រសួង/ស្ថាប័ន">
                    
                    </div>  
                    
                    <div class="form-group col-md-6">
                
                        <label>ខ្លឹមសារ</label>
                
                        <input type="password" class="form-control" placeholder="អង្គភាព">
                
                    </div>
                   
                </div>
                
                <div class="form-row">
                    
                    <div class="form-group col-md-6">
                    
                        <label>ប្រភេទ</label>
                    
                        <input type="password" class="form-control" placeholder="មុខតំណែង">
                    
                    </div>
                    
                    <div class="form-group col-md-6">
                
                        <label>ផ្សេង</label>
                    
                        <input type="text" class="form-control" placeholder="អង្គភាព">
                
                    </div>
                  
                </div>
                
                <div class="form-row">
                    
                    <div class="form-group col-md-6">
                    
                        <label>ប្រភេទ</label>
                    
                        <input type="password" class="form-control" placeholder="មុខតំណែង">
                    
                    </div>
                    
                    <div class="form-group col-md-6">
                
                        <label>ផ្សេង</label>
                    
                        <input type="text" class="form-control" placeholder="អង្គភាព">
                
                    </div>
                  
                </div>
                <select class="form-select" aria-label="Default select example">
                    <option selected>សូមធ្វើការជ្រើសរើស</option>
                    <option value="0">គ្រឿងឥស្សរិយយស ប័ណ្ណសរសើរ</option>
                    <option value="1">ទណ្ខកម្មវិន័យ</option>
                    
                </select>
                <br>
                <!-- ស្ថានភាពមុខងារបច្ចុប្បន្ន -->

              
                
                <button type="submit" class="btn btn-submit ">Create Account</button> 
                
            </form>
        <div>
    </div>
  

@endsection