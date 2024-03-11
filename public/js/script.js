$(document).ready(function() {
    var assetUrl = "/images/loading.png";
    $('#btn1').click(function() {
        var userId = $(this).data('id');
        fetchData(userId, '#exLargeModal .modal-body1', "/user/user_form_information/");
    });

    $('#btn2').click(function() {
        var userId = $(this).data('id');
        fetchData(userId, '#exLargeModal2 .modal-body2', "/user/user_work_history/");
    });

    $('#btn3').click(function() {
        var userId = $(this).data('id');
        fetchData(userId, '#exLargeModal3 .modal-body3', "/user/modal_certificate_of_appreciateion/");
    });

    $('#btn4').click(function() {
        var userId = $(this).data('id');
        fetchData(userId, '#exLargeModal4 .modal-body4', "/user/education_level/");
    });

    $('#btn5').click(function() {
        var userId = $(this).data('id');
        fetchData(userId, '#exLargeModal5 .modal-body5', "/user/ability_language/");
    });

    $('#btn6').click(function() {
        var userId = $(this).data('id');
        fetchData(userId, '#exLargeModal6 .modal-body6', "/user/user_family/");
    });

    function fetchData(userId, modalBodySelector, endpoint) {
        $(modalBodySelector).html('<br><div class="spinner-container" style="display: flex; justify-content: center; align-items: center; height: 100%;">' +
            '<img src="' + assetUrl + '" class="loading-circle animated" alt="Loading..." style="width: 50px; height: 50px; border-radius: 50%;" />' +
            '<p style="margin-top: 10px;">Loading...</p>' +
            '</div>');

        setTimeout(function() {
            $.ajax({
                type: "GET",
                url: endpoint + userId,
                data: { _token: '{{ csrf_token() }}' },
                dataType: "json",
                success: function(response) {
                    $(modalBodySelector).html(response.html);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }, 1700);
    }



});