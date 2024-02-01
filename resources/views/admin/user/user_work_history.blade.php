@extends('template.master')
@section('title', 'User')
@section('content')

    <div class="form-main">
        
        <div class="form-content">
                    <!-- ​​ព័ត៍មានអំពីស្ថានភាព -->
            <center> <h2 class="form-top-header"><u> ប្រវត្តិការងារ</u></h2> <br></center>
            <h4 class="form-header"><i class="fas fa-address-book"></i> ក្នុងវិស័យមុខងារសាធារណៈ</h4> <br>
            
            <form class="form-horizontal">
                
                <div class="form-row">
                    
                    <div class="form-group col-md-6">
                    
                        <label>ថ្ងៃ-ខែ-ឆ្នាំ ចូល</label>
                    
                        <!-- <input type="text" class="form-control" placeholder="ការបរិច្ជេទចូលបំរើការងារដំបូង"> -->
                        <input type="date" id="dateOfBirth" name="dateOfBirth" value="{{ old('dateOfBirth') }}"
                                class="form-control" max="{{ now()->subYears(18)->format('Y-m-d') }}"
                                {{-- max="{{ date('Y-m-d') }}" --}} placeholder="ថ្ងៃ-ខែ​​​-ឆ្នាំ">                    
                    </div>
                    
                    <div class="form-group col-md-6">
                     
                        <label>ថ្ងៃ-ខែ-ឆ្នាំ​ បញ្ចប់</label>
                     
                        <!-- <input type="text" class="form-control" placeholder="ការបរិច្ជេទចូលបំរើការងារដំបូង"> -->
                        <input type="date" id="dateOfBirth" name="dateOfBirth" value="{{ old('dateOfBirth') }}"
                                class="form-control" max="{{ now()->subYears(18)->format('Y-m-d') }}"
                                {{-- max="{{ date('Y-m-d') }}" --}} placeholder="ថ្ងៃ-ខែ​​​-ឆ្នាំ">
                    </div>
                   
                </div>
                
                <div class="form-row">
                    
                    <div class="form-group col-md-6">
                    
                        <label>ក្រសួង/ស្ថាប័ន</label>
                    
                        <input type="email" class="form-control" placeholder="ក្រសួង/ស្ថាប័ន">
                    
                    </div>  
                    
                    <div class="form-group col-md-6">
                
                        <label>អង្គភាព</label>
                
                        <input type="password" class="form-control" placeholder="អង្គភាព">
                
                    </div>
                   
                </div>
                
                <div class="form-row">
                    
                    <div class="form-group col-md-6">
                    
                        <label>មុខតំណែង</label>
                    
                        <input type="password" class="form-control" placeholder="មុខតំណែង">
                    
                    </div>
                    
                    <div class="form-group col-md-6">
                
                        <label>ផ្សេង</label>
                    
                        <input type="text" class="form-control" placeholder="អង្គភាព">
                
                    </div>
                  
                </div>
                
                <!-- ស្ថានភាពមុខងារបច្ចុប្បន្ន -->

                <h4 class="form-header"><i class="fas fa-address-book"></i> ក្នុងវិស័យឯកជន</h4> 
                
                <br>
                
                <div class="form-row">
                
                    <div class="form-group col-md-6">
                    
                        <label >ថ្ងៃខែឆ្នាំបំពេញការងារចូល</label>
                        
                            <input type="text" class="form-control" placeholder="ថ្ងៃខែឆ្នាំបំពេញការងារចូល">
                    
                    </div>
                
                    <div class="form-group col-md-6">
                
                        <label >ថ្ងៃខែឆ្នាំបំពេញការងារចេញ</label>
                    
                        <!-- <input type="text" class="form-control" placeholder="កាលបរិច្ឆេទប្តូរក្រខណ្ខ ឋានន្តរស័ក្ត និងថ្នាក់ចុងក្រោយ"> -->
                        <input type="date" id="dateOfBirth" name="dateOfBirth" value="{{ old('dateOfBirth') }}"
                                class="form-control" max="{{ now()->subYears(18)->format('Y-m-d') }}"
                                {{-- max="{{ date('Y-m-d') }}" --}} placeholder="ថ្ងៃ-ខែ​​​-ឆ្នាំ">
                    </div>
                
                </div>
                
                <div class="form-row">
                
                    <div class="form-group col-md-6">
                    
                        <label >គ្រឺះស្ថាន/អង្គភាព</label>
                        
                        <input type="text" class="form-control" placeholder="គ្រឺះស្ថាន/អង្គភាព">
                    
                    </div>
                    
                    <div class="form-group col-md-6">
                    
                        <label >មុខតំណែង</label>
                        
                        <!-- <input type="text" class="form-control" placeholder="កាលបរិច្ឆេទទទូលមុខតំណែងចុងក្រោយ"> -->
                        <input type="text" class="form-control" placeholder="មុខតំណែង">
                    </div>
                
                </div>
                
                <div class="form-row">
                
                    <div class="form-group col-md-6">
                    
                        <label >ជំនាញ/បច្ចេកទេស</label>
                        
                        <input type="text" class="form-control" placeholder="ជំនាញ/បច្ចេកទេស">
                    
                    </div>
                
                    <div class="form-group col-md-6">
                    
                        <label >ផ្សេងៗ</label>
                        
                        <input type="text" class="form-control" placeholder="ផ្សេងៗ">
                    
                    </div>
                   
                </div>
                
                <button type="submit" class="btn btn-submit ">Create Account</button> 
                
            </form>
        <div>
    </div>
  

@endsection