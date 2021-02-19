<?php
    session_start();
    include('../db.php');

    $user = $_POST["username"];
    $pw = $_POST["pass"];

    $usercheck = "SELECT * FROM twcp_users WHERE username='$user' AND password=MD5('$pw')";

    $result = $conn->query($usercheck);

    if(!$result) {
        echo $conn->error;
    } else {
        $num = $result->num_rows;
    }
    if($num>0) {
        $_SESSION['admin_40275431'] = $user;
        header("Location: admin.php");
    } else {
        header("Location: login.php");
    }
?>