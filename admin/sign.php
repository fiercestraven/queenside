<?php
    session_start();
    include('../db.php');
    include('../utils/functions.php');

    $user = $_POST["username"];
    $pw = $_POST["pass"];

    $result = checkauth($user, $pw, $conn);

    if(!$result) {
        echo $conn->error;
    } else {
        $num = $result->num_rows;
    }
    if($num>0) {
        $_SESSION['admin_40275431'] = $user;
        header("Location: admin.php");
    } else {
        header("Location: login.php?error"); 
    }
?>