<?php
include("db.php");
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <?php
                    if (isset($_GET["msg"])) {
                        if ($_GET["msg"] == "success") { ?>
                            <div class="alert alert-primary">You have created you account successfully</div>
                <?php   }
                    }
                    if (isset($_GET["error"])) {
                        if ($_GET["error"] == "invalid_input") { ?>
                            <div class="alert alert-danger">Invalid Username or Password</div>
                <?php   }
                        elseif($_GET["error"] == "invalid_entry"){ ?>
                            <div class="alert alert-danger">Force of Entry Detected</div>
                <?php   }
                        elseif($_GET["error"] == "404"){ ?>
                            <div class="alert alert-danger">No User_type found</div>
                <?php   }
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
                        <label class="form-label" for="uname">Username
                            <input type="text" id="uname" class="form-control" name="uname" required>
                        </label>
                    </div>

                    <div class="mb-3">
                        <label for="pass" class="form-label">Password
                            <input type="Password" id="pass" class="form-control" name="pass" required>
                        </label>
                    </div>

                    <div class="mb-3">
                        <input type="submit" class="btn btn-primary" name="submit">
                        <a href="registration.php" class="btn btn-success text-white">Create Account</a>
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