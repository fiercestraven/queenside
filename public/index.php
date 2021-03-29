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

    <!-- jumbo -->
    <div class="jumbotron img-responsive" id="my-jumbo">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 offset-md-2" id="my-jumbo-text">
                    <h2>Welcome</h2>
                    <p></p>
                    <p>Queenside is a site dedicated to highlighting the achievements of women in chess. Here,
                        you'll
                        find information on top players from around the world. Search for players, filter and sort
                        the results,
                        and view players in detail. Fancy yourself a future chess star? Head to the <a
                            href="outpost.php">Outpost</a> to find out which players are most
                        like you, pit countries against each other, and have a go at some chess trivia.</p>
                </div>
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