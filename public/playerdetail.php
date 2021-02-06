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

    <!-- player info -->
    <div class="card mb-3 my-card" style="max-width: 800px;">
        <div class="row g-0">
            <div class="col-md-4">
                <img class="img-responsive my-profile-icon" src="img/Chess_qlt45.svg" alt="icon of a chess queen">
            </div>
            <div class="col-md-8">
                <!-- player name -->
                <div class="card-header my-card-header">Humpy Koneru</div>
                <div class="card-body">
                    <!-- other player info -->
                    <p class="card-text">Status: <span class="my-player-status">Active</span></p>
                    <p class="card-text">Federation: India</p>
                    <p class="card-text">Birth Year: 1987</p>
                    <p class="card-text">Title: Grandmaster</p>
                    <!-- rating stats -->
                    <div class="container">
                        <div class="row">
                            <div class="col-sm my-ratings">
                                Std Rating: 2586
                            </div>
                            <div class="col-sm my-ratings">
                                Rapid Rating: 2483
                            </div>
                            <div class="col-sm my-ratings">
                                Blitz Rating: 2483
                            </div>
                        </div>
                    </div>
                    <!-- link to FIDE profile -->
                    <p class="card-text mt-2"><small class="text-muted">FIDE ID: <a
                                href="https://newratings.fide.com/profile/5008123" class="my-light-link"
                                target="_blank">5008123</a></small></p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- link to go back to player list -->
    <div class="container my-card-return">
        <a href="players.html" class="my-light-link">&laquo; Return to player list</a>
    </div>

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