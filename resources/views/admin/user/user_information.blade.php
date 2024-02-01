@extends('template.master')
@section('title', 'User')
@section('content')

    <div class="form-main">
        <div class="form-content">
                    <!-- ​​ព័ត៍មានអំពីស្ថានភាព -->
            <center> <h2 class="form-top-header"><u> ​​ព័ត៍មានអំពីស្ថានភាព</u></h2> <br></center>
            <h4 class="form-header"><i class="fas fa-address-book"></i> ចូលបម្រើការងាររដ្ឋដំបូង</h4> <br>
            
            <form class="form-horizontal" action="{{route('user_information',['id'=>$id])}}" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="form-row">
                    
                    <div class="form-group col-md-6">
                    
                        <label>ការបរិច្ឆេទចូលបំរើការងាររដ្ឋដំបូង</label>
                    
                        <!-- <input type="text" class="form-control" placeholder="ការបរិច្ជេទចូលបំរើការងារដំបូង"> -->
                        <input type="date" id="date" name="date" value="{{ old('date') }}"
                                class="form-control" max="{{ now()->subYears(18)->format('Y-m-d') }}"
                                {{-- max="{{ date('Y-m-d') }}" --}} placeholder="ថ្ងៃ-ខែ​​​-ឆ្នាំ">                    
                    </div>
                    
                    <div class="form-group col-md-6">
                     
                        <label>ការបរិច្ឆេទតាំងស៊ប់</label>
                     
                        <!-- <input type="text" class="form-control" placeholder="ការបរិច្ជេទចូលបំរើការងារដំបូង"> -->
                        <input type="date" id="dateOfBirth" name="dateOfBirth" value="{{ old('dateOfBirth') }}"
                                class="form-control" max="{{ now()->subYears(18)->format('Y-m-d') }}"
                                {{-- max="{{ date('Y-m-d') }}" --}} placeholder="ថ្ងៃ-ខែ​​​-ឆ្នាំ">
                    </div>
                   
                </div>
                
                <div class="form-row">
                    
                    <div class="form-group col-md-6">
                    
                        <label>ក្របខណ្ឌ</label>
                    
                        <input type="email" class="form-control" placeholder="ក្របខណ្ឌ">
                    
                    </div>  
                    
                    <div class="form-group col-md-6">
                
                        <label>មុខតំណែង</label>
                
                        <input type="password" class="form-control" placeholder="មុខតំណែង">
                
                    </div>
                   
                </div>
                
                <div class="form-row">
                    
                    <div class="form-group col-md-6">
                    
                        <label>ក្រសួង/ស្ថាប័ន</label>
                    
                        <input type="password" class="form-control" placeholder="មុខតំណែង">
                    
                    </div>
                    
                    <div class="form-group col-md-6">
                
                        <label>អង្គភាព</label>
                    
                        <input type="text" class="form-control" placeholder="អង្គភាព">
                
                    </div>
                  
                </div>
                
                <div class="form-row">
                    
                    <div class="form-group col-md-6">
                    
                        <label>នាយកដ្ឋាន/អង្គភាព/មន្ទីរ</label>
                    
                        <input type="text" class="form-control" placeholder="នាយកដ្ឋាន/អង្គភាព/មន្ទី">
                    
                    </div>
                    
                    <div class="form-group col-md-6 ">
                
                        <label>ការិយាល័យ</label>
                
                        <input type="text" class="form-control" placeholder="ការិយាល័យ">
                
                    </div>
                
                </div> 
                
                <!-- ស្ថានភាពមុខងារបច្ចុប្បន្ន -->

                <h4 class="form-header"><i class="fas fa-address-book"></i> ស្ថានភាពមុខងារបច្ចុប្បន្ន</h4> 
                
                <br>
                
                <div class="form-row">
                
                    <div class="form-group col-md-6">
                    
                        <label >ក្របខណ្ឌ​​ ឋានន្តរស័ក្ត​ និងថ្នាក់</label>
                        
                            <input type="text" class="form-control" placeholder="ក្របខណ្ឌ​​ ឋានន្តរស័ក្ត​ និងថ្នាក់">
                    
                    </div>
                
                    <div class="form-group col-md-6">
                
                        <label >កាលបរិច្ឆេទប្តូរក្រខណ្ខ ឋានន្តរស័ក្ត និងថ្នាក់ចុងក្រោយ</label>
                    
                        <!-- <input type="text" class="form-control" placeholder="កាលបរិច្ឆេទប្តូរក្រខណ្ខ ឋានន្តរស័ក្ត និងថ្នាក់ចុងក្រោយ"> -->
                        <input type="date" id="dateOfBirth" name="dateOfBirth" value="{{ old('dateOfBirth') }}"
                                class="form-control" max="{{ now()->subYears(18)->format('Y-m-d') }}"
                                {{-- max="{{ date('Y-m-d') }}" --}} placeholder="ថ្ងៃ-ខែ​​​-ឆ្នាំ">
                    </div>
                
                </div>
                
                <div class="form-row">
                
                    <div class="form-group col-md-6">
                    
                        <label >មុខតំណែង</label>
                        
                        <input type="text" class="form-control" placeholder="មុខតំណែង">
                    
                    </div>
                    
                    <div class="form-group col-md-6">
                    
                        <label >កាលបរិច្ឆេទទទូលមុខតំណែងចុងក្រោយ</label>
                        
                        <!-- <input type="text" class="form-control" placeholder="កាលបរិច្ឆេទទទូលមុខតំណែងចុងក្រោយ"> -->
                        <input type="date" id="dateOfBirth" name="dateOfBirth" value="{{ old('dateOfBirth') }}"
                                class="form-control" max="{{ now()->subYears(18)->format('Y-m-d') }}"
                                {{-- max="{{ date('Y-m-d') }}" --}} placeholder="ថ្ងៃ-ខែ​​​-ឆ្នាំ">
                    </div>
                
                </div>
                
                <div class="form-row">
                
                    <div class="form-group col-md-6">
                    
                        <label >អង្គភាព</label>
                        
                        <input type="text" class="form-control" placeholder="មុខតំណែង">
                    
                    </div>
                   
                </div>
                
                <!-- តួនាទីបន្ថែមលើមុខងារបច្ចុប្បន្ន -->

                <h4 class="form-header" ><i class="fas fa-address-book"></i> តួនាទីបន្ថែមលើមុខងារបច្ចុប្បន្ន</h4> <br>

                <div class="form-row">
                
                    <div class="form-group col-md-6">
                    
                        <label >ថ្ងៃ-ខែ​​​-ឆ្នាំ​</label>
                        
                        <input type="date" id="dateOfBirth" name="dateOfBirth" value="{{ old('dateOfBirth') }}"
                                class="form-control" max="{{ now()->subYears(18)->format('Y-m-d') }}"
                                {{-- max="{{ date('Y-m-d') }}" --}} placeholder="ថ្ងៃ-ខែ​​​-ឆ្នាំ">
                    
                    </div>

                    <div class="form-group col-md-6">
                    
                        <label >ឯកសារ</label>
                        
                        <input type="file" class="form-control" placeholder="ឯកសារ">
                    
                    </div>
                
                </div>

                <div class="form-row">
                
                    <div class="form-group col-md-6">
                    
                        <label >មុខតំណែង</label>
                        
                        <input type="text" class="form-control" placeholder="ថ្ងៃខែឆ្នាំ">
                    
                    </div>

                    <div class="form-group col-md-6">
                    
                        <label >ថានៈរស្មី</label>
                        
                        <input type="text" class="form-control" placeholder="ថានៈរស្មី">
                    
                    </div>
                   
                </div>

                <div class="form-row">

                    <div class="form-group col-md-6">
                    
                        <label >អង្គភាព</label>
                        
                        <input type="text" class="form-control" placeholder="អង្គភាព">
                
                    </div>

                </div>
               
            
                <button type="submit" class="btn btn-submit ">Create Account</button> 
                
            </form>
        <div>
    </div>
  

@endsection