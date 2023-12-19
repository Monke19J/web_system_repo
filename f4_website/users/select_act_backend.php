<?php
    session_start();

    if(isset($_GET["back"])){
        unset($_SESSION["payment"]);
        unset($_SESSION["selectedActivities"]);
        unset($_SESSION["activityStartTime"]);
        unset($_SESSION["activityEndTime"]);
        header("location: select_activity.php");
        die();
    }
    if(empty($_POST["selectedActivities"])){
        header("location: select_activity.php?error=emptyselected");
        die();
    }
    if(empty($_POST["payment"])){
        header("location: index.php?error=illegal_access");
        die();
    }

    $selectedActivities = $_POST["selectedActivities"];

    $uniqueDays = count(array_keys($selectedActivities));
    
    if ($uniqueDays != ($_SESSION["numberOfDays"])+ 1){
        header("location: select_activity.php?error=lack_of_activities_selected");
        die();
    }

    foreach ($selectedActivities as $day => $activities) {
        if (empty($activities)) {
            header("location: select_activity.php?error=missing_activities&day=$day");
            die();
        }
    }

    $_SESSION["payment"] = $_POST["payment"];
    $_SESSION["selectedActivities"] = $_POST["selectedActivities"];
    $_SESSION["activityStartTime"] = $_POST["activityStartTime"];
    $_SESSION["activityEndTime"] = $_POST["activityEndTime"];

    header("location: payment.php");
?>