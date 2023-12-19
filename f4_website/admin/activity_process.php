<?php
    session_start();
    include("../db.php");

    if(isset($_GET["add_act"])) {
        $act_name = $_GET['act_name'];
        $act_desc = $_GET['act_desc'];
        $act_location = $_GET['act_location']; 
        $act_type = $_GET['act_type'];    
        $act_combo = $_GET['act_combo'];    
        $act_price = $_GET['act_price'];    
       
        $sql_insert_activity = "INSERT INTO activities 
                                    (activity_name, description, act_type_id, combopackage_id, location_id, price);
                                VALUES ('$act_name','$act_desc','$act_type','$act_combo','$act_location','$act_price')";

        mysqli_query($conn, $sql_insert_activity);
    }
    elseif(isset($_GET['update_act'])){
        $act_name = $_GET['act_name'];
        $act_desc = $_GET['act_desc'];
        $act_location = $_GET['act_location']; 
        $act_type = $_GET['act_type'];    
        $act_combo = $_GET['act_combo'];    
        $act_price = $_GET['act_price'];
        $act_id = $_GET['act_id'];

        $sql_update_activity = "UPDATE `activities` 
                                    SET `activity_name` = '$act_name', 
                                    `description` = '$act_desc', 
                                    `act_type_id` = '$act_type', 
                                    `combopackage_id` = '$act_combo', 
                                    `location_id` = '$act_location', 
                                    `price` = '$act_price'
                                
                                WHERE activity_id = '$act_id'";

        mysqli_query($conn, $sql_update_activity);
    }
    elseif(isset($_GET['deactivate_act'])){
        $act_id = $_GET["act_id"];

        $sql_deactivate_activity = "UPDATE `activities` 
                                        SET `status` = 'I' 
                                    WHERE activity_id = '$act_id'";
        mysqli_query($conn, $sql_deactivate_activity);
    }
    elseif(isset($_GET['activate_act'])){
        $act_id = $_GET["act_id"];

        $sql_activate_activity = "UPDATE `activities` 
                                        SET `status` = 'A' 
                                    WHERE activity_id = '$act_id'";
        mysqli_query($conn,$sql_activate_activity);
    }
    else{
        header("location: ../logout.php?error=denied");
        die();
    }

    header("location: update_activity.php");
    die();
?>