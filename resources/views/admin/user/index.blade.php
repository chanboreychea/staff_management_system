@extends('template.master')
@section('title', 'User')
@section('content')

    <div class="card">
        <div class="card-header">
            <h5 class="m-0"><a href="/users/create" class="btn btn-success btn-sm">បន្ថែមមន្ត្រី</a></h5>
        </div>
        <div class="card-body table-responsive" style="font-size: 12px;vertical-align:middle">
            <table class="table table-sm table-bordered">
                <thead class="thead-dark " style="background: rgb(5, 38, 103);color: white" >
                    <tr>
                        <th class="nowrap">ល.រ</th>
                        <th class="nowrap">ឈ្មោះ</th>
                        <th class="nowrap">មុខងារ</th>
                        <th class="nowrap">ភេទ</th>
                        <th class="nowrap">លេខទូរស័ព្ទ</th>
                        <th class="nowrap">អ៊ីម៉ែល</th>
                        <th class="nowrap">រូបភាព</th>
                        <th class="nowrap">សកម្មភាព</th>
                    </tr>
                </thead>
                <tbody   style="font-size: 12px;" >
                    @foreach ($users as $key => $user)
                        <tr style="vertical-align:middle">
                            <td scope="row">{{ $key + 1 }}</td>
                            <td>{{ $user->lastNameKh }} {{ $user->firstNameKh }}</td>
                            <td class="nowrap">
                                {{-- {{ optional($user->role)->roleNameKh }} --}}
                              
                                    @if ($user->roleAction==0)
                                         មន្រ្តីសារធារណៈ
                                    @else
                                        មន្រ្តីលក្ខន្តិកៈ
                                    
                                    @endif
                             
                            </td>
                            <td>
                                @if ($user->gender == 'f')
                                    ស្រី
                                @elseif ($user->gender == 'm')
                                    ប្រុស
                                @else
                                    ផ្សេងៗ
                                @endif
                            </td>
                            <td>{{ $user->phoneNumber }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <div class="box-img">
                                    <img class="img-responsive" src="{{ asset('images/' . $user->image) }}" alt="">
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center align-items-center">
                                    <form class="me-2" action="/users/{{ $user->id }}/edit" class=""
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input class="btn btn-dark btn-sm" type="submit" value="Edit">
                                    </form>
                                    <form action="/users/{{ $user->id }}">
                                        @csrf
                                        <input class="btn btn-primary btn-sm" type="submit" value="Show">
                                    </form>
                                    <div class="m-2">
                                        <button href="" class="btn btn-warning btn-sm" data-id="{{ $user->id }}" data-bs-toggle="modal" data-bs-target="#detailModel">Detail</>
                                    </div>    
                                    
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- --------------------------detail------------------------- -->
  
    <div class="modal fade" id="detailModel" tabindex="-1" aria-hidden="true">
          
        <div class="modal-dialog modal-lg" role="document">
        
            <div class="modal-content">
            
                <div class="modal-header">
                 
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                
                </div>
              
                <div class="modal-body">

               
                 
                    @component('components.user.detail')

                    @endcomponent
               
                </div>
            
            </div>
          
        </div>
        
    </div>

  

<script>
    $(document).ready(function() {
    // Handle click event on buttons
    $('button[data-bs-toggle="modal"]').click(function() {
        // Get the user ID from the button's data attribute
        var userId = $(this).data('id');

      
        $('#detailModel .modal-body').html('<div class="spinner-container" style="display: flex; justify-content: center; align-items: center; height: 100%;">' +
                                    '<img src="{{ asset('images/loading.png') }}" class="loading-circle animated" alt="Loading..." style="width: 50px; height: 50px; border-radius: 50%;" />' +
                                    '<p style="margin-top: 10px;">Loading...</p>' +
                                '</div>');

        // Send an AJAX request to fetch the user details
        setTimeout(function() {
            // Send an AJAX request to fetch the user details
            $.ajax({
                type: "GET",
                url: "/user/detail/" + userId,
                data: {_token: '{{ csrf_token() }}'},
                dataType: "json",
                success: function (response) {
                    // Render the component with the user data
                    $('#detailModel .modal-body').html(response.html);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }, 3500); 
    });
});

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


