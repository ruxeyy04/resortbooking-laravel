<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="api_token" content="{{ isset($apiToken) ? $apiToken : '' }}">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<link rel="preconnect" href="https://fonts.googleapis.com" />
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
	<link rel="preconnect" href="https://fonts.googleapis.com" />
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
	<link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@400;700&family=Dongle:wght@300;400;700&family=Lexend+Deca:wght@700&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Nunito&family=Outfit:wght@500&display=swap" rel="stylesheet" />
	<script src="https://kit.fontawesome.com/b15d9bd0c0.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="../css/style.css" />
	<script src="../downloads/js-cookie.js"></script>
	<script src="../js/user/contact.js"></script>
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
		<!--Section: Contact v.2-->
		<section class="mb-4">
			<!--Section heading-->
			<h2 class="h1-responsive font-weight-bold text-center my-4">
				Contact us
			</h2>
			<!--Section description-->
			<p class="text-center w-responsive mx-auto mb-5">
				Do you have any questions? Please do not hesitate to contact us
				directly. Our team will come back to you within a matter of hours to
				help you.
			</p>
			<div class="row">
				<!--Grid column-->
				<div class="col-md-9 mb-md-0 mb-5">
					<form id="contact-form" name="contact-form" action="mail.php" method="POST">
						<!--Grid row-->
						<div class="row">
							<!--Grid column-->
							<div class="col-md-6">
								<div class="md-form mb-0">
									<input type="text" id="name" name="name" class="form-control" />
									<label for="name" class="">Your name</label>
								</div>
							</div>
							<!--Grid column-->
							<!--Grid column-->
							<div class="col-md-6">
								<div class="md-form mb-0">
									<input type="text" id="email" name="email" class="form-control" />
									<label for="email" class="">Your email</label>
								</div>
							</div>
							<!--Grid column-->
						</div>
						<!--Grid row-->
						<!--Grid row-->
						<div class="row">
							<div class="col-md-12">
								<div class="md-form mb-0">
									<input type="text" id="subject" name="subject" class="form-control" />
									<label for="subject" class="">Subject</label>
								</div>
							</div>
						</div>
						<!--Grid row-->
						<!--Grid row-->
						<div class="row">
							<!--Grid column-->
							<div class="col-md-12">
								<div class="md-form">
									<textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea"></textarea>
									<label for="message">Your message</label>
								</div>
							</div>
						</div>
						<!--Grid row-->
					</form>
					<div class="text-center text-md-left">
						<a class="btn btn-primary" onclick="document.getElementById('contact-form').submit();">Send</a>
					</div>
					<div class="status"></div>
				</div>
				<!--Grid column-->
				<!--Grid column-->
				<div class="col-md-3 text-center">
					<ul class="list-unstyled mb-0">
						<li>
							<i class="fas fa-map-marker-alt fa-2x"></i>
							<p>
								5R2R+386, H.T. Feliciano St, Ozamiz City, 7200 Misamis
								Occidental
							</p>
						</li>
						<li>
							<i class="fas fa-phone mt-4 fa-2x"></i>
							<p>+63 91243567890</p>
						</li>
						<li>
							<i class="fas fa-envelope mt-4 fa-2x"></i>
							<p>resorthub@email.com</p>
						</li>
					</ul>
				</div>
				<!--Grid column-->
			</div>
		</section>
		<!--Section: Contact v.2-->
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
					<button type="button" class="btn btn-danger" id="logout-btn">Logout</button>
				</div>
			</div>
		</div>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="../js/script.js"></script>
	<script src="{{asset('/js/logout.js')}}"></script>
</body>

</html>