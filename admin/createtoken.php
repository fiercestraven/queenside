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

    echo "<div class='row my-box-text ms-1 mb-3'>
            <h4>Your API key:</h4>
            <p>$token</p>
            <p style = 'font-style: italic; color: red;'>Please retain this code. It will not be shown again.</p>
        </div>";
} else {
    header("Location: admin.php");
}
?>