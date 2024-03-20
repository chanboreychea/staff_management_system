@if(isset($userFamily))
            <p  style="font-family: khmer mef2;">៧.ស្ថានភាពគ្រួសារ</hp>

            <p style="font-family: khmer mef2;margin-left:15px;">ក.ព័ត៍មានឪពុកម្តាយ</p>

            <div class="table-reponsive" style="font-size:12px">
                
                <table  class="table borderless" >

                    <thead>
                    
                        <tr class="grid-row">
                            
                            <td  class="grid-cell">ឈ្មោះឪពុក <span style="margin-left:50px;">:</span> {{$userFamily->father_name}}</td>
                            
                            <td  class="grid-cell">ជាអក្សរឡាតាំង <span style="margin-left:10px;">:</span> {{$userFamily->father_name_in_english}}</td>
                            
                            <td  class="grid-cell">ស្ថានភាព <span style="margin-left:10px;">:</span> {{$userFamily->father_status}}</td>
                        
                        </tr>

                        <tr class="grid-row">
                        
                            <td  class="grid-cell">ថ្ងៃខែឆ្នាំកំណើត<span style="margin-left:37px;">:</span> {{$userFamily->father_date}}</td>
                            
                            <td  class="grid-cell">សញ្ជាតិ<span style="margin-left:10px;">:</span> {{$userFamily->father_national}}</td>
                        
                        </tr>

                        <tr class="grid-row1">
                            
                            <td  class="grid-cell1">ទីលំនៅបច្ចុប្បន្ន<span style="margin-left:37px;">:</span> {{$userFamily->f_current_residence}}</td>
                        
                        </tr>

                        <tr class="grid-row1">
                            
                            <td  class="grid-cell1">មុខរបរ<span style="margin-left:76px;">:</span> {{$userFamily->father_job}}</td>
                        
                        </tr>
                    
                        <tr class="grid-row">
                        
                            <td  class="grid-cell">ឈ្មោះម្តាយ<span style="margin-left:57px;">:</span> {{$userFamily->mother_name}}</td>
                            
                            <td  class="grid-cell">ជាអក្សរឡាតាំង<span style="margin-left:10px;">:</span> {{$userFamily->mother_name_in_english}}</td>
                            
                            <td  class="grid-cell">ស្ថានភាព<span style="margin-left:10px;">:</span> {{$userFamily->mother_status}}</td>
                        
                        </tr>

                        <tr class="grid-row">
                        
                            <td class="grid-cell">ថ្ងៃខែឆ្នាំកំណើត<span style="margin-left:36px;">:</span> {{$userFamily->mother_date}}</td>
                            
                            <td  class="grid-cell">សញ្ជាតិ<span style="margin-left:10px;">:</span> {{$userFamily->mother_national}}</td>
                        
                        </tr>

                        <tr class="grid-row1">
                            
                            <td  class="grid-cell1">ទីលំនៅបច្ចុប្បន្ន<span style="margin-left:35px;">:</span> {{$userFamily->m_current_residence}}</td>
                        
                        </tr>

                        <tr class="grid-row1">
                            
                            <td  class="grid-cell1">មុខរបរ<span style="margin-left:74px;">:</span> {{$userFamily->federation_name}}</td>
                        
                        </tr>
                        
                    <thead>
                    
                </table>

            </div>
            <p style="font-family: khmer mef2;margin-left:15px;">ខ.ព័ត៍មានបងប្ធូន</p>

            <div class="table-responsive">
            
                <table class="table table-bordered" >

                    <thead>

                        <td class="nowrap" style="text-align:center;font-size:12px" >ល.រ</td>
                        
                        <td class="nowrap" style="text-align:center;font-size:12px" >គោត្តនាម និង នាម</td>
                        
                        <td class="nowrap" style="text-align:center;font-size:12px" >ជាអក្សរឡាតាំង</td>

                        <td class="nowrap" style="text-align:center;font-size:12px" >ភេទ</td>
                        
                        <td class="nowrap" style="text-align:center;font-size:12px" >ថ្ងៃខែឆ្នាំកំណើត</td>
                        
                        <td class="nowrap" style="text-align:center;font-size:12px" >មុខរបរ(អង្គភាព)</td>

                    </thead>
                    
                    <tbody>
       
                        @if($userFamily->relative_name!="N;")
       
                            <?php $i=1;?>
        
                            @foreach(unserialize($userFamily->relative_name) as $key => $name)
                                <tr>
                                  
                                    <td style="text-align:center;font-size:12px">{{$i++}}</td>
                                    
                                    <td  style="font-size:12px" ><div class="container">{{$name}}</div></td>
              
                                    <td  style="font-size:12px" ><div class="container">{{unserialize($userFamily->relative_name_in_english)[$key]}}</div></td>
                                    
                                    <td  style="font-size:12px" ><div class="container" >{{unserialize($userFamily->relative_gender)[$key]}}</div></td>
                                    
                                    <td  style="font-size:12px" ><div class="container">{{unserialize($userFamily->relative_date)[$key]}}</div></td>
                                    
                                    <td  style="font-size:12px" ><div class="container">{{unserialize($userFamily->relative_job)[$key]}}</div></td>
                                
                                </tr>
                            
                            @endforeach
                        
                        @endif
                
                    </tbody>

                </table>  

            </div>
            
            <p style="font-family: khmer mef2;margin-left:15px;">គ.ព័ត៍មានសហព័ន្ធ</p>
            
            <div class="table-responsive" style="font-size:12px;">
                
                <table class="table borderless" >

                    <thead>
                    
                        <tr class="grid-row">
                        
                            <td  class="grid-cell">ឈ្មោះប្តី​ ឬ​ ប្រពន្ធ<span style="margin-left:30px;">:</span> {{$userFamily->federation_name}} </td>
                            
                            <td  class="grid-cell">ជាអក្សរឡាតាំង<span style="margin-left:10px;">:</span>  {{$userFamily->federation_name_in_english}} </td>
                            
                            <td  class="grid-cell">ស្ថានភាព<span style="margin-left:10px;">:</span> {{$userFamily->federation_status}}</td>
                        
                        </tr>

                        <tr class="grid-row">
                        
                            <td  class="grid-cell1">ទីកន្លែងកំណើត<span style="margin-left:42px;">:</span> {{$userFamily->federation_current_residence}}</td>
                        
                        </tr>

                        <tr class="grid-row">
                            
                            <td  class="grid-cell">មុខរបរ<span style="margin-left:80px;">:</span> {{$userFamily->federation_job}}</td>
                            
                            <td  class="grid-cell">ស្ថានភាព/អង្គភាព<span style="margin-left:10px;">:</span> {{$userFamily->federation_institute}}</td>
                        
                        </tr>

                        <tr class="grid-row">
                            
                            <td  class="grid-cell">ប្រាក់ឧបត្ថម្ភ<span style="margin-left:57px;">:</span>  {{$userFamily->federation_allowance}}</td>
                            
                            <td  class="grid-cell">លេខទូរស័ព្ទ<span style="margin-left:30px;">:</span>  {{$userFamily->federation_phone_number}}</td>
                        
                        </tr>
                    
                    <thead>
                    
                </table>

            </div>

            <p style="font-family: khmer mef2;margin-left:15px;">ឃ.ព័ត៍មានកូន</p>
        
            <div class="table-responsive">

                <table class="table table-bordered" >

                    <thead>

                        <td class="nowrap" style="text-align:center;font-size:12px" >ល.រ</td>
                        
                        <td class="nowrap" style="text-align:center;font-size:12px" >គោត្តនាម និង នាម</td>
                        
                        <td class="nowrap" style="text-align:center;font-size:12px" >ជាអក្សរឡាតាំង</td>

                        <td class="nowrap" style="text-align:center;font-size:12px" >ភេទ</td>
                        
                        <td class="nowrap" style="text-align:center;font-size:12px" >ថ្ងៃខែឆ្នាំកំណើត</td>
                        
                        <td class="nowrap" style="text-align:center;font-size:12px" >មុខរបរ(អង្គភាព)</td>

                    <thead>

                    <tbody>

                        @if($userFamily->children_name!="N;")
                            
                            <?php $i=1;?>

                            @foreach(unserialize($userFamily->children_name) as $key => $name)
                                
                                <tr>

                                    <td style="text-align:center;font-size:12px">{{$i++}}</td>
                                    
                                    <td  style="font-size:12px" ><div class="container">{{$name}}</div></td>
                                    
                                    <td  style="font-size:12px" ><div class="container" >{{unserialize($userFamily->children_name_in_english)[$key]}}</div></td>
                                    
                                    <td  style="font-size:12px" ><div class="container" >{{unserialize($userFamily->children_gender)[$key]}}</div></td>
                                    
                                    <td  style="font-size:12px" ><div class="container" >{{unserialize($userFamily->children_date)[$key]}}</div></td>
                                    
                                    <td  style="font-size:12px" ><div class="container" >{{unserialize($userFamily->children_job)[$key]}}</div></td>
                                
                                </tr>

                            @endforeach

                        @endif

                    </tbody>

                    
                </table>  

            </div>
        @endif