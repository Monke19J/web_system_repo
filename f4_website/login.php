<?php
include("db.php");

if(isset($_POST["uname"])){
    $uname = $_POST["uname"];
    $pword = $_POST["pass"];

    $sql_check_user = "SELECT * FROM users 
                        WHERE username = '$uname' 
                        AND password = '$pword'";
    $users_result = mysqli_query($conn, $sql_check_user);

    if(mysqli_num_rows($users_result) == 1){
        $row = mysqli_fetch_assoc($users_result);
        
        if($row["user_type"] == 'U'){
            header("location: users/index.php");
        }
        elseif($row["user_type"] == 'A'){
            header("location: admin/index.php");
        }
        else{
            header("location: index.php?error=nomatch");
        }
    }
}
else{
    header("location: index.php?error=404");
}
?>