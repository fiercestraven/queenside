<?php
    function checkauth($user, $pw, $conn) {
    
        $checkuser = "SELECT * FROM twcp_users WHERE username='$user' AND password=MD5('$pw')";
    
        $userresult = $conn->query($checkuser);

        return $userresult;
    }

    function checksessionuser() {
        session_start();

        if (!isset($_SESSION['admin_40275431'])) {
            echo "Invalid login";
            header("Location: login.php");
        }
    }
?>