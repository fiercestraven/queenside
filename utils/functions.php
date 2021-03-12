<?php
    function checkauth($user, $pw, $conn) {
    
        $checkuser = "SELECT * FROM twcp_users WHERE username='$user' AND password=MD5('$pw')";
    
        $userresult = $conn->query($checkuser);

        return $userresult;
    }

    function checksessionuser() {
        session_start();

        if (!isset($_SESSION['admin_40275431'])) {
            echo "<h2>Invalid login</h2>";
            header("Location: login.php");
        }
    }

    function create_discover_card($player) {
        $name = htmlspecialchars($player['name']);
        $fed = htmlspecialchars($player['country_name']);
        $birth = $player['birth_year'] ?? 'Unknown';
        $title = htmlspecialchars($player['full_title']) ?? '';
        $ratingstd = $player['rating_standard'] ?? '--';
        $fide = $player['fide_id'];

        return "<div class='col'>
            <div class='card h-100'>     
                <a class='card-link my-discover-card' href='playerdetail.php?id=$fide'>
                    <img class='img-responsive card-img-top my-card-icon' src='img/playerimage.jpg' alt='collage of six female chess players'>
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
    
?>