$(document).ready(function () {
    getuser();
    getReserves();

    function getReserves() {
        $.ajax({
            type: "GET",
            url: "/api/grabreserve",
            data: {
                reserves: true,
            },
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                Authorization:
                    "Bearer " + $('meta[name="api_token"]').attr("content"),
            },
            dataType: "json",
            success: function (resorts) {
                console.log(resorts);
                var row = "";
                var length = resorts.length;
                for (i = 0; i < length; i++) {
                    var resort = resorts[i];
                    var image = resort.image;
                    var resort_id = resort.resort_id;
                    var resort_name = resort.resort_name;
                    var location = resort.location;
                    var price = resort.price;
                    var room_id = resort.room_id;
                    var room_name = resort.room_name;
                    var room_description = resort.room_description;

                    row +=
                        '<div class="ordereditem">' +
                        "<hr />" +
                        '<div class="row">' +
                        '<div class="col-md-3 d-flex align-items-center justify-content-center" >' +
                        '<img src="../img/' +
                        image +
                        '" width="120px" height="120px" alt="" /> ' +
                        "</div>" +
                        '<div class="col-md-3 text-center">' +
                        "<h4>" +
                        resort_name +
                        "</h4>" +
                        "<h4>" +
                        location +
                        "</h4>" +
                        '<strong><h4 class="text-danger">₱' +
                        price +
                        "</h4></strong>" +
                        "</div>" +
                        '<div class="col-md-3 text-center">' +
                        "<h4>" +
                        room_name +
                        "</h4>" +
                        "<h4>" +
                        room_description +
                        "</h4>" +
                        "</div>" +
                        '<div class="col-md-3 d-flex align-items-center justify-content-center" >' +
                        '<button class="btn btn-warning view_details" data-toggle="modal" data-target="#view" data-resort_id="' +
                        resort_id +
                        '" data-room_id="' +
                        room_id +
                        '"> View Details </button>' +
                        "</div>" +
                        "</div>" +
                        "<hr />" +
                        "</div>";
                }
                $(".allord").html(row);
            },
            error: function (xhr, textStatus, errorThrown) {
                swal({
                    title: "Error",
                    icon: "error",
                });
                console.log(
                    "Error:",
                    textStatus,
                    errorThrown,
                    xhr.responseText
                );
            },
        });
    }

    $(".allord").on("click", ".view_details", function () {
        var resort_id = $(this).attr("data-resort_id");
        var room_id = $(this).attr("data-room_id");

        $.ajax({
            type: "GET",
            url: "/api/getresortwithroom",
            data: {
                profile: true,
                resort_id: resort_id,
                room_id: room_id,
            },
            dataType: "json",
            success: function (resorts) {
                console.log(resorts);
                var resort = resorts[0];
                var image = resort.image;
                var resort_name = resort.resort_name;
                var price = resort.price;
                var resort_description = resort.resort_description;
                var location = resort.location;
                var date_reserved = resort.date_reserved;
                var reserve_id = resort.reserve_id;

                $("#resort_image").attr("src", "../img/" + image);
                $("#resort_name").text(resort_name);
                $("#price").text(price);
                $("#resort_description").text(resort_description);
                $("#location").text(location);
                $("#date_reserved").text(date_reserved);
                $("#booked_id").text(reserve_id);
            },
            error: function (xhr, textStatus, errorThrown) {
                swal({
                    title: "Error",
                    icon: "error",
                });
                console.log(
                    "Error:",
                    textStatus,
                    errorThrown,
                    xhr.responseText
                );
            },
        });
    });

    function getuser(account_id) {
        $.ajax({
            type: "GET",
            url: "/api/grabusers",
            data: {
                show: true,
                account_id: account_id,
            },
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                Authorization:
                    "Bearer " + $('meta[name="api_token"]').attr("content"),
            },
            dataType: "json",
            success: function (users) {
                var user = users[0];
                var account_id = user.account_id;
                var first_name = user.first_name;
                var last_name = user.last_name;
                var username = user.username;
                var password = user.password;
                var email = user.email;
                var contact_number = user.contact_number;
                var user_type = user.user_type;
                var name = first_name + " " + last_name;

                $("#account_id").val(account_id);
                $("#name").val(name);
                $("#email").val(email);
                $("#username").val(username);
                $("#contact_number").val(contact_number);

                $("#modal_account_id").val(account_id);
                $("#modal_first_name").val(first_name);
                $("#modal_last_name").val(last_name);
                $("#modal_username").val(username);
                $("#modal_password").val(password);
                $("#modal_email").val(email);
                $("#modal_contact_number").val(contact_number);
            },
            error: function (xhr, textStatus, errorThrown) {
                swal({
                    title: "Error",
                    icon: "error",
                });
                console.log(
                    "Error:",
                    textStatus,
                    errorThrown,
                    xhr.responseText
                );
            },
        });
    }

    $("#edit").submit(function (event) {
        event.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            type: "POST",
            url: "/api/edituser",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                Authorization:
                    "Bearer " + $('meta[name="api_token"]').attr("content"),
            },
            data: formData,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.hasOwnProperty("failed")) {
                    swal({
                        title: "Failed to add",
                        text: "There seems to be an error, contact the administrator",
                        icon: "error",
                    });
                    console.log(response);
                } else if (response.hasOwnProperty("exists")) {
                    swal({
                        title: "Exists",
                        text: "This email is already in use",
                        icon: "warning",
                    });
                } else {
                    swal({
                        title: response.title,
                        text: response.text,
                        icon: response.icon,
                    });
                    var user = response;
                    var first_name = user.first_name;
                    var last_name = user.last_name;
                    var username = user.username;
                    var email = user.email;
                    var contact_number = user.contact_number;
                    var user_type = user.user_type;
                    var name = first_name + " " + last_name;

                    $("#name").val(name);
                    $("#email").val(email);
                    $("#username").val(username);
                    $("#contact_number").val(contact_number);
                }
            },
            error: function (xhr, textStatus, errorThrown) {
                swal({
                    title: "Error",
                    icon: "error",
                });
                console.log(
                    "Error:",
                    textStatus,
                    errorThrown,
                    xhr.responseText
                );
            },
        });
    });
});
