$(document).ready(function () {
    $("#myTable").DataTable({
        ajax: {
            url: "/api/grabresorts",
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
                            '<button class="btn btn-warning edit-button" data-toggle="modal" data-target="#edit-resort" data-resort_id="' +
                            data.resort_id +
                            '" data-resort_name="' +
                            data.resort_name +
                            '" data-location="' +
                            data.location +
                            '" data-resort_description="' +
                            data.resort_description +
                            '" data-price="' +
                            data.price +
                            '" data-image="' +
                            data.image +
                            '">Edit</button>'
                        );
                    } else {
                        return (
                            '<button class="btn btn-warning edit-button" data-toggle="modal" data-target="#edit-resort" data-resort_id="' +
                            data.resort_id +
                            '" data-resort_name="' +
                            data.resort_name +
                            '" data-location="' +
                            data.location +
                            '" data-resort_description="' +
                            data.resort_description +
                            '" data-price="' +
                            data.price +
                            '" data-image="' +
                            data.image +
                            '">Edit</button>' +
                            '<button class="btn btn-danger delete-button" data-resort_id="' +
                            data.resort_id +
                            '" data-image="' +
                            data.image +
                            '">Delete</button>'
                        );
                    }
                },
            },
            {
                data: "image",
                render: function (data) {
                    return (
                        '<img src="../img/' +
                        data +
                        '" width="100" height="100">'
                    );
                },
            },
            { data: "resort_id" },
            { data: "resort_name" },
            { data: "location" },
            { data: "resort_description" },
            { data: "price" },
        ],
    });

    $("#add-button").click(function () {
        $.ajax({
            type: "GET",
            url: "/api/grabrooms",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                Authorization:
                    "Bearer " + $('meta[name="api_token"]').attr("content"),
            },
            dataType: "json",
            success: function (rooms) {
                var row = "";
                var roomsLength = rooms.length;
                var roomDivide = rooms.length / 5;
                var i = 0;
                for (j = 0; j < roomDivide; j++) {
                    row += '<div class="col">';
                    for (i; i < roomsLength; i++) {
                        var room_id = rooms[i].room_id;
                        var room_name = rooms[i].room_name;

                        row +=
                            '<div class="form-check">' +
                            '<label class="form-check-label">' +
                            '<input type="checkbox" class="form-check-input" name="room[]" value="' +
                            room_id +
                            '">' +
                            room_name +
                            "</label>" +
                            "</div>";
                    }
                    row += "</div>";
                }
                $(".rooms").html(row);
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

    $("#myTable").on("click", ".delete-button", function () {
        var resort_id = $(this).attr("data-resort_id");
        var image = $(this).attr("data-image");

        swal({
            title: "Are you sure?",
            text: "This is permanent!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                deleteResort(resort_id, image);
            }
        });
    });

    function deleteResort(resort_id, image) {
        $.ajax({
            type: "POST",
            url: "/api/deleteresort",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                Authorization:
                    "Bearer " + $('meta[name="api_token"]').attr("content"),
            },
            data: {
                resort_id: resort_id,
                image: image,
            },
            dataType: "json",
            success: function (response) {
                console.log(response);
                if (response.hasOwnProperty("success")) {
                    swal({
                        title: "Delete successful",
                        text: "Resort deleted successfully",
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
        var resort_id = $(this).attr("data-resort_id");
        var resort_name = $(this).attr("data-resort_name");
        var location = $(this).attr("data-location");
        var resort_description = $(this).attr("data-resort_description");
        var price = $(this).attr("data-price");

        getRoom(resort_id);

        $("#edit_resort_id").val(resort_id);
        $("#edit_resort_name").val(resort_name);
        $("#edit_location").val(location);
        $("#edit_resort_description").val(resort_description);
        $("#edit_price").val(price);
    });

    function getRoom(resort_id) {
        $.ajax({
            type: "POST",
            url: "/api/grabrooms",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                Authorization:
                    "Bearer " + $('meta[name="api_token"]').attr("content"),
            },
            data: { resort_id: resort_id },
            dataType: "json",
            success: function (room) {
                editRoom(room);
            },
            error: function (xhr, textStatus, errorThrown) {
                console.log(
                    "Error:",
                    textStatus,
                    errorThrown,
                    xhr.responseText
                );
            },
        });
    }

    function editRoom(resort_room) {
        console.log(resort_room);
        var rooms = [];
        for (i = 0; i < resort_room.length; i++) {
            rooms.push(resort_room[i].room_id);
        }
        $.ajax({
            type: "POST",
            url: "/api/grabrooms",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                Authorization:
                    "Bearer " + $('meta[name="api_token"]').attr("content"),
            },
            dataType: "json",
            success: function (room) {
                var row = "";
                var roomsLength = room.length;
                var roomDivide = room.length / 5;
                var i = 0;
                if (!room.hasOwnProperty("no rooms")) {
                    for (j = 0; j < roomDivide; j++) {
                        row += '<div class="col">';
                        for (i; i < roomsLength; i++) {
                            var room_id = room[i].room_id;
                            var room_name = room[i].room_name;
                            if (
                                Array.isArray(rooms) &&
                                rooms.includes(room_id)
                            ) {
                                row +=
                                    '<div class="form-check">' +
                                    '<label class="form-check-label">' +
                                    '<input type="checkbox" class="form-check-input" name="room[]" value="' +
                                    room_id +
                                    '" checked>' +
                                    room_name +
                                    "</label>" +
                                    "</div>";
                            } else {
                                row +=
                                    '<div class="form-check">' +
                                    '<label class="form-check-label">' +
                                    '<input type="checkbox" class="form-check-input" name="room[]" value="' +
                                    room_id +
                                    '">' +
                                    room_name +
                                    "</label>" +
                                    "</div>";
                            }
                        }
                        row += "</div>";
                    }
                }
                $(".edit_rooms").html(row);
            },
            error: function (xhr, textStatus, errorThrown) {
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
        var resort_id = $("#edit_resort_id").val();
        formData.append("resort_id", resort_id);

        // var formDataObject = {};
        // formData.forEach(function(value, key) {
        //   formDataObject[key] = value;
        // })
        // console.log(formDataObject)

        $.ajax({
            type: "POST",
            url: "/api/editresort",
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

    $("#add").submit(function (event) {
        event.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            type: "POST",
            url: "/api/addresort",
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
        $("#add_image").attr("src", "");
        $("#add_resort_name").val("");
        $("#add_location").val("");
        $("#add_resort_description").val("");
        $("#add_price").val("");
    }
});
