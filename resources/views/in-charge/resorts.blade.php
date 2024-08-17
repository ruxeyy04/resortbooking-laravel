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
  <script src="../js/in-charge/resorts.js"></script>
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
        <a class="nav-link text-warning mr-2" href="{{ route('inchargeProfile') }}profile.html"><i class="fa-solid fa-user"></i></a>
        <a href="" class="text-secondary" data-toggle="modal" data-target="#logout">Logout</a>
      </li>
    </ul>
  </nav>

  <div class="container-fluid">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="sidebar-sticky pt-3">
        @include('in-charge\sidebar')
        </div>
      </nav>

      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Resorts</h1>
          <button class="btn btn-success" data-toggle="modal" data-target="#add-resort" id="add-button">Add Resort</button>
        </div>


        <div class="table-responsive">
          <table class="table table-striped table-sm" id="myTable" class="display">
            <thead>
              <tr>
                <th>Action</th>
                <th>Image</th>
                <th>Resort #</th>
                <th>Name</th>
                <th>Location</th>
                <th>Description</th>
                <th>Price</th>
              </tr>
            </thead>
          </table>
        </div>

      </main>
    </div>
  </div>






  <div class="modal fade" id="add-resort" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Resort</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="add">
          <div class="modal-body">
            <label for="add_image">Image</label>
            <input type="file" class="form-control-file border" name="image" id="add_image">
            <label for="add_resort_name">Resort Name</label>
            <input type="text" class="form-control" name="resort_name" id="add_resort_name" />
            <label for="add_location">Location</label>
            <input type="text" class="form-control" name="location" id="add_location" />
            <label for="add_resort_description">Description</label>
            <textarea class="form-control" name="resort_description" id="add_resort_description" cols="30" rows="10"></textarea>
            <label for="add_price">Price</label>
            <input type="number" class="form-control" name="price" id="add_price" />

            <div>
              Rooms
              <div class="row rooms">
                <!-- Rooms -->
              </div>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Add</button>
          </div>
        </form>
      </div>
    </div>
  </div>


  <div class="modal fade" id="edit-resort" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Resort</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="edit">
          <div class="modal-body">
            <label for="edit_resort_id">Resort #</label>
            <input type="text" class="form-control" name="resort_id" id="edit_resort_id" disabled />
            <label for="edit_image">Image</label>
            <input type="file" class="form-control-file border" name="image" id="edit_image">
            <label for="add_resort_name">Resort Name</label>
            <input type="text" class="form-control" name="resort_name" id="edit_resort_name" />
            <label for="add_location">Location</label>
            <input type="text" class="form-control" name="location" id="edit_location" />
            <label for="add_resort_description">Description</label>
            <textarea class="form-control" name="resort_description" id="edit_resort_description" cols="30" rows="10"></textarea>
            <label for="add_price">Price</label>
            <input type="number" class="form-control" name="price" id="edit_price" />

            <div>
              Rooms
              <div class="row edit_rooms">
                <!-- Rooms -->
              </div>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Edit</button>
          </div>
        </form>
      </div>
    </div>
  </div>



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


</body>

</html>