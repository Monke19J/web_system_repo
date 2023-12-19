<?php 
    session_start();
    include("../db.php");

    if(empty($_SESSION['user_id'])){
        header("location: ../logout.php?error=denied");
        die();
    }

    // echo print_r($_SESSION);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Package</title>
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
              <li><a href="index.php" class="nav-link px-2 text-secondary">Manage Package</a></li>
              <li><a href="update_activity.php " class="nav-link px-2 text-white">Manage Activities</a></li>
              <li><a href="booking.php" class="nav-link px-2 text-white">Manage Bookings</a></li>
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
            <div class="col-4">
                <?php                   
                    if(isset($_GET["pack_id"])) {
                        $sql_package = "SELECT * FROM package";

                        $result = mysqli_query($conn,$sql_package);
                        
                        if (mysqli_num_rows($result) > 0 ) {
                            while($row = mysqli_fetch_assoc($result)){
                                if($_GET["pack_id"] == $row["package_id"]){ 
                                    $_SESSION['pack_name'] = $row["package_name"];                                    
                                    $_SESSION['pack_desc']  = $row["description"];
                                    $_SESSION['pack_type'] = $row["type_of_package"];
                                    $_SESSION['combo_package'] = $row["combopackage_id"];
                                    $_SESSION['location_id'] = $row["location_id"];
                                    $_SESSION['pack_cost'] = $row["package_cost"];
                ?>
                <h3 class="mb-1">Update Package</h3>
                                <div class="row">
                                    <a href="index.php" class="btn btn-success btn-block text-light text-decoration-none my-3">Create New Package</a>
                                </div>
                                    <form action="package_process.php" method="get" enctype="multipart/form-data">
                                        <div class="form-outline mb-4 m-auto">
                                            <label for="package_name"  class="form-label">Package Name:</label>
                                            <input type="text"  id="package_name" class="form-control" name="package_name" value="<?php echo $_SESSION['pack_name']; ?>">
                                        </div>
                                        <div class="form-outline mb-4 m-auto">
                                            <label for="package_desc" class="form-label">Package Description:</label>
                                            <input type="text"  id="package_desc" class="form-control" name="package_desc" value="<?php echo $_SESSION['pack_desc'] ?>">
                                        </div>
                                        <div class="form-outline mb-4 m-auto">
                                            <label for="package_location" class="form-label">Select Location:</label>
                                            <select name="package_location" id="package_location" class="form-select">
                                            <?php                
                                            $sql_location = "SELECT * FROM location";

                                            $result = mysqli_query($conn,$sql_location);    

                                            if (mysqli_num_rows($result) > 0 ) {
                                                while($row = mysqli_fetch_assoc($result)){ 
                                                    if($_SESSION['location_id'] == $row["location_id"]) {?>
                                                        <option selected value="<?php echo $row['location_id']; ?>"><?php echo $row["location_name"]; ?></option>
                                                        <br>
                                                <?php } else { ?>
                                                        <option value="<?php echo $row['location_id']; ?>"><?php echo $row["location_name"]; ?></option>
                                                        <br>
                                                    <?php } } } ?>
                                            <!-- end of tests -->
                                            </select>
                                        </div>
                                        <div class="form-outline mb-4 m-auto">
                                            <label for="package_type" class="form-label">Package Type:</label>

                                            <div class="form-check">
                                                <?php 
                                                    if($_SESSION['pack_type'] == "tour"){ ?>
                                                        <input type="radio" id="package1" name="package_type" value="tour" checked>
                                                    <?php } else { ?>
                                                        <input type="radio" id="package1" name="package_type" value="tour">
                                                    <?php }
                                                ?>
                                                <label for="package1">tour</label>
                                            </div>

                                            <div class="form-check">
                                                <?php
                                                    if($_SESSION['pack_type'] == "package"){ ?>
                                                        <input type="radio" id="package2" name="package_type" value="package" checked>
                                                    <?php } else { ?>
                                                        <input type="radio" id="package2" name="package_type" value="package">
                                                    <?php }
                                                ?>
                                                <label for="package2">package</label>
                                            </div>

                                            <div class="form-check">
                                                <?php
                                                    if($_SESSION['pack_type'] == "adventure"){ ?>
                                                        <input type="radio" id="package3" name="package_type" value="adventure" checked>
                                                    <?php } else { ?>
                                                        <input type="radio" id="package3" name="package_type" value="adventure">
                                                    <?php }
                                                ?>
                                                <label for="package3">adventure</label>
                                            </div>
                                        </div>

                                        <div class="form-outline mb-4 m-auto">
                                            <!-- <div class="collapse" id="package_combo"> -->
                                                <card class="card-body">
                                                    <label for="pack_combo" class="form-label">Type of Combo Package:</label>
                                                    <select name="pack_combo" id="pack_combo" class="form-select">
                                                        <?php                
                                                        $sql_location = "SELECT * FROM combopackage";

                                                        $result = mysqli_query($conn,$sql_location);    

                                                        if (mysqli_num_rows($result) > 0 ) {
                                                        while($row = mysqli_fetch_assoc($result))
                                                            if($_SESSION['combo_package'] == $row['combopackage_id']) { ?>
                                                                <option value="<?php echo $row['combopackage_id']; ?>" selected><?php echo $row["combopackage_name"]; ?></option>
                                                                <br>
                                                            <?php } else { ?>
                                                                <option value="<?php echo $row['combopackage_id']; ?>"><?php echo $row["combopackage_name"]; ?></option>
                                                                <br>                                                           
                                                        <?php } } ?>
                                                    </select>`
                                                </card>
                                            <!-- </div> -->
                                        </div>
                                        <div class="form-outline mb-4 m-auto">
                                            <label for="package_price" class="form-label">Price:</label>
                                            <input type="number" name="package_price" class="form-control" value="<?php echo $_SESSION['pack_cost']; ?>">
                                        </div>
                                        <input type="hidden" name="pack_id" value="<?php echo $_GET['pack_id']; ?>">
                                        <input type="submit" class="btn btn-primary" name="update_package">
                                    </form>
                <?php
                                }
                            }
                        }
                    }
                    else {
                ?>
                <h3 class="mb-1">Add Package</h3>
                <form action="package_process.php" method="get" enctype="multipart/form-data">
                    <div class="form-outline mb-4 m-auto">
                        <label for="package_name"  class="form-label">Package Name:</label>
                        <input type="text"  id="package_name" class="form-control" name="package_name" placeholder="Enter package name">
                    </div>
                    <div class="form-outline mb-4 m-auto">
                        <label for="package_desc" class="form-label">Package Description:</label>
                        <input type="text"  id="package_desc" class="form-control" name="package_desc" placeholder="Enter package description">
                    </div>
                    <div class="form-outline mb-4 m-auto">
                        <label for="package_location" class="form-label">Select Location:</label>
                         <!-- testing something -->
                        <select name="package_location" id="package_location" class="form-select">
                            <option value="">Select Location</option>
                        <?php                
                        $sql_location = "SELECT * FROM location";

                        $result = mysqli_query($conn,$sql_location);    

                        if (mysqli_num_rows($result) > 0 ) {
                        while($row = mysqli_fetch_assoc($result)){ ?> 
                            <option value="<?php echo $row['location_id']; ?>"><?php echo $row["location_name"]; ?></option>
                            <br>
                        <?php } } ?>
                        <!-- end of tests -->
                        </select>
                    </div>
                    <div class="form-outline mb-4 m-auto">
                        <label for="package_type" class="form-label">Package Type:</label>

                        <div class="form-check">
                            <input type="radio" id="package1" name="package_type" value="tour">
                            <label for="package1">tour</label>
                        </div>

                        <div class="form-check">
                            <input type="radio" id="package2" name="package_type" value="package">
                            <label for="package2">package</label>
                        </div>

                        <div class="form-check">
                            <input type="radio" id="package3" name="package_type" value="adventure">
                            <label for="package3">adventure</label>
                        </div>
                    </div>

                    <div class="form-outline mb-4 m-auto">
                        <!-- <div class="collapse" id="package_combo"> -->
                            <card class="card-body">
                                <label for="pack_combo" class="form-label">Type of Combo Package:</label>
                            <!-- testing something -->
                                <select name="pack_combo" id="pack_combo" class="form-select">
                                    <option value="">Select Type of Package</option>
                                    <?php                
                                        $sql_location = "SELECT * FROM combopackage";

                                        $result = mysqli_query($conn,$sql_location);    

                                        if (mysqli_num_rows($result) > 0 ) {
                                            while($row = mysqli_fetch_assoc($result)){ ?> 
                                                <option value="<?php echo $row['combopackage_id']; ?>"><?php echo $row["combopackage_name"]; ?></option>
                                                <br>
                                    <?php } } ?>
                                <!-- end of tests -->
                                </select>`
                            </card>
                        <!-- </div> -->
                    </div>
                    <div class="form-outline mb-4 m-auto">
                        <label for="package_price" class="form-label">Price:</label>
                        <input type="number" name="package_price" class="form-control" placeholder="Enter package price">
                    </div>
                    <input type="submit" class="btn btn-primary" name="add_package">
                </form>
                <?php } ?>
            </div>

            <div class="col-8">
            <?php
                include("../db.php");

                $sql_package = "SELECT * FROM package";
                $result = mysqli_query($conn,$sql_package);    
        
       
                if (mysqli_num_rows($result) > 0 ) {
                $count = 0;
                while($row = mysqli_fetch_assoc($result)){
                    if ($count % 2 == 0) {
                        echo '<div class="row">';
                    } ?>
                    
                    <div class="col-md-6">
                        <div class="card" style="width: 100%;">
                            <img src="..." class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"> <?php echo $row["package_name"]; ?> </h5>
                                <p class="card-text text-truncate mb-3"><?php echo $row["description"] . "..."; ?> </p>
                                <p class="card-text mb-3"><?php echo "Php ". $row["package_cost"] ?></p>
                                <p class="card-text mb-3"><?php echo "Type of Package: ". $row["type_of_package"] ?></p>
                                <p class="card-text mb-3"><?php echo "Is it a Combo Package: ";
                                    if($row["combopackage_id"] == 1){
                                        echo "No";
                                    } else{ echo "Yes";};
                                ?>
                                </p>
                                <p class="card-text mb-3"><?php echo "Location:".$row["location_id"];?></p>
                                <p class="card-text mb-3"><?php echo "Status:".$row["status"];?></p>
                                <a href="index.php?pack_id=<?php echo $row['package_id']; ?>" class="btn btn-success">Update</a>
                                <?php
                                    if($row["status"] == 'A'){
                                ?>
                                    <a href="package_process.php?deactivate_package&&pack_id=<?php echo $row['package_id']; ?>" class="btn btn-danger">Deactivate</a>
                                <?php } elseif($row["status"] == 'I'){ ?>
                                    <a href="package_process.php?activate_package&&pack_id=<?php echo $row['package_id']; ?>" class="btn btn-danger">Activate</a>
                                <?php } else { ?>
                                    <a href="package_process.php?activate_package&&pack_id=<?php echo $row['package_id']; ?>" class="btn btn-danger">Activation</a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
            <?php 
                $count++;
                if ($count % 2 == 0){
                    echo '<div>';
                }

                }
            }
            else{
                echo "No Result Found<br>";
            }
            ?>
            </div>
            
        </div>
      </div>
</body>

<script src="../js/bootstrap.js"></script>
</html>