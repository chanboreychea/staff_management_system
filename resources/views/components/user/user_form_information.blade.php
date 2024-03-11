
<!-- <div class="form-main ">
                    
                    <div class="form-content"> -->

      
                    <!-- ​​ព័ត៍មានអំពីស្ថានភាព -->
            <br>
            <center> <h4 class="form-top-header"><u> ​​ព័ត៍មានអំពីស្ថានភាព</u></h4> <br></center>
            <h5 class="form-header"><i class="fas fa-address-book"></i> ចូលបម្រើការងាររដ្ឋដំបូង</h5> <br>
            
            <form class="form-horizontal" action="{{ route('add_user_infromation') }}" method="post" enctype="multipart/form-data">
                
            @csrf

                <!-- Get Id from user -->

                <input type="hidden" value="<?= !empty($id)?$id:''?>" name="using_user_id" >
                
                <div class="form-row">
                    
                    <div class="form-group col-md-6">
                    
                        <label class="text-sm">ការបរិច្ឆេទចូលបំរើការងាររដ្ឋដំបូង</label>
                    
                        <!-- <input type="text" class="form-control form-control-sm" placeholder="ការបរិច្ជេទចូលបំរើការងារដំបូង"> -->
                        <input  type="date" 
                                               
                                name="date_enteing_public_service" 
                                
                                value="<?= !empty($user_information)?$user_information->date_enteing_public_service:old('date_enteing_public_service')?>"
                                
                                class="form-control form-control-sm"

                                
                                
                                placeholder="ថ្ងៃ-ខែ​​​-ឆ្នាំ">                    
                    </div>
                    
                    <div class="form-group col-md-6">
                     
                        <label class="text-sm">ការបរិច្ឆេទតាំងស៊ប់</label>
                     
                        <!-- <input type="text" class="form-control form-control-sm" placeholder="ការបរិច្ជេទចូលបំរើការងារដំបូង"> -->
                        <input  type="date" 
                        
                                
                                
                                name="comfirm_date" 
                                
                                value="<?= !empty($user_information)?$user_information->comfirm_date:old('comfirm_date')?>"
                                
                                

                                class="form-control form-control-sm"
                                
                                placeholder="ថ្ងៃ-ខែ​​​-ឆ្នាំ">
                    </div>
                   
                </div>
                
                <div class="form-row">
                    
                    <div class="form-group col-md-6">
                    
                        <label class="text-sm">ក្របខណ្ឌ</label>
                    
                        <input  type="text" 
                                
                                class="form-control form-control-sm" 
                                
                                name="constitution" 
                                
                                
                                
                                value="<?= !empty($user_information)?$user_information->constitution:old('constitution')?>"

                                

                                placeholder="ក្របខណ្ឌ">
                    
                    </div>  
                    
                    <div class="form-group col-md-6">
                
                        <label class="text-sm">មុខតំណែង</label>
                
                        <input  type="text" 
                                
                                class="form-control form-control-sm" 
                                
                                name="position_enteing_public_service" 
                                
                                 

                                value="<?= !empty($user_information)?$user_information->position_enteing_public_service:old('position_enteing_public_service')?>"

                                
                                
                                placeholder="មុខតំណែង">
                
                    </div>
                   
                </div>
                
                <div class="form-row">
                    
                    <div class="form-group col-md-6">
                    
                        <label class="text-sm">ក្រសួង/ស្ថាប័ន</label>
                    
                        <input  type="text" 
                        
                                class="form-control form-control-sm" 
                                
                                name="ministry_enteing_public_service" 
                                
                                value="<?= !empty($user_information)?$user_information->ministry_enteing_public_service:old('ministry_enteing_public_service')?>"

                                
                                
                                placeholder="ក្រសួង/ស្ថាប័ន">
                    
                    </div>
                    
                    <div class="form-group col-md-6">
                
                        <label class="text-sm">អង្គភាព</label>
                    
                        <input  type="text" 
                        
                                class="form-control form-control-sm" 
                                
                                name="economy_enteing_public_service"   

                                value="<?= !empty($user_information)?$user_information->economy_enteing_public_service:old('economy_enteing_public_service')?>"

                                

                                placeholder="អង្គភាព">
                
                    </div>
                  
                </div>
                
                <div class="form-row">
                    
                    <div class="form-group col-md-6 ">
                
                        <label class="text-sm">ការិយាល័យ</label>
                
                        <input  type="text" 
                        
                                class="form-control form-control-sm" 
                                
                                name="office_enteing_public_service" 
                                
                                value="<?= !empty($user_information)?$user_information->office_enteing_public_service:old('office_enteing_public_service')?>"

                                

                                placeholder="ការិយាល័យ">
                
                    </div>
                
                </div> 
                
                <!-- ស្ថានភាពមុខងារបច្ចុប្បន្ន -->

                <h5 class="form-header"><i class="fas fa-address-book"></i> ស្ថានភាពមុខងារបច្ចុប្បន្ន</h5> 
                
                <br>
                
                <div class="form-row">
                
                    <div class="form-group col-md-6">
                    
                        <label class="text-sm" >ក្របខណ្ឌ​​ ឋានន្តរស័ក្ត​ និងថ្នាក់</label>
                        
                            <input  type="text" 
                                    
                                    class="form-control form-control-sm" 
                                    
                                   
                                    
                                    name="constitution_misitry_rank"  
                                    
                                    value="<?= !empty($user_information)?$user_information->constitution_misitry_rank:old('constitution_misitry_rank')?>"


                                    placeholder="ក្របខណ្ឌ​​ ឋានន្តរស័ក្ត​ និងថ្នាក់">
                    
                    </div>
                
                    <div class="form-group col-md-6">
                
                        <label class="text-sm" >កាលបរិច្ឆេទប្តូរក្រខណ្ខ ឋានន្តរស័ក្ត និងថ្នាក់ចុងក្រោយ</label>
                    
                        <!-- <input type="text" class="form-control form-control-sm" placeholder="កាលបរិច្ឆេទប្តូរក្រខណ្ខ ឋានន្តរស័ក្ត និងថ្នាក់ចុងក្រោយ"> -->
                        <input  type="date" 
                                
                                
                                
                                name="constitution_amendment_date" 
                                
                                value="<?= !empty($user_information)?$user_information->constitution_amendment_date:old('constitution_amendment_date')?>"

                                class="form-control form-control-sm" 
                                


                                placeholder="ថ្ងៃ-ខែ​​​-ឆ្នាំ">
                    </div>
                
                </div>
                
                <div class="form-row">
                
                    <div class="form-group col-md-6">
                    
                        <label class="text-sm" >មុខតំណែង</label>
                        
                        <input  type="text" 
                                
                                class="form-control form-control-sm" 
                                
                                name="position_current_job_situation" 
                                
                              

                                value="<?= !empty($user_information)?$user_information->position_current_job_situation:old('position_current_job_situation')?>"

                                

                                placeholder="មុខតំណែង">
                    
                    </div>
                    
                    <div class="form-group col-md-6">
                    
                        <label class="text-sm" >កាលបរិច្ឆេទទទូលមុខតំណែងចុងក្រោយ</label>
                        
                        <!-- <input type="text" class="form-control form-control-sm" placeholder="កាលបរិច្ឆេទទទូលមុខតំណែងចុងក្រោយ"> -->
                        <input  type="date" 
                                
                                
                                
                                name="effective_date_of_last_promotion" 

                                value="<?= !empty($user_information)?$user_information->effective_date_of_last_promotion:old('effective_date_of_last_promotion')?>"
                                
                                class="form-control form-control-sm"

                                
                                
                                placeholder="ថ្ងៃ-ខែ​​​-ឆ្នាំ">
                    </div>
                
                </div>
                
                <div class="form-row">
                
                    <div class="form-group col-md-6">
                    
                        <label class="text-sm" >អង្គភាព</label>
                        
                        <input  type="text" 
                                
                                class="form-control form-control-sm" 
                                
                                name="economy_current_job_situation" 

                                value="<?= !empty($user_information)?$user_information->economy_current_job_situation:old('economy_current_job_situation')?>"
                                
                                

                                placeholder="អង្គភាព">
                    
                    </div>
                   
                </div>
                
                <!-- តួនាទីបន្ថែមលើមុខងារបច្ចុប្បន្ន -->

                <h5 class="form-header d-flex align-items-center justify-content-between">
                    <div><i class="fas fa-address-book"></i>តួនាទីបន្ថែមលើមុខងារបច្ចុប្បន្ន </div>
                    
                    <div>
                        
                        @component('components.buttons.btn_count',['class'=>'btn_click'])
                            <!-- button -->
                        @endcomponent
                    </div>
                </h5> 

                <div class="row" id="modal-body">

               
                @if(!empty($AdditionalPositionCurrentJob) )
                   
                    @component('components.user.form_edit_additional_current_on_job',['AdditionalPositionCurrentJob'=>$AdditionalPositionCurrentJob])
                    
                    @endcomponent
                @else
         
                    <div class="row1">
                 
                        {{-- @component('components.user.form_additional_current_on_job')
                            
                        @endcomponent --}}
                        
                    </div>
               
                @endif
            

              
     
                </div>
            
                <!-- <button type="submit" class="btn btn-submit ">Create Account</button>  -->

                <button type="submit" class="btn btn-sm" style=" background: #696cff; color:white">រក្សាទុក</button>
                
            </form>
      
            <!-- <div>
                    
</div> -->

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

        $('.btn_click').click(function(){

            @if(!empty($user_information))

                // we use user_information cus it in user_information

                var formHtml = `{!! view('components.user.form_additional_current_on_job', ['user_information' => $user_information])->render() !!}`;
            
            @else
        
                var formHtml = `{!! view('components.user.form_additional_current_on_job')->render() !!}`;
            
            @endif
            
            // Insert the content of the additional_current_on_job component
         
            // $('#modal-body').append(formHtml);
           
            $('#modal-body').append('<div class="row1">' + formHtml + '<button class="btn btn-sm btn-danger btn_remove  float-sm-right">លុប</button></div>');
        });
       
        $(document).on('click', '.btn_remove', function() {

            $(this).closest('.row1').remove();
        
        });
    
    });

  

</script>

