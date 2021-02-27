<?php
include('../utils/functions.php');
checksessionuser();

include('../db.php');

    $sql = "SELECT * 
            FROM top_women_chess_players 
            LEFT JOIN twcp_federations USING (federation)
            LEFT JOIN twcp_titles USING (title)
            LIMIT 10";
    $result = $conn->query($sql);

    if(!$result) {
        http_response_code(404);
        die();
    } 
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
    include("../_partials/adminnav.html");
    ?>

    <!-- Filtering options for player listings -->
    <div class="container my-container">
        <div class="row">
            <?php
                echo "<p>Logged in as {$_SESSION['admin_40275431']}</p>";
            ?>
            <h1 class="admin-intro">Admin Player Search</h1>  
        </div>
        <div class="row">
            <div class="col-3">
                <button type="button" class="btn dropdown-toggle my-filter-button" data-bs-toggle="dropdown" aria-expanded="false">
                    Search Filters
                </button>
                <div class="dropdown-menu my-filter-menu">
                    <form class="px-4 py-3">
                        <div class="mb-3">
                            <!-- FIDE ID -->
                            <div class="row mb-3">
                                <label for="inputFIDE" class="col-sm-2 col-form-label">FIDE ID</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="e.g., 5000123" id="inputFIDE">
                                </div>
                            </div>

                            <!-- Player name -->
                            <div class="row mb-3">
                                <label for="inputPlayerName" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="Enter all or part of the player's name" id="inputPlayerName">
                                </div>
                            </div>

                            <!-- Federation -->
                            <div class="row mb-3">
                                <label for="inputFederation" class="col-sm-2 col-form-label">Federation</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="Player's home country" id="inputFederation">
                                </div>
                            </div>

                            <!-- Player title -->
                            <div class="row mb-3">
                                <label for="inputPlayerTitle" class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <select class="form-select" aria-label="Dropdown selection for player title">
                                        <option selected>Select</option>
                                        <option value="1">Grandmaster</option>
                                        <option value="2">Woman Grandmaster</option>
                                        <option value="3">International Master</option>
                                        <option value="4">International Arbiter</option>
                                        <option value="5">FIDE Arbiter</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Player status -->
                            <fieldset class="row mb-3">
                                <legend class="col-form-label col-sm-2 pt-0">Include inactive players?</legend>
                                <div class="col-sm-10">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="flexSwitchCheck" id="switch" value="option1">
                                    </div>
                                </div>
                            </fieldset>

                            <!-- Form submission -->
                            <button type="submit" class="btn btn-secondary">Apply</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Sorting options for player list -->
            <div class="col-6"></div>
            <div class="col-3">
                <button type="button" class="btn dropdown-toggle my-sort-button" data-bs-toggle="dropdown" aria-expanded="false">
                    Sort by
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="#">FIDE ID</a></li>
                    <li><a class="dropdown-item" href="#">Name</a></li>
                    <li><a class="dropdown-item" href="#">Federation</a></li>
                    <li><a class="dropdown-item" href="#">Birth Year</a></li>
                    <li><a class="dropdown-item" href="#">Title</a></li>
                    <li><a class="dropdown-item" href="#">Standard Rating</a></li>
                    <li><a class="dropdown-item" href="#">Rapid Rating</a></li>
                    <li><a class="dropdown-item" href="#">Blitz Rating</a></li>
                    <li><a class="dropdown-item" href="#">Active Status</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- player table, currently w/ dummy data -->
    <div class="container my-container">
        <h4>Internationally Ranked Women Chess Players</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">FIDE ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Federation (Country)</th>
                    <th scope="col">Birth Year</th>
                    <th scope="col">Chess Title</th>
                    <th scope="col">Standard Rating</th>
                    <th scope="col">Rapid Rating</th>
                    <th scope="col">Blitz Rating</th>
                    <th scope="col">Active</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($player = $result->fetch_assoc()) { 

                    $name = htmlspecialchars($player['name']);
                    $inactive = $player['inactive'];
                    $fed = htmlspecialchars($player['country_name']);
                    $birth = $player['birth_year'] ?? 'Unknown';
                    $title = htmlspecialchars($player['full_title']) ?? '';
                    $ratingstd = $player['rating_standard'] ?? '--';
                    $ratingrap = $player['rating_rapid'] ?? '--';
                    $ratingblitz = $player['rating_blitz'] ?? '--';
                    $fide = $player['fide_id'];
                    
                    echo "<tr>
                        <td>{$fide}</td>
                        <td><a class='my-light-link' href='playeredit.php?id={$fide}'>{$name}</a></td>
                        <td>{$fed}</td>
                        <td>{$birth}</td>
                        <td>{$title}</td>
                        <td>{$ratingstd}</td>
                        <td>{$ratingrap}</td>
                        <td>{$ratingblitz}</td>";
                        if($inactive) {
                            echo "<td>Withdrawn</td>";
                        } else {
                            echo "<td>Active</td>";
                        }
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- pagination: will implement when real data is present -->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-end">
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <!-- <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li> -->
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Footer -->
    <?php
    include("../_partials/footer.html");
    ?>

    <!-- JS Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

</body>

</html>