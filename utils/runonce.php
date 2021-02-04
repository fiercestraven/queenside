<?php
   include("db.php"); 

    // echo "<p>This is my script.</p>";

    $file = "top_women_chess_players_2020.csv";
    $filepath = fopen($file, "r");
    //read and discard the header line
    fgetcsv($filepath);
    
    while(($line = fgetcsv($filepath)) !== FALSE) {
        // echo "<p>{$line[0]}</p>";

        // $productname = $conn->real_escape_string($_POST['guitar_name']);
        $fideid = $conn->real_escape_string($line[0]);
        $playername = $conn->real_escape_string($line[1]);
        $federation = $conn->real_escape_string($line[2]);
        $birthyear = $line[4] ? "'" . $conn->real_escape_string($line[4]) . "'" : "NULL";
        $title = $line[5] ? "'" . $conn->real_escape_string($line[5]) . "'" : "NULL";
        $ratingstd = $line[6] ? "'" . $conn->real_escape_string($line[6]) . "'" : "NULL";
        $ratingrap = $line[7] ? "'" . $conn->real_escape_string($line[7]) . "'" : "NULL";
        $ratingblitz = $line[8] ? "'" . $conn->real_escape_string($line[8]) . "'" : "NULL";
        $inactive = (int)($line[9] == 'wi');

        // echo "<p>INSERT INTO top_women_chess_players (fide_id,name,federation,birth_year,title,rating_standard,rating_rapid,rating_blitz,inactive) VALUES ('$fideid','$playername','$federation','$birthyear','$title','$ratingstd','$ratingrap','$ratingblitz','$inactive')</p>";

        $insertsql = "INSERT INTO top_women_chess_players (fide_id,name,federation,birth_year,title,rating_standard,rating_rapid,rating_blitz,inactive) VALUES ('$fideid','$playername','$federation',$birthyear,$title,$ratingstd,$ratingrap,$ratingblitz,'$inactive')";

        //to add results from another table...
        // $insertsql2 = "INSERT INTO federations () VALUES ()";

        $result = $conn->query($insertsql);

        if(!$result) {
            echo $conn->error;
            die();
        }
    }
?>