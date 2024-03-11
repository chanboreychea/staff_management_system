<style>
    
    .box{
        width:30%;
        /* height:30%; */
        /* background:red; */
    }
    .box_img_detail img{
        width:35%;
        height:35%;
    }
    .gallary{
        width: 35%;
        height:40%;
        /* background:blue; */

    }
    .gallary img{
        width:100%;
        height:auto;
        object-fit:cover;
    }
    .text_logo,.form-top-header{
        font-size:1vw;
    }
    .text-size{
        font-size:.9vw;
    }
    .borderless td, .borderless th {
    border: none;
    }
    .tab1{
        tab-size:2;
    }
    
</style>
<div>
<div class="d-flex align-items-center mt-2">
    <button class="btn btn-primary me-2" onclick="Export2Word('page-content', 'word-content.docx');">ទាញយកជា WORD<i class="bx bx-download mx-2"></i></button>
    <button class="btn btn-primary me-2" onclick="printContent()">បោះពុម្ព <i class="bx bx-print"></i></button>
</div>
<script>
    function printContent() {
    // Get the content of the div to print
    var content = document.getElementById('page-content').innerHTML;

    // Create a new window with the content
    var
        printWindow = window.open('none', '_blank');
    printWindow.document.open();
    // printWindow.document.write('<!DOCTYPE html><html><head><title></title></head><body>');
    printWindow.document.write(content);
    // printWindow.document.write('</body></html>');
    printWindow.document.close();

    // Print the window
    printWindow.print();
    }
</script>

    <br>
    <div id="page-content" hidden>
                <!-- ​​ព័ត៍មានអំពីស្ថានភាព -->
        <center  style="font-family: khmer mef2;color: #2F5496;"> <h6 class="form-top-header">ព្រះរាជាណាច្រកម្ពជា</h6> </center>
        
        <center  style="font-family: khmer mef2;color: #2F5496;"> <h6 class="form-top-header">ជាតិ សាសនា​ ព្រះមហាក្សត្រ</h6> <br></center>
        
        <div style="display: flex;justify-content: space-between;align-items: center;">
            
            <div class="box box_img_detail">
                
                <center><img src="{{ asset('images/logo2.png') }}" alt=""  style="width: 100px;"></center>
                
                <center> <h6 class="form-top-header text_logo">អង្គភាពសវនកម្មផ្ទៃក្នុងនៃ</h6></center>
                <center> <h6 class="form-top-header text_logo">អាជ្ញាធរនៃសេវាហិរញវត្ថុមិនមែនធនាគា</h6></center>


            </div>
            
            <div class="box box_img_detail">
                
                <center>
                
                    <div class="gallary border">
                        
                        <img  class=" border" src="{{ asset('images/gallary.jpg') }}"  style="width: 200px;height:250px" alt="">
                
                    </div> 
                
                </center>
                    
            </div>
            
        </div>
        
        <center> <h6 class="form-top-header">ប្រវត្តិរូបមន្ត្រីរបស់</h6> </center>
                
        <center> <h6 class="form-top-header">អង្គភាពសវនកម្មផ្ទៃក្នុងនៃអាជ្ញាធរនៃសេវាហិរញវត្ថុមិនមែនធនាគារ</h6> <br></center>
    
    
        @if(isset($user))

            <!-- -------------------------------ព័ត៍មានផ្ទាល់ខ្លួន-------------------------------- -->
            @component('components.table_detail_users.user_information', ['user' => $user, 'user_information' => $user_information, 'additionalPCJ' => $additionalPCJ])
                <!-- button -->
            @endcomponent

            <!-- -----------------------------------------ប្រវត្តិការងារ--------------------------------------------- -->

            @component('components.table_detail_users.user_working_history', ['userWoringHistoryPublicSetor' => $userWoringHistoryPublicSetor, 'userWoringHistoryPrivateSetor' => $userWoringHistoryPrivateSetor])
                <!-- button -->
            @endcomponent
            
            <!-- -----------------------------------------គ្រឿងឥស្សរិយយស ប័ណ្ណសរសើរ ឬទណ្ណកម្មវិន័យ--------------------------------------------- -->

            @component('components.table_detail_users.user_modal_certificate', ['userModalCertificate' => $userModalCertificate])
                <!-- button -->
            @endcomponent

            <!-- -----------------------------------------៥.កម្រិតវប្បធម៍ទូទៅ ការបណ្តុះបណ្តាលវិជ្ជាជីវៈ និងការបណ្តុះបណ្តាលបន្ត--------------------------------------------- -->

            @component('components.table_detail_users.user_education_level', ['userEducationLevel' => $userEducationLevel])
                <!-- button -->
            @endcomponent

            <!-- -----------------------------------------៥.សមត្ថភាពភាសាបរទេស--------------------------------------------- -->
            @component('components.table_detail_users.user_language', ['userAbilityLanguage' => $userAbilityLanguage])
                <!-- button -->
            @endcomponent
        
        @endif

        
        @if(isset($userFamily))
            <h6 class="form-top-header">៧.ស្ថានភាពគ្រួសារ</h6>

            <h6 class="form-top-header tab1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ក.ព័ត៍មានឪពុកម្តាយ</h6>
            <div class="table-responsive">
                
                <table class="table borderless" >

                    <thead>
                    
                        <tr>
                        
                            <td  class="nowrap text-size">ឈ្មោះឪពុក&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </td>
                            
                            <td  class="nowrap text-size">ជាអក្សរឡាតាំង&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </td>
                            
                            <td  class="nowrap text-size">ស្ថានភាព&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:គ្មាន</td>
                        
                        </tr>

                        <tr>
                        
                            <td  class="nowrap text-size">ថ្ងៃខែឆ្នាំកំណើត&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </td>
                            
                            <td  class="nowrap text-size">សញ្ជាតិ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </td>
                        
                        </tr>

                        <tr>
                            
                            <td  class="nowrap text-size">ទីលំនៅបច្ចុប្បន្ន&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </td>
                        
                        </tr>

                        <tr>
                            
                            <td  class="nowrap text-size">មុខរបរ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </td>
                        
                        </tr>
                    
                        <tr>
                        
                            <td  class="nowrap text-size">ឈ្មោះម្តាយ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </td>
                            
                            <td  class="nowrap text-size">ជាអក្សរឡាតាំង&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </td>
                            
                            <td  class="nowrap text-size">ស្ថានភាព&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:គ្មាន</td>
                        
                        </tr>

                        <tr>
                        
                            <td  class="nowrap text-size">ថ្ងៃខែឆ្នាំកំណើត&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </td>
                            
                            <td  class="nowrap text-size">សញ្ជាតិ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </td>
                        
                        </tr>

                        <tr>
                            
                            <td  class="nowrap text-size">ទីលំនៅបច្ចុប្បន្ន&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </td>
                        
                        </tr>

                        <tr>
                            
                            <td  class="nowrap text-size">មុខរបរ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </td>
                        
                        </tr>
                        
                    
                        
                    <thead>
                    
                </table>

            </div>
            <h6 class="form-top-header tab1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ខ.ព័ត៍មានបងប្ធូន</h6>

            <div class="table-responsive">
            
                <table class="table table-bordered" >

                    <thead>

                        <th class="nowrap text-size" >ល.រ</th>
                        
                        <th class="nowrap text-size" >គោត្តនាម និង នាម</th>
                        
                        <th class="nowrap text-size" >ជាអក្សរឡាតាំង</th>

                        <th class="nowrap text-size" >ភេទ</th>
                        
                        <th class="nowrap text-size" >ថ្ងៃខែឆ្នាំកំណើត</th>
                        
                        <th class="nowrap text-size" >មុខរបរ(អង្គភាព)</th>

                        

                

                    <thead>
                    <tbody>
                        @if($userFamily->relative_name)
                            <?php $i=1;?>
                            @foreach(unserialize($userFamily->relative_name) as $key => $name)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$name}}</td>
                                    <td>{{unserialize($userFamily->relative_name_in_english)[$key]}}</td>
                                    <td>{{unserialize($userFamily->relative_gender)[$key]}}</td>
                                    <td>{{unserialize($userFamily->relative_date)[$key]}}</td>
                                    <td>{{unserialize($userFamily->relative_job)[$key]}}</td>
                                
                                </tr>
                            @endforeach
                        @endif
                </tbody>

                    
                </table>  

            </div>
            
            <h6 class="form-top-header tab1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;គ.ព័ត៍មានសហព័ន្ធ</h6>
            <div class="table-responsive">
                
                <table class="table borderless" >

                    <thead>
                    
                        <tr>
                        
                            <td  class="nowrap text-size">ឈ្មោះឪពុក&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </td>
                            
                            <td  class="nowrap text-size">ជាអក្សរឡាតាំង&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </td>
                            
                            <td  class="nowrap text-size">ស្ថានភាព&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:គ្មាន</td>
                        
                        </tr>

                        <tr>
                        
                            <td  class="nowrap text-size">ថ្ងៃខែឆ្នាំកំណើត&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </td>
                            
                            <td  class="nowrap text-size">សញ្ជាតិ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </td>
                        
                        </tr>

                        <tr>
                            
                            <td  class="nowrap text-size">ទីលំនៅបច្ចុប្បន្ន&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </td>
                        
                        </tr>

                        <tr>
                            
                            <td  class="nowrap text-size">មុខរបរ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </td>
                        
                        </tr>
                    
                        <tr>
                        
                            <td  class="nowrap text-size">ឈ្មោះម្តាយ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </td>
                            
                            <td  class="nowrap text-size">ជាអក្សរឡាតាំង&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </td>
                            
                            <td  class="nowrap text-size">ស្ថានភាព&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:គ្មាន</td>
                        
                        </tr>

                        <tr>
                        
                            <td  class="nowrap text-size">ថ្ងៃខែឆ្នាំកំណើត&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </td>
                            
                            <td  class="nowrap text-size">សញ្ជាតិ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </td>
                        
                        </tr>

                        <tr>
                            
                            <td  class="nowrap text-size">ទីលំនៅបច្ចុប្បន្ន&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </td>
                        
                        </tr>

                        <tr>
                            
                            <td  class="nowrap text-size">មុខរបរ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </td>
                        
                        </tr>
                        
                    
                        
                    <thead>
                    
                </table>

            </div>

            <h6 class="form-top-header tab1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ឃ.ព័ត៍មានកូន</h6>
        
            <div class="table-responsive">

                <table class="table table-bordered" >

                    <thead>

                        <th class="nowrap text-size" >ល.រ</th>
                        
                        <th class="nowrap text-size" >គោត្តនាម និង នាម</th>
                        
                        <th class="nowrap text-size" >ជាអក្សរឡាតាំង</th>

                        <th class="nowrap text-size" >ភេទ</th>
                        
                        <th class="nowrap text-size" >ថ្ងៃខែឆ្នាំកំណើត</th>
                        
                        <th class="nowrap text-size" >មុខរបរ(អង្គភាព)</th>

                        



                    <thead>
                    <tbody>
                        @if($userFamily->children_name)
                            <?php $i=1;?>
                            @foreach(unserialize($userFamily->children_name) as $key => $name)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$name}}</td>
                                    <td>{{unserialize($userFamily->children_name_in_english)[$key]}}</td>
                                    <td>{{unserialize($userFamily->children_gender)[$key]}}</td>
                                    <td>{{unserialize($userFamily->children_date)[$key]}}</td>
                                    <td>{{unserialize($userFamily->children_job)[$key]}}</td>
                                
                                </tr>
                            @endforeach
                        @endif
                    </tbody>

                    
                </table>  

            </div>
        @endif


    </div> 
        <form  method="get">
            @csrf
            @if(isset($user))
            <a href="/user/generate_pdf/{{$user->id}}" class="btn " style=" background: #696cff; color:white">print</a>
            @endif
           
        </form>
        
</div>

  