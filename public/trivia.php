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

    <!-- content -->
    <div class="container my-container">
        <div class="row">
            <div class="col-md-3">
                <img src="img/outpostLogo.png" alt="an icon of a pawn with the words The Outpost" id="outpost-logo">
            </div>
            <div class="col-md-9">
                <h2>Test Yourself</h2>
                <p>So you think you know a thing or two?</p>
                <p>Take the grandmaster trivia quiz!</p>
            </div>
        </div>       
        
        <form action="triviaans.php" method="post">
            <p class="question"><strong>Q1</strong>: Which Federation (country) is the top-ranking
                female Grandmaster (GM) from?</p>
            <!-- ans a -->
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="one" id="q1r1"
                    value="option1">
                <label class="form-check-label" for="q1r1">Scotland</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="one" id="q1r2"
                    value="option2">
                <label class="form-check-label" for="q1r2">India</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="one" id="q1r3"
                    value="option3">
                <label class="form-check-label" for="q1r3">Georgia</label>
            </div>

            <p class="question"><strong>Q2</strong>: What is the average blitz rating score of all Woman
                Grandmasters (WGM)?</p>
            <!-- ans c, 1925 -->
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="two" id="q2r1"
                    value="option1">
                <label class="form-check-label" for="q2r1">2205</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="two" id="q2r2"
                    value="option2">
                <label class="form-check-label" for="q2r2">2015</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="two" id="q2r3"
                    value="option3">
                <label class="form-check-label" for="q2r3">1925</label>
            </div>

            <p class="question"><strong>Q3</strong>: When was the oldest active Woman Grandmaster (WGM)
                born?</p>
            <!-- ans b FIDE ID 14561 -->
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="three" id="q3r1"
                    value="option1">
                <label class="form-check-label" for="q3r1">1946</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="three" id="q3r2"
                    value="option2">
                <label class="form-check-label" for="q3r2">1938</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="three" id="q3r3"
                    value="option3">
                <label class="form-check-label" for="q3r3">1961</label>
            </div>

            <p class="question"><strong>Q4</strong>: How many Woman Grandmasters are there in India?</p>
            <!-- c -->
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="four" id="q4r1"
                    value="option1">
                <label class="form-check-label" for="q4r1">20</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="four" id="q4r2"
                    value="option2">
                <label class="form-check-label" for="q4r2">52</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="four" id="q4r3"
                    value="option3">
                <label class="form-check-label" for="q4r3">11</label>
            </div>

            <p class="question"><strong>Q5</strong>: What year was the youngest Woman Grandmaster born?
            </p>
            <!-- c FIDE ID 34127035-->
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="five" id="q5r1"
                    value="option1">
                <label class="form-check-label" for="q5r1">2002</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="five" id="q5r2"
                    value="option2">
                <label class="form-check-label" for="q5r2">2007</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="five" id="inlineRadio3"
                    value="q5r3">
                <label class="form-check-label" for="q5r3">2004</label>
            </div>

            <div>
                <p></p>
                <button class="btn btn-secondary" type="submit">Submit</button>
            </div>

        </form>


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