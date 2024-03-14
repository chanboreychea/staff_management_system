<br>

<form class="form-horizontal" action="/user/add_modal_certificate_of_appreciateion" method="post"
    enctype="multipart/form-data">

    @csrf
    <center>
        <h4 class="form-top-header"><u> គ្រឿងឥស្សរិយយស ប័ណ្ណសរសើរ​ ទ័ណ្ខកម្មវិន័យ</u></h4>
    </center>
    <h5 class="form-header d-flex align-items-center justify-content-between">
        <div>គ្រឿងឥស្សរិយយស ប័ណ្ណសរសើរ​ ទ័ណ្ខកម្មវិន័យ</div>

        <div class="float-sm-right">

            @component('components.buttons.btn_count', ['class' => 'btn_click1'])
                <!-- button -->
            @endcomponent

        </div>
    </h5>

    <br>

    <input type="hidden" value="<?= !empty($id) ? $id : '' ?>" name="using_user_id">

    <div class="row" id="modal-body3">

        @if (!empty($modalCertificate))

            @component('components.user.form_edit_modal_certificate_of_appreciateion', [
                'modalCertificate' => $modalCertificate,
            ])
            @endcomponent
        @else
            <div class="row4">

                {{-- @component('components.user.form_add_modal_certificate_of_appreciateion')

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


    $(document).ready(function() {
        // Event delegation for blur event on inputs
        $(document).on('blur', 'input , select', function() {
            if ($(this).val() != '') {
                $(this).addClass('add-border-green').removeClass('add-border-red');
            } else {
                $(this).addClass('add-border-red').removeClass('add-border-green');
            }
        });

        $('.btn_click1').click(function() {

            var formHtml = `{!! view('components.user.form_add_modal_certificate_of_appreciateion')->render() !!}`;

            $('#modal-body3').append('<div class="row4">' + formHtml +
                '<button class="btn btn-sm  btn-danger btn_remove float-sm-right">លុប</button></div>'
            );
        });

        $(document).on('click', '.btn_remove', function() {

            $(this).closest('.row4').remove();

        });

    });
</script>
