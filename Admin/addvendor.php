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
                    <li class="--set-active">
                        <a href="calender.php">
                            <span class="icon"><i class="mdi mdi-table"></i></span>
                            <span class="menu-item-label">Calender</span>
                        </a>
                    </li>
                    <li class="--active">
                        <a href="bookings.php">
                            <span class="icon"><i class="mdi mdi-cart-outline"></i></span>
                            <span class="menu-item-label">Bookings</span>
                        </a>
                    </li>
                    <li class="--set-active-forms-html">
                        <a href="payments.php">
                            <span class="icon"><i class="mdi mdi-credit-card-outline"></i></span>
                            <span class="menu-item-label">Payments</span>
                        </a>
                    </li>
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
                        <li class="active">
                            <a class="dropdown">
                                <span class="icon"><i class="mdi mdi-square-edit-outline"></i></span>
                                <span class="menu-item-label">Manage Vendors</span>
                                <span class="icon"><i class="mdi mdi-plus"></i></span>
                            </a>
                            <ul>
                                <li class="active">
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



        <section class="is-hero-bar">
            <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
                <h1 class="title">
                    Add Vendor
                </h1>

            </div>
        </section>

        <section class="section main-section">
            <div class="row align-items-center">
                <div class="card-content">
                    <form id="form" method="post" autocomplete="off">
                        <input autocomplete="false" name="hidden" type="text" style="display:none;">
                        <span id="error" style="color:red;"></span>
                        <span id="msg" style="color:green;"></span>
                        <div class="field">
                            <div class="field-body">
                                <div class="field">
                                    <label class="label">Company Name</label>
                                    <div class="control icons-left">
                                        <input class="input" type="text" id="name" name="name" placeholder="Name of the Vendor" required>
                                        <span class="icon left"><i class="mdi mdi-account"></i></span>
                                    </div>
                                </div>

                                <div class="field">
                                    <label class="label">Contact Number</label>
                                    <div class="control icons-left">
                                        <input class="input" type="number" id="contact" name="number" placeholder="Contact Number" required>
                                        <span class="icon left"><i class="mdi mdi-account"></i></span>
                                    </div>
                                </div>

                                <div class="field">
                                    <label class="label">Email Address</label>
                                    <div class="control icons-left">
                                        <input class="input" type="email" id="email" name="email" autocomplete="off" placeholder="Company Email Address" required>
                                        <span class="icon left"><i class="mdi mdi-account"></i></span>
                                    </div>
                                </div>

                                <div class="field">
                                    <label class="label">Category</label>
                                    <div class="control icons-left">
                                        <input class="input" type="text" id="category" name="category" placeholder="Vendor Category" required>
                                        <span class="icon left"><i class="mdi mdi-account"></i></span>
                                    </div>
                                </div>

                                <div class="field">
                                    <label class="label">Create Password</label>
                                    <div class="control icons-left">
                                        <input class="input" type="password" id="password" name="password" autocomplete="off" placeholder="Password (Min 6 Characters)" required>
                                        <span class="icon left"><i class="mdi mdi-account"></i></span>
                                    </div>
                                </div>

                                <div class="field">
                                    <label class="label">Confirm Password</label>
                                    <div class="control icons-left">
                                        <input class="input" type="password" id="cpassword" name="cpassword" placeholder="Confrim Password" required>
                                        <span class="icon left"><i class="mdi mdi-account"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="field grouped">
                            <div class="control">
                                <button type="submit" name="add" class="button green">
                                    Add Vendor
                                </button>
                            </div>
                            <div class="control">
                                <button type="reset" name="reset" class="button red">
                                    Reset
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </div>
    </section>

    </div>
    <?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    if (isset($_POST["add"])) {

        $name = $_POST["name"];
        $number = $_POST["number"];
        $email = $_POST["email"];
        $category = $_POST["category"];
        $password = $_POST["password"];
        $cpassword = $_POST["cpassword"];

        echo "<script>document.querySelector('#name').value='$name';</script>";
        echo "<script>document.querySelector('#email').value='$email';</script>";
        echo "<script>document.querySelector('#contact').value='$number';</script>";
        echo "<script>document.querySelector('#category').value='$category';</script>";
        echo "<script>document.querySelector('#password').value='$password';</script>";
        echo "<script>document.querySelector('#cpassword').value='$cpassword';</script>";

        $search = "SELECT COUNT(`Email`) as 'Vendors' FROM `vendors` WHERE `Email`=:email";
        $stmt = $con->prepare($search);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $allusers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($allusers as $row) {
            $flag = $row["Vendors"];
        }
        if (strlen($number) < 10 || is_numeric($name) || is_numeric($email)) {
            echo "<script>document.querySelector('#error').innerHTML='Please enter valid details!';</script>";
        } else if ($password != $cpassword) {
            echo "<script>document.querySelector('#error').innerHTML='Passwords do not match!';</script>";
        } else if (strlen($password) < 6) {
            echo "<script>document.querySelector('#error').innerHTML='Password must be at least 6 characters long!';</script>";
        } else if ($flag != "0" || $flag != 0) {
            echo "<script>document.querySelector('#error').innerHTML='Email ID already exists!';</script>";
        } else {
            $query = "SELECT * FROM `vendors`";
            $stmt = $con->prepare($query);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($stmt->rowCount() > 0) {
                foreach ($data as $row) {
                    $vendor = $row["Vendor_ID"];
                }

                $num = substr($vendor, 1);
                //die($num);
                $vendorid1 = $num + 1;
                $vendorid = "V" . $vendorid1;
                //die($user_id);
            } else {
                $vendorid = "V101";
            }

            $ins = "INSERT INTO `vendors`(`Vendor_ID`, `Company_Name`, `Contact_No`, `Email`, `Password`, `Category`) 
            VALUES (:vendorid,:name,:contact,:email,:password,:category)";
            $stmt = $con->prepare($ins);
            $stmt->bindParam(':vendorid', $vendorid);
            $stmt->bindParam(':contact', $number);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':category', $category);
            $stmt->bindParam(':password', $password);
            $success = $stmt->execute();
            if ($success) {
                echo "<script>document.querySelector('#msg').innerHTML='Vendor Addedd Successfully!';</script>";
                //echo "<script>document.getElementById('form').reset(); </script>";

                //Load Composer's autoloader
                require_once 'vendor/autoload.php';

                //Create an instance; passing `true` enables exceptions
                $mail = new PHPMailer(true);

                try {
                    //Server settings
                    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;

                    //Enable verbose debug output
                    $mail->isSMTP();                                            //Send using SMTP
                    $mail->Host       = $MAIL_HOST;                     //Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                    $mail->Username   = $MAIL_USERNAME;                     //SMTP username
                    $mail->Password   = $MAIL_PASSWORD;                               //SMTP password
                    $mail->SMTPSecure = $MAIL_ENCRYPTION;            //Enable implicit TLS encryption
                    $mail->Port       = $MAIL_PORT;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`


                    //Recipients
                    $mail->setFrom('platformproductions112@gmail.com', 'Platform Productions');
                    $mail->addAddress($email, $name);     //Add a recipient
                    // $mail->addAddress('ellen@example.com');               //Name is optional
                    //$mail->addReplyTo('info@example.com', 'Information');
                    //$mail->addCC('cc@example.com');
                    //$mail->addBCC('bcc@example.com');

                    //Attachments
                    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
                    $subject = "Your Vendor Account is Created | Platform Productions";

                    $htmlBody = "<b>Hey $name,</b>
                    <br>
                    Your vendor account has been successfully created by Platform Productions. Please use the following login credentials to login to your account.
                    <br>
                    <br>
                    Email ID: $email<br>
                    Password: $password<br><br>

                    <a href='http://localhost/Platform/Vendor/Login/login.php' target='_blank'>Click here to login</a>
                    <br>
                    <br>
                    Regards,
                    <br>
                    Platform Productions
                    ";

                    $body = "";
                    //Content
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = $subject;
                    $mail->Body    = $htmlBody;
                    $mail->AltBody = $htmlBody;

                    $mail->send();
                    //echo 'Message has been sent';
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            } else {
                echo "<script>document.querySelector('#error').innerHTML='Something Went Wrong!';</script>";
            }
        }
    }
    ?>
    <!-- Scripts below are for demo only -->
    <script type="text/javascript" src="js/main.min.js?v=1628755089081"></script>


    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">

</body>

</html>