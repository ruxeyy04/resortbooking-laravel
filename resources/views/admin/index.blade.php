<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="api_token" content="{{ isset($apiToken) ? $apiToken : '' }}">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors" />
  <meta name="generator" content="Hugo 0.101.0" />
  <title>Dashboard</title>
  <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"></script>
  <link rel="stylesheet" href="../downloads/cdn.jsdelivr.net_npm_bootstrap@4.0.0_dist_css_bootstrap.min.css" />
  <script src="../downloads/jquery.min.js"></script>
  <script src="../downloads/cdn.jsdelivr.net_npm_popper.js@1.12.9_dist_umd_popper.min.js"></script>
  <script src="../downloads/cdn.jsdelivr.net_npm_bootstrap@4.0.0_dist_js_bootstrap.min.js"></script>
  <script src="../downloads/unpkg.com_sweetalert@2.1.2_dist_sweetalert.min.js"></script>
  <script src="../downloads/js-cookie.js"></script>
  <script src="../downloads/DataTables/datatables.js"></script>
  <link rel="stylesheet" href="../downloads/DataTables/datatables.css">
  <link rel="stylesheet" href="../css/admin.css">
  <script src="../js/admin/index.js"></script>
  <script src="{{asset('/js/logout.js')}}"></script>
  <script src="https://kit.fontawesome.com/b15d9bd0c0.js" crossorigin="anonymous"></script>

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>

</head>

<body>
  <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">ResortHub</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <ul class="navbar-nav px-3">
      <li class="nav-item text-nowrap d-flex align-items-center">
        <a class="nav-link text-warning mr-2" href="{{ route('adminProfile') }}"><i class="fa-solid fa-user"></i></a>
        <a href="" class="text-secondary" data-toggle="modal" data-target="#logout">Logout</a>
      </li>
    </ul>
  </nav>

  <div class="container-fluid">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="sidebar-sticky pt-3">
          @include('admin\sidebar')
        </div>
      </nav>

      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Users</h1>
          <button class="btn btn-success" data-toggle="modal" data-target="#add-user" id="add-button">Add User</button>
        </div>

        <div class="table-responsive">
          <table class="table table-striped table-sm" id="myTable" class="display">
            <thead>
              <tr>
                <th>Action</th>
                <th>Account #</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Username</th>
                <th>Password</th>
                <th>Contact #</th>
                <th>User Type</th>
              </tr>
            </thead>
          </table>
        </div>

      </main>
    </div>
  </div>




  <div class="modal fade" id="add-user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Account</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="add">
          <div class="modal-body">
            <label for="add_user_type">User Type</label>
            <select name="user_type" id="add_user_type" class="form-control">
              <option value="customer">Customer</option>
              <option value="in-charge">In-Charge</option>
              <option value="admin">Admin</option>
            </select>
            <label for="add_first_name">Firstname</label>
            <input type="text" class="form-control" name="first_name" id="add_first_name" placeholder="Enter Firstname" />
            <label for="add_last_name">Lastname</label>
            <input type="text" class="form-control" name="last_name" id="add_last_name" placeholder="Enter Lastname" />
            <label for="add_email">Email</label>
            <input type="text" class="form-control" name="email" id="add_email" placeholder="Enter email" />
            <label for="add_username">Username</label>
            <input type="text" class="form-control" name="username" id="add_username" placeholder="Enter Username" />
            <label for="add_password">Password</label>
            <input type="text" class="form-control" name="password" id="add_password" placeholder="Enter Password" />
            <label for="add_contact_number">Contact Number</label>
            <input type="number" class="form-control" name="contact_number" id="add_contact_number" placeholder="Contact Number" oninput="limitInput(this, 11)" />
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Add</button>
          </div>
        </form>
      </div>
    </div>
  </div>




  <div class="modal fade" id="edit-user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Account</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="edit">
          <div class="modal-body">
            <label for="edit_account_id">Account #</label>
            <input type="text" class="form-control" name="account_id" id="edit_account_id" placeholder="Enter Account ID" disabled />
            <label for="edit_user_type">User Type</label>
            <select name="user_type" id="edit_user_type" class="form-control">
              <option value="customer">Customer</option>
              <option value="in-charge">In-Charge</option>
              <option value="admin">Admin</option>
            </select>
            <label for="edit_first_name">Firstname</label>
            <input type="text" class="form-control" name="first_name" id="edit_first_name" placeholder="Enter Firstname" />
            <label for="edit_last_name">Lastname</label>
            <input type="text" class="form-control" name="last_name" id="edit_last_name" placeholder="Enter Lastname" />
            <label for="edit_email">Email</label>
            <input type="text" class="form-control" name="email" id="edit_email" placeholder="Enter email" />
            <label for="edit_username">Username</label>
            <input type="text" class="form-control" name="username" id="edit_username" placeholder="Enter Username" />
            <label for="edit_password">Password</label>
            <input type="text" class="form-control" name="password" id="edit_password" placeholder="Enter Password" />
            <label for="edit_contact_number">Contact Number</label>
            <input type="number" class="form-control" name="contact_number" id="edit_contact_number" placeholder="Contact Number" oninput="limitInput(this, 11)" />
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>



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