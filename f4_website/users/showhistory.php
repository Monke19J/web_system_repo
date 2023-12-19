<?php
    include("../db.php");
    session_start();
    $user_id = $_SESSION["user_id"];

    if(isset($_GET["cancelled"])){
        $bookpack_id = $_GET["bookpack_id"];

        $sql_update_bookpack= "UPDATE `bookingpackage` 
                                        SET `status` = 'Cancelled' 
                                WHERE booking_id = '$bookpack_id'";

        mysqli_query($conn, $sql_update_bookpack);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book History</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">   
                <a href="reset_session.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                    <span class="text-success ms-1 fs-3">Travel Planner Kuno</span>
                </a>
                <ul class="nav nav-pills">
                    <li class="nav-item"><a href="reset_session.php" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="showhistory.php" class="nav-link active">History</a></li>
                    <li class="nav-item"><a href="../logout.php" class="nav-link">Log-out</a></li>
                </ul>
            </header>
        </div>
        <div class="row">
            <!-- <div class="col-2"></div>
            <div class="col-8"> -->
                <?php
                    $get_bookschedule = "SELECT * FROM bookingpackage WHERE user_id = '$user_id'";
                    $booked_result = mysqli_query($conn, $get_bookschedule);

                    if (mysqli_num_rows($booked_result) == 0){
                        echo "<tr><td colspan='4'>Didn't Have a Booked Package Yet:(</td></tr>";
                    }
                    else{
                        echo '<h3 class="fs-2 text-success text-center">History:</h3>';

                        while($row = mysqli_fetch_assoc($booked_result)){
                            $ref_num = $row["ref_num"];
                            $bookpack_id = $row["booking_id"];
                            // I dont know how to merge the two table:(
                            $package_id = $row["package_id"];
                            $status = $row["status"];
                            $get_pack_table = "SELECT * FROM `package` WHERE package_id = '$package_id'";
                            $package_result = mysqli_query($conn, $get_pack_table);
                            $pack = mysqli_fetch_assoc($package_result);
                            $package_name = $pack["package_name"];


                            $check_in = $row["check_in_date"];
                            $check_out = $row["check_out_date"];
                            $total_amount = $row["total_amount"];

                            echo '<table class="table table-bordered table-striped" border-info>';
                        echo '<thead><tr><th>Reference Number</th><th>Package Name</th><th>Check-In Date</th><th>Check-Out Date</th><th>Total Amount</th><th>Book Status</th><th></th></tr></thead>';
                            echo '<tbody>';
                            echo "<tr><td>$ref_num</td><td>$package_name</td><td>$check_in</td><td>$check_out</td><td>$total_amount</td><td>$status</td><td>";
                            if($status == "Pending"){
                                echo "<a href='showhistory.php?bookpack_id=$bookpack_id&&cancelled' class='btn btn-danger'>Cancel Book</a>";
                            }
                            else{
                            
                            }
                            echo "</td>";
                            echo "<td>";
                            $get_customerschedule = "SELECT * FROM customerschedule WHERE ref_num = '$ref_num'";
                            $sched_result = mysqli_query($conn, $get_customerschedule);

                            while($row = mysqli_fetch_assoc($sched_result)){
                            $day = $row["day"];
                            $act_id = $row["activity_id"];
                            $start_of_activity = $row["start_of_activity"];
                            $end_of_activity = $row["end_of_activity"]; 
                            
                            $get_activity = "SELECT * FROM activities WHERE activity_id = '$act_id'";
                            $act_result = mysqli_query($conn, $get_activity);
                            $row = mysqli_fetch_assoc($act_result);
                            $act_name = $row["activity_name"];
                            ?>

                            <div>
                                <table class="table table-bordered table-striped" border-info>
                                <thead><tr><th>Day</th><th>Activity Id</th><th>Start of Activity</th><th>End of Activity</th></tr></thead>
                                <tbody>
                                <tr><td> <?php  echo $day; ?> </td><td><?php echo $act_name; ?></td><td><?php echo $start_of_activity; ?></td><td><?php echo $end_of_activity; ?></td></tr>
                                </tbody>
                                </table>
                            </div> <hr><?php
                            } 
                            echo "</td>";
                            echo "</tr>";
                            echo '</tbody>';
                            echo '</table>';

                             
                           
                        }
                        
                    }                   
                ?>
            </div>
            <!-- <div class="col-2"></div> -->
        </div>
    </div>
</body>
<script src="../js/bootstrap.js"></script>
</html>