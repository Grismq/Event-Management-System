<?php
include('../db.php');
$request = $_POST['request'];

if ($request == "delete") {
    $vendorid = $_POST['vendorid'];

    $stmt = $con->prepare("DELETE FROM `vendors` WHERE `Vendor_ID`='$vendorid'");
    $result = $stmt->execute();

    $stmt2 = $con->prepare("DELETE FROM `service` WHERE `Vendor_ID`='$vendorid'");
    $result2 = $stmt2->execute();
    if($result && $result2)
        echo "Deleted";
    else
        echo "Error";
}
else if ($request == "deleteservice") {
    $serviceid = $_POST['serviceid'];

    $stmt = $con->prepare("DELETE FROM `service` WHERE `Service_ID`='$serviceid'");
    $result = $stmt->execute();

    if($result)
        echo "Deleted";
    else
        echo "Error";
}
else
{
    header("Location: Login/login.php");
}

