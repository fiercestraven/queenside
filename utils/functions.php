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
    //set up image api
    // $endpt = "https://api.unsplash.com/search/photos?query=woman-face&orientation=landscape&per_page=30&client_id={$SECRETS['unsplash']}";
    // $jresult = file_get_contents($endpt);
    // $data = json_decode($jresult, true);
    // $random = array_rand($data['results']);
    // $img = $data['results'][$random]['urls']['thumb'];

    $name = htmlspecialchars($player['name']);
    $fed = htmlspecialchars($player['country_name']);
    $birth = $player['birth_year'] ?? 'Unknown';
    $title = htmlspecialchars($player['full_title']) ?? '';
    $ratingstd = $player['rating_standard'] ?? '--';
    $fide = $player['fide_id'];
    // FIXME add below line in and delete empty string img var
    // $img = $player['img_url'];
    $img = '';

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
