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





        <div class="new_arrivals" style="margin-top: 100px;">
            <div class="container">
                <div class="row">
                    <div class="col text-center">
                        <div class="section_title new_arrivals_title">
                            <h2>My Bookings</h2>
                        </div>
                    </div>
                </div>
                <br><br>
                <div class="row align-items-center">
                    <?php
                    include('db.php');
                    $userid = $_SESSION["user"];
                    $getBookings = "SELECT booking.*,payment.Amount FROM booking,payment,booked_services 
                    WHERE booking.Booking_ID=booked_services.Booking_ID AND booking.Booking_ID=payment.Booking_ID AND 
                    payment.Status='COMPLETED' AND booking.User_ID=:userid GROUP BY booking.Booking_ID;";
                    $stmt = $con->prepare("$getBookings");
                    $stmt->bindParam(':userid', $userid);
                    $stmt->execute();
                    $services = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    if($stmt->rowCount()>0)
                    {
                    ?>
                    <table class="table table-striped">
                        <tr>
                            <th>Booking ID</th>
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
                    <h3>No Bookings! <a href="/Platform">Book Now</a></h3>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>


    </div>

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