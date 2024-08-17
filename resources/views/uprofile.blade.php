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
  <script src="downloads/unpkg.com_sweetalert@2.1.2_dist_sweetalert.min.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@400;700&family=Dongle:wght@300;400;700&family=Lexend+Deca:wght@700&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Nunito&family=Outfit:wght@500&display=swap" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/b15d9bd0c0.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../css/style.css" />
  <script src="../downloads/js-cookie.js"></script>
  <script src="../js/user/profile.js"></script>
  <title>ResortHub</title>
</head>

<body>
  <nav class="navbar container navbar-expand-lg navbar-light">
    <img src="../img/logorh.png" width="150" height="70" alt="" />
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    @include('usidebar')
      <form action="">
        <div class="row mt-3 mr-4 pl-4">
          <input type="text" class="col form-control" id="search" />
          <button class="col-md-1 btn btn" id="srchbtn">
            <i class="fa-solid fa-magnifying-glass"></i>
          </button>
        </div>
      </form>
      <a class="nav-link text-warning" href="{{ route('uprofile') }}"><i class="fa-solid fa-user"></i></a>
      <a href="" class="text-secondary" data-toggle="modal" data-target="#logout">Logout</a>
    </div>
  </nav>
  <div class="login container">
    <div class="prof container" id="profiled">
      <div class="row">
        <div class="col-md-12">
          <div id="mt">
            <div class="cardd">
              <div class="card-header" id="menutypee">
                <h5 class="mb-0">
                  <h5>Settings</h5>
                </h5>
              </div>
              <div id="menutype" class="collapse show" aria-labelledby="menutypee" data-parent="#mt">
                <div class="card-body">
                  <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                      <a class="nav-link text-dark" id="cprofile" href="#">Profile</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link text-dark" id="cpurchased" href="#">Booked</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
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
          <!-- <div class="cpassword" id="cpassword">
              <hr />
              <h5>Change password</h5>
              <hr />
              <label for="">Old Password</label>
              <input type="password" class="form-control" name="" id="" />
              <label for="">New Password</label>
              <input type="password" class="form-control" name="" id="" />
              <label for="">Confirm Password</label>
              <input type="password" class="form-control" name="" id="" />
              <button class="btn btn-info mt-3">Save</button>
              <hr />
            </div> -->
          <div class="purchased" id="purchased">
            <hr />
            <div class="allord">
              <div class="ordereditem">
                <hr />
                <div class="row">
                  <div class="col-md-4 d-flex align-items-center justify-content-center">
                    <img src="../img/edvin-johansson-rlwE8f8anOc-unsplash.jpg" width="120px" height="120px" alt="" />
                  </div>
                  <div class="col-md-4 text-center">
                    <h4>Resort name</h4>
                    <h4>Location:</h4>
                    <strong>
                      <h4 class="text-danger">₱1,250.00</h4>
                    </strong>
                    <p>
                      Status:
                      <i class="fa-solid fa-circle" style="color: #23be35"></i>
                    </p>
                  </div>
                  <div class="col-md-4 d-flex align-items-center justify-content-center">
                    <button class="btn btn-warning" data-toggle="modal" data-target="#view">
                      View Details
                    </button>
                  </div>
                </div>
                <hr />
              </div>
              <div class="ordereditem">
                <hr />
                <div class="row">
                  <div class="col-md-4 d-flex align-items-center justify-content-center">
                    <img src="../img/fabio-fistarol-qai_Clhyq0s-unsplash.jpg" width="120px" height="120px" alt="" />
                  </div>
                  <div class="col-md-4 text-center">
                    <h4>Resort name</h4>
                    <h4>Location:</h4>
                    <strong>
                      <h4 class="text-danger">₱1,250.00</h4>
                    </strong>
                    <p>
                      Status:
                      <i class="fa-solid fa-circle" style="color: #1744d7"></i>
                    </p>
                  </div>
                  <div class="col-md-4 d-flex align-items-center justify-content-center">
                    <button class="btn btn-warning" data-toggle="modal" data-target="#view">
                      View Details
                    </button>
                  </div>
                </div>
                <hr />
              </div>
              <div class="ordereditem">
                <hr />
                <div class="row">
                  <div class="col-md-4 d-flex align-items-center justify-content-center">
                    <img src="../img/yuliya-pankevich-oyxsG2Lh_uA-unsplash.jpg" width="120px" height="120px" alt="" />
                  </div>
                  <div class="col-md-4 text-center">
                    <h4>Resort name</h4>
                    <h4>Location:</h4>
                    <strong>
                      <h4 class="text-danger">₱1,250.00</h4>
                    </strong>
                    <p>
                      Status:
                      <i class="fa-solid fa-circle" style="color: #be3523"></i>
                    </p>
                  </div>
                  <div class="col-md-4 d-flex align-items-center justify-content-center">
                    <button class="btn btn-warning" data-toggle="modal" data-target="#view">
                      View Details
                    </button>
                  </div>
                </div>
                <hr />
              </div>
            </div>
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
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- View order details -->
  <div class="modal fade" id="view" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Resort Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body container">
          <div class="row">
            <div class="col-md-12 text-center mb-3">
              <img src="../img/edvin-johansson-rlwE8f8anOc-unsplash.jpg" width="350" id="resort_image" />
            </div>
            <div class="col-md-6">
              <h4 id="resort_name">Resort Name</h4>
            </div>
            <div class="col-md-6 text-right">
              <h5 class="text-danger">₱<span id="price">1,200.00</span> p/ night</h5>
            </div>
            <div class="col-md-12">
              <p id="resort_description">
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Accusamus fugiat dolorum iusto quasi exercitationem, rerum
                optio officia alias ipsa commodi eos, sit at in repudiandae et
                hic itaque facilis nam accusantium minus. Deserunt eum cumque
                numquam voluptatem officiis ratione voluptas ullam,
                consequuntur nihil a nulla perferendis dicta laudantium cum
                velit iste enim totam atque exercitationem quaerat ipsum
                necessitatibus maiores animi. Voluptatem earum officiis, fuga
                deleniti libero quis dolorum! Saepe cupiditate harum aliquid
                error amet soluta in eaque eius ipsum modi dolore obcaecati
                omnis blanditiis at quidem consequatur, velit vel veniam sunt
                iste suscipit consequuntur nemo quae voluptatibus? Rem, sunt.
                A?
              </p>
            </div>
            <div class="col-md-6 d-flex">
              <i class="fa-solid fa-location-dot"></i>
              <h4>&nbsp;<span id="location">Location</span></h4>
            </div>
            <div class="col-md-6">
              <div class="row">
                <div class="col-md-12">
                  <h5>Selected date for reserving:</h5>
                </div>

                <div class="col-md-12">
                  <input type="text" class="form-control" placeholder="11/01/23" id="date_reserved" readonly />
                </div>
              </div>
            </div>
            <div class="col-md-12 mt-3">
              <h4>Most popular facilities:</h4>
              <div class="row">
                <div class="col-md-2">
                  <i class="fa-solid fa-person-swimming"></i>
                </div>
                <div class="col-md-2"><i class="fa-solid fa-wifi"></i></div>
                <div class="col-md-2">
                  <i class="fa-solid fa-umbrella-beach"></i>
                </div>
                <div class="col-md-2">
                  <i class="fa-solid fa-champagne-glasses"></i>
                </div>
                <div class="col-md-2">
                  <i class="fa-solid fa-utensils"></i>
                </div>
                <div class="col-md-2">
                  <i class="fa-solid fa-broom"></i>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <h4>Booked ID: <span id="booked_id"></span></h4>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            Close
          </button>
          <button type="button" class="btn btn-primary">Cancel</button>
        </div>
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
  <script src="../js/script.js"></script>
  <script src="{{asset('/js/logout.js')}}"></script>
  <script>
    function limitInput(element, maxLength) {
      if (element.value.length > maxLength) {
        element.value = element.value.slice(0, maxLength);
      }
    }
  </script>
</body>

</html>