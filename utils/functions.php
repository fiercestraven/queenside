<?php
    function checkauth($user, $pw, $conn) {
    
        $checkuser = "SELECT * FROM twcp_users WHERE username='$user' AND password=MD5('$pw')";
    
        $userresult = $conn->query($checkuser);

        return $userresult;
    }
?>