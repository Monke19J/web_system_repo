<?php
    include("db.php");
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="my.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
            <?php
                if(isset($_GET["msg"])){
                    if($_GET["msg"] == "success"){ ?>
                        <div class="alert alert-primary">You have created you account successfully</div>
                    <?php }
                }
            ?>  
            </div>
            <div class="col-3"></div>
        </div>
    
        <br>
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4">
                <h1>Login Here</h1>
            </div>
            <div class="col-4"></div>
        </div>
        <br><br>
        <div class="row">
            <div class="col-4">
                <img src="gigachad.jpeg" alt="picture in selwyn">
                <h2>Hello Pogi</h2>
            </div>
            <div class="col-4">
                <form action="login.php" method="post">

                    <div class="mb-3">
                        <label for="uname">Username
                            <input type="text" id="uname" class="form-control" name="uname" required>
                        </label>
                    </div>

                    <div class="mb-3">
                        <label for="pass1">Password
                            <input type="Password" name="pass1" class="form-control" name="pass1" required>
                        </label>
                    </div>

                    <div class="mb-3">
                        <input type="submit" class="btn btn-primary" name="submit">
                        <button class="btn btn-success"><a href="registration.php" class="text-white">Create Account</a></button>
                    </div>
                </form>
                
            </div>
            <div class="col-4">
                <img src="gigachad.jpeg" alt="picture in selwyn">
                <h2>Hello Pogi</h2>
             </div>
        </div>
    </div>
</body>
    <script src="js/bootstrap.js"></script>
</html>