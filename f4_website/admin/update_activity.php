<!-- clean this later on with the use of session because of so many repetition -->
<!-- also use the join keyword for it to be shorter -->
<!-- textarea instead of normal inputtype type for a large textbox -->
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
              <li><a href="update_activity.php " class="nav-link px-2 text-secondary">Manage Activities</a></li>
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
                    include("../db.php");
                    
                    if(isset($_GET["act_id"])) {
                        $sql_package = "SELECT * FROM activities";

                        $result = mysqli_query($conn,$sql_package);
                        
                        if (mysqli_num_rows($result) > 0 ) {
                            while($row = mysqli_fetch_assoc($result)){
                                if($_GET["act_id"] == $row["activity_id"]){ 
                                    $act_name = $row["activity_name"];
                                    $act_desc = $row["description"];
                                    $act_type = $row["act_type_id"];
                                    $combo_package = $row["combopackage_id"];
                                    $location_id = $row["location_id"];
                                    $act_cost = $row["price"];
                ?>
                <h3 class="mb-1">Update Activity</h3>
                                <div class="row">
                                    <a href="update_activity.php" class="btn btn-success btn-block text-light text-decoration-none my-3">Create New Activity</a>
                                </div>
                                    <form action="activity_process.php" method="get" enctype="multipart/form-data">
                                        <div class="form-outline mb-4 m-auto">
                                            <label for="act_name"  class="form-label">Activity Name:</label>
                                            <input type="text"  id="act_name" class="form-control" name="act_name" value="<?php echo $act_name; ?>">
                                        </div>
                                        <div class="form-outline mb-4 m-auto">
                                            <label for="act_desc" class="form-label">Activity Description:</label>
                                            <input type="text"  id="act_desc" class="form-control" name="act_desc" value="<?php echo $act_desc; ?>">
                                        </div>
                                        <div class="form-outline mb-4 m-auto">
                                            <label for="act_location" class="form-label">Select Location:</label>
                                            <select name="act_location" id="act_location" class="form-select">
                                            <?php                
                                            $sql_location = "SELECT * FROM location";

                                            $result = mysqli_query($conn,$sql_location);    

                                            if (mysqli_num_rows($result) > 0 ) {
                                                while($row = mysqli_fetch_assoc($result)){ 
                                                    if($location_id == $row["location_id"]) {?>
                                                        <option selected value="<?php echo $row['location_id']; ?>"><?php echo $row["location_name"]; ?></option>
                                                        <br>
                                                <?php } else { ?>
                                                        <option value="<?php echo $row['location_id']; ?>"><?php echo $row["location_name"]; ?></option>
                                                        <br>
                                                    <?php } } } ?>
                                            <!-- end of tests -->
                                            </select>
                                        </div>

                                        <!-- Fix this!!! so messy -->
                                        <div class="form-outline mb-4 m-auto">
                                            <label for="act_type" class="form-label">Type of Activity:</label>
                                            <select name="act_type" id="act_type" class="form-select">
                                                <option value="">Select the Type of the Activity</option>
                                            <?php                
                                            $sql_acttype = "SELECT * FROM activitytype";

                                            $result = mysqli_query($conn,$sql_acttype);    

                                            if (mysqli_num_rows($result) > 0 ) {
                                            while($row = mysqli_fetch_assoc($result)){ 
                                                if($act_type == $row["act_type_id"]) { ?>
                                                    <option selected value="<?php echo $row['act_type_id']; ?>"><?php echo $row["act_type_name"]; ?></option>
                                                    <br>
                                                <?php } else { ?>
                                                    <option value="<?php echo $row['act_type_id']; ?>"><?php echo $row["act_type_name"]; ?></option>
                                                    <br>
                                                <?php } } } ?>
                                            </select>
                                        </div>

                                        <div class="form-outline mb-4 m-auto">
                                            <!-- <div class="collapse" id="package_combo"> -->
                                                <card class="card-body">
                                                    <label for="act_combo" class="form-label">Type of Combo Package:</label>
                                                    <select name="act_combo" id="act_combo" class="form-select">
                                                        <?php                
                                                        $sql_combopack = "SELECT * FROM combopackage";

                                                        $result = mysqli_query($conn,$sql_combopack);    

                                                        if (mysqli_num_rows($result) > 0 ) {
                                                        while($row = mysqli_fetch_assoc($result))
                                                            if($combo_package == $row['combopackage_id']) { ?>
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
                                            <label for="act_price" class="form-label">Price:</label>
                                            <input type="number" name="act_price" class="form-control" value="<?php echo $act_cost; ?>">
                                        </div>
                                        <input type="hidden" name="act_id" value="<?php echo $_GET['act_id']; ?>">
                                        <input type="submit" class="btn btn-primary" name="update_act">
                                    </form>
                <?php
                                }
                            }
                        }
                    }
                    else {
                ?>
                <h3 class="mb-1">Add Activity</h3>
                <form action="activity_process" method="get" enctype="multipart/form-data">
                    <div class="form-outline mb-4 m-auto">
                        <label for="act_name"  class="form-label">Activity Name:</label>
                        <input type="text"  id="act_name" class="form-control" name="act_name" placeholder="Enter package name">
                    </div>
                    <div class="form-outline mb-4 m-auto">
                        <label for="act_desc" class="form-label">Activity Description:</label>
                        <input type="text"  id="act_desc" class="form-control" name="act_desc" placeholder="Enter package description">
                    </div>

                    <div class="form-outline mb-4 m-auto">
                        <label for="act_location" class="form-label">Select Location:</label>
                        <select name="act_location" id="act_location" class="form-select">
                            <option value="">Select Location</option>
                        <?php                
                        $sql_location = "SELECT * FROM location";

                        $result = mysqli_query($conn,$sql_location);    

                        if (mysqli_num_rows($result) > 0 ) {
                        while($row = mysqli_fetch_assoc($result)){ ?> 
                            <option value="<?php echo $row['location_id']; ?>"><?php echo $row["location_name"]; ?></option>
                            <br>
                        <?php } } ?>
                        </select>
                    </div>

                    <div class="form-outline mb-4 m-auto">
                        <label for="act_type" class="form-label">Type of Activity:</label>
                        <select name="act_type" id="act_type" class="form-select">
                            <option value="">Select the Type of the Activity</option>
                        <?php                
                        $sql_acttype = "SELECT * FROM activitytype";

                        $result = mysqli_query($conn,$sql_acttype);    

                        if (mysqli_num_rows($result) > 0 ) {
                        while($row = mysqli_fetch_assoc($result)){ ?> 
                            <option value="<?php echo $row['act_type_id']; ?>"><?php echo $row["act_type_name"]; ?></option>
                            <br>
                        <?php } } ?>
                        </select>
                    </div>

                    <div class="form-outline mb-4 m-auto">
                        <!-- <div class="collapse" id="package_combo"> -->
                            <card class="card-body">
                                <label for="act_combo" class="form-label">Type of Combo Package:</label>
                                <select name="act_combo" id="act_combo" class="form-select">
                                    <option value="">Select Type of Package</option>
                                    <?php                
                                        $sql_location = "SELECT * FROM combopackage";

                                        $result = mysqli_query($conn,$sql_location);    

                                        if (mysqli_num_rows($result) > 0 ) {
                                            while($row = mysqli_fetch_assoc($result)){ ?> 
                                                <option value="<?php echo $row['combopackage_id']; ?>"><?php echo $row["combopackage_name"]; ?></option>
                                                <br>
                                    <?php } } ?>
                                </select>`
                            </card>
                        <!-- </div> -->
                    </div>
                    <div class="form-outline mb-4 m-auto">
                        <label for="act_price" class="form-label">Price:</label>
                        <input type="number" name="act_price" class="form-control" placeholder="Enter package price">
                    </div>
                    <input type="submit" class="btn btn-primary" name="add_act">
                </form>
                <?php } ?>
            </div>

            <div class="col-8">
            <?php
                include("../db.php");

                $sql_act = "SELECT * FROM activities";
                $result = mysqli_query($conn,$sql_act);    
        
       
                if (mysqli_num_rows($result) > 0 ) {
                $count = 0;
                while($row = mysqli_fetch_assoc($result)){
                    if ($count % 2 == 0) {
                        echo '<div class="row">';
                    } ?>
                    
                    <div class="col-md-6">
                        <div class="card" style="width: 100%;">
                            <img src="<?php echo $row['activity_image']; ?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"> <?php echo $row["activity_name"]; ?> </h5>
                                <p class="card-text text-truncate mb-3"><?php echo $row["description"] . "..."; ?> </p>
                                <p class="card-text mb-3"><?php echo "Php ". $row["price"] ?></p>
                                <p class="card-text mb-3"><?php echo "Type of Package: ". $row["act_type_id"] ?></p>
                                <p class="card-text mb-3"><?php echo "Is it a Combo Package: ";
                                    if($row["combopackage_id"] == 1){
                                        echo "No";
                                    } else{ echo "Yes";};
                                ?>
                                </p>
                                <p class="card-text mb-3"><?php echo "Location:".$row["location_id"];?></p>
                                <p class="card-text mb-3"><?php echo "Status:".$row["status"];?></p>
                                <a href="update_activity.php?act_id=<?php echo $row['activity_id']; ?>" class="btn btn-success">Update</a>
                                <?php
                                    if($row["status"] == 'A'){
                                ?>
                                    <a href="activity_process.php?deactivate_act&&act_id=<?php echo $row['activity_id']; ?>" class="btn btn-danger">Deactivate</a>
                                <?php } elseif($row["status"] == 'I'){ ?>
                                    <a href="activity_process.php?activate_act&&act_id=<?php echo $row['activity_id']; ?>" class="btn btn-danger">Activate</a>
                                <?php } else { ?>
                                    <a href="activity_process.php?activate_act&&act_id=<?php echo $row['activity_id']; ?>" class="btn btn-danger">Activation</a>
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