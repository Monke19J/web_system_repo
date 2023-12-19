<?php
session_start();
include("../db.php");

// Check if the user is logged in
if (empty($_SESSION['user_id'])) {
    header("location: ../logout.php?error=denied");
    die();
}

// Check for the cancel_booking_id parameter
if (isset($_GET['cancel_booking_id'])) {
    // Get the booking_id from the parameter
    $booking_id_to_cancel = $_GET['cancel_booking_id'];

    // Update the status to 'Canceled' in the database
    $update_query = "UPDATE bookingpackage SET status = 'Canceled' WHERE booking_id = $booking_id_to_cancel";
    $result = mysqli_query($conn, $update_query);

    if (!$result) {
        die("Error in SQL query: " . mysqli_error($conn));
    }

    // Redirect back to booking.php with the pending tab selected
    header("location: booking.php#pending");
    exit;
}

// Update status to 'Booked' for past bookings
$update_query = "UPDATE bookingpackage 
                 SET status = 'Booked' 
                 WHERE check_out_date < CURRENT_DATE() 
                 AND status = 'Pending'";
$result_update = mysqli_query($conn, $update_query);

if (!$result_update) {
    die("Error in SQL query: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Activity</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <style>
        .card-text {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    </style>
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
                    <li><a href="update_activity.php" class="nav-link px-2 text-white">Manage Activities</a></li>
                    <li><a href="booking.php" class="nav-link px-2 text-secondary">Manage Bookings</a></li>
                    <li><a href="manage_others.php" class="nav-link px-2 text-white">Others</a></li>
                </ul>

                <div class="text-end">
                    <a href="../logout.php" class="btn btn-outline-light me-2">Log-out</a>
                    <button type="button" class="btn btn-warning">Username</button>
                </div>
            </div>
        </div>
     </header>

    <div class="container">
        <div class="row my-4">
            <div class="col-12">
                <ul class="nav nav-tabs" id="bookingTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="pending-tab" data-bs-toggle="tab" href="#pending" role="tab" aria-controls="pending" aria-selected="true">Pending</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="booked-tab" data-bs-toggle="tab" href="#booked" role="tab" aria-controls="booked" aria-selected="false">Booked</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="canceled-tab" data-bs-toggle="tab" href="#canceled" role="tab" aria-controls="canceled" aria-selected="false">Canceled</a>
                    </li>
                </ul>

                <div class="tab-content" id="bookingTabsContent">
                    <!-- Pending Tab -->
                    <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                        <?php
                        $sql_pending = "SELECT bookingpackage.booking_id, bookingpackage.ref_num, bookingpackage.total_amount, 
                            users.user_id, users.last_name, users.first_name, users.middle_name,
                            bookingpackage.check_in_date, bookingpackage.check_out_date
                            FROM bookingpackage
                            INNER JOIN users ON bookingpackage.user_id = users.user_id
                            WHERE bookingpackage.status = 'Pending'";
                        $result_pending = mysqli_query($conn, $sql_pending);

                        echo "Number of Pending Bookings: " . mysqli_num_rows($result_pending);

                        if (mysqli_num_rows($result_pending) > 0) {
                            while ($row = mysqli_fetch_assoc($result_pending)) {
                                ?>
                                <div class="col-md-6">
                                    <div class="card" style="width: 100%;">
                                        <div class="card-body">
                                            <h5 class="card-title">Booking ID: <?php echo $row["booking_id"]; ?> </h5>
                                            <p class="card-text mb-3"><?php echo "Reference Number: " . $row["ref_num"]; ?> </p>
                                            <p class="card-text mb-3"><?php echo "User ID: " . $row["user_id"] . " (" . $row["last_name"] . ", " . $row["first_name"] . " " . $row["middle_name"] . ")"; ?> </p>
                                            <p class="card-text mb-3"><?php echo "Total Amount: Php " . $row["total_amount"]; ?> </p>
                                            <p class="card-text mb-3"><?php echo "Check-in Date: " . $row["check_in_date"]; ?> </p>
                                            <p class="card-text mb-3"><?php echo "Check-out Date: " . $row["check_out_date"]; ?> </p>

                                            <form method="post" action="cancel_booking.php?tab=pending">
                                                <input type="hidden" name="booking_id" value="<?php echo $row['booking_id']; ?>">
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#cancelModal<?php echo $row['booking_id']; ?>">
                                                    Cancel
                                                </button>
                                            </form>

                                            <div class="modal fade" id="cancelModal<?php echo $row['booking_id']; ?>" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="cancelModalLabel">Cancel Booking</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to cancel this booking?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <a href="booking.php?cancel_booking_id=<?php echo $row['booking_id']; ?>" class="btn btn-danger">Cancel Booking</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        } 
                        ?>
                    </div>

                   <!-- Booked Tab -->
                    <div class="tab-pane fade" id="booked" role="tabpanel" aria-labelledby="booked-tab">
                        <?php
                        $sql_booked = "SELECT bookingpackage.booking_id, bookingpackage.ref_num, bookingpackage.total_amount, 
                                        users.user_id, users.last_name, users.first_name, users.middle_name,
                                        bookingpackage.check_in_date, bookingpackage.check_out_date
                                        FROM bookingpackage
                                        INNER JOIN users ON bookingpackage.user_id = users.user_id
                                        WHERE bookingpackage.status = 'Booked'";
                        $result_booked = mysqli_query($conn, $sql_booked);

                        echo "Number of Successful Bookings: " . mysqli_num_rows($result_booked)."<br>";
                        
                        $sql_sum_of_booked = "SELECT * FROM bookingpackage WHERE `status` = 'Booked'";
                        $sum_booked = mysqli_query($conn, $sql_booked);
                        $total = 0;
                        while ($sum =  mysqli_fetch_assoc($sum_booked)){
                            $total += $sum["total_amount"];
                        }
                        
                        echo "Total Amount: ".$total;


                        if (mysqli_num_rows($result_booked) > 0) {
                            while ($row = mysqli_fetch_assoc($result_booked)) {
                                ?>
                                <div class="col-md-6">
                                    <div class="card" style="width: 100%;">
                                        <div class="card-body">
                                            <h5 class="card-title">Booking ID: <?php echo $row["booking_id"]; ?> </h5>
                                            <p class="card-text mb-3"><?php echo "Reference Number: " . $row["ref_num"]; ?> </p>
                                            <p class="card-text mb-3"><?php echo "User ID: " . $row["user_id"] . " (" . $row["last_name"] . ", " . $row["first_name"] . " " . $row["middle_name"] . ")"; ?> </p>
                                            <p class="card-text mb-3"><?php echo "Total Amount: Php " . $row["total_amount"]; ?> </p>
                                            <p class="card-text mb-3"><?php echo "Check-in Date: " . $row["check_in_date"]; ?> </p>
                                            <p class="card-text mb-3"><?php echo "Check-out Date: " . $row["check_out_date"]; ?> </p>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        } 
                        ?>
                    </div>
                    <!-- Canceled Tab -->
                    <div class="tab-pane fade" id="canceled" role="tabpanel" aria-labelledby="canceled-tab">
                        <?php
                        $sql_canceled = "SELECT bookingpackage.booking_id, bookingpackage.ref_num, bookingpackage.total_amount, 
                            users.user_id, users.last_name, users.first_name, users.middle_name,
                            bookingpackage.check_in_date, bookingpackage.check_out_date
                            FROM bookingpackage
                            INNER JOIN users ON bookingpackage.user_id = users.user_id
                            WHERE bookingpackage.status = 'Canceled'";
                        $result_canceled = mysqli_query($conn, $sql_canceled);

                        if (!$result_canceled) {
                            die("Error in SQL query: " . mysqli_error($conn));
                        }

                        echo "Number of Cancelled Bookings: " . mysqli_num_rows($result_canceled);

                        if (mysqli_num_rows($result_canceled) > 0) {
                            while ($row = mysqli_fetch_assoc($result_canceled)) {
                                ?>
                                <div class="col-md-6">
                                    <div class="card" style="width: 100%;">
                                        <div class="card-body">
                                            <h5 class="card-title">Booking ID: <?php echo $row["booking_id"]; ?> </h5>
                                            <p class="card-text mb-3"><?php echo "Reference Number: " . $row["ref_num"]; ?> </p>
                                            <p class="card-text mb-3"><?php echo "User ID: " . $row["user_id"] . " (" . $row["last_name"] . ", " . $row["first_name"] . " " . $row["middle_name"] . ")"; ?> </p>
                                            <p class="card-text mb-3"><?php echo "Total Amount: Php " . $row["total_amount"]; ?> </p>
                                            <p class="card-text mb-3"><?php echo "Check-in Date: " . $row["check_in_date"]; ?> </p>
                                            <p class="card-text mb-3"><?php echo "Check-out Date: " . $row["check_out_date"]; ?> </p>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../js/bootstrap.js"></script>
</body>
</html>
