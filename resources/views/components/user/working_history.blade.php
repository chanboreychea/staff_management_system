
            <br>
            
            
            <form class="form-horizontal" action="{{ route('add_user_working_histories') }}" method="post" enctype="multipart/form-data">
                
                @csrf
                <center> <h4 class="form-top-header"><u> ប្រវត្តិការងារ</u></h4></center>
            
              
                

                <h5 class="form-header d-flex align-items-center justify-content-between"> 
                    <div><i class="fas fa-address-book"></i> ក. ក្នុងវិស័យមុខងារសារធារណៈ  </div> 
                    <div>
                        
                        @component('components.buttons.btn_count',['class'=>'btn_click1'])
                            <!-- button -->
                        @endcomponent

                    </div>
                </h5>               

                <input type="hidden" value="<?= !empty($id)?$id:''?>" name="using_user_id" >
               
                <div class="row" id="modal-body1" style="overflow-x: auto;">
                    @if(!empty($workingHistoryPublicSector))

                        @component('components.user.form_edit_working_history_public_sector',['workingHistoryPublicSector'=>$workingHistoryPublicSector])
                                
                        @endcomponent
                    @else
                
                        <div class="row2">
                            
                            {{-- @component('components.user.form_add_working_history_public_sector')
                                    
                            @endcomponent --}}

                        </div>
            
                    @endif
                  
                </div>
                <!-- --------------------------------------ខ​ ​ក្នុងវិស័យឯកជន------------------------------------------------- -->
               
                
            
                <br> 
                <h5 class="form-header d-flex align-items-center justify-content-between">
                    <div><i class="fas fa-address-book"></i> ខ. ក្នុងវិស័យឯកជន</div>
                    <div >
                        
                        @component('components.buttons.btn_count',['class'=>'btn_click2'])
                            <!-- button -->
                        @endcomponent

                </div>
                </h5>      

                <input type="hidden" value="<?= !empty($id)?$id:''?>" name="using_user_id" >
               
                <div class="row" id="modal-body2" style="overflow-x: auto;">
                    @if(!empty($workingHistoryPrivateSector))

                        @component('components.user.form_edit_working_history_private_sector',['workingHistoryPrivateSector'=>$workingHistoryPrivateSector])
                                
                        @endcomponent
                    @else
                
                        <div class="row3">
                            
                            {{-- @component('components.user.form_add_working_history_private_sector')
                                    
                            @endcomponent --}}

                        </div>
            
                    @endif
                  
                </div>

                <button type="submit" class="btn btn-sm " style=" background: #696cff; color:white">រក្សាទុក</button>
                
            </form>


<script>

//    ----------------------------Insert Row see only modal--------------------------------------
$('#success-alert, #error-alert').fadeIn('slow');
    
    setTimeout(function() {

        $('#success-alert, #error-alert').fadeOut('slow');
    
    }, 5000); 


$(document).ready(function(){
    // Event delegation for blur event on inputs
    $(document).on('blur', 'input', function(){
        if($(this).val() != ''){
            $(this).addClass('add-border-green').removeClass('add-border-red');
        } else {
            $(this).addClass('add-border-red').removeClass('add-border-green');
        }
    });

    $('.btn_click1').click(function(){

        
        var formHtml =`{!! view('components.user.form_add_working_history_public_sector')->render() !!}`;

        $('#modal-body1').append('<div class="row2">' + formHtml + '<button class="btn btn-sm btn-danger btn_remove float-sm-right">លុប</button></div>');
    });

    $('.btn_click2').click(function(){
        var formHtml = `{!! view('components.user.form_add_working_history_private_sector')->render() !!}`;
        $('#modal-body2').append('<div class="row3">' + formHtml + '<button class="btn btn-sm btn-danger btn_remove float-sm-right">លុប</button></div>');
    });

    $(document).on('click', '.btn_remove', function() {
        $(this).closest('.row2, .row3').remove();
    });
});




</script>

