
<!-- <div class="form-main ">
                    
                <div class="form-content"> -->
            
                <!-- <div>              
</div> -->

                    <!-- ​​ព័ត៍មានអំពីស្ថានភាព -->
    <br>
    
    <center> <h4 class="form-top-header"><u> ស្ថានភាពគ្រួសារ </u></h4> <br></center>
        
        <h5 class="form-header"><i class="fas fa-address-book"></i> ក.ព័ត៍មានឪពុក</h5> <br>
            
        <form class="form-horizontal" action="{{ route('add_user_family') }}" method="post" enctype="multipart/form-data">
                
            @csrf
                <!-- Get Id from user -->
                <input type="hidden" value="<?= !empty($id)?$id:''?>" name="using_user_id" >
                
                <div class="form-row">
                    
                    <div class="form-group col-md-6">
                    
                        <label class="text-sm">ឈ្មោះឪពុក</label>
                    
                        <!-- <input type="text" class="form-control form-control-sm" placeholder="ការបរិច្ជេទចូលបំរើការងារដំបូង"> -->
                        
                        <input  type="text" 
                                               
                                name="father_name" 
                                
                                value="<?=!empty($userFamily)?$userFamily->father_name:old('father_name')?>"
                                
                                class="form-control form-control-sm"

                                required
                                
                                placeholder="ឈ្មោះឪពុក">                    
                    </div>
                    
                    <div class="form-group col-md-6">
                     
                        <label class="text-sm">ជាអក្សរឡាតាំង</label>
                     
                        <!-- <input type="text" class="form-control form-control-sm" placeholder="ការបរិច្ជេទចូលបំរើការងារដំបូង"> -->
                        <input  type="text" 
                        
                                name="father_name_eng" 
                                
                                value="<?= !empty($userFamily)?$userFamily->father_name_in_english:old('father_name_eng')?>"
                                
                                required

                                class="form-control form-control-sm"
                                
                                placeholder="ជាអក្សរឡាតាំង">
                    </div>
                   
                </div>
                
                <div class="form-row">
                    
                    <div class="form-group col-md-6">
                    
                        <label class="text-sm">ស្ថានភាព</label>
                    
                        <input  type="text" 
                                
                                class="form-control form-control-sm" 
                                
                                name="father_status" 
                                
                                value="<?= !empty($userFamily)?$userFamily->father_status:old('father_status')?>"

                                required

                                placeholder="ស្ថានភាព">
                    
                    </div>  
                    
                    <div class="form-group col-md-6">
                
                        <label class="text-sm">ថ្ងៃខែឆ្នាំកំណើត</label>
                
                        <input  type="date" 
                                
                                class="form-control form-control-sm" 
                                
                                name="f_date_first_birst" 

                                value="<?= !empty($userFamily)?$userFamily->father_date:old('f_date_first_birst')?>"

                                required>
                
                    </div>
                   
                </div>
                
                <div class="form-row">
                    
                    <div class="form-group col-md-6">
                    
                        <label class="text-sm">សញ្ចតិ</label>
                    
                        <input  type="text" 
                        
                                class="form-control form-control-sm" 
                                
                                name="f_national" 
                                
                                value="<?=  !empty($userFamily)?$userFamily->father_national:old('f_national')?>"

                                required
                                
                                placeholder="សញ្ចតិ">
                    
                    </div>
                    
                    <div class="form-group col-md-6">
                
                        <label class="text-sm">ទីលំនៅបច្ចុប្បន្ន</label>
                    
                        <input  type="text" 
                        
                                class="form-control form-control-sm" 
                                
                                name="f_current_residence"   

                                value="<?= !empty($userFamily)?$userFamily->f_current_residence:old('f_current_residence')?>"

                                required

                                placeholder="ទីលំនៅបច្ចុប្បន្ន">
                
                    </div>
                  
                </div>
                
                <div class="form-row">
                    
                    <div class="form-group col-md-6 ">
                
                        <label class="text-sm">មុខរបរ</label>
                
                        <input  type="text" 
                        
                                class="form-control form-control-sm" 
                                
                                name="f_job" 
                                
                                value="<?= !empty($userFamily)?$userFamily->father_job:old('f_job')?>"

                                required

                                placeholder="មុខរបរ">
                
                    </div>
                    <div class="form-group col-md-6 ">
                    
                        <label class="text-sm">ស្ថាប័ន/អង្គភាព</label>
                
                        <input  type="text" 
                        
                                class="form-control form-control-sm" 
                                
                                name="f_institudeOr_unit" 
                                
                                value="<?= !empty($userFamily)?$userFamily->f_institute:old('f_institudeOr_unit')?>"

                                required

                                placeholder="ស្ថាប័ន/អង្គភាព">
                
                    </div>
                
                </div> 
            
                <h5 class="form-header"><i class="fas fa-address-book"></i> ខ​.ព័ត៍មានម្តាយ</h5> 
                
                <div class="form-row">
                    
                    <div class="form-group col-md-6">
                    
                        <label class="text-sm">ឈ្មោះម្តាយ</label>
                    
                        <!-- <input type="text" class="form-control form-control-sm" placeholder="ការបរិច្ជេទចូលបំរើការងារដំបូង"> -->
                        <input  type="text" 
                                               
                                name="m_name" 
                                
                                value="<?=!empty($userFamily)?$userFamily->mother_name:old('m_name')?>"
                                
                                class="form-control form-control-sm"

                                required
                                
                                placeholder="ឈ្មោះម្តាយ">                    
                    </div>
                    
                    <div class="form-group col-md-6">
                     
                        <label class="text-sm">ជាអក្សរឡាតាំង</label>
                     
                        <!-- <input type="text" class="form-control form-control-sm" placeholder="ការបរិច្ជេទចូលបំរើការងារដំបូង"> -->
                        <input  type="text" 
                        
                                name="m_name_eng" 
                                
                                value="<?= !empty($userFamily)?$userFamily->mother_name_in_english:old('m_name_eng')?>"
                                
                                required

                                class="form-control form-control-sm"
                                
                                placeholder="ជាអក្សរឡាតាំង">
                    </div>
                   
                </div>
                
                <div class="form-row">
                    
                    <div class="form-group col-md-6">
                    
                        <label class="text-sm">ស្ថានភាព</label>
                    
                        <input  type="text" 
                                
                                class="form-control form-control-sm" 
                                
                                name="m_status" 
                                
                                value="<?=!empty($userFamily)?$userFamily->mother_status:old('m_status')?>"

                                required

                                placeholder="ស្ថានភាព">
                    
                    </div>  
                    
                    <div class="form-group col-md-6">
                
                        <label class="text-sm">ថ្ងៃខែឆ្នាំកំណើត</label>
                
                        <input  type="date" 
                                
                                class="form-control form-control-sm" 
                                
                                name="m_date_of_birst" 

                                value="<?= !empty($userFamily)?$userFamily->mother_date:old('m_date_of_birst')?>"

                                required
                                
                                placeholder="ថ្ងៃខែឆ្នាំកំណើត">
                
                    </div>
                   
                </div>
                
                <div class="form-row">
                    
                    <div class="form-group col-md-6">
                    
                        <label class="text-sm">សញ្ចតិ</label>
                    
                        <input  type="text" 
                        
                                class="form-control form-control-sm" 
                                
                                name="m_national" 
                                
                                value="<?= !empty($userFamily)?$userFamily->mother_national:old('m_national')?>"

                                required
                                
                                placeholder="សញ្ចតិ">
                    
                    </div>
                    
                    <div class="form-group col-md-6">
                
                        <label class="text-sm">ទីលំនៅបច្ចុប្បន្ន</label>
                    
                        <input  type="text" 
                        
                                class="form-control form-control-sm" 
                                
                                name="m_current_residence"   

                                value="<?=!empty($userFamily)?$userFamily->m_current_residence:old('m_current_residence')?>"

                                required

                                placeholder="ទីលំនៅបច្ចុប្បន្ន">
                
                    </div>
                  
                </div>
                
                <div class="form-row">
                    
                    <div class="form-group col-md-6 ">
                
                        <label class="text-sm">មុខរបរ</label>
                
                        <input  type="text" 
                        
                                class="form-control form-control-sm" 
                                
                                name="m_job" 
                                
                                value="<?= !empty($userFamily)?$userFamily->m_current_residence:old('mother_job')?>"

                                required

                                placeholder="មុខរបរ">
                
                    </div>
                    <div class="form-group col-md-6 ">
                    
                        <label class="text-sm">ស្ថាប័ន/អង្គភាព</label>
                
                        <input  type="text" 
                        
                                class="form-control form-control-sm" 
                                
                                name="m_instituteOr_unit" 
                                
                                value="<?= !empty($userFamily)?$userFamily->m_institute:old('m_instituteOr_unit')?>"

                                required

                                placeholder="ស្ថាប័ន/អង្គភាព">
                
                    </div>
                
                </div> 


                <h5 class="form-header d-flex align-items-center justify-content-between">
                   
                    <div><i class="fas fa-address-book"></i> ព័ត៍មានបងប្អូន </div>
                    
                    <div>
                        
                        @component('components.buttons.btn_count',['class'=>'btn_click6'])
                     
                        @endcomponent

                    </div>
                </h5> 

                <div class="row" id="modal-body5">

               
                    @if(!empty($userFamily) )
                    
                        @component('components.user.form_edit_user_relative',['userFamily'=>$userFamily])
                        
                        @endcomponent
                    @else
         
                        <div class="row6">
                    
                            <!-- @component('components.user.form_user_relative')
                                
                            @endcomponent -->
                            
                        </div>
                
                    @endif
            
                </div>

                <h5 class="form-header"><i class="fas fa-address-book"></i>  គ.ព័ត៍មានសហព័ន្ធ​ </h5> 
                
                <div class="form-row">
                    
                    <div class="form-group col-md-6">
                    
                        <label class="text-sm">ឈ្មោះប្តី ឫ ប្រព័ន្ធ</label>
                    
                        <input  type="text" 
                                               
                                name="federation_name" 
                                
                                value="<?= !empty($userFamily)?$userFamily->federation_name:old('federation_name')?>"
                                
                                class="form-control form-control-sm"

                                required
                                
                                placeholder="ឈ្មោះម្តាយ">                    
                    </div>
                    
                    <div class="form-group col-md-6">
                     
                        <label class="text-sm">ជាអក្សរឡាតាំង</label>
                     
                    
                        <input  type="text" 
                        
                                name="eng_federation_name" 
                                
                                value="<?=  !empty($userFamily)?$userFamily->federation_name_in_english:old('eng_federation_name')?>"
                                
                                required

                                class="form-control form-control-sm"
                                
                                placeholder="ជាអក្សរឡាតាំង">
                    </div>
                   
                </div>
                
                <div class="form-row">
                    
                    <div class="form-group col-md-6">
                    
                        <label class="text-sm">ស្ថានភាព</label>
                    
                        <input  type="text" 
                                
                                class="form-control form-control-sm" 
                                
                                name="federation_status" 
                                
                                value="<?= !empty($userFamily)?$userFamily->federation_status:old('federation_status')?>"

                                required

                                placeholder="ស្ថានភាព">
                    
                    </div>  
                    
                    <div class="form-group col-md-6">
                
                        <label class="text-sm">ថ្ងៃខែឆ្នាំកំណើត</label>
                
                        <input  type="date" 
                                
                                class="form-control form-control-sm" 
                                
                                name="date_federation" 

                                value="<?=  !empty($userFamily)?$userFamily->federation_date:old('date_federation')?>"

                                required
                                
                                placeholder="ថ្ងៃខែឆ្នាំកំណើត">
                
                    </div>
                   
                </div>
                
                <div class="form-row">
                    
                    <div class="form-group col-md-6">
                    
                        <label class="text-sm">សញ្ចតិ</label>
                    
                        <input  type="text" 
                        
                                class="form-control form-control-sm" 
                                
                                name="federation_national" 
                                
                                value="<?= !empty($userFamily)?$userFamily->federation_national:old('federation_national')?>"

                                required
                                
                                placeholder="សញ្ចតិ">
                    
                    </div>
                    
                    <div class="form-group col-md-6">
                
                        <label class="text-sm">ទីលំនៅបច្ចុប្បន្ន</label>
                    
                        <input  type="text" 
                        
                                class="form-control form-control-sm" 
                                
                                name="federation_current_residence"   

                                value="<?= !empty($userFamily)?$userFamily->federation_current_residence:old('federation_current_residence')?>"

                                required

                                placeholder="ទីលំនៅបច្ចុប្បន្ន">
                
                    </div>
                  
                </div>
                
                <div class="form-row">
                    
                    <div class="form-group col-md-6 ">
                
                        <label class="text-sm">មុខរបរ</label>
                
                        <input  type="text" 
                        
                                class="form-control form-control-sm" 
                                
                                name="federation_job" 
                                
                                value="<?= !empty($userFamily)?$userFamily->federation_job:old('federation_job')?>"

                                required

                                placeholder="មុខរបរ">
                
                    </div>
                    <div class="form-group col-md-6 ">
                    
                        <label class="text-sm">ស្ថាប័ន/អង្គភាព</label>
                
                        <input  type="text" 
                        
                                class="form-control form-control-sm" 
                                
                                name="federation_institute" 
                                
                                value="<?= !empty($userFamily)?$userFamily->federation_institute:old('federation_institute')?>"

                                required

                                placeholder="ស្ថាប័ន/អង្គភាព">
                
                    </div>
                
                </div> 
                <div class="form-row">
                    
                    <div class="form-group col-md-6 ">
                
                        <label class="text-sm">ប្រាក់ឧបត្ថម្ភ</label>
                
                        <input  type="text" 
                        
                                class="form-control form-control-sm" 
                                
                                name="federation_allowance" 
                                
                                value="<?= !empty($userFamily)?$userFamily->federation_allowance:old('federation_allowance')?>"

                                required

                                placeholder="ប្រាក់ឧបត្ថម្ភ">
                
                    </div>
                    <div class="form-group col-md-6 ">
                    
                        <label class="text-sm">លេខទូរស័ព្ទ</label>
                
                        <input  type="text" 
                        
                                class="form-control form-control-sm" 
                                
                                name="federation_phone_number" 
                                
                                value="<?= !empty($userFamily)?$userFamily->federation_phone_number:old('federation_phone_number')?>"

                                required

                                placeholder="ស្ថាប័ន/អង្គភាព">
                
                    </div>
                
                </div> 

         

                <h5 class="form-header d-flex align-items-center justify-content-between">
                   
                   <div><i class="fas fa-address-book"></i> ព័ត៍មានកូន </div>
                   
                   <div>
                       
                       @component('components.buttons.btn_count',['class'=>'btn_click8'])
                   
                       @endcomponent

                   </div>
               </h5> 

               <div class="row" id="modal-body8">

              
                   @if(!empty($userFamily) )
                   
                       @component('components.user.form_edit_user_children',['userFamily'=>$userFamily])
                       
                       @endcomponent
                   @else
        
                       <div class="row8">
                   
                           <!-- @component('components.user.form_user_children')
                               
                           @endcomponent -->
                           
                       </div>
               
                   @endif
    
               </div>
              

              
       

                <button type="submit" class="btn btn-sm" style=" background: #696cff; color:white">រក្សាទុក</button>
                
        </form>
      


    <style>
        
        .hoverable-input {
        
            position: relative;
    
        }

        .hoverable-textarea {
        
            position: absolute;
        
            top: 0;
        
            left: 0;
        
            width: 100%;
        
            height: 100%;
        
        }

    </style>

<script>

    // ---------------------------Alert Auto--------------------------------------------
    $('#success-alert, #error-alert').fadeIn('slow');
    
    setTimeout(function() {

        $('#success-alert, #error-alert').fadeOut('slow');
    
    }, 5000); // 5 seconds in milliseconds
    // --------------------------------------border green and red -------------------------------------------
    $(document).ready(function(){
    
        $('input,select').blur(function(){
            
            if($(this).val() != ''){
    
                $(this).addClass('add-border-green');
    
                $(this).removeClass('add-border-red');
    
            }else {
    
                $(this).addClass('add-border-red');
    
                $(this).removeClass('add-border-green');
            }
            
        });
    
    });

    //    ----------------------------Insert Row see only modal--------------------------------------
        $(document).ready(function(){

            $('.btn_click6').click(function(){

                // @if(!empty($user_information))

                    // we use user_information cus it in user_information

                    // var formHtml = `{!! view('components.user.form_user_relative', ['user_information' => $user_information])->render() !!}`;
                
                // @else
                
                    var formHtml = `{!! view('components.user.form_user_relative')->render() !!}`;
                
                // @endif
                // Insert the content of the additional_current_on_job component
            
                // $('#modal-body').append(formHtml);
            
                $('#modal-body5').append('<div class="row6">' + formHtml + '<button class="btn btn-sm btn-danger btn_remove  float-sm-right">លុប</button></div>');
            });
            $('.btn_click8').click(function(){
             
             var formHtml = `{!! view('components.user.form_user_children')->render() !!}`;
     
                $('#modal-body8').append('<div class="row8">' + formHtml + '<button class="btn btn-sm btn-danger btn_remove  float-sm-right">លុប</button></div>');
            });
        
            $(document).on('click', '.btn_remove', function() {

                $(this).closest('.row6,.row8').remove();
            
            });

        });

</script>

