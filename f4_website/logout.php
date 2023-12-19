<?php
    session_start();
    session_unset();
    session_destroy();

    if(isset($_GET['error'])){
        if($_GET['error'] == 'denied'){
            header("location: index.php?error=invalid_entry");
            die();
        }
    }
    else {
        header("location: index.php");
        die();
    }
    
?>