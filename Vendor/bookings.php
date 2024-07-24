<?php
include('../db.php');
session_start();

if (isset($_SESSION["vendor"]) && isset($_SESSION["name"])) {
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
					<li class="--active">
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
					<li class="active">
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
					Bookings
				</h1>

			</div>
		</section>

		<section class="section main-section">
        <div class="row align-items-center">
                    <?php
                    $vendorid = $_SESSION["vendor"];
                    //$userid = $_SESSION["user"];
                    $getBookings = "SELECT booking.*,user_login.Name,user_login.Contact_No,payment.Amount FROM booking,user_login,payment,booked_services 
                    WHERE booking.Booking_ID=booked_services.Booking_ID AND booking.Booking_ID=payment.Booking_ID AND user_login.User_ID=booking.User_ID AND 
                    payment.Status='COMPLETED' AND booked_services.Vendor_ID=:vendorid GROUP BY booking.Booking_ID;";
                    $stmt = $con->prepare("$getBookings");
					$stmt->bindParam(':vendorid', $vendorid);
                    $stmt->execute();
                    $services = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    if($stmt->rowCount()>0)
                    {
                    ?>
                    <table class="table table-striped">
                        <tr>
                            <th>Booking ID</th>
                            <th>Customer Name</th>
                            <th>Contact Number</th>
                            <th>Event</th>
                            <th>Location</th>
                            <th>Date</th>
                            <th>Event Start Time</th>
                            <th>Event End Time</th>
                            <th>People</th>
                            <th>Services Booked</th>
                            <th>Amount</th>
                        </tr>

                        <?php

                        //print_r($services);
                        foreach ($services as $row) {
                            $booking_id = $row["Booking_ID"];
                            $getServices = "SELECT service.Service_Name from booked_services,service 
                            WHERE booked_services.Service_ID=service.Service_ID AND booked_services.Booking_ID=:bookingid";
                            $stmt2 = $con->prepare($getServices);
                            $stmt2->bindParam(':bookingid', $booking_id);
                            $stmt2->execute();
                            $serviceData = $stmt2->fetchAll();

                            $bookedServices = [];
                            foreach ($serviceData as $s) {
                                array_push($bookedServices, $s["Service_Name"]);
                            }
                            $finalServices = implode(", ", $bookedServices);
                        ?>
                            <tr>
                                <td><?php echo $row["Booking_ID"]; ?></td>
                                <td><?php echo $row["Name"]; ?></td>
                                <td><?php echo $row["Contact_No"]; ?></td>
                                <td><?php echo $row["Event_Name"]; ?></td>
                                <td><?php echo $row["Event_Location"]; ?></td>
                                <td><?php echo $row["Event_Date"]; ?></td>
                                <td><?php echo $row["Event_Start_Time"]; ?></td>
                                <td><?php echo $row["Event_End_Time"]; ?></td>
                                <td><?php echo $row["No_Of_People"]; ?></td>
                                <td><?php echo $finalServices?></td>
                                <td><?php echo $row["Amount"]; ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                    <?php
                    }
                    else
                    {
                    ?>
                    <h3>No Bookings!</h3>
                    <?php
                    }
                    ?>
                </div>
            </div>
		</section>

	</div>

	<!-- Scripts below are for demo only -->
	<script type="text/javascript" src="js/main.min.js?v=1628755089081"></script>


	<link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">

</body>

</html>