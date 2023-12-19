<?php
include("../db.php");
session_start();

if(empty($_SESSION["packageview"]) || empty($_SESSION["select_activity"]) || empty($_SESSION["payment"])){
    header("location: index.php?error=illegal_access");
}

$id_value = $_SESSION["package_id"];
$user_id = $_SESSION["user_id"];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
</head>
<body>
    <div class="container">
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">   
            <a href="select_act_backend.php?back" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                <span class="text-danger ms-1">back</span>
            </a>
            
            <ul class="nav nav-pills">
                <li class="nav-item"><a href="reset_session.php" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="showhistory.php" class="nav-link">History</a></li>
                <li class="nav-item"><a href="../logout.php" class="nav-link">Log-out</a></li>
            </ul>
        </header>
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
            <?php            
                if (isset($_GET["error"])) {
                    if ($_GET["error"] == "insufficient_amount") { ?>
                        <div class="alert alert-danger text-center">Insufficient Amount</div>
            <?php   }
                }
            ?>
            </div>
            <div class="col-3"></div>
        </div>
        

        <div class="row">
            <div class="col-md-6">
            <?php
                $package_name =  $_SESSION["package_name"];
                $price = $_SESSION["price"];
                $startDate = $_SESSION["startDate"];
                $endDate = $_SESSION["endDate"];

                $total_price = $price;

                echo '<h3 class="fs-5 text-success">Package:</h3>';
                echo '<table class="table table-bordered table-striped" border-info>';
                echo '<thead><tr><th>Package Name</th><th>Check-In Date</th><th>Check-Out Date</th><th>Price</th></tr></thead>';
                echo '<tbody>';
                echo "<tr><td>$package_name</td><td>$startDate</td><td>$endDate</td><td>$price</td></tr>";
                echo '</tbody>';
                echo '</table>';

                echo '<h3 class="fs-5 text-success">Activity:</h3>';
                echo '<table class="table table-bordered table-striped" border-info>';
                echo '<thead><tr><th>Day</th><th>Activity Name</th><th>Price</th><th>Start Time</th><th>End Time</th></tr></thead>';
                echo '<tbody>';

                    foreach ($_SESSION["selectedActivities"] as $day => $no_of_activities) {
                        foreach ($no_of_activities as $act_pos => $act_id) {
                            $startTime = $_SESSION["activityStartTime"][$day][$act_pos];
                            $endTime = $_SESSION["activityEndTime"][$day][$act_pos];
                            $get_activity = "SELECT * FROM activities WHERE activity_id = '$act_id'";
                            $activity_result = mysqli_query($conn, $get_activity);

                            if (mysqli_num_rows($activity_result) == 0) {
                                echo "<tr><td>$day</td><td colspan='4'>No Activity Selected</td></tr>";
                            } else {
                                $row = mysqli_fetch_assoc($activity_result);
                                $act_name = $row["activity_name"];
                                $act_combopackage = $row["combopackage_id"];
                                $act_type = $row["act_type_id"];
                                $act_image = $row["activity_image"];
                                $act_desc = $row["description"];
                                $act_price = $row["price"];

                                echo "<tr><td>$day</td><td>$act_name</td><td>$act_price</td><td>$startTime</td><td>$endTime</td></tr>";
                                $total_price += $act_price;
                            }
                        }
                    }

                    echo '</tbody>';
                    echo '</table>';
                    echo "<p class='lead mt-3'>Total cost = $total_price</p>";
                    $_SESSION["total_cost"] = $total_price;             
            ?>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-5 fw-bold">
                <form action="payment_process.php" method="post">
                    <?php
                        $get_user = "SELECT * FROM users WHERE user_id = '$user_id'";
                        $user_result =  mysqli_query($conn, $get_user);

                        $row = mysqli_fetch_assoc($user_result);
                        $lastname = $row["last_name"];
                        $firstname = $row["first_name"];
                        $address = $row["address"];
                    ?>
                    <div class="row mb-3">
                        <div class="col-md-4 ">
                            <label for="lastname" class="mb-1">Last Name:</label>
                            <input type="text" id="lastname" class="form-control" name="lastname" value="<?php echo $lastname; ?>" readonly>
                        </div>
                        <div class="col-md-8 mb-1">
                            <label for="firstname" class="mb-1">First Name</label>
                            <input type="text" id="firstname" class="form-control" name="firstname" value="<?php echo $firstname; ?>" readonly>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <label for="address" class="mb-1">Address:</label>
                        <input type="text" id="address" class="form-control m-2" name="address" value="<?php echo $address; ?>" readonly>
                    </div>
                    <div class="row mt-5">
                        <label for="payment" class="mb-1">Payment:</label>
                        <input type="number" id="payment" class="form-control m-2" name="payment" required>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <button class="btn btn-success ms-1 mt-3" type="submit">Book</button>
                        </div>                
                    </div>                                      
                </form>
            </div>
        </div>
    </div>
    
</body>
<script src="../js/bootstrap.js"></script>
</html>


