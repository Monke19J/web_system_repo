<!-- the isset get edit portion can be simplified -->
<!-- so many else if :( -->
<!-- the code are so messy -->
<?php
    session_start();
    include("../db.php");
    // print_r($_GET);
    // die();

    if(isset($_GET["add_location"])) {
        if(empty($_GET['location_name'])){
            header("location: manage_others.php?error=loc_empty");
            die();
        }
        if(isset($_GET['edit'])){
            $loc_name = $_GET['location_name'];
            $loc_id = $_GET["loc_id"];
            header("location: manage_others.php?loc_name=$loc_name&&loc_id=$loc_id&&edit");
            die();
        }

        $location_name= $_GET['location_name'];
       
        $sql_insert_location = "INSERT INTO location 
                                    (location_name)
                                VALUES ('$location_name')";

        mysqli_query($conn, $sql_insert_location);
    }

    elseif(isset($_GET["add_activity_type"])) {
        if(empty($_GET['act_type_name'])){
            header("location: manage_others.php?error=act_type_empty");
            die();
        }
        if(isset($_GET['edit'])){
            $acttype_name = $_GET['act_type_name'];
            $acttype_id = $_GET["acttype_id"];
            header("location: manage_others.php?acttype_name=$acttype_name&&acttype_id=$acttype_id&&edit");
            die();
        }
        $act_type_name = $_GET['act_type_name'];
       
        $sql_insert_acttype = "INSERT INTO activitytype 
                                    (act_type_name)
                                VALUES ('$act_type_name')";

        mysqli_query($conn, $sql_insert_acttype);
    }
    elseif(isset($_GET["add_combo_package"])) {
        if(empty($_GET['combo_package_name'])){
            header("location: manage_others.php?error=combo_pack_empty");
            die();
        }
        if(isset($_GET['edit'])){
            $combopack_name = $_GET['combo_package_name'];
            $combopack_id = $_GET["combopack_id"];
            header("location: manage_others.php?combopack_name=$combopack_name&&combopack_id=$combopack_id&&edit");
            die();
        }
        $combo_pack_name = $_GET['combo_package_name'];
       
        $sql_insert_combopack = "INSERT INTO combopackage
                                    (combopackage_name)
                                VALUES ('$combo_pack_name')";

        mysqli_query($conn, $sql_insert_combopack);
    }
    
    elseif(isset($_GET['update_loc'])){
        if(empty($_GET['location_name'])){
            header("location: manage_others.php?error=loc_empty");
            die();
        }
        $loc_name = $_GET['location_name'];
        $loc_id = $_GET["loc_id"];

        $sql_update_loc = "UPDATE `location` 
                                    SET `location_name` = '$loc_name'
                                
                                WHERE location_id = '$loc_id'";

        mysqli_query($conn, $sql_update_loc);
        
    }
    elseif(isset($_GET['update_acttype'])){
        if(empty($_GET['acttype_name'])){
            header("location: manage_others.php?error=act_type_empty");
            die();
        }
        $acttype_name = $_GET["acttype_name"];
        $acttype_id = $_GET["acttype_id"];

        $sql_update_acttype = "UPDATE `activitytype` 
                                    SET `act_type_name` = '$acttype_name' 
                                
                                WHERE act_type_id = '$acttype_id'";

        mysqli_query($conn, $sql_update_acttype);
        
    }
    elseif(isset($_GET['update_combopack'])){
        if(empty($_GET['combopack_name'])){
            header("location: manage_others.php?error=combo_pack_empty");
            die();
        }
        $combopack_name = $_GET["combopack_name"];
        $combopack_id = $_GET["combopack_id"];

        $sql_update_combopack = "UPDATE `combopackage` 
                                    SET `combopackage_name` = '$combopack_name' 
                                
                                WHERE combopackage_id = '$combopack_id'";

        mysqli_query($conn, $sql_update_combopack);
        
    }

    elseif(isset($_GET["deactivate"])){
        if(isset($_GET["loc_id"])){
            $loc_id = $_GET["loc_id"];

            $sql_deactivate_loc = "UPDATE `location` 
                                    SET `status` = 'I'
                                
                                WHERE location_id = '$loc_id'";

            mysqli_query($conn, $sql_deactivate_loc);
        }
        elseif($_GET["acttype_id"]){
            $acttype_id = $_GET["acttype_id"];

            $sql_deactivate_acttype = "UPDATE `activitytype` 
                                    SET `act_type_status` = 'I' 
                                
                                WHERE act_type_id = '$acttype_id'";

            mysqli_query($conn, $sql_deactivate_acttype);
        }
        elseif($_GET["combopack_id"]){
            $combopack_id = $_GET["combopack_id"];

            $sql_deactivate_combopack = "UPDATE `combopackage` 
                                        SET `status` = 'I' 
                                    WHERE combopackage_id = '$combopack_id'";

            mysqli_query($conn, $sql_deactivate_combopack);
        }
    }
    elseif(isset($_GET["activate"])){
        if(isset($_GET["loc_id"])){
            $loc_id = $_GET["loc_id"];

            $sql_activate_loc = "UPDATE `location` 
                                    SET `status` = 'A'
                                
                                WHERE location_id = '$loc_id'";

            mysqli_query($conn, $sql_activate_loc);
        }
        elseif($_GET["acttype_id"]){
            $acttype_id = $_GET["acttype_id"];

            $sql_activate_acttype = "UPDATE `activitytype` 
                                    SET `act_type_status` = 'A' 
                                
                                WHERE act_type_id = '$acttype_id'";

            mysqli_query($conn, $sql_activate_acttype);
        }
        elseif($_GET["combopack_id"]){
            $combopack_id = $_GET["combopack_id"];

            $sql_activate_combopack = "UPDATE `combopackage` 
                                        SET `status` = 'A' 
                                    WHERE combopackage_id = '$combopack_id'";

            mysqli_query($conn, $sql_activate_combopack);
        }
    }

    else{
        header("location: ../logout.php?error=denied");
        die();
    }

    header("location: manage_others.php");
    die();
?>