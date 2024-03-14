
<br>
        
        <form class="form-horizontal" action="/user/add_eduction_level" method="post">
            
            @csrf
            <center> <h4 class="form-top-header"><u> កម្រិតវប្បធម៍ទូទៅ ការបណ្តុះបណ្តាលវិទ្យាជីវ​ និងការបណ្តុះបណ្តាលបន្ត</u></h4></center>
            
            <h5 class="form-header d-flex align-items-center justify-content-between">
                    <div>កម្រិតវប្បធម៍ទូទៅ ការបណ្តុះបណ្តាលវិទ្យាជីវ​ និងការបណ្តុះបណ្តាលបន្ត</div>
                        
                    <div>
                            
                        @component('components.buttons.btn_count',['class'=>'btn_click5'])
                            <!-- button -->
                        @endcomponent

                    </div>
            </h5>          
    
            <input type="hidden" value="<?= !empty($id)?$id:''?>" name="using_user_id" >
            
            <div class="row" id="modal-body4" >
    
                @if(!empty($eductionLevel))
    
                    @component('components.user.form_edit_education_level',['eductionLevel'=>$eductionLevel])
                            
                    @endcomponent
                @else
            
                    <div class="row5">
                        
                        {{-- @component('components.user.form_add_education_level')
                                
                        @endcomponent --}}
    
                    </div>
        
                @endif
                
            </div>
            
    
            <button type="submit" class="btn btn-sm" style=" background: #696cff; color:white">រក្សាទុក</button>
            
        </form>
    
    
    <script>
    
    //    ----------------------------Insert Row see only modal--------------------------------------
        
    $(document).ready(function(){
        // Event delegation for blur event on inputs
        $(document).on('blur', 'input','select', function(){
            if($(this).val() != ''){
                $(this).addClass('add-border-green').removeClass('add-border-red');
            } else {
                $(this).addClass('add-border-red').removeClass('add-border-green');
            }
        });
    
        $('.btn_click5').click(function(){
            
            var formHtml =`{!! view('components.user.form_add_education_level')->render() !!}`;
    
            $('#modal-body4').append('<div class="row5">' + formHtml + '<button class="btn btn-sm btn-danger btn_remove float-sm-right">លុប</button></div>');
        });
    
        $(document).on('click', '.btn_remove', function() {
    
            $(this).closest('.row5').remove();
        
        });
    
    });
    
    
    
    
    </script>
    
    