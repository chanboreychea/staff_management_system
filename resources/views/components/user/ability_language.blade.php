<br>

<form class="form-horizontal" action="/user/add_ability_language" method="post" enctype="multipart/form-data">

    @csrf
    <center>
        <h4 class="form-top-header"><u>សមត្ថភាពភាសាបរទេស</u></h4>
    </center>


    <h5 class="form-header d-flex align-items-center justify-content-between">
        <div>សមត្ថភាពភាសាបរទេស</div>

        <div>

            @component('components.buttons.btn_count', ['class' => 'btn_click7'])
                <!-- button -->
            @endcomponent

        </div>
    </h5>

    <input type="hidden" value="<?= !empty($id) ? $id : '' ?>" name="using_user_id">

    <div class="row" id="modal-body7" style="overflow-x: auto;">

        @if (!empty($langaugeSkill))

            @component('components.user.form_edit_ability_language', ['langaugeSkill' => $langaugeSkill])
            @endcomponent
        @else
            <div class="row7">

                {{-- @component('components.user.form_add_ability_language')

                        @endcomponent --}}

            </div>

        @endif

    </div>


    <button type="submit" class="btn btn-sm" style=" background: #696cff; color:white">រក្សាទុក</button>

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

        $('.btn_click7').click(function() {

            var formHtml = `{!! view('components.user.form_add_ability_language')->render() !!}`;

            $('#modal-body7').append('<div class="row7">' + formHtml +
                '<button class="btn btn-sm btn-danger btn_remove float-sm-right">លុប</button></div>'
            );
        });

        $(document).on('click', '.btn_remove', function() {

            $(this).closest('.row7').remove();

        });

    });
</script>
