<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Package</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
</head>
<body class="bg-light">
    <div class="container mt-3">
        <h1 class="text-center">Insert Package</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="package_name"  class="form-label">Package Name:</label>
                <input type="text"  id="package_name" class="form-control" name="package_name" placeholder="Enter package name">
            </div>
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="package_name" class="form-label">Package Description:</label>
                <input type="text"  id="package_desc" class="form-control" name="package_desc" placeholder="Enter package description">
            </div>
            <div class="form-outline mb-4 w-50 m-auto">
                <!-- testing something -->
                <select name="package_location" id="package_location" class="form-select">
                    <option value="">Select Location</option>
                <?php                
                include("../db.php");
                $sql_location = "SELECT location_name FROM location";

                $result = mysqli_query($conn,$sql_location);    

                if (mysqli_num_rows($result) > 0 ) {
                while($row = mysqli_fetch_assoc($result)){ ?> 
                    <option value=""><?php echo $row["location_name"]; ?></option>
                    <br>
                <?php } } ?>
                <!-- end of tests -->
                </select>
            </div>
        </form>
    </div>
</body>
<script src="../js/bootstrap.js"></script>
</html>