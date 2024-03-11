@extends('template.master')
@section('title', 'User')
@section('content')

    @if($id && !empty($user_information))

        @if($message = Session::get('msg'))
            
            <div id="success-alert" class="alert alert-success" role="alert">
            
                {{ $message }}
            
            </div>
        
        @endif
        

        @component('components.user.user_form_information', ['id' => $id, 'user_information' => $user_information])
            <!-- Additional content if necessary -->
        @endcomponent

    @else
            
        @if($message = Session::get('msg'))
        
            <div id="success-alert" class="alert alert-success" role="alert">
            
                {{ $message }}
            
            </div>
        
        @endif
      
        @component('components.user.user_form_information', ['id' => $id])
            <!-- Additional content if necessary -->
        @endcomponent

    @endif

@endsection

