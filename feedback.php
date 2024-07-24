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
	<link rel="stylesheet" type="text/css" href="styles/contact_styles.css">
	<link rel="stylesheet" type="text/css" href="styles/contact_responsive.css">


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
								<ul class="navbar_user" style="padding-left:0px;margin-left:0px;">
									<li><a href="#"><i class="fa fa-user" aria-hidden="true"></i></a></li>
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
							<li><a href="#"><i class="fa fa-sign-in" aria-hidden="true"></i>Log Out</a></li>
						</ul>
					</li>
					<li class="menu_item"><a href="/Platofrm">Home</a></li>
					<li class="menu_item"><a href="booking.php">My Bookings</a></li>
					<li class="menu_item"><a href="feedback.php">Feedback</a></li>
					<li class="menu_item"><a href="profile.php">Profile</a></li>
				</ul>
			</div>
		</div>





		<div class="new_arrivals" style="margin-top: 100px;">
			<div class="container">
				<div class="row">
					<div class="col text-center">
						<div class="section_title new_arrivals_title">
							<h2>Share Your Feedback</h2>
						</div>
					</div>
				</div>
				<br><br>
				<div class="row align-items-center">
					<div class="col-lg-12 get_in_touch_col text-center">
						<div class="get_in_touch_contents">
							<span id="msg" style="color:green;"></span>
							<form method="post">
								<div>
									<textarea style="width:500px;" id="input_message" class="input_ph input_message" name="message" placeholder="Message" rows="6" required data-error="Please, write us a message."></textarea>
								</div>
								<div>
									<button name="send" id="review_submit" type="submit" class="red_button message_submit_btn trans_300" value="Submit">send message</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
		if(isset($_POST["send"]))
		{
			$userid = $_SESSION["user"];
			$message = $_POST["message"];
			$feedbackSubmit = "INSERT INTO `feedback`(`User_ID`, `Feedback`) VALUES (:userid,:feedback)";
			$stmt = $con->prepare($feedbackSubmit);
			$stmt->bindParam(':userid', $userid);
			$stmt->bindParam(':feedback', $message);
			$result = $stmt->execute();
			if($result)
			{
				echo "<script>document.getElementById('msg').innerHTML='Feedback Submitted Successfully'</script>";
			}

		}
		
	?>
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/jquery.js?v=230620221103"></script>
	<script src="styles/bootstrap4/popper.js"></script>
	<script src="styles/bootstrap4/bootstrap.min.js"></script>
	<script src="plugins/Isotope/isotope.pkgd.min.js"></script>
	<script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
	<script src="plugins/easing/easing.js"></script>
	<script src="js/custom.js"></script>
	<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
	<script src="js/payment.js?v=230620221105"></script>
</body>

</html>