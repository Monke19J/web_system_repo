<?php
session_start();
include("../db.php");

if (empty($_SESSION['user_id'])) {
    header("location: ../logout.php?error=denied");
    die();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['booking_id'])) {
        $booking_id = $_POST['booking_id'];

        // Update the status to 'Canceled' in the database
        $update_query = "UPDATE bookingpackage SET status = 'Canceled' WHERE booking_id = $booking_id";
        $result = mysqli_query($conn, $update_query);

        if (!$result) {
            die("Error in SQL query: " . mysqli_error($conn));
        }

        // Redirect back to the 'Pending' tab
        header("location: booking.php#pending");
        exit();
    }
}
?>
