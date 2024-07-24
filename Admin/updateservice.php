<?php
include('../db.php');
session_start();

if (isset($_SESSION["admin"]) && isset($_SESSION["name"])) {
    //Get details
} else {
    header("Location: Login/login.php");
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
                                <li>
                                    <a href="addservice.php">
                                        <span>Add Service</span>
                                    </a>
                                </li>
                                <li class="active">
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
                    Manage Services
                </h1>
            </div>
        </section>

        <section class="section main-section">
            <div class="row align-items-center">
            <span id="msg" style="color:green;"></span>
                <?php

                //$userid = $_SESSION["user"];
                $getBookings = "SELECT * FROM `service`,vendors WHERE service.Vendor_ID=vendors.Vendor_ID;";
                $stmt = $con->prepare("$getBookings");
                $stmt->execute();
                $services = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if ($stmt->rowCount() > 0) {
                ?>
                    <table class="table table-striped">
                        <tr>
                            <th>Service Name</th>
                            <th>Vendor Name</th>
                            <th>Amount</th>
                            <th>Max Orders/Day</th>
                            <th>Image</th>
                            <th class="text-center" colspan="2">Actions</th>
                        </tr>

                        <?php

                        //print_r($services);
                        foreach ($services as $row) {
                        ?>
                            <tr>
                                <td><?php echo $row["Service_Name"]; ?></td>
                                <td><?php echo $row["Company_Name"]; ?></td>
                                <td><?php echo $row["Amount"]; ?></td>
                                <td><?php echo $row["Maximum"]; ?></td>
                                <td><a href="../images/services/<?php echo $row['Image']; ?>" target="_blank">View</a></td>
                                <td style="color: green;">
                                    <a href="editservice.php?v=<?php echo $row["Vendor_ID"]; ?>&s=<?php echo $row["Service_ID"]; ?>">
                                        <button class="button small green --jb-modal" type="button">
                                            <span class="icon"><i class="mdi mdi-square-edit-outline"></i></span>
                                        </button>
                                    </a>
                                </td>
                                <td style="color: red;">
                                    <button class="button small red --jb-modal" data-target="sample-modal" data-service="<?php echo $row["Service_ID"]; ?>" data-name="<?php echo $row["Service_Name"]; ?>" type="button" onclick="del(this)">
                                        <span class="icon"><i class="mdi mdi-trash-can"></i></span>
                                    </button>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                <?php
                } else {
                ?>
                    <h3>No Services!</h3>
                <?php
                }
                ?>
            </div>
    </div>
    </section>

    </div>
    <div id="sample-modal" class="modal">
        <div class="modal-background --jb-modal-close"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Delete Service</p>
            </header>
            <section class="modal-card-body">
                <p>Do you want to Delete Service <b id="service">' '</b>?</p>
            </section>
            <footer class="modal-card-foot">
                <button class="button --jb-modal-close">Cancel</button>
                <button id="confirm" onclick="deleteService(this)" class="button red --jb-modal-close">Confirm</button>
            </footer>
        </div>
    </div>
    <script src="../js/jquery-3.2.1.min.js"></script>
    <script>
        function del(service) {
            var serviceid = service.getAttribute("data-service");
            var servicename = service.getAttribute("data-name");
            document.getElementById('service').innerHTML = servicename;

            var confirm = document.getElementById('confirm');
            confirm.setAttribute("data-service", serviceid);
        }
        function deleteService(service) {
            var serviceid = service.getAttribute("data-service");

            $.post("delete.php", {
                    request: "deleteservice",
                    serviceid: serviceid
                },
                function(data, status) {
                    if(data=="Deleted")
                    {
                        window.location.reload();
                        $(document).ready(function()
                        {
                            $('#msg').text("Deleted Successfully").delay(4000).fadeOut();
                        });
                    }
                    else
                    {
                        $('#msg').text("Something Went Wrong").delay(4000).fadeOut();
                    }  
                    //alert("Data: " + data + "\nStatus: " + status);
                });
        }

    </script>
    <script type="text/javascript" src="js/main.min.js?v=1628755089081"></script>


    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">

</body>

</html>