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
    include("../_partials/nav.php");
    ?>

    <!-- begin content + about/welcome section -->
    <div class="container my-container">
        <div class="row">
            <div class="col-md-3 mt-4">
                <a href="outpost.php">
                    <img src="img/outpostLogo.png" alt="an icon of a pawn with the words The Outpost" id="outpost-logo">
                </a>
            </div>
            <div class="col-md-9 my-3">
                <h2>Welcome to the Outpost</h2>
                <p></p>
                <p>Did you know? An outpost is a term for a chess piece that's placed nice and close to your opponent in such a way that it's difficult for them to remove. We hope you'll stick around and explore a bit more about the women powerhouses of chess. Here you'll find trivia to test your wits, a chance to pit one country head to head with another, and the opportunity to see yourself in the chess world.</p>
            </div>
        </div>

        <!-- outpost options -->
        <a class="my-dark-link my-outpost-link" id="my-trivia-link" href="trivia.php">Trivia</a>
        <a class="my-dark-link my-outpost-link" id="my-country-link" href="countryshowdown.php">Country vs Country</a>
        <a class="my-dark-link my-outpost-link" id="my-queen-link" href="queenme.php">Queen Me!</a>
    </div>

    <!-- Footer -->
    <?php
    include("../_partials/footer.html");
    ?>

    <!-- JS Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

</body>

</html>