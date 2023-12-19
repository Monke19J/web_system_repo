<?php
    define("BR", "<br>");

    if (isset($_POST["lastname"])) {
        include("db.php");
        $lastname = $_POST["lastname"];
        $firstname = $_POST["firstname"];
        $midname = $_POST["middlename"];
        $address = $_POST["address"];
        $uname = $_POST["uname"];
        $pass = $_POST["pass1"];
        $confirm_pass = $_POST["pass2"];

        if ($pass != $confirm_pass) {
            header("location: registration.php?error=passmismatch");
            die();
        }

        $get_table = "SELECT * FROM users WHERE username = '$uname'";
        $result = mysqli_query($conn, $get_table);

        if (mysqli_num_rows($result) > 0) {
            header("location: registration.php?error=accexists");
            die();
        } 
        else {
            $sql_insert_user = "INSERT INTO users (last_name, first_name, middle_name, address, username, password)
                                                    VALUES ('$lastname','$firstname','$midname','$address','$uname','$pass')";

            mysqli_query($conn, $sql_insert_user);

            header("location: index.php?msg=success");
        }
    } else {
        header("location: registration.php?error=notallowed");
        die();
    }
?>
