<?php
    session_start();
    include("../db.php");

    if(empty($_SESSION["packageview"]) || empty($_SESSION["select_activity"])){
        header("location: index.php?error=illegal_access");
    }

    $id_value = $_SESSION["package_id"];

    $package_name =  $_SESSION["package_name"];
    $description = $_SESSION["description"];
    $package_type = $_SESSION["package_type"];
    $pack_combopackage = $_SESSION["pack_combopackage"];
    $price = $_SESSION["price"];

    $startDate = $_SESSION["startDate"];
    $endDate = $_SESSION["endDate"];

    $startDateTime = new DateTime($startDate);
    $endDateTime = new DateTime($endDate);

    $interval = $startDateTime->diff($endDateTime);

    $numberOfDays = $interval->days;
    $_SESSION["numberOfDays"] = $numberOfDays;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select your Activities</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <style>
        .card-img-top {
            height: 200px; /* Adjust the height as needed */
            object-fit: cover; /* This property ensures the image maintains its aspect ratio */
        }
    </style>
    <style>
        .card-text {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
            if(isset($_GET["error"])){ ?>
                <div class="row">
                    <div class="col-4"></div>
                    <div class="col-4">
                    <?php if ($_GET["error"] == "emptyselected") { 
                        echo"<div class='alert alert-danger'>No Activity Selected</div>";
                    } elseif ($_GET["error"] == "lack_of_activities_selected") {
                        echo"<div class='alert alert-danger'>Some activities on some of the days are not selected</div>";
                    }?>
                    </div>
                    <div class="col-4"></div>
                </div>
            <?php }
        ?>
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">   
            <a href="packageview_backend.php?back" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                <span class="text-danger ms-1">back</span>
            </a>
            
            <ul class="nav nav-pills">
                <li class="nav-item"><a href="reset_session.php" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="showhistory.php" class="nav-link">History</a></li>
                <li class="nav-item"><a href="../logout.php" class="nav-link">Log-out</a></li>
            </ul>
        </header>
        <div class="row-12 mb-5">
            <h1 class="text-success text-center fs-3">
                <?php echo $package_name;?>
            </h1>
        </div>
        <form action="select_act_backend.php" method="post">
            <div class="btn-group" role="group" aria-label="Button group">
                <?php        
                    for($i = 1; $i <= $numberOfDays + 1; $i++){ ?>
                        <button class="btn btn-outline-primary" data-bs-toggle="collapse" data-bs-target="#day<?php echo $i; ?>" type="button" aria-expanded="false" aria-controls="day<?php echo $i; ?>">
                            <h3 class="fs-4"><?php echo "Day ".$i;?></h3> 
                        </button> <?php
                } ?>
            </div>
            <?php
                for($i = 1; $i <= $numberOfDays + 1; $i++){ ?>
                    <div>
                        <div class="collapse" id="day<?php echo $i; ?>">
                            <h3 class="fs-2 text-center"><?php echo "Day ".$i;?></h3>                             
                            <?php 
                            $count = 0;
                            if($package_type == "tour"){
                                $get_activities = "SELECT * FROM activities WHERE act_type_id = 1 AND `status` = 'A'";
                            
                            }
                            elseif($package_type == "package"){
                                $get_activities = "SELECT * FROM activities WHERE combopackage_id = $pack_combopackage AND `status` = 'A'";
                            }
                            elseif($package_type == "adventure"){
                                $get_activities = "SELECT * FROM activities WHERE act_type_id != 1 AND act_type_id != 3 AND `status` = 'A'";
                            }

                            $activity_result = mysqli_query($conn, $get_activities); 
                            if (mysqli_num_rows($activity_result) > 0) {
                                while($row = mysqli_fetch_assoc($activity_result)){
                                    $act_id = $row["activity_id"];
                                    $act_name = $row["activity_name"];
                                    $act_combopackage = $row["combopackage_id"];
                                    $act_type = $row["act_type_id"];
                                    $act_image = $row["activity_image"];
                                    $act_desc = $row["description"];
                                    $act_price = $row["price"];

                                    if($count % 3 == 0){
                                        echo "<div class='row mt-3'>";
                                    }
                            ?>                    
                                    <div class="col-md-4">
                                        <div class="card border-warning" style="width: 18rem;">
                                            <img src="<?php echo $act_image; ?>" class="card-img-top" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo $act_name; ?></h5>
                                                <p class="card-text text-truncate"><?php echo $act_desc; ?></p>
                                                <div class="row">
                                                    <a href="#" class="btn btn-primary">More Info</a>                   
                                                </div>
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <span class="fw-bold"><?php echo"Php ".$act_price; ?></span>
                                                            <div class="form-check">
                                                                <input type="checkbox" name="selectedActivities[<?php echo $i; ?>][<?php echo $count; ?>]" value="<?php echo $act_id; ?>" class="form-check-input" data-bs-toggle="collapse" data-bs-target="#activityDetails<?php echo $i; ?>_<?php echo $count; ?>">
                                                                <label class="form-check-label">Select</label>
                                                            </div>      
                                                        </div>
                                                    </li>
                                                    <div class="collapse <?php echo isset($_POST['selectedActivities'][$i][$count]) ? 'show' : ''; ?>" id="activityDetails<?php echo $i; ?>_<?php echo $count; ?>">
                                                        <tr>
                                                            <td>
                                                                <label for="startTime<?php echo $i; ?>_<?php echo $count; ?>" class="form-label">Start Time</label>
                                                                <input type="time" name="activityStartTime[<?php echo $i; ?>][<?php echo $count ; ?>]" class="form-control" id="startTime<?php echo $i; ?>_<?php echo $count; ?>" value="12:00">
                                                            </td>
                                                            <td>
                                                                <label for="endTime<?php echo $i; ?>_<?php echo $count; ?>" class="form-label">End Time</label>
                                                                <input type="time" name="activityEndTime[<?php echo $i; ?>][<?php echo $count; ?>]" class="form-control" id="endTime<?php echo $i; ?>_<?php echo $count; ?>" value="18:00">
                                                            </td>
                                                        </tr>
                                                        

                                                        
                                                     </div>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>              
                            <?php 
                                    $count++;
                                
                                    if($count % 3 == 0 && $count == mysqli_num_rows($activity_result)){
                                        echo "</div><hr>";
                                    }
                                    elseif($count % 3 == 0) {
                                        echo "</div>";
                                    }
                                } //while loop
                            } //if statement
                            else{
                                echo "No Activities Found";
                            } ?>
                        </div> 
                    </div><?php
                }//for loop
            ?>
            <hr>
            <button class="btn btn-success ms-1 mt-3" type="submit" name="payment" value="access">Continue Booking</button>
        </form>
        
    </div>


</body>
<script src="../js/bootstrap.js"></script>
</html>