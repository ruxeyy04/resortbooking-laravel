$(document).ready(function () {
    $("#myTable").DataTable({
        ajax: {
            url: "/api/grabreserve",
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
                            '<button class="btn btn-warning edit-button" data-toggle="modal" data-target="#edit-reserve" data-reserve_id="' +
                            data.reserve_id +
                            '">Edit</button>'
                        );
                    } else {
                        return (
                            '<button class="btn btn-warning edit-button" data-toggle="modal" data-target="#edit-reserve" data-reserve_id="' +
                            data.reserve_id +
                            '">Edit</button>' +
                            '<button class="btn btn-danger delete-button" data-reserve_id="' +
                            data.reserve_id +
                            '">Delete</button>'
                        );
                    }
                },
            },
            { data: "reserve_id" },
            { data: "resort_id" },
            { data: "room_id" },
            { data: "account_id" },
            { data: "date_reserved" },
        ],
    });

    $("#myTable").on("click", ".delete-button", function () {
        var reserve_id = $(this).attr("data-reserve_id");

        swal({
            title: "Are you sure?",
            text: "This is permanent!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                deleteReserve(reserve_id);
            }
        });
    });

    function deleteReserve(reserve_id) {
        $.ajax({
            type: "POST",
            url: "/api/deletereserve",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                Authorization:
                    "Bearer " + $('meta[name="api_token"]').attr("content"),
            },
            data: { reserve_id: reserve_id },
            dataType: "json",
            success: function (response) {
                console.log(response);
                if (response.hasOwnProperty("success")) {
                    swal({
                        title: "Delete successful",
                        text: "Reservation deleted successfully",
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

    $("#add-button").click(function () {
        $.ajax({
            type: "GET",
            url: "/api/grabresorts",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                Authorization:
                    "Bearer " + $('meta[name="api_token"]').attr("content"),
            },
            dataType: "json",
            success: function (resorts) {
                var row =
                    '<option value="" disabled selected>Select Resort</option>';
                var resortLength = resorts.length;
                for (i = 0; i < resortLength; i++) {
                    var resort_id = resorts[i].resort_id;
                    var resort_name = resorts[i].resort_name;
                    row +=
                        '<option value="' +
                        resort_id +
                        '">' +
                        resort_name +
                        "</option>";
                }
                $("#add_resort_id").html(row);
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

        $("#add_resort_id").change(function () {
            var resort_id = $(this).val();
            $.ajax({
                type: "POST",
                url: "/api/grabrooms",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                    Authorization:
                        "Bearer " + $('meta[name="api_token"]').attr("content"),
                },
                data: { add: resort_id },
                dataType: "json",
                success: function (rooms) {
                    console.log(rooms);
                    var row = "";
                    var roomsLength = rooms.length;
                    for (i = 0; i < roomsLength; i++) {
                        var room_id = rooms[i].room_id;
                        var room_name = rooms[i].room_name;
                        row +=
                            '<option value="' +
                            room_id +
                            '">' +
                            room_name +
                            "</option>";
                    }
                    $("#add_room_id").html(row);
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

        $.ajax({
            type: "GET",
            url: "/api/grabusers",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                Authorization:
                    "Bearer " + $('meta[name="api_token"]').attr("content"),
            },
            data: { reserved: true },
            dataType: "json",
            success: function (users) {
                var row = "";
                var userLength = users.length;
                for (i = 0; i < userLength; i++) {
                    var account_id = users[i].account_id;
                    var user_name =
                        users[i].first_name + " " + users[i].last_name;
                    row +=
                        '<option value="' +
                        account_id +
                        '">' +
                        account_id +
                        " - " +
                        user_name +
                        "</option>";
                }
                $("#add_account_id").html(row);
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

    $("#myTable").on("click", ".edit-button", function () {
        clearFormEdit();
        var reserve_id = $(this).attr("data-reserve_id");
        $("#edit_reserve_id").val(reserve_id);
        $.ajax({
            type: "GET",
            url: "/api/grabreserve",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                Authorization:
                    "Bearer " + $('meta[name="api_token"]').attr("content"),
            },
            data: { reserve_id: reserve_id },
            dataType: "json",
            success: function (reserves) {
                var reserve = reserves[0];
                var edit_resort_id = reserve.resort_id;
                var edit_room_id = reserve.room_id;
                var edit_account_id = reserve.account_id;
                var date_reserved = reserve.date_reserved;

                $("#edit_date_reserved").val(date_reserved);

                $.ajax({
                    type: "GET",
                    url: "/api/grabresorts",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                        Authorization:
                            "Bearer " +
                            $('meta[name="api_token"]').attr("content"),
                    },
                    dataType: "json",
                    success: function (resorts) {
                        var row =
                            '<option value="" disabled selected>Select Resort</option>';
                        var resortLength = resorts.length;
                        for (i = 0; i < resortLength; i++) {
                            var resort_id = resorts[i].resort_id;
                            var resort_name = resorts[i].resort_name;
                            if (edit_resort_id == resort_id) {
                                row +=
                                    '<option value="' +
                                    resort_id +
                                    '" selected>' +
                                    resort_name +
                                    "</option>";
                            } else {
                                row +=
                                    '<option value="' +
                                    resort_id +
                                    '">' +
                                    resort_name +
                                    "</option>";
                            }
                        }
                        $("#edit_resort_id").html(row);
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

                $.ajax({
                    type: "POST",
                    url: "/api/grabrooms",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                        Authorization:
                            "Bearer " +
                            $('meta[name="api_token"]').attr("content"),
                    },
                    data: {
                        preview: true,
                        resort_id: edit_resort_id,
                        room_id: edit_room_id,
                    },
                    dataType: "json",
                    success: function (rooms) {
                        var row = "";
                        var roomsLength = rooms.length;
                        for (i = 0; i < roomsLength; i++) {
                            var room_id = rooms[i].room_id;
                            var room_name = rooms[i].room_name;
                            if (edit_room_id == room_id) {
                                row +=
                                    '<option value="' +
                                    room_id +
                                    '" selected>' +
                                    room_name +
                                    "</option>";
                            } else {
                                row +=
                                    '<option value="' +
                                    room_id +
                                    '">' +
                                    room_name +
                                    "</option>";
                            }
                        }
                        $("#edit_room_id").html(row);
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

                $("#edit_resort_id").change(function () {
                    var resort_id = $(this).val();
                    $.ajax({
                        type: "POST",
                        url: "/api/grabrooms",
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                            Authorization:
                                "Bearer " +
                                $('meta[name="api_token"]').attr("content"),
                        },
                        data: {
                            edit: true,
                            resort_id: resort_id,
                            room_id: edit_room_id,
                        },
                        dataType: "json",
                        success: function (rooms) {
                            var row = "";
                            var roomsLength = rooms.length;
                            for (i = 0; i < roomsLength; i++) {
                                var room_id = rooms[i].room_id;
                                var room_name = rooms[i].room_name;
                                row +=
                                    '<option value="' +
                                    room_id +
                                    '">' +
                                    room_name +
                                    "</option>";
                            }
                            $("#edit_room_id").html(row);
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

                $.ajax({
                    type: "GET",
                    url: "/api/grabusers",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                        Authorization:
                            "Bearer " +
                            $('meta[name="api_token"]').attr("content"),
                    },
                    data: {
                        edit: true,
                        account_id: edit_account_id,
                    },
                    dataType: "json",
                    success: function (users) {
                        var row = "";
                        var userLength = users.length;
                        for (i = 0; i < userLength; i++) {
                            var account_id = users[i].account_id;
                            var user_name =
                                users[i].first_name + " " + users[i].last_name;
                            row +=
                                '<option value="' +
                                account_id +
                                '">' +
                                account_id +
                                " - " +
                                user_name +
                                "</option>";
                        }
                        $("#edit_account_id").html(row);
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
    });

    $("#edit").submit(function (event) {
        event.preventDefault();
        var formData = new FormData(this);
        var reserve_id = $("#edit_reserve_id").val();
        formData.append("reserve_id", reserve_id);

        $.ajax({
            type: "POST",
            url: "/api/editreserve",
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
                        title: "Failed to reserve",
                        text: "There seems to be an error, contact the administrator",
                        icon: "error",
                    });
                    console.log(response);
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
            url: "/api/addreserve",
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
        $("#add_resort_id").val("");
        var row = '<option value=""></option>';
        $("#add_room_id").html(row);
        $("#add_account_id").val("");
        $("#add_date_reserved").val("");
    }
    function clearFormEdit() {
        $("#edit_resort_id").val("");
        $("#edit_room_id").val("");
        $("#edit__account_id").val("");
    }
});
