<?php
include('../db.php');
session_start();

if (isset($_SESSION["admin"]) && isset($_SESSION["name"])) {
    //Get details
} else {
    header("Location: Login/login.php");
}
$vendorid = $_GET["v"];
$serviceid = $_GET["s"];
$search = "SELECT * FROM `service` WHERE `Service_ID`=:serviceid";
$stmt = $con->prepare($search);
$stmt->bindParam(':serviceid', $serviceid);
$stmt->execute();
$allusers = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($allusers as $row) {
    $service = $row["Service_Name"];
    $amount = $row["Amount"];
    $max = $row["Maximum"];
    $filename = $row["Image"];
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
                        <li class="active">
                            <a class="dropdown">
                                <span class="icon"><i class="mdi mdi-view-list"></i></span>
                                <span class="menu-item-label">Manage Services</span>
                                <span class="icon"><i class="mdi mdi-plus"></i></span>
                            </a>
                            <ul>
                                <li class="active">
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
                    Update Service
                </h1>

            </div>
        </section>

        <section class="section main-section">
            <div class="row align-items-center">
                <div class="card-content">
                    <form id="form" method="post" autocomplete="off" enctype="multipart/form-data">
                        <input autocomplete="false" name="hidden" type="text" style="display:none;">
                        <span id="error" style="color:red;"></span>
                        <span id="msg" style="color:green;"></span>
                        <div class="field">
                            <div class="field-body">
                                <div class="field">
                                    <label class="label">Updating Vendor</label>
                                    <div class="control icons-left select">
                                        <select name="vendor" id="vendor" disabled required>
                                            <option value="">Choose Vendor</option>
                                            <?php
                                            $getVendors = "SELECT * FROM `vendors`";
                                            $stmt = $con->prepare("$getVendors");

                                            $stmt->execute();
                                            $vendors = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                            //print_r($services);
                                            foreach ($vendors as $row) {
                                            ?>
                                                <option value="<?php echo $row['Vendor_ID']; ?>"><?php echo $row["Company_Name"]; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="field">
                                    <label class="label">Service Name</label>
                                    <div class="control icons-left">
                                        <input class="input" type="text" id="service" name="service" placeholder="Name of the Service" required>
                                        <span class="icon left"><i class="mdi mdi-cart"></i></span>
                                    </div>
                                </div>

                                <div class="field">
                                    <label class="label">Amount</label>
                                    <div class="control icons-left">
                                        <input class="input" type="number" id="amount" name="amount" autocomplete="off" placeholder="Amount (In Rupees)" required>
                                        <span class="icon left"><i class="mdi mdi-cart"></i></span>
                                    </div>
                                </div>

                                <div class="field">
                                    <label class="label">Maximum Orders per Day</label>
                                    <div class="control icons-left">
                                        <input class="input" type="number" id="max" name="max" placeholder="Max Orders/Day" required>
                                        <span class="icon left"><i class="mdi mdi-cart"></i></span>
                                    </div>
                                </div>
                                <div class="field">
                                    <label class="label">Upload Image</label>
                                    <div class="control icons-left">
                                        <input type="file" name="image" id="image" accept="image/*">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="field grouped">
                            <div class="control">
                                <button type="submit" name="add" class="button green">
                                    Update
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
    echo "<script>document.querySelector('#vendor').value='$vendorid';</script>";
    echo "<script>document.querySelector('#service').value='$service';</script>";
    echo "<script>document.querySelector('#amount').value='$amount';</script>";
    echo "<script>document.querySelector('#max').value='$max';</script>";
    if (isset($_POST["add"])) {

        $servicename = $_POST["service"];
        $amount = $_POST["amount"];
        $max = $_POST["max"];


        //print_r($_FILES);
        if (!empty($_FILES["image"]["name"])) {
            $target_dir = "../images/services/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            $uploadOk = 1;

            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if ($check !== false) {
                //echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                //echo "File is not an image.";
                $uploadOk = 0;
            }
            // Check if file already exists
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    //echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
            $filename = $_FILES["image"]["name"];

            $ins = "UPDATE `service` SET `Service_Name`=:service,`Amount`=:amount,`Maximum`=:max,`Image`=:image WHERE `Service_ID`=:serviceid";
            $stmt = $con->prepare($ins);
            $stmt->bindParam(':serviceid', $serviceid);
            $stmt->bindParam(':service', $servicename);
            $stmt->bindParam(':amount', $amount);
            $stmt->bindParam(':max', $max);
            $stmt->bindParam(':image', $filename);
            $success = $stmt->execute();
            if ($success) {
                echo "<script>document.querySelector('#msg').innerHTML='Service Updated Successfully!';</script>";
                //echo "<script>document.getElementById('form').reset(); </script>";
            } else {
                echo "<script>document.querySelector('#error').innerHTML='Something Went Wrong!';</script>";
            }
        } else {

            $ins = "UPDATE `service` SET `Service_Name`=:service,`Amount`=:amount,`Maximum`=:max WHERE `Service_ID`=:serviceid";
            $stmt = $con->prepare($ins);
            $stmt->bindParam(':serviceid', $serviceid);
            $stmt->bindParam(':service', $servicename);
            $stmt->bindParam(':amount', $amount);
            $stmt->bindParam(':max', $max);
            $success = $stmt->execute();
            if ($success) {
                echo "<script>document.querySelector('#msg').innerHTML='Service Updated Successfully!';</script>";
                //echo "<script>document.getElementById('form').reset(); </script>";
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