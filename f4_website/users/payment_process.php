<?php
session_start();
include("../db.php");

$user_id = $_SESSION["user_id"];
$pack_id = $_SESSION["package_id"];
$startDate = $_SESSION["startDate"];
$endDate = $_SESSION["endDate"];

$total_price = $_SESSION["total_cost"];
$payment = $_POST["payment"];

if($payment < $total_price){
    header("location: payment.php?error=insufficient_amount");
    die();
}

$alpha_num = array("A", 'B','C','D','E','F','G','H','I','J'
                    ,'K','L','M','N','O','P','Q','R','S','T'
                    ,'U','V','W','X','Y','Z','1','2','3','4'
                    ,'5','6','7','8','9','0');
$key = "";
for($i = 0; $i <= 8; $i++){
    if($i%2 == 0 && $i > 0){
        $key .= $alpha_num[rand(0,25)]; 
    }
    else {
        $key .= $alpha_num[rand(26,sizeof($alpha_num) - 1)];
    }
}

foreach ($_SESSION["selectedActivities"] as $day => $no_of_activities) {
    foreach ($no_of_activities as $act_pos => $act_id) {
        $startTime = $_SESSION["activityStartTime"][$day][$act_pos];
        $endTime = $_SESSION["activityEndTime"][$day][$act_pos];

        $sql_insert_schedule = "INSERT INTO customerschedule (user_id, ref_num, day, activity_id, start_of_activity, end_of_activity)
                        VALUES ('$user_id','$key','$day','$act_id','$startTime','$endTime')";

        mysqli_query($conn, $sql_insert_schedule);
        
    }
}
$sql_insert_package= "INSERT INTO bookingpackage (user_id, ref_num, package_id, check_in_date, check_out_date,total_amount)
                                                    VALUES ('$user_id','$key','$pack_id','$startDate','$endDate','$total_price')";

mysqli_query($conn, $sql_insert_package);
header("location: reset_session.php?success");
die();
?>