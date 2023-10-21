<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="my.css">
</head>
<body>
    <div class="container">
        <br><br><br>
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <h1 class="font-control">Welcome <?php echo $_POST["uname"];  ?></h1>
            </div>
            <div class="col-3"></div>
        </div>

        <br>

        <div class="row">
            <div class="col-4"></div>
            <div class="col-4">
                <p class="fontbig">
                    <?php
                        define("BR","<br>");

                        echo "Your username is ".$_POST["uname"].BR;
                        echo "Your password is ".$_POST["pass1"].BR;
                    ?>
                </p>  
            </div>
            <div class="col-4"></div>
        </div>     
    </div>
</body>
</html>

