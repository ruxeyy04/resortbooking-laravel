document.addEventListener('DOMContentLoaded', function () {
    var logoutBtn = document.getElementById('logout-btn');
    
    logoutBtn.addEventListener('click', function () {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'http://127.0.0.1:8000/api/logout', true);

        // Set headers
        xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
        xhr.setRequestHeader('Authorization', 'Bearer ' + document.querySelector('meta[name="api_token"]').getAttribute('content'));

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                window.location.href = "/";
            }
        };

        // Send the request
        xhr.send();
    });
});
