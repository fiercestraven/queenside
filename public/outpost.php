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

    <!-- accordion -->
    <!-- <div class="accordion">
            <div class="accordion-item" id="triviaAccordion">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Trivia
                    </button>
                </h2> -->
    <!-- trivia -->
    <!-- <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="trivia"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <h4>So you think you know a thing or two?</h4>
                        <h5>Take the grandmaster trivia quiz!</h5>
                        <form>
                            <p class="question"><strong>Q1</strong>: Which Federation (country) is the top-ranking
                                female Grandmaster (GM) from?</p> -->
    <!-- ans a -->
    <!-- <div class="form-check form-check-inline">
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
                            </div> -->

    <!-- <p class="question"><strong>Q2</strong>: What is the average blitz rating score of all Woman
                                Grandmasters (WGM)?</p> -->
    <!-- ans unknown, dummy data -->
    <!-- <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="two" id="q2r1"
                                    value="option1">
                                <label class="form-check-label" for="q2r1">2205</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="two" id="q2r2"
                                    value="option2">
                                <label class="form-check-label" for="q2r2">2092</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="two" id="q2r3"
                                    value="option3">
                                <label class="form-check-label" for="q2r3">2431</label>
                            </div>

                            <p class="question"><strong>Q3</strong>: When was the oldest active Woman Grandmaster (WGM)
                                born?</p> -->
    <!-- ans b FIDE ID 14561 -->
    <!-- <div class="form-check form-check-inline">
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
                            </div> -->

    <!-- <p class="question"><strong>Q4</strong>: How many Woman Grandmasters are there in India?</p> -->
    <!-- c -->
    <!-- <div class="form-check form-check-inline">
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
                            </div> -->

    <!-- <p class="question"><strong>Q5</strong>: What year was the youngest Woman Grandmaster born?
                            </p> -->
    <!-- c FIDE ID 34127035-->
    <!-- <div class="form-check form-check-inline">
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
                                <button type="submit">Submit</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div> -->

    <!-- country vs country -->
    <!-- <div class="accordion-item" id="countryAccordion">
                <h2 class="accordion-header my-accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Country vs Country
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="country vs country"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <h4>Head to Head</h4>
                        <h5>Pick two, any two.</h5>
                    </div>
                </div>
            </div> -->

    <!-- queen me -->
    <!-- <div class="accordion-item" id="queenAccordion">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Queen Me
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="queen me"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <h4>Find yourself!</h4>
                        <p>If you were a chess queen, who would you be?</p>
                        <form> -->
    <!-- Federation -->
    <!-- <div class="row mb-3">
                                <label for="inputHomeCountry" class="col-sm-2 col-form-label">Enter your home country:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="e.g., Chile"
                                        id="inputHomeCountry">
                                </div>
                            </div> -->

    <!-- Birth Year -->
    <!-- <div class="row mb-3">
                                <label for="inputBirthYear" class="col-sm-2 col-form-label">Enter your birth year:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="e.g., 1987"
                                        id="inputBirthYear">
                                </div>
                            </div> -->

    <!-- submission button -->
    <!-- <button type="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <!-- Footer -->
    <?php
    include("../_partials/footer.html");
    ?>

    <!-- JS Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

</body>

</html>