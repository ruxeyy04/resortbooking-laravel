<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="api_token" content="{{ isset($apiToken) ? $apiToken : '' }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../downloads/cdn.jsdelivr.net_npm_bootstrap@4.0.0_dist_css_bootstrap.min.css" />
  <script src="../downloads/jquery.min.js"></script>
  <script src="../downloads/cdn.jsdelivr.net_npm_popper.js@1.12.9_dist_umd_popper.min.js"></script>
  <script src="../downloads/cdn.jsdelivr.net_npm_bootstrap@4.0.0_dist_js_bootstrap.min.js"></script>
  <script src="../downloads/unpkg.com_sweetalert@2.1.2_dist_sweetalert.min.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@400;700&family=Dongle:wght@300;400;700&family=Lexend+Deca:wght@700&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Nunito&family=Outfit:wght@500&display=swap" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/b15d9bd0c0.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../css/style.css" />
  <script src="../downloads/js-cookie.js"></script>
  <script src="../js/admin/profile.js"></script>
  <script src="{{asset('/js/logout.js')}}"></script>
  <title>ResortHub</title>
</head>

<body>
  <nav class="navbar container navbar-expand-lg navbar-light">
    <img src="../img/logorh.png" width="150" height="70" alt="" />
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    @include('admin\sidebar')
      <form action="">
        <div class="row mt-3 mr-4 pl-4">
          <input type="text" class="col form-control" id="search" />
          <button class="col-md-1 btn btn" id="srchbtn">
            <i class="fa-solid fa-magnifying-glass"></i>
          </button>
        </div>
      </form>
      <a class="nav-link text-warning" href="{{ route('adminProfile') }}"><i class="fa-solid fa-user"></i></a>
      <a href="" class="text-secondary" data-toggle="modal" data-target="#logout">Logout</a>
    </div>
  </nav>
  <div class="login container">
    <div class="prof container" id="profiled">
      <div class="row">
        <div class="col-md-12">
          <div class="profile text-center mb-5" id="profile">
            <hr />
            <h5>
              Profile
              <i class="fa-solid fa-user-pen pl-2 fa-xs text-warning" data-target="#editprof" data-toggle="modal"></i>
            </h5>
            <hr />
            <form>
              <div class="row">
                <div class="col-md-12">
                  <label for="">Account ID</label>
                  <input type="text" class="form-control text-center" name="" id="account_id" placeholder="2" readonly />
                </div>
                <div class="col-md-6">
                  <label for="">Name</label>
                  <input type="text" class="form-control text-center" name="" id="name" placeholder="Marck Benedict Balucan" readonly />
                  <label for="">Username</label>
                  <input type="text" class="form-control text-center" name="" id="username" placeholder="Marck" readonly />
                </div>
                <div class="col-md-6">
                  <label for="">Email</label>
                  <input type="text" class="form-control text-center" name="" id="email" placeholder="Marck@email.com" readonly />
                  <label for="">Contact Number</label>
                  <input type="text" class="form-control text-center" name="" id="contact_number" placeholder="+63 091234567890" readonly />
                </div>
              </div>
            </form>

            <hr />
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- edit profile -->
  <div class="modal fade" id="editprof" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="edit">
          <div class="modal-body">
            <label for="">Account ID</label>
            <input type="text" class="form-control" name="account_id" id="modal_account_id" readonly />
            <label for="">First Name</label>
            <input type="text" class="form-control" name="first_name" id="modal_first_name" />
            <label for="">Last Name</label>
            <input type="text" class="form-control" name="last_name" id="modal_last_name" />
            <label for="">Username</label>
            <input type="text" class="form-control" name="username" id="modal_username" />
            <label for="">Password</label>
            <input type="text" class="form-control" name="password" id="modal_password" />
            <label for="">Email</label>
            <input type="text" class="form-control" name="email" id="modal_email" />
            <label for="">Contact Number</label>
            <input type="text" class="form-control" name="contact_number" id="modal_contact_number" oninput="limitInput(this, 11)" />
            <input type="hidden" name="user_type" value="admin">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="breaker"></div>
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-md-4 text-center" id="logb">
          <img src="../img/logorh.png" width="200" height="100" alt="" />
        </div>
        <div class="col-md-4 text-center" id="navi">
          <a href="index.html">
            <h4>Users</h4>
          </a>
          <a href="resorts.html">
            <h5>Resorts</h5>
          </a>
          <a href="rooms.html">
            <h5>Rooms</h5>
          </a>
          <a href="reserved.html">
            <h5>Reserved</h5>
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
  <!-- logout -->
  <div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">Do you want to Logout?</div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            Close
          </button>
          <button type="button" class="btn btn-danger" id="logout-btn">
            Logout
          </button>
        </div>
      </div>
    </div>
  </div>
  <script>
    function limitInput(element, maxLength) {
      if (element.value.length > maxLength) {
        element.value = element.value.slice(0, maxLength);
      }
    }
  </script>
</body>

</html>