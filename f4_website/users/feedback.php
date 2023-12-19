<?php 
    session_start();
    include("../db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
                <li class="nav-item"><a href="showhistory.php" class="nav-link">History</a></li>
                <li class="nav-item"><a href="feedback.php" class="nav-link active">Feedback</a></li>
                <li class="nav-item"><a href="../logout.php" class="nav-link">Log-out</a></li>
            </ul>
        </header>
        <form action="payment_process.php" method="post">
            <?php
                $user_id = $_SESSION["user_id"];
                $get_user = "SELECT * FROM users WHERE user_id = '$user_id'";
                $user_result =  mysqli_query($conn, $get_user);
                $row = mysqli_fetch_assoc($user_result);
                $lastname = $row["last_name"];
                $firstname = $row["first_name"];
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
                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="4" required></textarea><br>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <button class="btn btn-success ms-1 mt-3" type="submit">Submit</button>
                </div>                
            </div>                                      
        </form>
    </div>
</div>
</body>
<script src="../js/bootstrap.js"></script>
</html>