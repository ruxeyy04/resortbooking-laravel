$(document).ready(function () {
    $("#myTable").DataTable({
        ajax: {
            url: "/api/grabusers",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                Authorization:
                    "Bearer " + $('meta[name="api_token"]').attr("content"),
            },
            dataSrc: "",
        },
        columns: [
            {
                data: null,
                render: function (data) {
                    if (data.user_type == "admin") {
                        return (
                            '<button class="btn btn-warning edit-button" data-toggle="modal" data-target="#edit-user" data-account_id="' +
                            data.account_id +
                            '" data-first_name="' +
                            data.first_name +
                            '" data-last_name="' +
                            data.last_name +
                            '" data-email="' +
                            data.email +
                            '" data-username="' +
                            data.username +
                            '" data-password="' +
                            data.password +
                            '" data-contact_number="' +
                            data.contact_number +
                            '" data-user_type="' +
                            data.user_type +
                            '">Edit</button>'
                        );
                    } else {
                        return (
                            '<button class="btn btn-warning edit-button" data-toggle="modal" data-target="#edit-user" data-account_id="' +
                            data.account_id +
                            '" data-first_name="' +
                            data.first_name +
                            '" data-last_name="' +
                            data.last_name +
                            '" data-email="' +
                            data.email +
                            '" data-username="' +
                            data.username +
                            '" data-password="' +
                            data.password +
                            '" data-contact_number="' +
                            data.contact_number +
                            '" data-user_type="' +
                            data.user_type +
                            '">Edit</button>' +
                            '<button class="btn btn-danger delete-button" data-account_id="' +
                            data.account_id +
                            '">Delete</button>'
                        );
                    }
                },
            },
            { data: "account_id" },
            { data: "first_name" },
            { data: "last_name" },
            { data: "email" },
            { data: "username" },
            { data: "password" },
            { data: "contact_number" },
            { data: "user_type" },
        ],
    });

    $("#myTable").on("click", ".delete-button", function () {
        var account_id = $(this).attr("data-account_id");

        swal({
            title: "Are you sure?",
            text: "This is permanent!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    url: "/api/deleteuser",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                        Authorization:
                            "Bearer " +
                            $('meta[name="api_token"]').attr("content"),
                    },
                    data: { account_id: account_id },
                    dataType: "json",
                    success: function (response) {
                        if (response.hasOwnProperty("success")) {
                            swal({
                                title: "Delete successful",
                                text: "User deleted successfully",
                                icon: "success",
                            });
                        }
                        $("#myTable").DataTable().ajax.reload();
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
        });
    });

    $("#myTable").on("click", ".edit-button", function () {
        var account_id = $(this).attr("data-account_id");
        var first_name = $(this).attr("data-first_name");
        var last_name = $(this).attr("data-last_name");
        var email = $(this).attr("data-email");
        var username = $(this).attr("data-username");
        var password = $(this).attr("data-password");
        var contact_number = $(this).attr("data-contact_number");
        var user_type = $(this).attr("data-user_type");

        $("#edit_account_id").val(account_id);
        $("#edit_user_type").val(user_type);
        $("#edit_first_name").val(first_name);
        $("#edit_last_name").val(last_name);
        $("#edit_email").val(email);
        $("#edit_username").val(username);
        $("#edit_password").val(password);
        $("#edit_contact_number").val(contact_number);
    });

    $("#edit").submit(function (event) {
        event.preventDefault();
        var formData = new FormData(this);
        var account_id = $("#edit_account_id").val();
        formData.append("account_id", account_id);

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
                    clearForm();
                    $("#myTable").DataTable().ajax.reload();
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

    $("#add").submit(function (event) {
        event.preventDefault();
        var formData = new FormData(this);

        // var formDataObject = {};
        // formData.forEach(function(value, key) {
        //   formDataObject[key] = value;
        // })
        // console.log(formDataObject)

        $.ajax({
            type: "POST",
            url: "/api/addUser",
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
                    clearForm();
                    $("#myTable").DataTable().ajax.reload();
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

    function clearForm() {
        $("#add_first_name").val("");
        $("#add_last_name").val("");
        $("#add_email").val("");
        $("#add_username").val("");
        $("#add_password").val("");
        $("#add_contact_number").val("");
    }
});
