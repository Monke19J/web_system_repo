<?php
    include("db.php");
    session_start();

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
                $_SESSION["user_id"] = $row["user_id"];
                header("location: users/index.php");
            }
            elseif($row["user_type"] == 'A'){
                $_SESSION["user_id"] = $row["user_id"];
                header("location: admin/index.php");
            }
            else{
                header("location: index.php?error=404");
            }
        }
        else{
            header("location: index.php?error=invalid_input");
            die();
        }
    }
    else{
        header("location: index.php?error=invalid_entry");
        die();
    }
?>