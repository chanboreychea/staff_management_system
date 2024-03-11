@extends('template.master')

@section('title', 'User')

@section('page-script')
<!-- <script src="{{ asset('js/script.js') }}"></script> -->
@endsection

@section('content')

    <!-- ---------------------------Message---------------------------------- -->
        @component('components.alerts.message')@endcomponent
    
    <div class="card">
        <!-- ----------------------------Link Modal------------------------------------ -->
        
            @component('components.user_link.modal_link',['user'=>$user])
                            
            @endcomponent
        
        <!-- ----------------------------End Link------------------------------------ -->

        <!-- --------------------------Main User--------------------------- -->
            @component('components.user.form_main_user',['user'=>$user,'roles'=>$roles,'departments'=>$departments,'offices'=>$offices])
                        
            @endcomponent
        <!-- --------------------------End Main User--------------------------- --> 

    </div>
    <!-- ---------------------------Modal---------------------------------------------- -->
        @component('components.user_modal.user_information_model')
                        
        @endcomponent
<!-- Include jQuery -->

<!-- Include your custom JavaScript file -->
<script src="{{ asset('js/script.js') }}"></script>

    <script >
        // $(document).ready(function () {

        //     $('#btn1').click(function(){
            
        //         var userId =$(this).data('id');
            
        //         alert(userId);

        //     // Send an AJAX request to fetch the user details
            
        //         $('#exLargeModal .modal-body1').html('<br><div class="spinner-container" style="display: flex; justify-content: center; align-items: center; height: 100%;">' +
        //                                 '<img src="{{ asset('images/logo2.png') }}" class="loading-circle animated" alt="Loading..." style="width: 50px; height: 50px; border-radius: 50%;" />' +
        //                                 '<p style="margin-top: 10px;">Loading...</p>' +
        //                             '</div>');
        //         setTimeout(function() {
        //             // Send an AJAX request to fetch the user details
        //             $.ajax({
        //                 type: "GET",
        //                 url: "/user/user_form_information/" + userId,
        //                 data: {_token: '{{ csrf_token() }}'},
        //                 dataType: "json",
        //                 success: function (response) {
        //                     // Render the component with the user data
        //                     $('#exLargeModal .modal-body1').html(response.html);
        //                 },
        //                 error: function(xhr, status, error) {
        //                     console.error(xhr.responseText);
        //                 }
        //             });
        //         }, 3500); 
                
        //     });
        //     $('#btn2').click(function(){
        //         var userId =$(this).data('id');
        //         alert(userId);

        //     // Send an AJAX request to fetch the user details
            
        //         $('#exLargeModal2 .modal-body2').html('<br><div class="spinner-container" style="display: flex; justify-content: center; align-items: center; height: 100%;">' +
        //                                 '<img src="{{ asset('images/logo2.png') }}" class="loading-circle animated" alt="Loading..." style="width: 50px; height: 50px; border-radius: 50%;" />' +
        //                                 '<p style="margin-top: 10px;">Loading...</p>' +
        //                             '</div>');
        //         setTimeout(function() {
        //             // Send an AJAX request to fetch the user details
        //             $.ajax({
        //                 type: "GET",
        //                 url: "/user/user_work_history/" + userId,
        //                 data: {_token: '{{ csrf_token() }}'},
        //                 dataType: "json",
        //                 success: function (response) {
        //                     // Render the component with the user data
        //                     $('#exLargeModal2 .modal-body2').html(response.html);
        //                 },
        //                 error: function(xhr, status, error) {
        //                     console.error(xhr.responseText);
        //                 }
        //             });
        //         }, 3500); 
                
        //     });

        //     $('#btn3').click(function(){
        //         var userId =$(this).data('id');
        //         alert(userId);

        //     // Send an AJAX request to fetch the user details
            
        //         $('#exLargeModal3 .modal-body3').html('<br><div class="spinner-container" style="display: flex; justify-content: center; align-items: center; height: 100%;">' +
        //                                 '<img src="{{ asset('images/logo2.png') }}" class="loading-circle animated" alt="Loading..." style="width: 50px; height: 50px; border-radius: 50%;" />' +
        //                                 '<p style="margin-top: 10px;">Loading...</p>' +
        //                             '</div>');
        //         setTimeout(function() {
        //             // Send an AJAX request to fetch the user details
        //             $.ajax({
        //                 type: "GET",
        //                 url: "/user/modal_certificate_of_appreciateion/" + userId,
        //                 data: {_token: '{{ csrf_token() }}'},
        //                 dataType: "json",
        //                 success: function (response) {
        //                     // Render the component with the user data
        //                     $('#exLargeModal3 .modal-body3').html(response.html);
        //                 },
        //                 error: function(xhr, status, error) {
        //                     console.error(xhr.responseText);
        //                 }
        //             });
        //         }, 3500); 
                
        //     });

        //     $('#btn4').click(function(){
        //         var userId =$(this).data('id');
        //         alert(userId);

        //     // Send an AJAX request to fetch the user details
            
        //         $('#exLargeModal4 .modal-body4').html('<br><div class="spinner-container" style="display: flex; justify-content: center; align-items: center; height: 100%;">' +
        //                                 '<img src="{{ asset('images/logo2.png') }}" class="loading-circle animated" alt="Loading..." style="width: 50px; height: 50px; border-radius: 50%;" />' +
        //                                 '<p style="margin-top: 10px;">Loading...</p>' +
        //                             '</div>');
        //         setTimeout(function() {
        //             // Send an AJAX request to fetch the user details
        //             $.ajax({
        //                 type: "GET",
        //                 url: "/user/education_level/" + userId,
        //                 data: {_token: '{{ csrf_token() }}'},
        //                 dataType: "json",
        //                 success: function (response) {
        //                     // Render the component with the user data
        //                     $('#exLargeModal4 .modal-body4').html(response.html);
        //                 },
        //                 error: function(xhr, status, error) {
        //                     console.error(xhr.responseText);
        //                 }
        //             });
        //         }, 3500); 
                
        //     });

        // });


    </script>
  
<style>
    @keyframes spin {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}

.animated {
    animation: spin 2s linear infinite; /* Apply the animation to the image */
}
</style>

@endsection
