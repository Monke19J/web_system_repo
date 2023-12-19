<?php 
    session_start();
    include("../db.php");

    // print_r($_GET);
    // die();

    if(empty($_SESSION['user_id'])){
        header("location: ../logout.php?error=denied");
        die();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Others</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
</head>
<body>
    <header class="p-3 text-bg-dark">
            <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="https://getbootstrap.com/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
                        <use xlink:href="#bootstrap"></use>
                    </svg>
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="index.php" class="nav-link px-2 text-white">Manage Package</a></li>
                    <li><a href="update_activity.php " class="nav-link px-2 text-white">Manage Activities</a></li>
                    <li><a href="booking.php" class="nav-link px-2 text-white">Manage Bookings</a></li>
                    <li><a href="#p" class="nav-link px-2 text-secondary">Others</a></li>
                </ul>

                <div class="text-end">
                    <a href="../logout.php" class="btn btn-outline-light me-2">Log-out</a>
                <button type="button" class="btn btn-warning">Username</button>
                </div>
            </div>
            </div>
    </header>
    <div class="container-fluid">
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
        <?php
        if(isset($_GET["error"])){
            if($_GET["error"] == "loc_empty"){
                echo '<div class="alert alert-danger text-center">Location Name is Empty</div>';
            }
            elseif($_GET["error"] == "act_type_empty"){
                echo '<div class="alert alert-danger text-center">Activity Type Name is Empty</div>';
            }
            elseif($_GET["error"] == "combo_pack_empty"){
                echo '<div class="alert alert-danger text-center">Combo Package Name is Empty</div>';
            }
        }
        if(isset($_GET["edit"])){
            if(isset($_GET["loc_name"])){
            $loc_name = $_GET["loc_name"];
            $loc_id = $_GET["loc_id"];
        ?>
            <h3 class = "m-2">Edit Location Name:</h5>
            <form action="others_process.php" method="get">
                <div class="form-outline mb-4 m-auto">
                    <input type="text" id="location_name" class="form-control" name="location_name" value="<?php echo htmlspecialchars($loc_name); ?>">
                </div>
                <input type="hidden" class="btn btn-primary mb-3" name="loc_id" value="<?php echo $loc_id; ?>">
                <input type="submit" class="btn btn-primary mb-3" name="update_loc">
            </form>
        <?php } elseif (isset($_GET["acttype_name"])){ 
            $acttype_name = $_GET["acttype_name"];
            $acttype_id = $_GET["acttype_id"];
        ?>
            <h5 class="m-2">Edit Activity Type Name:</h5>
            <form action="others_process.php" method="get">
                <div class="form-outline mb-4 m-auto">
                    <input type="text" id="location_name" class="form-control" name="acttype_name" value="<?php echo htmlspecialchars($acttype_name); ?>">
                </div>
                <input type="hidden" class="btn btn-primary mb-3" name="acttype_id" value="<?php echo $acttype_id; ?>">
                <input type="submit" class="btn btn-primary mb-3" name="update_acttype">
            </form>
        <?php } elseif (isset($_GET["combopack_name"])){ 
            $combopack_name = $_GET["combopack_name"];
            $combopack_id = $_GET["combopack_id"];
        ?>
            <h5 class="m-2">Edit Combo Package Name:</h5>
            <form action="others_process.php" method="get">
                <div class="form-outline mb-4 m-auto">
                    <input type="text" id="location_name" class="form-control" name="combopack_name" value="<?php echo htmlspecialchars($combopack_name); ?>">
                </div>
                <input type="hidden" class="btn btn-primary mb-3" name="combopack_id" value="<?php echo $combopack_id; ?>">
                <input type="submit" class="btn btn-primary mb-3" name="update_combopack">
            </form>
        
        <?php }
            echo "<a href='manage_others.php' class='btn btn-primary ms-auto'>cancel</a>";
        }
        ?>
        </div>
        <div class="col-3"></div>
    </div>
    
        <div class="row">
            <div class="col-4 border-end">
                <div class="row">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loc_modal">
                        Add Location
                    </button>
                </div>          
                <div class="modal fade" id="loc_modal" tabindex="-1" aria-labelledby="loc_modal" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="loc_modal">Location Name:</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="others_process.php" method="get">
                                    <div class="form-outline mb-4 m-auto">
                                        <input type="text" id="location_name" class="form-control" name="location_name">
                                    </div>
                                    <input type="submit" class="btn btn-primary" name="add_location">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4 border-end">
                <div class="row">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#act_type_modal">
                        Add Activity Type
                    </button>
                </div>          
                <div class="modal fade" id="act_type_modal" tabindex="-1" aria-labelledby="act_type_modal" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="act_type_modal">Type of Activity Name:</h5>
                                <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="others_process.php" method="get">
                                    <div class="form-outline mb-4 m-auto">
                                        <input type="text"  id="act_type_name" class="form-control" name="act_type_name">
                                    </div>
                                    <input type="submit" class="btn btn-primary" name="add_activity_type">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="row">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#combo_pack_modal">
                        Add Combo Package
                    </button>
                </div>
                <div class="modal fade" id="combo_pack_modal" tabindex="-1" aria-labelledby="combo_pack_modal" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="combo_pack_modal">Combo Pack name:</h5>
                                <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="others_process.php" method="get">
                                    <div class="form-outline mb-4 m-auto">
                                        <input type="text"  id="combo_package_name" class="form-control" name="combo_package_name">
                                    </div>
                                    <input type="submit" class="btn btn-primary" name="add_combo_package">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-4 border-end">
                <?php
                    $get_location = "SELECT * FROM location";
                    $location_result = mysqli_query($conn, $get_location);

                    if (mysqli_num_rows($location_result) > 0){
                        echo '<h3 class="fs-2 text-success text-center">Location:</h3>';
                        echo '<table class="table table-bordered table-striped" border-info>';
                        echo '<thead><tr><th>Location id</th><th>Location Name</th><th>Status</th><th></th></tr></thead>';

                        while($row = mysqli_fetch_assoc($location_result)){
                            $loc_id = $row["location_id"];
                            $loc_name = $row["location_name"];
                            $status = $row['status'];

                            echo '<tbody>';
                            echo "<tr><td>$loc_id</td><td>$loc_name</td><td>$status</td><td>";
                            echo "<a href='others_process.php?location_name=$loc_name&&add_location=Submit&&loc_id=$loc_id&&edit' class='btn btn-primary'><i class='bi bi-pencil-square'></i></a>";
                            if ($status == 'A') {
                                echo "<a href='others_process.php?deactivate&&loc_id=$loc_id' class='btn btn-primary'><i class='bi bi-toggle-on'></i></a>";
                            } 
                            elseif ($status == 'I') {
                                echo "<a href='others_process.php?activate&&loc_id=$loc_id' class='btn btn-primary'><i class='bi bi-toggle-off'></i></a>";
                            } 
                            else {
                                echo "<a href='others_process.php?activate&&loc_id=$loc_id' class='btn btn-primary'><i class='bi bi-toggle-off'></i></a>";
                            }
                            echo "</td></tr>";
                            echo '</tbody>';
                        }
                        echo '</table>';
                    }
                    else{
                        echo "<tr><td colspan='4'>The location table is empty</td></tr>";
                        
                        
                    }                   
                ?>
            </div>
            <div class="col-4 border-end">
                <?php
                    $get_acttype = "SELECT * FROM activitytype";
                    $acttype_result = mysqli_query($conn, $get_acttype);

                    if (mysqli_num_rows($acttype_result) > 0){
                        echo '<h3 class="fs-2 text-success text-center">Activity Type:</h3>';
                        echo '<table class="table table-bordered table-striped" border="info">';
                        echo '<thead><tr><th>Act Type id</th><th>Act Type Name</th><th>Status</th><th></th></tr></thead>';                       
                        while($row = mysqli_fetch_assoc($acttype_result)){
                            $act_type_id = $row["act_type_id"];
                            $act_type_name = $row["act_type_name"];
                            $status = $row["act_type_status"];
                        
                            echo '<tbody>';
                            echo "<tr><td>$act_type_id</td><td>$act_type_name</td><td>$status</td><td>";
                                echo "<a href='others_process.php?act_type_name=$act_type_name&&acttype_id=$act_type_id&&add_activity_type=Submit&&edit' class='btn btn-primary'><i class='bi bi-pencil-square'></i></a>";
                            if ($status == 'A') {
                                echo "<a href='others_process.php?deactivate&acttype_id=$act_type_id' class='btn btn-primary'><i class='bi bi-toggle-on'></i></a>";
                            } 
                            elseif ($status == 'I') {
                                echo "<a href='others_process.php?activate&acttype_id=$act_type_id' class='btn btn-primary'><i class='bi bi-toggle-off'></i></a>";
                            } 
                            else {
                                echo "<a href='others_process.php?activate&acttype_id=$act_type_id' class='btn btn-primary'><i class='bi bi-toggle-off'></i></a>";
                            }
                            echo "</td></tr>";
                            echo '</tbody>';
                        }
                        echo '</table>';
                    }
                    else{
                        echo "<tr><td colspan='4'>The activity type table is empty</td></tr>";
                        
                        
                    }                   
                ?>
            </div>
            <div class="col-4">
            <?php
                    $get_combopackage = "SELECT * FROM combopackage";
                    $combopackage_result = mysqli_query($conn, $get_combopackage);

                    if (mysqli_num_rows($combopackage_result) > 0){
                        echo '<h3 class="fs-2 text-success text-center">Combo Package:</h3>';
                        echo '<table class="table table-bordered table-striped" border-info>';
                        echo '<thead><tr><th>Combo Pack id</th><th>Combo Pack Name</th><th>Status</th><th></th></tr></thead>';

                        while($row = mysqli_fetch_assoc($combopackage_result)){
                            $combopackage_id = $row["combopackage_id"];
                            $combopackage_name = $row["combopackage_name"];
                            $status = $row["status"];

                            echo '<tbody>';
                            echo "<tr><td>$combopackage_id</td><td>$combopackage_name</td><td>$status</td><td>";
                            echo "<a href='others_process.php?combo_package_name=$combopackage_name&&add_combo_package=Submit&&combopack_id=$combopackage_id&&edit' class='btn btn-primary'><i class='bi bi-pencil-square'></i></a>";
                            if ($status == 'A') {
                                echo "<a href='others_process.php?deactivate&combopack_id=$combopackage_id' class='btn btn-primary'><i class='bi bi-toggle-on'></i></a>";
                            } 
                            elseif ($status == 'I') {
                                echo "<a href='others_process.php?activate&combopack_id=$combopackage_id' class='btn btn-primary'><i class='bi bi-toggle-off'></i></i></a>";
                            } 
                            else {
                                echo "<a href='others_process.php?activate&combopack_id=$combopackage_id' class='btn btn-primary'><i class='bi bi-toggle-off'></i></i></a>";
                            }
                            echo "</td></tr>";
                            echo '</tbody>';
                        }
                        echo '</table>';
                    }
                    else{
                        echo "<tr><td colspan='4'>The activity type table is empty</td></tr>";
                        
                        
                    }                   
                ?>
            </div>
        </div>
    </div>
</body>
<script src="../js/bootstrap.js"></script>
</html>