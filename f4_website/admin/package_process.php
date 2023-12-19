<?php
    session_start();
    include("../db.php");

    if(isset($_GET["add_package"])) {
        $package_name = $_GET['package_name'];
        $package_desc = $_GET['package_desc'];
        $package_location = $_GET['package_location']; 
        $package_type = $_GET['package_type'];    
        $pack_combo = $_GET['pack_combo'];    
        $package_price = $_GET['package_price'];    
       
        $sql_insert_package = "INSERT INTO package 
                                    (package_name, description, type_of_package, combopackage_id, location_id, package_cost)
                                VALUES ('$package_name','$package_desc','$package_type','$pack_combo','$package_location','$package_price')";

        mysqli_query($conn, $sql_insert_package);
    }
    elseif(isset($_GET['update_package'])){
        $package_name = $_GET['package_name'];
        $package_desc = $_GET['package_desc'];
        $package_location = $_GET['package_location']; 
        $package_type = $_GET['package_type'];    
        $pack_combo = $_GET['pack_combo'];    
        $package_price = $_GET['package_price'];
        $pack_id = $_GET['pack_id'];

        $sql_update_package = "UPDATE `package` 
                                    SET `package_name` = '$package_name', 
                                    `description` = '$package_desc', 
                                    `type_of_package` = '$package_type', 
                                    `combopackage_id` = '$pack_combo', 
                                    `location_id` = '$package_location', 
                                    `package_cost` = '$package_price'
                                
                                WHERE package_id = '$pack_id'";

        mysqli_query($conn, $sql_update_package);
    }
    elseif(isset($_GET['deactivate_package'])){
        $pack_id = $_GET["pack_id"];

        $sql_deactivate_package = "UPDATE `package` 
                                        SET `status` = 'I' 
                                    WHERE package_id = '$pack_id'";
        mysqli_query($conn, $sql_deactivate_package);
    }
    elseif(isset($_GET['activate_package'])){
        $pack_id = $_GET["pack_id"];

        $sql_activate_package = "UPDATE `package` 
                                        SET `status` = 'A' 
                                    WHERE package_id = '$pack_id'";
        mysqli_query($conn, $sql_activate_package);
    }
    else{
        header("location: ../logout.php?error=denied");
        die();
    }

    header("location: index.php");
    die();
?>