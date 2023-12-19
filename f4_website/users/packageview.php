<?php
    session_start();
    include("../db.php");    
    
    if(empty($_SESSION["packageview"])){
        header("location: index.php?error=illegal_access");
    }

    $id_value = $_SESSION["package_id"];

    $package_name =  $_SESSION["package_name"];
    $description = $_SESSION["description"];
    $package_type = $_SESSION["package_type"];
    $pack_combopackage = $_SESSION["pack_combopackage"];
    $price = $_SESSION["price"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <html><title> <?php echo $package_name; ?> </title></html>
    <!-- for the date input to only allow to select present and onwards -->
    <script>
        document.addEventListener("DOMContentLoaded",function () {
            var today = new Date().toISOString().split('T')[0];
            document.getElementById("startDate").min = today;
            document.getElementById("endDate").min = today;
        })
    </script>
</head>

<body>
    <div class="container">
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">   
            <a href="index_backend.php?back" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                <span class="text-danger ms-1">back</span>
            </a>
            <ul class="nav nav-pills">
                <li class="nav-item"><a href="reset_session.php" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="showhistory.php" class="nav-link">History</a></li>
                <li class="nav-item"><a href="../logout.php" class="nav-link">Log-out</a></li>
            </ul>
        </header>
        
        <div class="row-12 mb-4">
            <h1 class="text-success text-center fs-3">
                <?php echo $package_name;?>
            </h1>
        </div>
        
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <div id="carouselPicture" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner mb-4 overflow: hidden;" style="width: 550px; height: 350px">
                        <?php
                            if($package_type == "tour"){
                                $get_activities = "SELECT * FROM activities WHERE act_type_id = 1 AND `status` = 'A'";
                            }
                            elseif($package_type == "package"){
                                $get_activities = "SELECT * FROM activities WHERE combopackage_id = $pack_combopackage AND `status` = 'A'";
                            }
                            elseif($package_type == "adventure"){
                                $get_activities = "SELECT * FROM activities WHERE act_type_id != 1 AND act_type_id != 3 AND `status` = 'A'";
                            }

                            $activity_result =  mysqli_query($conn, $get_activities);

                            if (mysqli_num_rows($activity_result) > 0) {
                                $row = mysqli_fetch_assoc($activity_result);
                                echo '<div class="carousel-item active" style="height: 100%;">';
                                    echo '<img src="' . $row["activity_image"] . '" class="d-block w-100 h-100 object-fit: cover" alt="...">';
                                echo '</div>';
                            
                                while ($row = mysqli_fetch_assoc($activity_result)) {
                                    echo '<div class="carousel-item" style="height: 100%;">';
                                    echo '<img src="' . $row["activity_image"] . '" class="d-block w-100 h-100 object-fit: cover" alt="...">';
                                    echo '</div>';
                                }
                            }
                            else {
                                echo '<div class="carousel-item active" style="height: 100%;">';
                                echo '<img src="placeholder_image.jpg" class="d-block w-100 h-100 object-fit: cover" alt="No Image Available">';
                                echo '</div>';
                            }
                        ?>  
                        
                    </div>
                </div>
            </div>
            <div class="col-3"></div>
        </div>

        
        <hr>
        <div class="row mb-5">
            <h3 class="fs-4 text-primary-emphasis">Description</h3>
            <div class="ms-3"><p style="white-space: pre-line;"><?php echo $description ?></p></div>
        </div>
        <hr>
        <div class="row mb-5">
            <form action="packageview_backend.php" method="post">
                <div>
                    <label for="startDate">Select Start Date:</label>
                    <input type="date" id="startDate" name="startDate" required>
                </div>
                <div>
                    <label for="endDate">Select End Date:</label>
                    <input type="date" id="endDate" name="endDate" required>
                </div>
                <span class="fw-bold"><?php echo"Php ".$price ?></span>
                <button class="btn btn-success ms-1 mt-3" type="submit" name="select_activity" value="access" >Book Package</button>
            </form>            
        </div>
    </div>
</body>
<script src="../js/bootstrap.js"></script>
</html>