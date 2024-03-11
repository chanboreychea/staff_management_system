// Fade in success and error alerts
$('#success-alert, #error-alert').fadeIn('slow');

setTimeout(function() {
    $('#success-alert, #error-alert').fadeOut('slow');
}, 5000);

$(document).ready(function() {
    // Event delegation for blur event on inputs
    $(document).on('blur', 'input', function() {
        if ($(this).val() != '') {
            $(this).addClass('add-border-green').removeClass('add-border-red');
        } else {
            $(this).addClass('add-border-red').removeClass('add-border-green');
        }
    });

    $('.btn_click1').click(function() {
        var formHtml = `{!! addslashes(view('components.user.form_add_working_history_public_sector')->render()) !!}`;
        $('#modal-body1').append('<div class="row2">' + formHtml + '<button class="btn btn-sm btn-danger btn_remove float-sm-right">លុប</button></div>');
    });

    $('.btn_click2').click(function() {
        var formHtml = `{!! addslashes(view('components.user.form_add_working_history_private_sector')->render()) !!}`;
        $('#modal-body2').append('<div class="row3">' + formHtml + '<button class="btn btn-sm btn-danger btn_remove float-sm-right">លុប</button></div>');
    });

    $(document).on('click', '.btn_remove', function() {
        $(this).closest('.row2, .row3').remove();
    });
});