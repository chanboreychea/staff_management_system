
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
    var printWindow = window.open('none', '_blank');
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
        width: 40%;
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
    .grid-row {
        display: grid;
        grid-template-columns: repeat(3, 1fr); /* Create three equal columns */
        gap: 20px; /* Adjust the gap between cells */
        white-space: nowrap;
    }
    
    .grid-cell {
        padding: 5px; /* Adjust the padding as needed */
        box-sizing: border-box; /* Include padding in the width calculation */
        width: 100%;
        overflow: hidden; /* Prevents content from overflowing */
        text-overflow: ellipsis; /* Adds an ellipsis (...) when content overflows */
    }
    
    .grid-row1{
        width:100%;
    }
   
    .grid-cell1 {
      
        box-sizing: border-box;
      
        padding: 5px;
      
        width:100%;
      
    }
       /* Add custom CSS for responsiveness */
       .table-wrapper {
            overflow-x: auto;
        }

        .table-bordered {
            border-collapse: collapse;
            width: 100%;
            max-width: 100%;
        }

        .table-bordered th, .table-bordered td {
            border: 1px solid #ddd;
            padding: 8px;
            /* white-space: nowrap; */
            /* text-align: center; */
        }

        .nowrap {
            white-space: nowrap;
        }

        @media screen and (max-width: 600px) {
            /* Adjust table layout for smaller screens */
            .table-bordered thead {
                display: none;
            }
            .table-bordered, .table-bordered tbody, .table-bordered tr, .table-bordered td {
                display: block;
                width: 100%;
            }
            .table-bordered tr {
                margin-bottom: 15px;
            }
            .table-bordered td {
                text-align: right;
                padding-left: 50%;
                text-align: right;
                position: relative;
            }
            .table-bordered td::before {
                content: attr(data-label);
                position: absolute;
                left: 0;
                width: 50%;
                padding-left: 15px;
                font-weight: bold;
            }
        }
     
</style>


<div style="font-family: khmer mef1;color: #2F5496;">


       
    
    
        @if(isset($user))

                 <!-- ​​ព័ត៍មានអំពីស្ថានភាព -->
                 <center  style="font-family: khmer mef2;color: #2F5496;">ព្រះរាជាណាច្រកម្ពជា</center>
        
        <center  style="font-family: khmer mef2;color: #2F5496;"> ជាតិ សាសនា​ ព្រះមហាក្សត្រ<br></center>
        
        <div style="display: flex;justify-content: space-between;align-items: center;">
            
            <div class="box box_img_detail">
                
                <center><img src="{{ asset('images/logo2.png') }}" alt="" ></center>
                
                <center  style="font-family: khmer mef2;color: #2F5496;font-size:14px;">អង្គភាពសវនកម្មផ្ទៃក្នុងនៃ</center>
                <center  style="font-family: khmer mef2;color: #2F5496;font-size:14px;">អាជ្ញាធរនៃសេវាហិរញវត្ថុមិនមែនធនាគា</center>


            </div>
            
            <div class="box box_img_detail">
                
                <center>
                
                    <div class="gallary border">

                    <img class=" border" src="{{ asset('images/' . $user->image) }}" alt="">
                       
                
                    </div> 
                
                </center>
                    
            </div>
            
        </div>
        
        <center style="font-family: khmer mef2;">ប្រវត្តិរូបមន្ត្រីរបស់</center>
                
        <center style="font-family: khmer mef2;"> អង្គភាពសវនកម្មផ្ទៃក្នុងនៃអាជ្ញាធរនៃសេវាហិរញវត្ថុមិនមែនធនាគារ <br></center>

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
            <p  style="font-family: khmer mef2;">៧.ស្ថានភាពគ្រួសារ</hp>

            <p style="font-family: khmer mef2;margin-left:15px;">ក.ព័ត៍មានឪពុកម្តាយ</p>
            <div class="table-reponsive">
                
                <table  class="table borderless" >

                    <thead>
                    
                        <tr>
                        
                            <td  class="nowrap">ឈ្មោះឪពុក: </td>
                            
                            <td  class="nowrap">ជាអក្សរឡាតាំង: </td>
                            
                            <td  class="nowrap">ស្ថានភាព:គ្មាន</td>
                        
                        </tr>

                        <tr>
                        
                            <td  class="nowrap ">ថ្ងៃខែឆ្នាំកំណើត: </td>
                            
                            <td  class="nowrap ">សញ្ជាតិ: </td>
                        
                        </tr>

                        <tr>
                            
                            <td  class="nowrap ">ទីលំនៅបច្ចុប្បន្ន: </td>
                        
                        </tr>

                        <tr>
                            
                            <td  class="nowrap ">មុខរបរ: </td>
                        
                        </tr>
                    
                        <tr>
                        
                            <td  class="nowrap">ឈ្មោះម្តាយ: </td>
                            
                            <td  class="nowrap">ជាអក្សរឡាតាំង: </td>
                            
                            <td  class="nowrap">ស្ថានភា:គ្មាន</td>
                        
                        </tr>

                        <tr>
                        
                            <td  class="nowrap">ថ្ងៃខែឆ្នាំកំណើត: </td>
                            
                            <td  class="nowrap">សញ្ជាតិ: </td>
                        
                        </tr>

                        <tr>
                            
                            <td  class="nowrap">ទីលំនៅបច្ចុប្បន្ន: </td>
                        
                        </tr>

                        <tr>
                            
                            <td  class="nowrap">មុខរបរ: </td>
                        
                        </tr>
                        
                    
                        
                    <thead>
                    
                </table>

            </div>
            <p style="font-family: khmer mef2;margin-left:15px;">ខ.ព័ត៍មានបងប្ធូន</p>

            <div class="table-responsive">
            
                <table class="table table-bordered" >

                    <thead>

                        <th class="nowrap" >ល.រ</th>
                        
                        <th class="nowrap" >គោត្តនាម និង នាម</th>
                        
                        <th class="nowrap" >ជាអក្សរឡាតាំង</th>

                        <th class="nowrap" >ភេទ</th>
                        
                        <th class="nowrap" >ថ្ងៃខែឆ្នាំកំណើត</th>
                        
                        <th class="nowrap" >មុខរបរ(អង្គភាព)</th>

                    </thead>
                    <tbody>
                        @if($userFamily->relative_name)
                            <?php $i=1;?>
                            @foreach(unserialize($userFamily->relative_name) as $key => $name)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td  style="font-size:12px" ><div style="width:130px;">{{$name}}</div></td>
                                    <td  style="font-size:12px" ><div style="width:130px;">{{unserialize($userFamily->relative_name_in_english)[$key]}}</div></td>
                                    <td  style="font-size:12px" ><div style="width:50px;">{{unserialize($userFamily->relative_gender)[$key]}}</div></td>
                                    <td  style="font-size:12px" ><div style="width:100px;">{{unserialize($userFamily->relative_date)[$key]}}</div></td>
                                    <td  style="font-size:12px" ><div style="width:150px;">{{unserialize($userFamily->relative_job)[$key]}}</div></td>
                                
                                </tr>
                            @endforeach
                        @endif
                </tbody>

                    
                </table>  

            </div>
            
            <p style="font-family: khmer mef2;margin-left:15px;">គ.ព័ត៍មានសហព័ន្ធ</p>
            <div class="table-responsive">
                
                <table class="table borderless" >

                    <thead>
                    
                        <tr class="grid-row">
                        
                            <td  class="grid-cell1">ឈ្មោះឪពុក: </td>
                            
                            <td  class="grid-cell1">ជាអក្សរឡាតាំង: </td>
                            
                            <td  class="grid-cell1">ស្ថានភាព:គ្មាន</td>
                        
                        </tr>

                        <tr>
                        
                            <td  class="nowrap">ថ្ងៃខែឆ្នាំកំណើត: </td>
                            
                            <td  class="nowrap">សញ្ជាតិ: </td>
                        
                        </tr>

                        <tr>
                            
                            <td  class="nowrap">ទីលំនៅបច្ចុប្បន្ន: </td>
                        
                        </tr>

                        <tr>
                            
                            <td  class="nowrap">មុខរបរ: </td>
                        
                        </tr>
                    
                        <tr>
                        
                            <td  class="nowrap">ឈ្មោះម្តាយ: </td>
                            
                            <td  class="nowrap">ជាអក្សរឡាតាំង: </td>
                            
                            <td  class="nowrap">ស្ថានភាព:គ្មាន</td>
                        
                        </tr>

                        <tr>
                        
                            <td  class="nowrap">ថ្ងៃខែឆ្នាំកំណើត: </td>
                            
                            <td  class="nowrap">សញ្ជាតិ: </td>
                        
                        </tr>

                        <tr>
                            
                            <td  class="nowrap">ទីលំនៅបច្ចុប្បន្ន: </td>
                        
                        </tr>

                        <tr>
                            
                            <td  class="nowrap">មុខរបរ: </td>
                        
                        </tr>
                        
                    
                        
                    <thead>
                    
                </table>

            </div>

            <p style="font-family: khmer mef2;margin-left:15px;">ឃ.ព័ត៍មានកូន</p>
        
            <div class="table-responsive">

                <table class="table table-bordered" >

                    <thead>

                        <th class="nowrap" >ល.រ</th>
                        
                        <th class="nowrap" >គោត្តនាម និង នាម</th>
                        
                        <th class="nowrap" >ជាអក្សរឡាតាំង</th>

                        <th class="nowrap" >ភេទ</th>
                        
                        <th class="nowrap" >ថ្ងៃខែឆ្នាំកំណើត</th>
                        
                        <th class="nowrap" >មុខរបរ(អង្គភាព)</th>

                        



                    <thead>
                    <tbody>
                        @if($userFamily->children_name)
                            
                            <?php $i=1;?>

                            @foreach(unserialize($userFamily->children_name) as $key => $name)
                                
                                <tr>

                                    <td>{{$i++}}</td>
                                    
                                    <td  style="font-size:12px" ><div style="width:130px;">{{$name}}</div></td>
                                    
                                    <td  style="font-size:12px" ><div style="width:130px;">{{unserialize($userFamily->children_name_in_english)[$key]}}</div></td>
                                    
                                    <td  style="font-size:12px" ><div style="width:50px;">{{unserialize($userFamily->children_gender)[$key]}}</div></td>
                                    
                                    <td  style="font-size:12px" ><div style="width:100px;">{{unserialize($userFamily->children_date)[$key]}}</div></td>
                                    
                                    <td  style="font-size:12px" ><div style="width:150px;">{{unserialize($userFamily->children_job)[$key]}}</div></td>
                                
                                </tr>

                            @endforeach

                        @endif

                    </tbody>

                    
                </table>  

            </div>
        @endif


    </div> 
        <!-- <form  method="get">
            @csrf
            @if(isset($user))
            <a href="/user/generate_pdf/{{$user->id}}" class="btn " style=" background: #696cff; color:white">print</a>
            @endif
           
        </form> -->
        
</div>
</div >

  