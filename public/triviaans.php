<?php
include("../_partials/head.html");
?>
</head>

<body>
    <!-- logo and nav -->
    <?php
    include("../_partials/nav.html");
    ?>

    <!-- calculate quiz results -->
    <?php

    $answer1 = $_POST['one'];
    $answer2 = $_POST['two'];
    $answer3 = $_POST['three'];
    $answer4 = $_POST['four'];
    $answer5 = $_POST['five'];

    $totalCorrect = 0;

    if ($answer1 == "option1") {
        $totalCorrect++;
    }
    if ($answer2 == "option3") {
        $totalCorrect++;
    }
    if ($answer3 == "option2") {
        $totalCorrect++;
    }
    if ($answer4 == "option3") {
        $totalCorrect++;
    }
    if ($answer5 == "option3") {
        $totalCorrect++;
    }

    ?>

    <!-- content -->
    <div class="container my-container">
        <div class="row">
            <div class="col-md-3">
                <img src="img/outpostLogo.png" alt="an icon of a pawn with the words The Outpost" id="outpost-logo">
            </div>
            <div class="col-md-9">
                <h2>Well, well, well....</h2>
                <p>How well do you know your chess trivia?</p>
                <?php
                echo "<div id='results'>$totalCorrect / 5 correct</div>";
                ?>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php
    include("../_partials/footer.html");
    ?>

    <!-- JS Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

</body>

</html>