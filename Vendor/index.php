<?php
include('../db.php');
session_start();

if (isset($_SESSION["vendor"]) && isset($_SESSION["name"])) {
	//Get details
} else {
	header("Location: Login/login.php");
}
$vendorid = $_SESSION["vendor"];
$search = "SELECT COUNT(Service_ID) as 'Services' FROM `service` WHERE `Vendor_ID`=:vendorid";
$stmt = $con->prepare($search);
$stmt->bindParam(':vendorid', $vendorid);
$stmt->execute();
$allusers = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($allusers as $row) {
	$vendors = $row["Services"];
}

$search = "SELECT COUNT(booked_services.Vendor_ID) as 'Bookings' FROM booked_services,booking WHERE booking.Booking_ID=booked_services.Booking_ID AND booked_services.Vendor_ID=:vendorid";
$stmt = $con->prepare($search);
$stmt->bindParam(':vendorid', $vendorid);
$stmt->execute();
$allusers = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($allusers as $row) {
	$bookings = $row["Bookings"];
}


?>
<!DOCTYPE html>
<html lang="en" class="">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Vendor Dashboard | Platform Productions</title>

	<!-- Tailwind is included -->
	<link rel="stylesheet" href="css/main.css?v=1628755089081">
</head>

<body>

	<div id="app">

		<nav id="navbar-main" class="navbar is-fixed-top">
			<div class="navbar-brand">
				<a class="navbar-item mobile-aside-button">
					<span class="icon"><i class="mdi mdi-forwardburger mdi-24px"></i></span>
				</a>
			</div>
			<div class="navbar-brand is-right">
				<a class="navbar-item --jb-navbar-menu-toggle" data-target="navbar-menu">
					<span class="icon"><i class="mdi mdi-dots-vertical mdi-24px"></i></span>
				</a>
			</div>
			<div class="navbar-menu" id="navbar-menu">
				<div class="navbar-end">

					<div class="navbar-item dropdown has-divider has-user-avatar">
						<a class="navbar-link">
							<div class="is-user-name"><span><?php echo $_SESSION["name"]; ?></span></div>
							<span class="icon"><i class="mdi mdi-chevron-down"></i></span>
						</a>
						<div class="navbar-dropdown">
							<a class="navbar-item" href="Login/logout.php">
								<span class="icon"><i class="mdi mdi-logout"></i></span>
								<span>Log Out</span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</nav>

		<aside class="aside is-placed-left is-expanded">
			<div class="aside-tools">
				<div>
					<b class="font-black">Platform</b> Productions
				</div>
			</div>
			<div class="menu is-menu-main">
				<p class="menu-label">General</p>
				<ul class="menu-list">
					<li class="active">
						<a href="/Platform/Vendor/">
							<span class="icon"><i class="mdi mdi-desktop-mac"></i></span>
							<span class="menu-item-label">Dashboard</span>
						</a>
					</li>
				</ul>
				<p class="menu-label">Orders</p>
				<ul class="menu-list">
					<li class="--set-active-tables-html">
						<a href="calender.php">
							<span class="icon"><i class="mdi mdi-table"></i></span>
							<span class="menu-item-label">Calender</span>
						</a>
					</li>
					<li class="--set-active-forms-html">
						<a href="bookings.php">
							<span class="icon"><i class="mdi mdi-cart-outline"></i></span>
							<span class="menu-item-label">Bookings</span>
						</a>
					</li>
				</ul>
				<p class="menu-label">Profile</p>
				<ul class="menu-list">
					<li class="--set-active-profile-html">
						<a href="editprofile.php">
							<span class="icon"><i class="mdi mdi-account-circle"></i></span>
							<span class="menu-item-label">Edit Profile</span>
						</a>
					</li>
				</ul>
			</div>
		</aside>



		<section class="is-hero-bar">
			<div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
				<h1 class="title">
					Vendor Dashboard
				</h1>

			</div>
		</section>

		<section class="section main-section">
			<div class="grid gap-6 grid-cols-1 md:grid-cols-3 mb-6">
			<div class="card">
					<div class="card-content">
						<div class="flex items-center justify-between">
							<div class="widget-label">
								<h3>
									Orders
								</h3>
								<h1>
									<?php echo $bookings; ?>
								</h1>
							</div>
							<span class="icon widget-icon text-red-500"><i class="mdi mdi-finance mdi-48px"></i></span>
						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-content">
						<div class="flex items-center justify-between">
							<div class="widget-label">
								<h3>
									Services
								</h3>
								<h1>
								<?php echo $vendors; ?>
								</h1>
							</div>
							<span class="icon widget-icon text-blue-500"><i class="mdi mdi-cart-outline mdi-48px"></i></span>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- <footer class="footer">
			<div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0">
				<div class="flex items-center justify-start space-x-3">
					<div>
						© 2022 Platform Productions
					</div>
				</div>


			</div>
		</footer> -->

		<div id="sample-modal" class="modal">
			<div class="modal-background --jb-modal-close"></div>
			<div class="modal-card">
				<header class="modal-card-head">
					<p class="modal-card-title">Sample modal</p>
				</header>
				<section class="modal-card-body">
					<p>Lorem ipsum dolor sit amet <b>adipiscing elit</b></p>
					<p>This is sample modal</p>
				</section>
				<footer class="modal-card-foot">
					<button class="button --jb-modal-close">Cancel</button>
					<button class="button red --jb-modal-close">Confirm</button>
				</footer>
			</div>
		</div>

		<div id="sample-modal-2" class="modal">
			<div class="modal-background --jb-modal-close"></div>
			<div class="modal-card">
				<header class="modal-card-head">
					<p class="modal-card-title">Sample modal</p>
				</header>
				<section class="modal-card-body">
					<p>Lorem ipsum dolor sit amet <b>adipiscing elit</b></p>
					<p>This is sample modal</p>
				</section>
				<footer class="modal-card-foot">
					<button class="button --jb-modal-close">Cancel</button>
					<button class="button blue --jb-modal-close">Confirm</button>
				</footer>
			</div>
		</div>

	</div>

	<!-- Scripts below are for demo only -->
	<script type="text/javascript" src="js/main.min.js?v=1628755089081"></script>


	<link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">

</body>

</html>