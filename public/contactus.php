<?php

include('../db.php');

//create local variables-- no real_escape_string needed due to prepare/bind steps below
$username = $_POST['uname'] ?? NULL;
$useremail = $_POST['email'];
$usermessage = $_POST['message'];

$stmt = $conn->prepare("INSERT INTO twcp_messages (name, email, message) 
VALUES (?, ?, ?)");

$stmt->bind_param("sss", $username, $useremail, $usermessage);

$stmt->execute();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
        include("../_partials/head.html");
    ?>
</head>

<body>
    <!-- logo and nav -->
    <?php
        include("../_partials/nav.html");
    ?>

    <!-- return message after form submission -->
    <?php
    if($stmt->error){
        echo $stmt->error;
        die();
    }else{
        echo "<div class='m5 container my-container my-thanks'>
                    <h1 class='my-response'>Thanks for your message!</h1>
                    <p>Someone will be in touch shortly.</p>
            </div>";
    }
    ?>

    <!-- Footer -->
    <?php
        include("../_partials/footer.html");
    ?>  

    <!-- JS Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
        crossorigin="anonymous"></script>

</body>

</html>