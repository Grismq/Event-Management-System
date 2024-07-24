<?php
session_start();
require_once '../razorpay/Razorpay.php';

use Razorpay\Api\Api;

include('../db.php');


try {
    date_default_timezone_set("Asia/Kolkata");
    $data = trim(file_get_contents("php://input"));
    $data = json_decode($data, true);



    $request = $data['request'];
    $now = date("d-m-Y H:i:s");


    if ($request == "payment") {

        $user_id = $_SESSION["user"];
        //die($user_id);
        $query = "SELECT * FROM `user_login` WHERE `User_ID`=:userid";
        $stmt = $con->prepare($query);
        $stmt->bindParam(':userid', $user_id);
        $stmt->execute();
        $userinfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //print_r($data);
        
        if ($stmt->rowCount() > 0) {
            foreach ($userinfo as $row) {
                $name = $row["Name"];
                $email = $row["Email"];
                $contact = $row["Contact_No"];
            }
        } else {
          die("Session Expired");
        }

        $eventname = $data['name'];
        $location = $data['location'];
        $date = $data['date'];
        $stime = $data['stime'];
        $etime = $data['etime'];
        $people = $data['people'];

        $services[] = $data['services'];
        $total = 0;
        foreach ($services as $row) {
            //die(count($row));
            for ($s = 0; $s < count($row); $s++) {
                $stmt = $con->prepare("SELECT * FROM `service` WHERE `Service_ID`='$row[$s]'");
                $stmt->execute();
                $result = $stmt->fetchAll();
    
                foreach ($result as $row2) {
                    $total += $row2["Amount"];
                }
            }
        }

        $amount = $total * 100;

        $api = new Api($key_id, $secret);
        $details = $api->order->create(array('amount' => $amount, 'currency' => 'INR'));
        $payment = [
            'order_id' => $details['id'],
            'amount' => $details['amount'],
            'status' => $details['status'],
            'name' => $name,
            'email' => $email,
            'contact' => $contact,
        ];
        $order_id = $details['id'];
        $amount = $details['amount'];
        $query = "SELECT `Booking_ID` FROM `booking`";
        $stmt = $con->prepare($query);
        $stmt->execute();
        $allbookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($stmt->rowCount() > 0) {
        foreach ($allbookings as $row) {
            $booking = $row["Booking_ID"];
        }

        $num = substr($booking, 1);
        //die($num);
        $bookingid1 = $num + 1;
        $bookingid = "B".$bookingid1;
        //die($bookingid);
        } else {
        $bookingid = "B101";
        }
 
        
        $ins = "INSERT INTO `booking`(`User_ID`, `Booking_ID`, `Event_Name`, `Event_Location`, `Event_Date`, `Event_Start_Time`, `Event_End_Time`, `No_Of_People`) 
        VALUES (:userid,:bookingid,:eventname,:location,:date,:stime,:etime,:people)";
        $stmt2 = $con->prepare($ins);
        $stmt2->bindParam(':bookingid', $bookingid);
        $stmt2->bindParam(':userid', $user_id);
        $stmt2->bindParam(':eventname', $eventname);
        $stmt2->bindParam(':location', $location);
        $stmt2->bindParam(':date', $date);
        $stmt2->bindParam(':stime', $stime);
        $stmt2->bindParam(':etime', $etime);
        $stmt2->bindParam(':people', $people);


        $result = $stmt2->execute();
        if (!$result) {
            die(json_encode(['status' => 'success', 'message' => "Something went wrong ! . Please try again later"]));
        }

        
        foreach ($services as $row) {
            for ($s = 0; $s < count($row); $s++) {
                $stmt = $con->prepare("SELECT * FROM `service` WHERE `Service_ID`='$row[$s]'");
                $stmt->execute();
                $result = $stmt->fetchAll();
    
                foreach ($result as $row2) {
                    $serviceid = $row2["Service_ID"];
                    $vendorid = $row2["Vendor_ID"];
                }
                $ins2 = "INSERT INTO `booked_services`(`Booking_ID`, `Vendor_ID`, `Service_ID`) 
                VALUES (:bookingid,:vendorid,:serviceid)";
                $stmt = $con->prepare($ins2);
                $stmt->bindParam(':bookingid', $bookingid);
                $stmt->bindParam(':vendorid', $vendorid);
                $stmt->bindParam(':serviceid', $serviceid);
                $stmt->execute();
            }
        }
        $status = "CREATED";
        $ins = "INSERT INTO `payment`(`User_ID`, `Booking_ID`, `Order_ID`, `Amount`, `Status`, `Created_At`, `Updated_At`) 
        VALUES (:userid,:bookingid,:orderid,:amount,:status,:now1,:now2)";
        $orderamount = $amount/100;
        $stmt2 = $con->prepare($ins);
        $stmt2->bindParam(':bookingid', $bookingid);
        $stmt2->bindParam(':userid', $user_id);
        $stmt2->bindParam(':orderid', $order_id);
        $stmt2->bindParam(':amount', $orderamount);
        $stmt2->bindParam(':status', $status);
        $stmt2->bindParam(':now1', $now);
        $stmt2->bindParam(':now2', $now);
        $stmt2->execute();

        die(json_encode(['status' => 'success', 'message' => $payment]));
    } else if ($request == "payment_complete") {
        $api = new Api($key_id, $secret);

        $payment_id = $data["payment_id"];
        $order_id = $data["order_id"];
        $signature = $data["signature"];

        $attributes  = array('razorpay_signature'  => $signature,  'razorpay_payment_id'  => $payment_id,  'razorpay_order_id' => $order_id);
        $order  = $api->utility->verifyPaymentSignature($attributes);

        $status = "COMPLETED";
        $err_code = NULL;

        $updateQuery = "UPDATE `payment` SET `Status`=:status,`Updated_At`=:now1,`Razorpay_Signature`=:signature,`Razorpay_Payment_ID`=:payment_id,`Error_Code`=:error_code WHERE `Order_ID`=:order_id";
        $stmt = $con->prepare($updateQuery);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':now1', $now);
        $stmt->bindParam(':signature', $signature);
        $stmt->bindParam(':payment_id', $payment_id);
        $stmt->bindParam(':error_code', $err_code);
        $stmt->bindParam(':order_id', $order_id);
        $stmt->execute();

        die(json_encode(['status' => 'success', 'message' => 'verified']));
    } else if ($request == "payment_failed") {

        //If payment failed 
        $errorCode = $data['error'];
        $order_id = $data['order_id'];
        $payment_id = $data['payment_id'];

        $status = "FAILED";

        $updateQuery = "UPDATE `payment` SET `Status`=:status,`Updated_At`=:now1,`Razorpay_Payment_ID`=:payment_id,`Error_Code`=:error_code WHERE `Order_ID`=:order_id";
        $stmt = $con->prepare($updateQuery);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':now1', $now);
        $stmt->bindParam(':payment_id', $payment_id);
        $stmt->bindParam(':error_code', $errorCode);
        $stmt->bindParam(':order_id', $order_id);
        $stmt->execute();

        die(json_encode(['status' => 'success', 'message' => 'Payment Failed', 'errorCode' => $errorCode]));
    } else {
        header('Location:/Platform/');
    }
} catch (Exception $th) {
    die(json_encode(['status' => 'failed', 'message' => $th->getMessage()]));
}

