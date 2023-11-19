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
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">   
            <a href="index.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                <span class="text-danger ms-1">back</span>
            </a>
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a href="#" class="nav-link active" aria-current="page">Home</a>
                </li>
                <li class="nav-item"><a href="#" class="nav-link">Features</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Pricing</a></li>
                <li class="nav-item"><a href="#" class="nav-link">FAQs</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Log-out</a></li>
            </ul>
        </header>
        <?php
            include("../db.php");
            $id_value = $_POST["id_value"];
            $get_package = "SELECT * FROM package WHERE package_id = '$id_value'";
            $package_result = mysqli_query($conn, $get_package);

            if (mysqli_num_rows($package_result) == 0) {
                header("location: index.php");
            } 

            $row = mysqli_fetch_assoc($package_result); 
            $package_name =  $row["package_name"];
            $description = $row["description"];
            $package_type = $row["type_of_package"];
            $pack_combopackage = $row["combopackage_id"];
            $price = $row["package_cost"];

            $startDate = $_POST["startDate"];
            $endDate = $_POST["endDate"];

            $startDateTime = new DateTime($startDate);
            $endDateTime = new DateTime($endDate);

            $interval = $startDateTime->diff($endDateTime);

            $numberOfDays = $interval->days;
        
            for($i = 1; $i <= $numberOfDays + 1; $i++){ ?>
                <h3 class="fs-4 text-primary-emphasis"><?php echo "Day ".$i?></h3> <?php

                $count = 0;
                if($package_type == "tour"){
                    $get_activities = "SELECT * FROM activities WHERE act_type_id = 1";
                
                }
                elseif($package_type == "package"){
                    $get_activities = "SELECT * FROM activities WHERE combopackage_id = $pack_combopackage";
                }
                elseif($package_type == "adventure"){
                    $get_activities = "SELECT * FROM activities WHERE act_type_id != 1 AND act_type_id != 3";
                }

                $activity_result = mysqli_query($conn, $get_activities); 
                if (mysqli_num_rows($activity_result) > 0) {
                    while($row = mysqli_fetch_assoc($activity_result)){
                        $act_name = $row["activity_name"];
                        $act_combopackage = $row["combopackage_id"];
                        $act_type = $row["act_type_id"];
                        $act_image = $row["activity_image"];
                        $act_desc = $row["description"];
                        $act_price = $row["price"];

                        if($count % 3 == 0){
                            echo "<div class='row'>";
                        }
        ?>                    
                        <div class="col-md-4">
                            <div class="card border-warning" style="width: 18rem;">
                                <img src="<?php echo $act_image; ?>" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $act_name; ?></h5>
                                    <p class="card-text text-truncate"><?php echo $act_desc; ?></p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="fw-bold"><?php echo"Php ".$act_price; ?></span>
                                        <div class="form-check">
                                            <input type="checkbox" class=" border-info form-check-input">
                                        </div>
                                        <a href="" class="btn btn-primary mt-2">More Info</a> 
                                    </div>
                                </div>
                            </div>
                            <hr>
                        </div>              
        <?php 
                        $count++;
                    
                        if($count % 3 == 0 || $count == mysqli_num_rows($activity_result)){
                            echo "</div>";
                        }
                    } //while loop
                } //if statement
                else{
                    echo "No Activities Found";
                }
            }//for loop
        ?>
    </div>


</body>
<script src="../js/bootstrap.js"></script>
</html>