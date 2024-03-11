$(document).ready(function() {
    var assetUrl = "/images/logo2.png";
    $('#btn1').click(function() {

        var userId = $(this).data('id');

        alert(userId);

        // Send an AJAX request to fetch the user details

        $('#exLargeModal .modal-body1').html('<br><div class="spinner-container" style="display: flex; justify-content: center; align-items: center; height: 100%;">' +
            '<img src="' + assetUrl + '" class="loading-circle animated" alt="Loading..." style="width: 50px; height: 50px; border-radius: 50%;" />' +
            '<p style="margin-top: 10px;">Loading...</p>' +
            '</div>');
        setTimeout(function() {
            // Send an AJAX request to fetch the user details
            $.ajax({
                type: "GET",
                url: "/user/user_form_information/" + userId,
                data: { _token: '{{ csrf_token() }}' },
                dataType: "json",
                success: function(response) {
                    // Render the component with the user data
                    $('#exLargeModal .modal-body1').html(response.html);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }, 3000);

    });
    $('#btn2').click(function() {
        var userId = $(this).data('id');
        alert(userId);

        // Send an AJAX request to fetch the user details

        $('#exLargeModal2 .modal-body2').html('<br><div class="spinner-container" style="display: flex; justify-content: center; align-items: center; height: 100%;">' +
            '<img src="' + assetUrl + '" class="loading-circle animated" alt="Loading..." style="width: 50px; height: 50px; border-radius: 50%;" />' +
            '<p style="margin-top: 10px;">Loading...</p>' +
            '</div>');
        setTimeout(function() {
            // Send an AJAX request to fetch the user details
            $.ajax({
                type: "GET",
                url: "/user/user_work_history/" + userId,
                data: { _token: '{{ csrf_token() }}' },
                dataType: "json",
                success: function(response) {
                    // Render the component with the user data
                    $('#exLargeModal2 .modal-body2').html(response.html);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }, 3000);

    });

    $('#btn3').click(function() {
        var userId = $(this).data('id');
        alert(userId);

        // Send an AJAX request to fetch the user details

        $('#exLargeModal3 .modal-body3').html('<br><div class="spinner-container" style="display: flex; justify-content: center; align-items: center; height: 100%;">' +
            '<img src="' + assetUrl + '" class="loading-circle animated" alt="Loading..." style="width: 50px; height: 50px; border-radius: 50%;" />' +
            '<p style="margin-top: 10px;">Loading...</p>' +
            '</div>');
        setTimeout(function() {
            // Send an AJAX request to fetch the user details
            $.ajax({
                type: "GET",
                url: "/user/modal_certificate_of_appreciateion/" + userId,
                data: { _token: '{{ csrf_token() }}' },
                dataType: "json",
                success: function(response) {
                    // Render the component with the user data
                    $('#exLargeModal3 .modal-body3').html(response.html);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }, 3000);

    });

    $('#btn4').click(function() {
        var userId = $(this).data('id');
        alert(userId);

        // Send an AJAX request to fetch the user details

        $('#exLargeModal4 .modal-body4').html('<br><div class="spinner-container" style="display: flex; justify-content: center; align-items: center; height: 100%;">' +
            '<img src="' +
            assetUrl + '" class="loading-circle animated" alt="Loading..." style="width: 50px; height: 50px; border-radius: 50%;" />' +
            '<p style="margin-top: 10px;">Loading...</p>' +
            '</div>');
        setTimeout(function() {
            // Send an AJAX request to fetch the user details
            $.ajax({
                type: "GET",
                url: "/user/education_level/" + userId,
                data: { _token: '{{ csrf_token() }}' },
                dataType: "json",
                success: function(response) {
                    // Render the component with the user data
                    $('#exLargeModal4 .modal-body4').html(response.html);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }, 3000);

    });
    $('#btn5').click(function() {
        var userId = $(this).data('id');
        alert(userId);

        // Send an AJAX request to fetch the user details

        $('#exLargeModal5 .modal-body5').html('<br><div class="spinner-container" style="display: flex; justify-content: center; align-items: center; height: 100%;">' +
            '<img src="' +
            assetUrl + '" class="loading-circle animated" alt="Loading..." style="width: 50px; height: 50px; border-radius: 50%;" />' +
            '<p style="margin-top: 10px;">Loading...</p>' +
            '</div>');
        setTimeout(function() {
            // Send an AJAX request to fetch the user details
            $.ajax({
                type: "GET",
                url: "/user/ability_language/" + userId,
                data: { _token: '{{ csrf_token() }}' },
                dataType: "json",
                success: function(response) {
                    // Render the component with the user data
                    $('#exLargeModal5 .modal-body5').html(response.html);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }, 3000);

    });

});