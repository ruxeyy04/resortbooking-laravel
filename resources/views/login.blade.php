<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="downloads/cdn.jsdelivr.net_npm_bootstrap@4.0.0_dist_css_bootstrap.min.css" />
  <script src="downloads/jquery.min.js"></script>
  <script src="downloads/cdn.jsdelivr.net_npm_popper.js@1.12.9_dist_umd_popper.min.js"></script>
  <script src="downloads/cdn.jsdelivr.net_npm_bootstrap@4.0.0_dist_js_bootstrap.min.js"></script>
  <script src="downloads/unpkg.com_sweetalert@2.1.2_dist_sweetalert.min.js"></script>
  <script src="downloads/js-cookie.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@400;700&family=Dongle:wght@300;400;700&family=Lexend+Deca:wght@700&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Nunito&family=Outfit:wght@500&display=swap" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/b15d9bd0c0.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/style.css" />
  <script>
    $(document).ready(function() {

      $('#logout-btn').click(function() {
        Cookies.remove('account_id')
        Cookies.remove('user_type')
        window.location.href = "/"
      })

      var user_type = Cookies.get('user_type')
      if (user_type == 'customer') {
        window.location.href = "user";
      } else if (user_type == 'admin') {
        window.location.href = "admin";
      } else if (user_type == 'in-charge') {
        window.location.href = "in-charge";
      }

      $('#login').submit(function(event) {
        event.preventDefault();
        var formData = new FormData(this)

        $.ajax({
          type: "POST",
          url: "api/getUser",
          data: formData,
          dataType: "json",
          processData: false,
          contentType: false,
          success: function(response) {
            console.log(response)
            if (response.hasOwnProperty('error')) {
              swal({
                title: 'Error',
                text: 'There seems to be an error, contact the administrator',
                icon: 'error'
              })
              console.log(response)
            } else if (response.hasOwnProperty('failed')) {
              swal({
                title: response.title,
                text: response.text,
                icon: response.icon
              })
            } else if (response.hasOwnProperty('success')) {
              swal({
                title: response.title,
                text: response.text,
                icon: response.icon,
                buttons: false
              })
              var user_type = response.user_type
              if (user_type === 'customer') {
                setTimeout(function() { 
                  window.location.href = "/uindex";
                }, 3000);
              } else if (user_type === 'admin') {
                setTimeout(function() { 
                  window.location.href = "/admin";
                }, 3000);
              } else if (user_type === 'in-charge') {
                setTimeout(function() { 
                  window.location.href = "/in-charge";
                }, 3000);
              }
            }
          },
          error: function(xhr, textStatus, errorThrown) {
            swal({
              title: 'Error',
              icon: 'error'
            })
            console.log('Error:', textStatus, errorThrown, xhr.responseText)
          }
        })
      })


      $('#register').submit(function(event) {
        event.preventDefault();
        var formData = new FormData(this)

        $.ajax({
          type: "POST",
          url: "api/addUser",
          data: formData,
          dataType: "json",
          processData: false,
          contentType: false,
          success: function(response) {
            if (response.hasOwnProperty('failed')) {
              swal({
                title: 'Failed to register',
                text: 'There seems to be an error, contact the administrator',
                icon: 'error'
              })
              console.log(response)
            } else if (response.hasOwnProperty('exists')) {
              swal({
                title: 'Exists',
                text: 'This email is already in use',
                icon: 'warning'
              })
            } else {
              swal({
                title: response.title,
                text: response.text,
                icon: response.icon
              })
              clearForm()
            }
          },
          error: function(xhr, textStatus, errorThrown) {
            swal({
              title: 'Error',
              icon: 'error'
            })
            console.log('Error:', textStatus, errorThrown, xhr.responseText)
          }
        })
      })

      function clearForm() {
        $('#first_name').val('')
        $('#last_name').val('')
        $('#email').val('')
        $('#username').val('')
        $('#password').val('')
        $('#contact_number').val('')
      }

    })
  </script>
  <title>ResortHub</title>
</head>

<body>
  <nav class="navbar container navbar-expand-lg navbar-light">
    <img src="img/logorh.png" width="150" height="70" alt="" />
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      @include('sidebar')
      <form action="">
        <div class="row mt-3 mr-4 pl-4">
          <input type="text" class="col form-control" id="search" />
          <button class="col-md-1 btn btn" id="srchbtn">
            <i class="fa-solid fa-magnifying-glass"></i>
          </button>
        </div>
      </form>
      <a class="nav-link active" href="{{ route('loginpage') }}">login</a>
    </div>
  </nav>

  <div class="login container">
    <h3 class="text-center">Login</h3>

    <div class="row">
      <div class="col-md-4"></div>
      <div class="col-md-4">
        <hr />
        <form id="login">
          @csrf
          <label for="usernameoremail">Username/email:</label>
          <input type="text" name="loginUsername" class="form-control" placeholder="Enter username/email" />
          <label for="loginpassword">Password:</label>
          <input type="password" name="loginPassword" class="form-control" placeholder="Enter password" />
          <center><button type="submit" class="btn btn-primary d-flex">Login</button></center>
        </form>
        <hr />
        Don't have an account?
        <span class="text-primary" data-target="#reg" data-toggle="modal">Register Here!</span>
      </div>
      <div class="col-md-4"></div>
    </div>
  </div>
  <div class="breaker"></div>

  <footer>
    <div class="container">
      <div class="row">
        <div class="col-md-4 text-center" id="logb">
          <img src="img/logorh.png" width="200" height="100" alt="" />
        </div>
        <div class="col-md-4 text-center" id="navi">
          <a href="">
            <h4>Home</h4>
          </a>
          <a href="">
            <h5>Resorts</h5>
          </a>
          <a href="">
            <h5>Contacts</h5>
          </a>
          <a href="">
            <h5>About</h5>
          </a>
        </div>
        <div class="col-md-4 text-center" id="soc">
          <h4>Social Media</h4>
          <a href="">
            <h5>Facebook</h5>
          </a>
          <a href="">
            <h5>Instagram</h5>
          </a>
          <a href="">
            <h5>Twitter</h5>
          </a>
        </div>
      </div>
    </div>
  </footer>



  <!-- Register Modal -->
  <div class="modal fade" id="reg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"> Register New Account </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="register">
          <div class="modal-body">
            <label for="first_name">Firstname</label>
            <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Enter Firstname" />
            <label for="last_name">Lastname</label>
            <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Enter Lastname" />
            <label for="email">Email</label>
            <input type="text" class="form-control" name="email" id="email" placeholder="Enter email" />
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" id="username" placeholder="Enter Username" />
            <label for="password">Password</label>
            <input type="text" name="password" id="password" class="form-control" placeholder="Enter Password" />
            <label for="contact_number">Contact Number</label>
            <input type="number" class="form-control" name="contact_number" id="contact_number" placeholder="Contact Number" oninput="limitInput(this, 11)" />
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Register</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script src="js/script.js"></script>
  <script>
    function limitInput(element, maxLength) {
      if (element.value.length > maxLength) {
        element.value = element.value.slice(0, maxLength);
      }
    }
  </script>
</body>

</html>