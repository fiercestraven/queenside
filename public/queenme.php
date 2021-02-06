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
                <h2>Find yourself!</h2>
                <p>If you were a chess queen, who would you be?</p>
            </div>
        </div>       
        
        <form>
            <!-- Federation -->
            <div class="row mb-3">
                <label for="inputHomeCountry" class="col-sm-2 col-form-label">Enter your home country:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="e.g., Chile"
                        id="inputHomeCountry">
                </div>
            </div>

            <!-- Birth Year -->
            <div class="row mb-3">
                <label for="inputBirthYear" class="col-sm-2 col-form-label">Enter your birth year:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="e.g., 1987"
                        id="inputBirthYear">
                </div>
            </div>

            <!-- submission button -->
            <button type="submit">Submit</button>
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