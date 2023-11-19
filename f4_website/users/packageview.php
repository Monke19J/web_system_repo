
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
        <div class="row-12">
            <h1 class="text-success text-center fs-3">
                <?php echo $package_name;?>
            </h1>
        </div>
        <!-- the php code is repeatative -->
        
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner mb-4 overflow: hidden;" style="height: 400px;">
                <?php
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
        <hr>
        <div class="row mb-5">
            <h3 class="fs-4 text-primary-emphasis">Description</h3>
            <div class="ms-3"><p style="white-space: pre-line;"><?php echo $description ?></p></div>
        </div>
        <hr>
        <div class="row mb-5">
            <form action="select_activity.php" method="post">
                <div>
                    <label for="startDate">Select Start Date:</label>
                    <input type="date" id="startDate" name="startDate" required>
                </div>
                <div>
                    <label for="endDate">Select End Date:</label>
                    <input type="date" id="endDate" name="endDate" required>
                </div>
                <input type="hidden" name="id_value" value="<?php echo $id_value; ?>">
                <span class="fw-bold"><?php echo"Php ".$price ?></span>
                <button class="btn btn-success ms-1 mt-3" type="submit" >Book Package</button>
            </form>            
        </div>
    </div>

</body>
<!-- to only operate the collapse if the dates are fill first -->

<!-- <script>
    function updateEndDateMin() {
        var startDate = document.getElementById("startDate").value;
        document.getElementById("endDate").min = startDate;

        var startDateObj = new Date(startDate);
        var endDateObj = new Date(document.getElementById("endDate").value);

        var timeDifference = endDateObj - startDateObj;
        var daysDifference = Math.ceil(timeDifference / (1000* 60* 60* 24));

        document.getElementById("numberOfDaysInput").value = daysDifference;
        document.getElementById("numberOfDays").innerHTML = daysDifference;
    }

    function validateAndToggle() {
        if (validateDates()){
            $("#activityCards").collapse("toggle")
        }
    }

    function validateDates() {
        var startDate = document.getElementById("startDate").value;
        var endDate = document.getElementById("endDate").value;

        if(!startDate || !endDate) {
            alert("Please select both start and end dates.");
            return false;
        }else{
            return true;
        }
        
    }
</script> -->
<script src="../js/bootstrap.js"></script>
</html>