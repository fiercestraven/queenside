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

    <!-- about text plus image -->
    <div class="container my-container">
        <div class="row">
            <div class="col-md-8">
                <h2>Welcome</h2>
                <p>Queenside is a site dedicated to highlighting the achievements of women in chess. Here, you'll find
                    information on top players from around the world. Fancy yourself a future chess star? Head to our <a
                        class="my-light-link" href="outpost.html">Outpost</a> to find out which players are most like
                    you, see countries match up head to head, and have a go with some chess trivia.</p>
                <p>Still have questions, or want to give us feedback? <span><a class="my-light-link"
                            href="mailto: 40275431@ads.qub.ac.uk">Contact Us.</a></span></p>
            </div>
            <div class="col-md-4">
                <img src="img/pjimage.jpg" class="img-responsive my-player-collage"
                    alt="a collage of women chess players">
            </div>
        </div>
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