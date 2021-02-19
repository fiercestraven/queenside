<?php
    session_start();
    if(!isset($_SESSION["admin_40275431"])){
        //fix to redirect to popup box
        header("Location: login.php");
    }else{
        unset($_SESSION["admin_40275431"]);
        header("Location: login.php");
        echo "You have successfully logged out.";
    }
?>


