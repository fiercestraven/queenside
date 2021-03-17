<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('../utils/functions.php');
    include('../db.php');

    checksessionuser();

    $token = bin2hex(random_bytes(16));
    $hashedtoken = MD5($token);
    $user = $_SESSION['admin_40275431'];

    $sql = "UPDATE twcp_users 
            SET apikey = ?
            WHERE username = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $hashedtoken, $user);
    $stmt->execute();

    echo $token;
} else {
    header("Location: admin.php");
}
?>