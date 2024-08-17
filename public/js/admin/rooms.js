$(document).ready(function () {
    $("#myTable").DataTable({
        ajax: {
            url: "/api/grabrooms",
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
                            '<button class="btn btn-warning edit-button" data-toggle="modal" data-target="#edit-room" data-room_id="' +
                            data.room_id +
                            '" data-room_name="' +
                            data.room_name +
                            '" data-room_description="' +
                            data.room_description +
                            '">Edit</button>'
                        );
                    } else {
                        return (
                            '<button class="btn btn-warning edit-button" data-toggle="modal" data-target="#edit-room" data-room_id="' +
                            data.room_id +
                            '" data-room_name="' +
                            data.room_name +
                            '" data-room_description="' +
                            data.room_description +
                            '">Edit</button>' +
                            '<button class="btn btn-danger delete-button" data-room_id="' +
                            data.room_id +
                            '">Delete</button>'
                        );
                    }
                },
            },
            { data: "room_id" },
            { data: "room_name" },
            { data: "room_description" },
        ],
    });

    $("#myTable").on("click", ".delete-button", function () {
        var room_id = $(this).attr("data-room_id");

        swal({
            title: "Are you sure?",
            text: "This is permanent!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                deleteRoom(room_id);
            }
        });
    });

    function deleteRoom(room_id) {
        $.ajax({
            type: "POST",
            url: "/api/deleteroom",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                Authorization:
                    "Bearer " + $('meta[name="api_token"]').attr("content"),
            },
            data: { room_id: room_id },
            dataType: "json",
            success: function (response) {
                console.log(response);
                if (response.hasOwnProperty("success")) {
                    swal({
                        title: "Delete successful",
                        text: "Room deleted successfully",
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

    $("#myTable").on("click", ".edit-button", function () {
        var room_id = $(this).attr("data-room_id");
        var room_name = $(this).attr("data-room_name");
        var room_description = $(this).attr("data-room_description");

        $("#edit_room_id").val(room_id);
        $("#edit_room_name").val(room_name);
        $("#edit_room_description").val(room_description);
    });

    $("#edit").submit(function (event) {
        event.preventDefault();
        var formData = new FormData(this);
        var room_id = $("#edit_room_id").val();
        formData.append("room_id", room_id);

        // var formDataObject = {};
        // formData.forEach(function(value, key) {
        //   formDataObject[key] = value;
        // })
        // console.log(formDataObject)

        $.ajax({
            type: "POST",
            url: "/api/editroom",
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
                        text: "Room name is already in use",
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

        $.ajax({
            type: "POST",
            url: "/api/addroom",
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
                        text: "Resort name is already in use",
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
        $("#add_room_name").val("");
        $("#add_room_description").val("");
    }
});
