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
                <h2>Country vs Country</h2>
                <p>Pick two, any two!</p>
                <p>How does one country stack up against another? Find out in the country vs country showdown. Select any two countries to put their best women chess players head to head, and see whose average score comes out on top.
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