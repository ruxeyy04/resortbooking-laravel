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
});
