<?php
session_start();
include("../db.php");

if(isset($_GET["back"])){
    $user_id = $_SESSION["user_id"];
    session_unset();

    $_SESSION["user_id"] = $user_id;
    header("location: index.php");
    die();
}

if(empty($_GET["packageview"])){
    header("location: index.php?error=illegal_access");
    die();
}

$_SESSION["package_id"] = $_GET["id_value"];
$_SESSION["packageview"] = $_GET["packageview"];

$id_value = $_SESSION["package_id"];

$get_package = "SELECT * FROM package WHERE package_id = '$id_value'";
$package_result = mysqli_query($conn, $get_package);
if (mysqli_num_rows($package_result) == 0) {
    header("location: reset_session.php");
    die();
}
     
$row = mysqli_fetch_assoc($package_result); 

$_SESSION["package_name"] = $row["package_name"];
$_SESSION["description"] = $row["description"];
$_SESSION["package_type"] = $row["type_of_package"];
$_SESSION["pack_combopackage"] = $row["combopackage_id"];
$_SESSION["price"] = $row["package_cost"];

header("location: packageview.php");
?>