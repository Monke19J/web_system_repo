<html>
<head>
    <meta charset="UTF-8">
    <title>Registration</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>

<body class="register">
    <div class="container">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <?php
                if (isset($_GET["error"])) {
                    if ($_GET["error"] == "accexists") { ?>
                        <div class="alert alert-danger">An account already exist!!! </div>
                <?php }
                    elseif ($_GET["error"] == "passmismatch") { ?>
                        <div class="alert alert-danger">Password and Confirmation Password do not match </div>
                <?php } 
                    elseif ($_GET["error"] == "notallowed") { ?>
                        <div class="alert alert-danger">Fuck you</div>
                <?php }
                }
                ?>
            </div>
            <div class="col-3"></div>
        </div>
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4">
                <h1>Registration</h1>
            </div>
            <div class="col-4"></div>
        </div>
        <br>

        <div class="row">
            <div class="col-4">
                <img src="gigachad.jpeg" alt="picture in selwyn" height="250">
                <h2>Register ka na Pogi</h2>
            </div>
            <div class="col-4">
                <form action="register.php" method="post">
                    <div class="mb-3">
                        <label for="lastname">Last Name
                            <input type="text" id="lastname" class="form-control" name="lastname" required>
                        </label>
                    </div>

                    <div class="mb-3">
                        <label for="firstname">First Name
                            <input type="text" id="firstname" class="form-control" name="firstname" required>
                        </label>
                    </div>

                    <div class="mb-3">
                        <label for="middlename">Middle Name
                            <input type="text" id="middlename" class="form-control" name="middlename" required>
                        </label>
                    </div>

                    <div class="mb-3">
                        <label for="address">Address
                            <input type="text" id="address" class="form-control" name="address" required>
                        </label>
                    </div>

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
                        <label for="pass2">Confirm Password
                            <input type="Password" id="pass2" class="form-control" name="pass2" required>
                        </label>
                    </div>

                    <div class="mb-3">
                        <input type="submit" class="btn btn-danger" name="submit">
                        <a href="index.php" class="btn btn-primary text-white">Back</a>
                    </div>
                </form>
            </div>
            <div class="col-4">
                <img src="gigachad.jpeg" alt="picture in selwyn" height="250">
                <h2>Register ka na Pogi</h2>
            </div>
        </div>
    </div>
</body>
<script src="js/bootstrap.js"></script>

</html>