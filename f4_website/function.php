<?php
    // for register.php
    function insert_database($name,$address,$uname,$pass,$confirm_pass){
        include("db.php");
        define("BR","<br>");

        $sql_insert_user = "INSERT INTO users_register (fullname, address, username, password)
                VALUES ('$name','$address','$uname','$pass')";

        try{
            mysqli_query($conn, $sql_insert_user);
        }
        catch(mysqli_sql_exception){
            echo "Invalid Input!!!".BR;
            die();
        }
                                
        echo "Your Fullname is ". $name.BR;
        echo "Your Address is ". $address.BR;
        echo "Your Username is ". $uname.BR;
        echo "Your Password is ". $pass.BR;

                        
        mysqli_close($conn);
    }

    //login
    function check_duplicate($username){
        include("db.php");

        $get_table = "SELECT * FROM users_register WHERE username = '$username'";
        $result = mysqli_query($conn, $get_table);

        return mysqli_num_rows($result) > 0;
        mysqli_close($conn);
    }
?>