<?php
include('db.php');
session_start();
//$_SESSION["user"] = "Deepak Cardoza";
if (isset($_SESSION["user"]) && isset($_SESSION["name"])) {
    //Get details
    $userid = $_SESSION["user"];
    $getData = "SELECT * FROM `user_login` WHERE `User_ID`=:userid";
    $stmt = $con->prepare($getData);
    $stmt->bindParam(':userid', $userid);
    $stmt->execute();
    $result = $stmt->fetchAll();
    if ($stmt->rowCount() > 0) {
        foreach ($result as $row) {
            $name = $row["Name"];
            $email = $row["Email"];
            $contact = $row["Contact_No"];
            $password = $row["Password"];
        }
    }
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
    <link rel="stylesheet" type="text/css" href="styles/contact_styles.css?v=1">
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
                            <h2>Update Your Profile</h2>
                        </div>
                    </div>
                </div>
                <br><br>
                <div class="row align-items-center">
                    <div class="col-lg-12 get_in_touch_col text-left">
                        <div class="get_in_touch_contents">
                            <center><span id="msg" style="color:green;"></span>
                                <span id="err" style="color:red;"></span>
                            </center>
                            <form method="post">
                                <div>
                                    <label for="email">Email Address</label>
                                    <input id="email" style="cursor:not-allowed;" class="form_input input_name input_ph" type="email" placeholder="Email ID" required="required" disabled>
                                    <label for="name">Name</label>
                                    <input id="name" class="form_input input_name input_ph" type="text" name="name" placeholder="Name" required="required">
                                    <label for="contact">Contact Number</label>
                                    <input id="contact" class="form_input input_name input_ph" type="number" name="number" placeholder="Contact Number" required="required">
                                    <label for="password">Password</label>
                                    <input id="password" class="form_input input_name input_ph" type="password" name="password" placeholder="New Password" required="required">
                                    <label for="cpassword">Confrim Password</label>
                                    <input id="cpassword" class="form_input input_name input_ph" type="password" name="cpassword" placeholder="Confirm New Password" required="required">
                                </div>
                                <div>
                                    <button name="update" id="review_submit" type="submit" class="red_button message_submit_btn trans_300" value="Submit">Update</button>
                                </div>
                                <br>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    echo "<script>document.getElementById('name').value='$name';</script>";
    echo "<script>document.getElementById('email').value='$email';</script>";
    echo "<script>document.getElementById('contact').value='$contact';</script>";
    echo "<script>document.getElementById('password').value='$password';</script>";
    echo "<script>document.getElementById('cpassword').value='$password';</script>";
    if (isset($_POST["update"])) {
        $userid = $_SESSION["user"];
        $name = $_POST["name"];
        $number = $_POST["number"];
        $password = $_POST["password"];
        $cpassword = $_POST["cpassword"];

        if (strlen($number) < 10 || is_numeric($name) || is_numeric($email)) {
            echo "<script>document.querySelector('#err').innerHTML='Please enter valid details!';</script>";
        } else if ($password != $cpassword) {
            echo "<script>document.querySelector('#err').innerHTML='Passwords do not match!';</script>";
        } else if (strlen($password) < 6) {
            echo "<script>document.querySelector('#err').innerHTML='Password must be at least 6 characters long!';</script>";
        } else {
            $updateProfile = "UPDATE `user_login` SET `Name`=:name,`Password`=:password,`Contact_No`=:contact WHERE `User_ID`=:userid";
            $stmt = $con->prepare($updateProfile);
            $stmt->bindParam(':userid', $userid);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':contact', $number);
            $stmt->bindParam(':password', $password);
            $result = $stmt->execute();
            if ($result) {
                echo "<script>document.getElementById('msg').innerHTML='Profile Updated Successfully!'</script>";
            }
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
</body>

</html>