<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="api_token" content="{{ isset($apiToken) ? $apiToken : '' }}">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
	<script src="/downloads/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<link rel="preconnect" href="https://fonts.googleapis.com" />
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
	<link rel="preconnect" href="https://fonts.googleapis.com" />
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
	<link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@400;700&family=Dongle:wght@300;400;700&family=Lexend+Deca:wght@700&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Nunito&family=Outfit:wght@500&display=swap" rel="stylesheet" />
	<script src="https://kit.fontawesome.com/b15d9bd0c0.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="../css/style.css" />

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
	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
			<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
			<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
		</ol>
		<div class="carousel-inner">
			<div class="carousel-item active">
				<img class="d-block w-100" src="../img/edvin-johansson-rlwE8f8anOc-unsplash.jpg" alt="First slide" />
			</div>
			<div class="carousel-item">
				<img class="d-block w-100" src="../img/fabio-fistarol-qai_Clhyq0s-unsplash.jpg" alt="Second slide" />
			</div>
			<div class="carousel-item">
				<img class="d-block w-100" src="../img/yuliya-pankevich-oyxsG2Lh_uA-unsplash.jpg" alt="Third slide" />
			</div>
		</div>
		<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
	<h6 class="quote text-center">
		"Life is better in flip flops and a cozy resort, where the only worry is
		whether to order a margarita or a piña colada."
	</h6>
	<div class="sp container">
		<h3 class="text-center">Resorts</h3>
		<div class="row" id="resorts-landing">
		</div>
	</div>
	<div class="abt container">
		<div class="row">
			<div class="col-md-6 text-center">
				<h3>About us</h3>
				<h5>Enjoy & chill with unforgettable memories!</h5>
				<p>
					An online resort booking platform that focuses on room services and
					local resorts can offer a targeted and personalized experience for
					travelers. By partnering with local resorts, customers can enjoy an
					authentic and immersive experience that showcases the local culture
					and flavor of the region. The advantage of being a local booking
					platform is the ability to provide insider knowledge and
					recommendations to customers, building trust and loyalty for future
					bookings. Accurate and up-to-date information about accommodations
					is crucial, and offering additional services like transportation,
					tours, and activities can enhance the overall experience for
					customers. Ultimately, this niche approach can create a unique and
					personalized vacation experience for travelers.
				</p>
				<a href="{{ route('uabout') }}"><button class="btn btn-primary btn-lg">Read More</button></a>
			</div>
			<div class="col-md-6" id="abtimg">
				<img src="../img/logorh.png" alt="" />
			</div>
		</div>
	</div>
	<div class="breaker"></div>
	<footer>
		<div class="container">
			<div class="row">
				<div class="col-md-4 text-center" id="logb">
					<img src="../img/logorh.png" width="150" height="70" alt="" />
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
	<!-- view resort -->
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
							<img src="img/edvin-johansson-rlwE8f8anOc-unsplash.jpg" id="resort-image" width="350" alt="" />
						</div>
						<div class="col-md-6">
							<h4 id="resort-name">Resort Name</h4>
						</div>
						<div class="col-md-6 text-right">
							<h5 class="text-danger" id="resort-price">₱1,200.00 p/ night</h5>
						</div>
						<div class="col-md-12">
							<p id="resort-details">
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
							<h4>&nbsp;<span id="resort-location">Location</span></h4>
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
						<div class="col-md-12 mt-3">
							<h4>Rooms:</h4>
							<div class="row">
								<div class="col-md-4">
									<h5 id="room-name">Club Room</h5>
								</div>
								<div class="col-md-8">
									<p id="room-description">2 large double bed</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal"> Close </button>
				</div>
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
					<button type="button" class="btn btn-danger" id="logout-btn">Logout</button>
				</div>
			</div>
		</div>
	</div>
	<script src="downloads/unpkg.com_sweetalert@2.1.2_dist_sweetalert.min.js"></script>
	<script src="../downloads/js-cookie.js"></script>
	<script src="../js/user/index.js"></script>
	<script src="../js/script.js"></script>
	
	<script src="{{asset('/js/logout.js')}}"></script>
</body>

</html>