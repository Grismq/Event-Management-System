<?php
include('../db.php');
session_start();

if (isset($_SESSION["admin"]) && isset($_SESSION["name"])) {
	//Get details
} else {
	header("Location: Login/login.php");
}

$search = "SELECT COUNT(`User_ID`) as 'Users' FROM `user_login`;";
$stmt = $con->prepare($search);
$stmt->execute();
$allusers = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($allusers as $row) {
	$users = $row["Users"];
}

$search = "SELECT COUNT(`Vendor_ID`) as 'Vendors' FROM `vendors`;";
$stmt = $con->prepare($search);
$stmt->execute();
$allusers = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($allusers as $row) {
	$vendors = $row["Vendors"];
}

$search = "SELECT COUNT(`Booking_ID`) as 'Bookings' FROM `booking`;";
$stmt = $con->prepare($search);
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
	<title>Admin Dashboard | Platform Productions</title>

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
					<li class="--set-active-tables-html">
						<a href="/Platform/Admin/">
							<span class="icon"><i class="mdi mdi-desktop-mac"></i></span>
							<span class="menu-item-label">Dashboard</span>
						</a>
					</li>
				</ul>
				<p class="menu-label">Event Managment</p>
				<ul class="menu-list">
					<li class="active">
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
					<li class="--active">
						<a href="payments.php">
							<span class="icon"><i class="mdi mdi-credit-card-outline"></i></span>
							<span class="menu-item-label">Payments</span>
						</a>
					</li>

				</ul>
				<p class="menu-label">Users</p>
				<ul class="menu-list">
					<li class="--set-active-profile-html">
						<a href="users.php">
							<span class="icon"><i class="mdi mdi-account-circle"></i></span>
							<span class="menu-item-label">Registered Users</span>
						</a>
					</li>
					<li>
						<a href="feedback.php" class="has-icon">
							<span class="icon"><i class="mdi mdi-message-text-outline"></i></span>
							<span class="menu-item-label">Feedback</span>
						</a>
					</li>
				</ul>
				<p class="menu-label">Vendors & Services</p>
				<ul class="menu-list">
					<li>
						<a class="dropdown">
							<span class="icon"><i class="mdi mdi-square-edit-outline"></i></span>
							<span class="menu-item-label">Manage Vendors</span>
							<span class="icon"><i class="mdi mdi-plus"></i></span>
						</a>
						<ul>
							<li>
								<a href="addvendor.php">
									<span>Add Vendor</span>
								</a>
							</li>
							<li>
								<a href="updatevendor.php">
									<span>Update Vendor Details</span>
								</a>
							</li>
						</ul>
					</li>
					<li>
						<a class="dropdown">
							<span class="icon"><i class="mdi mdi-view-list"></i></span>
							<span class="menu-item-label">Manage Services</span>
							<span class="icon"><i class="mdi mdi-plus"></i></span>
						</a>
						<ul>
							<li>
								<a href="addservice.php">
									<span>Add Service</span>
								</a>
							</li>
							<li>
								<a href="updateservice.php">
									<span>Update Services</span>
								</a>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</aside>

		<?php
		require_once 'vendor/autoload.php';

		$client = new Google_Client();
		//The json file you got after creating the service account
		putenv('GOOGLE_APPLICATION_CREDENTIALS=platform-productions-3427cf594d82.json');
		$client->useApplicationDefaultCredentials();
		$client->setApplicationName("Platform_Productions");
		$client->setScopes(Google_Service_Calendar::CALENDAR);
		$client->setAccessType('offline');

		$service = new Google_Service_Calendar($client);

		$calendarList = $service->calendarList->listCalendarList();
		//print_r($calendarList);
		?>
		<section class="is-hero-bar">
			<div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
				<h1 class="title">
					Calender
				</h1>
				<div class="field grouped">
					<div class="control">
						<a href="addevent.php">
						<button type="submit" name="add" class="button green">
							Add Event
						</button>
						</a>
					</div>
				</div>
			</div>
		</section>

		<section class="section main-section">
			<iframe src="https://calendar.google.com/calendar/embed?height=500&wkst=2&bgcolor=%23ffffff&ctz=Asia%2FKolkata&title=Platform%20Productions&src=c3FoMzI0ZmhkNWh0dWFlOGh0cmlzNWlxMG9AZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ&color=%23AD1457" style="border:solid 1px #777" width="100%" height="500" frameborder="0" scrolling="no"></iframe>
		</section>
	</div>
	<script>
		//document.getElementById('calenderTitle').innerHTML = "Platform Productions Calender";
	</script>
	<!-- Scripts below are for demo only -->
	<script type="text/javascript" src="js/main.min.js?v=1628755089081"></script>


	<link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">

</body>

</html>