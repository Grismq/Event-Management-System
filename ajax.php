<?php
include('db.php');
$request = $_POST['request'];

if ($request == "add") {
    $serviceid[] = $_POST['serviceid'];
    $date = $_POST['date'];
    //die(print_r($serviceid));
    $search = "SELECT * FROM `calender` WHERE `Date`=:date";
    $stmt = $con->prepare($search);
    $stmt->bindParam(':date', $date);
    $stmt->execute();
    $allusers = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($stmt->rowCount() > 0) {
        foreach ($allusers as $row) {
            $flag = $row["Date"];
        }
        if ($flag != "0" || $flag != 0) {
            die("Booking Restricted");
        }
    }

    //$i = 0;
    $i = 0;
    $j = 0;
    foreach ($serviceid as $row) {
        //die(count($row));
        for ($s = 0; $s < count($row); $s++) {
            $stmt = $con->prepare("SELECT * FROM `service` WHERE `Service_ID`='$row[$s]'");
            $stmt->execute();
            $result = $stmt->fetchAll();

            foreach ($result as $row2) {
                $max = $row2["Maximum"];
                $serviceid = $row2["Service_ID"];

                $search = "SELECT COUNT(booked_services.Service_ID) as 'Bookings' FROM `booked_services`,booking 
                WHERE booked_services.Service_ID=:serviceid AND booking.Event_Date=:date AND booking.Booking_ID=booked_services.Booking_ID";
                $stmt = $con->prepare($search);
                $stmt->bindParam(':serviceid', $serviceid);
                $stmt->bindParam(':date', $date);
                $stmt->execute();
                $allusers = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if ($stmt->rowCount() > 0) {
                    foreach ($allusers as $row) {
                        $total = $row["Bookings"];
                    }
                    if($total>=$max)
                    {
                        $service = $row2["Service_Name"];
                        die("Maximum allowed order requests for $service on $date has exceeded!");
                    }
                }

                $amount[$i][$j] = $row2["Service_Name"];
                $amount[$i][$j + 1] = $row2["Amount"];
                $amount[$i][$j + 2] = $row2["Vendor_ID"];
            }
            $i++;
            $j = 0;
        }
    }

    echo json_encode($amount);
}
