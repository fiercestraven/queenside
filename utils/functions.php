<?php
//checks authorization and password against the database
function checkauth($user, $pw, $conn)
{

    $checkuser = "SELECT * FROM twcp_users WHERE username='$user' AND password=MD5('$pw')";

    $userresult = $conn->query($checkuser);

    return $userresult;
}

//checks if the admin user session is set and otherwise returns to login page
function checksessionuser()
{
    session_start();

    if (!isset($_SESSION['admin_40275431'])) {
        echo "<h2>Invalid login</h2>";
        header("Location: login.php");
        die();
    }
}

//returns true or false depending if the api key exists in the database
function authorized($conn, $apikey) {
    if (!$apikey) {
        return false;
    } else {
        $apikey = MD5($apikey);
        $sql = "SELECT *
                    FROM twcp_users
                    WHERE apikey = '$apikey'";
        $result = $conn->query($sql);

        if ($result->num_rows == 0) {
            return false;
        } else {
            return true;
        }
    }
}

//creates player card in the style of the discover page
function create_discover_card($player) {
    include('../secrets.php');
    // FIXME
    //$endpt = "https://api.unsplash.com/search/photos?query=woman-face&orientation=landscape&per_page=30&client_id={$SECRETS['unsplash']}";
    // $jresult = file_get_contents($endpt);
    // $data = json_decode($jresult, true);
    // $random = array_rand($data['results']);
    // $img = $data['results'][$random]['urls']['thumb'];

    $name = htmlspecialchars($player['name']);
    $fed = htmlspecialchars($player['country_name']);
    $birth = $player['birth_year'] ?? 'Unknown';
    $title = htmlspecialchars($player['full_title'] ?? '');
    $ratingstd = $player['rating_standard'] ?? '--';
    $fide = $player['fide_id'];
    $imgurl = htmlspecialchars($player['img_url'] ?? '');
    if ($imgurl == '') {
        //set up image api 
        $endpt = "https://api.unsplash.com/photos/random?query=woman-face&orientation=landscape&client_id={$SECRETS['unsplash']}";
        $jresult = file_get_contents($endpt);
        $data = json_decode($jresult, true);
        $img = $data['urls']['thumb'];
    } else {
        $img = $imgurl;
    }

    return "<div class='col'>
            <div class='card h-100'>     
                <a class='card-link my-discover-card' href='playerdetail.php?id=$fide'>
                    <img class='img-responsive card-img-top my-card-icon' src='$img' alt='randomised image of a woman's face'>
                    <!-- player info -->
                    <div class='card-body'>
                        <p class='my-card-header'>$name</p>
                        <p class='my-card-text'>Federation: $fed</p>
                        <p class='my-card-text'>Birth Year: $birth</p>
                        <p class='my-card-text'>Title: $title</p>
                        <p class='my-card-text'>Standard Rating: $ratingstd</p>
                    </div>
                </a>
            </div>
        </div>";
}

//creates player card in the style of the player detail page
function create_player_card($player) {
    include('../secrets.php');

    $name = htmlspecialchars($player['name']);
    $inactive = $player['inactive'];
    $fed = htmlspecialchars($player['country_name']);
    $birth = $player['birth_year'] ?? 'Unknown';
    $title = htmlspecialchars($player['full_title'] ?? '');
    $ratingstd = $player['rating_standard'] ?? '--';
    $ratingrap = $player['rating_rapid'] ?? '--';
    $ratingblitz = $player['rating_blitz'] ?? '--';
    $fide = $player['fide_id'];
    $imgurl = htmlspecialchars($player['img_url'] ?? '');

    if ($imgurl == '') {
        //set up image api 
        $endpt = "https://api.unsplash.com/photos/random?query=woman-face&orientation=landscape&client_id={$SECRETS['unsplash']}";
        $jresult = file_get_contents($endpt);
        $data = json_decode($jresult, true);
        $img = $data['urls']['thumb'];
    } else {
        $img = $imgurl;
    }

    //set up inactive return messages
    if($inactive) {
        $status = "<span class='my-player-inactive'>Withdrawn</span></p>";
    } else {
        $status = "<span class='my-player-active'>Active</span></p>";
    }

    // card creation
    return "<div class='card mb-3 my-detail-card'>
        <div class='row g-0'>
            <div class='col-md-4'>
                <img class='img-responsive my-profile-icon' src=$img alt='icon of a chess queen'>
            </div>
            <div class='col-md-8'>
                <!-- player name -->
                <div class='card-header my-card-header'>$name</div>
                <div class='card-body'>
                    <!-- other player info -->
                    <p class='card-text'>Status: $status </p>
                    <p class='card-text'>Federation: $fed</p>
                    <p class='card-text'>Birth Year: $birth</p>
                    <p class='card-text'>Title: $title</p>
                    <!-- rating stats -->
                    <div class='container'>
                        <div class='row'>
                            <div class='col-sm my-ratings'>
                                Std Rating: $ratingstd
                            </div>
                            <div class='col-sm my-ratings'>
                                Rapid Rating: $ratingrap
                            </div>
                            <div class='col-sm my-ratings'>
                                Blitz Rating: $ratingblitz
                            </div>
                        </div>
                    </div>
                    <!-- link to FIDE profile -->
                    <p class='card-text mt-2'><small class='text-muted'>FIDE ID: <a
                                href='https://ratings.fide.com/profile/$fide' class='my-light-link'
                                target='_blank'>$fide</a></small></p>
                </div>
            </div>
        </div>
    </div>";
}