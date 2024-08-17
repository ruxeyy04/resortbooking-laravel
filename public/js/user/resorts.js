$(document).ready(function () {
    resorts();

    $(document).on("click", ".btn-view", function () {
        var resort_id = $(this).attr("data-resort_id");
        var resort_name = $(this).attr("data-resort_name");
        var image = $(this).attr("data-image");
        var location = $(this).attr("data-location");
        var price = "₱" + $(this).attr("data-price");
        var resort_description = $(this).attr("data-resort_description");
        var room_name = $(this).attr("data-room_name");
        var status = $(this).attr("data-status");

        $("#resort_id").val(resort_id);
        $("#resort-image").attr("src", "../img/" + image);
        $("#resort-name").text(resort_name);
        $("#resort-price").text(price);
        $("#resort-details").text(resort_description);
        $("#resort-location").text(location);

        $.ajax({
            type: "POST",
            url: "/api/grabrooms",
            data: { add: resort_id },
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                Authorization:
                    "Bearer " + $('meta[name="api_token"]').attr("content"),
            },
            dataType: "json",
            success: function (response) {
                var row = '<div class="form-check">';
                for (i = 0; i < response.length; i++) {
                    var room_id = response[i].room_id;
                    var room_name = response[i].room_name;
                    var room_description = response[i].room_description;
                    row +=
                        '<label class="form-check-label">' +
                        '<input type="checkbox" class="form-check-input" name="room[]" value="' +
                        room_id +
                        '">' +
                        room_name +
                        " - " +
                        room_description +
                        "</label>" +
                        "<br>";
                }
                row += "</div>";
                $("#rooms").html(row);
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

    $("#reserve").submit(function (event) {
        event.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            type: "POST",
            url: "/api/reserve",
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
                Swal.fire({
                    title: "Reserved",
                    icon: "success",
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

    function resorts() {
        $.ajax({
            type: "GET",
            url: "/api/getresortwithroom",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                Authorization:
                    "Bearer " + $('meta[name="api_token"]').attr("content"),
            },
            dataType: "json",
            success: function (resorts) {
                console.log(resorts);
                var row = "";
                if (resorts.hasOwnProperty("empty")) {
                    row = "<h2>No Resorts Available</h2>";
                } else {
                    var resortsLength = resorts.length;
                    if (resortsLength > 3) {
                        resortsLength = 3;
                    }
                    for (i = 0; i < resorts.length; i++) {
                        var resort_id = resorts[i].resort_id;
                        var resort_name = resorts[i].resort_name;
                        var image = resorts[i].image;
                        var location = resorts[i].location;
                        var price = resorts[i].price + " p/ night";
                        var resort_description = resorts[i].resort_description;
                        var room_name = resorts[i].room_name;
                        var room_id = resorts[i].room_id;
                        var status = resorts[i].status;
                        row +=
                            '<div class="col-md-4 d-flex justify-content-center">' +
                            '<div class="card" style="width: 18rem">' +
                            '<img class="card-img-top" src="/img/' +
                            image +
                            '" alt="Card image cap" />' +
                            '<div class="card-body">' +
                            '<h5 class="card-title">' +
                            resort_name +
                            "</h5>" +
                            '<a href="#" class="btn btn-warning btn-view" data-target="#view" data-toggle="modal" data-resort_id="' +
                            resort_id +
                            '" data-resort_name="' +
                            resort_name +
                            '" data-image="' +
                            image +
                            '" data-location="' +
                            location +
                            '" data-price="' +
                            price +
                            '" data-resort_description="' +
                            resort_description +
                            '" data-room_name="' +
                            room_name +
                            '" data-room_id="' +
                            room_id +
                            '" data-status="' +
                            status +
                            '">View Details</a>' +
                            "</div>" +
                            "</div>" +
                            "</div>";
                    }
                }
                $(".resortsDis").html(row);
            },
            error: function (xhr, textStatus, errorThrown) {
                Swal.fire({
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
