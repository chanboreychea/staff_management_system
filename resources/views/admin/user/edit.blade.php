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

<!-- Include your script JavaScript file  this is click buttom link modal and ajax return data in file script-->

<script src="{{ asset('js/script.js') }}"></script>


  
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
