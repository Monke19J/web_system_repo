<?php
session_start();
$user_id = $_SESSION["user_id"];
session_unset();

$_SESSION["user_id"] = $user_id;

if($_GET["success"]){
    header("location: index.php?msg=success");
    die();
}
header("location: index.php");
?>