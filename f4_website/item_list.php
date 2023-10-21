<?php
    include("db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row"></div>
        <div class="row"></div>
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
                <?php
                    $sql_item_list = "SELECT * FROM `items`";

                    $items_result = mysqli_query($conn, $sql_item_list);

                    
                ?>
            </div>
            <div class="col-2"></div>
        </div>
    </div>
</body>
</html>