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

    $answer1 = $_POST['one'] ?? NULL;
    $answer2 = $_POST['two'] ?? NULL;
    $answer3 = $_POST['three'] ?? NULL;
    $answer4 = $_POST['four'] ?? NULL;
    $answer5 = $_POST['five'] ?? NULL;

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
    <div class="container my-container my-outpost-container">
        <div class="row">
            <div class="col-md-3">
                <img src="img/outpostLogo.png" alt="an icon of a pawn with the words The Outpost" id="outpost-logo">
            </div>
            <div class="col-md-9">
                <h2>Well, well, well.... how did you do?</h2>
                <?php
                switch ($totalCorrect) {
                    case 0:
                        echo "<p class='my-trivia-result'>You scored $totalCorrect / 5. OUCH. Study up.</p>";
                        break;
                    case 1:
                        echo "<p class='my-trivia-result'>You scored $totalCorrect / 5. Sleeping much?</p>";
                        break;
                    case 2:
                        echo "<p class='my-trivia-result'>You scored $totalCorrect / 5. Needs improvement, to say the least.</p>";
                        break;
                    case 3:
                        echo "<p class='my-trivia-result'>You scored $totalCorrect / 5. Them's the breaks!</p>";
                        break;
                    case 4:
                        echo "<p class='my-trivia-result'>You scored $totalCorrect / 5. Hey, not bad!</p>";
                        break;
                    case 5:
                        echo "<p class='my-trivia-result'>You scored $totalCorrect / 5. On fire!</p>";
                        break;
                    default:
                        echo "<p class='my-trivia-result'>Score not understood.</p>";
                        break;
                }
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