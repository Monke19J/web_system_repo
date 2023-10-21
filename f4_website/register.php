
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="my.css">
    <title>register</title>
</head>
<body class="register">
    <div class="container">
            <br><br><br>
            <div class="row">
                <div class="col-4"></div>
                <div class="col-4 text-center">
                    <h1 class="font-control">Welcome <?php echo $_POST["uname"];  ?></h1>
                </div>
                <div class="col-4"></div>
            </div>

        <br>

        <div class="row">
            <div class="col-3"></div>
            <div class="col-6 text-center text-danger">
                <p class="fontbig">
                <?php
                    define("BR","<br>");

                    if(isset($_POST["fullname"])){
                        include("db.php");
                        $name = $_POST["fullname"];
                        $address = $_POST["address"];
                        $uname = $_POST["uname"];
                        $pass = $_POST["pass1"];
                        $confirm_pass = $_POST["pass2"];

                        

                        if($pass != $confirm_pass){
                            header("location: registration.php?error=passmismatch");
                            die();                    
                        }

                        $get_table = "SELECT * FROM users_register WHERE username = '$uname'";
                        $result = mysqli_query($conn, $get_table);

                        if(mysqli_num_rows($result) > 0){
                            header("location: registration.php?error=accexists");
                        }
                        else{
                            $sql_insert_user = "INSERT INTO users_register (fullname, address, username, password)
                                                                    VALUES ('$name','$address','$uname','$pass')";
                            
                            mysqli_query($conn, $sql_insert_user);

                            header("location: index.php?msg=success");

                        }
                    }
                    else{
                        header("location: registration.php?error=notallowed"); 
                    }  
                ?>
                </p>  
            </div>
            <div class="col-3"></div>
        </div>     
    </div>

</body>
</html>
