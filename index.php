<?php
include('db.php');
session_start();
//$_SESSION["user"] = "Deepak Cardoza";
if (isset($_SESSION["user"]) && isset($_SESSION["name"])) {
	//Get details
} else {
	header("Location: Login/login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Platform Productions</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="Colo Shop Template">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
	<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
	<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
	<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
	<link rel="stylesheet" type="text/css" href="styles/main_styles.css?v=220620220822">
	<link rel="stylesheet" type="text/css" href="styles/responsive.css">


</head>

<body>

	<div class="super_container">

		<!-- Header -->
		<header class="header trans_300">

			<!-- Top Navigation -->

			<div class="top_nav">
				<div class="container">
					<div class="row">
						<div class="col-md-6">
							<!-- <div class="top_nav_left">free shipping on all u.s orders over $50</div> -->
						</div>
						<div class="col-md-6 text-right">
							<div class="top_nav_right">
								<ul class="top_nav_menu">
									<li class="account">
										<a href="#">
											<?php echo $_SESSION["name"]; ?>
											<i class="fa fa-angle-down"></i>
										</a>
										<ul class="account_selection">
											<li><a href="Login/logout.php"><i class="fa fa-sign-in" aria-hidden="true"></i>Log Out</a></li>
										</ul>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Main Navigation -->

			<div class="main_nav_container">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 text-right">
							<div class="logo_container">
								<a href="/Platform">Platform<span>Productions</span></a>
							</div>
							<nav class="navbar">
								<ul class="navbar_menu" style="padding-left:0px;margin-left:0px;">
									<li><a href="/Platform">Home</a></li>
									<li><a href="booking.php">My Bookings</a></li>
									<li><a href="feedback.php">Feedback</a></li>
									<li><a href="profile.php">Profile</a></li>
								</ul>
								<div class="hamburger_container">
									<i class="fa fa-bars" aria-hidden="true"></i>
								</div>
							</nav>
						</div>
					</div>
				</div>
			</div>

		</header>

		<div class="fs_menu_overlay"></div>
		<div class="hamburger_menu">
			<div class="hamburger_close"><i class="fa fa-times" aria-hidden="true"></i></div>
			<div class="hamburger_menu_content text-right">
				<ul class="menu_top_nav">
					<li class="menu_item has-children">
						<a href="#">
							<?php echo $_SESSION["name"]; ?>
							<i class="fa fa-angle-down"></i>
						</a>
						<ul class="menu_selection">
							<li><a href="Login/logout.php"><i class="fa fa-sign-in" aria-hidden="true"></i>Log Out</a></li>
						</ul>
					</li>
					<li class="menu_item"><a href="/Platform">Home</a></li>
					<li class="menu_item"><a href="booking.php">My Bookings</a></li>
					<li class="menu_item"><a href="feedback.php">Feedback</a></li>
					<li class="menu_item"><a href="profile.php">Profile</a></li>
				</ul>
			</div>
		</div>

		<!-- Slider -->

		<div class="main_slider" style="background-image:url(images/images/bg.jpeg)">
			<div class="container fill_height">
				<div class="row align-items-center fill_height">
					<div class="col">
						<div class="main_slider_content">
							<h1 style="color: #fff;">Dreams to Reality...</h1>
							<div class="red_button shop_now_button"><a href="#">book now</a></div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- New Arrivals -->

		<div class="new_arrivals">
			<div class="container">
				<div class="row">
					<div class="col text-center">
						<div class="section_title new_arrivals_title">
							<h2>Book a Service</h2>
						</div>
					</div>
				</div>
				<!-- <div class="row align-items-center">
				<div class="col text-center">
					<div class="new_arrivals_sorting">
						<ul class="arrivals_grid_sorting clearfix button-group filters-button-group">
							<li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center active is-checked" data-filter="*">all</li>
							<li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center" data-filter=".women">women's</li>
							<li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center" data-filter=".accessories">accessories</li>
							<li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center" data-filter=".men">men's</li>
						</ul>
					</div>
				</div>
			</div> -->
				<div class="row">
					<div class="col">
						<div class="product-grid" data-isotope='{ "itemSelector": ".product-item", "layoutMode": "fitRows" }'>
							<div class="cart-box">

							</div>
							<!-- All Services -->
							<?php

							$getServices = "SELECT * FROM `service`";
							$stmt = $con->prepare("$getServices");
							//$stmt->bindParam(':registration_id', $regId);
							$stmt->execute();
							$services = $stmt->fetchAll(PDO::FETCH_ASSOC);

							//print_r($services);
							foreach ($services as $row) {
							?>
								<label style="margin-right: 10px;" class="label-add" for="<?php echo $row["Service_ID"]; ?>">
									<div class="product-item men">
										<div class="product discount product_filter">
											<div class="product_image">
												<img src="images/services/<?php echo $row['Image']; ?>" alt="Service Image">
											</div>
											<!-- <div class="favorite favorite_left"></div> -->
											<!-- <div class="product_bubble product_bubble_right product_bubble_red d-flex flex-column align-items-center">
											<span></span>
										</div> -->
											<div class="product_info">
												<h6 class="product_name"><?php echo $row["Service_Name"]; ?></h6>
												<div class="product_price"><?php echo "₹" . $row["Amount"]; ?>
													<span><?php //Striked Amount 
															?></span>
												</div>
												<div><input id="<?php echo $row["Service_ID"]; ?>" type="checkbox"></div>
											</div>
										</div>
										<div class="red_button add_to_cart_button">
											<a href="javascript:void(0);" class="add-to-cart" data-item-id="<?php echo $row["Service_ID"]; ?>">Proceed to Pay</a>
										</div>
									</div>
								</label>
							<?php
							}
							?>

						</div>
						<div class="modal fade" id="paymentConfirmation" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content text-center">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLongTitle">Complete Your Order</h5>
										<button type="button" id="close" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
									</div>
									<div class="modal-body" style="color:#fff;">
										<p id="printServices"></p>
										<p id="printAmount"></p>
										<div class="form-row-last">
											<a href="#payment" id="pay" name="register" class="register1 btn">Proceed to Pay</a>
										</div>

									</div>
								</div>
							</div>
						</div>

						<div class="modal fade" id="eventInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content text-center">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLongTitle">Event Details</h5>
										<button type="button" id="close" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
									</div>
									<div class="modal-body" id="eventDetails">
										<span style="color:red" id="error"></span><br>
										<label for="event-name">Choose Event</label><br>
										<select id="event-name">
											<option value="">Choose Event</option>
											<option value="Wedding">Wedding</option>
											<option value="Birthday">Birthday</option>
											<option value="Inaugration">Inaugration</option>
											<option value="Launch Party">Launch Party</option>
											<option value="Anniversary">Anniversary</option>
											<option value="Engagement">Engagement</option>
											<option value="Mehendi">Mehendi</option>
											<option value="Sangeet Ceremony">Sangeet Ceremony</option>
											<option value="Haldi Ceremony">Haldi Ceremony</option>
											<option value="Roce">Roce</option>
											<option value="Bridal Shower">Bridal Shower</option>
											<option value="Baby Shower">Baby Shower</option>
											<option value="Product Launch">Product Launch</option>
											<option value="Naming Ceremony">Naming Ceremony</option>
											<option value="House Warming Ceremony">House Warming Ceremony</option>
											<option value="Other">Other</option>
										</select><br>
										<input type="text" id="event-name-other" placeholder="Please Specify Event"><br>
										<label for="event-location">Event Location</label><br>
										<input type="text" id="event-location"><br>
										<label for="event-date">Event Date</label><br>
										<input type="date" id="event-date" placeholder="Enter Event Date"><br>
										<label for="event-time1">Event Start Time</label><br>
										<input type="time" id="event-time1" placeholder="Enter Start Time"><br>
										<label for="event-time2">Event End Time</label><br>
										<input type="time" id="event-time2" placeholder="Enter End Time"><br>
										<label for="people">Total No of People</label><br>
										<input type="number" id="people"><br>
										<div class="form-row-last">
											<a href="javascript:void(0);" id="continue" name="register" class="register1 btn">Continue</a>
										</div>

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Footer -->
		<br><br>
		<footer class="footer">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="footer_nav_container">
							<div class="cr">©2022 All Rights Reserverd | <a href="#">Platform Productions</a></div>
						</div>
					</div>
				</div>
			</div>
		</footer>

	</div>

	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/jquery.js?v=250620220114"></script>
	<script src="styles/bootstrap4/popper.js"></script>
	<script src="styles/bootstrap4/bootstrap.min.js"></script>
	<script src="plugins/Isotope/isotope.pkgd.min.js"></script>
	<script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
	<script src="plugins/easing/easing.js"></script>
	<script src="js/custom.js"></script>
	<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
	<script src="js/payment.js?v=230620220701"></script>
</body>

</html>