<?php
    session_start();
    
    if(isset($_GET["back"])){
        unset($_SESSION["select_activity"]);
        unset($_SESSION["startDate"]);
        unset($_SESSION["endDate"]);
        header("location: packageview.php");
        die();
    }
    if(empty($_POST["select_activity"])){
        header("location: index.php?error=illegal_access");
        die();
    }

    $_SESSION["select_activity"] = $_POST["select_activity"];
    $_SESSION["startDate"] = $_POST["startDate"];
    $_SESSION["endDate"] = $_POST["endDate"];

    header("location: select_activity.php");
?>