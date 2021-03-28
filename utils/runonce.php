<?php
    include("../db.php");

    $file = "../data/top_women_chess_players_2020.csv";
    $filepath = fopen($file, "r");
    //read and discard the header line
    fgetcsv($filepath);
    
    while(($line = fgetcsv($filepath)) !== FALSE) {
        $fideid = $conn->real_escape_string($line[0]);
        $playername = $conn->real_escape_string($line[1]);
        $federation = $conn->real_escape_string($line[2]);
        $birthyear = $line[4] ? "'" . $conn->real_escape_string($line[4]) . "'" : "NULL";
        $title = $line[5] ? "'" . $conn->real_escape_string($line[5]) . "'" : "NULL";
        $ratingstd = $line[6] ? "'" . $conn->real_escape_string($line[6]) . "'" : "NULL";
        $ratingrap = $line[7] ? "'" . $conn->real_escape_string($line[7]) . "'" : "NULL";
        $ratingblitz = $line[8] ? "'" . $conn->real_escape_string($line[8]) . "'" : "NULL";
        $inactive = (int)($line[9] == 'wi');

        //set up image urls from unsplash api
        $endpt = "https://api.unsplash.com/photos/random?query=woman-face&orientation=landscape&client_id={$SECRETS['unsplash']}";
        $jresult = file_get_contents($endpt);
        $data = json_decode($jresult, true);
        //set up random var for image api results
        // $random = array_rand($data['results']);
        $imgurl = $data['urls']['thumb'];

        $insertsql = "INSERT INTO top_women_chess_players (fide_id,name,federation,birth_year,title,rating_standard,rating_rapid,rating_blitz,inactive,img_url) VALUES ('$fideid','$playername','$federation',$birthyear,$title,$ratingstd,$ratingrap,$ratingblitz,'$inactive','$imgurl')";

        echo $imgurl;

        // $result = $conn->query($insertsql);

        // if(!$result) {
        //     echo $conn->error;
        //     die();
        // }
    }

?>