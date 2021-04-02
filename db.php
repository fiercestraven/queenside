<?php
    include('secrets.php');

    $host = "fveit01.lampt.eeecs.qub.ac.uk";
    $username = "fveit01";
    $passw = $SECRETS['dbpw'];
    $db = "fveit01";
 
    $conn = new mysqli($host, $username, $passw, $db);
 
    if($conn->connect_error){
        echo "not connected".$conn->connect_error;
    }else{
       // echo "connection to DB found.";
    }
?>
