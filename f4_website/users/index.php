<?php 
    session_start();
    include("../db.php");

    if(empty($_SESSION['user_id'])){
        header("location: ../logout.php?error=denied");
        die();
    }
    if(isset($_GET["error"])){ ?>
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4">
            <?php if ($_GET["error"] == "illegal_access") { ?>
                <div class="alert alert-danger">Force of Entry Detected</div>
            <?php } ?>
            </div>
            <div class="col-4"></div>
        </div>
    <?php }
    if(isset($_GET["msg"])){ ?>
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4">
            <?php if ($_GET["msg"] == "success") { ?>
                <div class="alert alert-info">You book a Package Successfully</div>
            <?php } ?>
            </div>
            <div class="col-4"></div>
        </div>
    <?php }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <title>Home Page</title>
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
                    <li class="nav-item">
                        <a href="reset_session.php" class="nav-link active">Home</a>
                    </li>
                    <li class="nav-item"><a href="showhistory.php" class="nav-link">History</a></li>
                    <li class="nav-item"><a href="feedback.php" class="nav-link">Feedback</a></li>
                    <li class="nav-item"><a href="../logout.php" class="nav-link">Log-out</a></li>
                </ul>
            </header>
        </div>

        <form class="col-12 col-lg-auto mb-5 me-lg-3" role="search" method="get">
          <input type="search" class="form-control form-control-dark" placeholder="Search..." aria-label="Search" name="search">
        </form>

        <?php       
        if (isset($_GET["search"])){
            $search_item = $_GET["search"];
            $sql = "SELECT * FROM package
                    WHERE package_name LIKE '%$search_item%'";
            
            $result = mysqli_query($conn,$sql);
        }
        else{
            $sql_package = "SELECT * FROM package WHERE `status` = 'A'";

            $result = mysqli_query($conn,$sql_package);    
        }
       
        if (mysqli_num_rows($result) > 0 ) {
            $count = 0;
            while($row = mysqli_fetch_assoc($result)){
                $pack_id = $row["package_id"];

                if ($count % 2 == 0) {
                    echo '<div class="row">';
                } ?>
                
                <div class="col-md-6">
                    <div class="card" style="width: 100%;">
                        <img src="<?php echo $row['package_img'] ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"> <?php echo $row["package_name"]; ?> </h5>
                            <p class="card-text"><?php echo substr($row["description"], 0, 130)."..."; ?> </p>
                            <a href="index_backend.php?id_value=<?php echo $pack_id; ?>&&packageview=access" class="btn btn-primary">Book</a>
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
</body>
<script src="../js/bootstrap.js"></script>
</html>