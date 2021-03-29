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

    <!-- contact us form -->
    <div class="card mb-3 my-card" style="max-width: 800px;">
        <div class="row g-0">
            <div class="col-md-9">
                <div class="card-body">
                    <h2 class="card-title">Contact Us</h2>
                    <form action="action_page.php">
                        <div class="row mb-3">
                            <label for="inputName" class="col-sm-2 col-form-label">Your Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="First and last name"
                                    id="inputName">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputEmail" class="col-sm-2 col-form-label">Your Email</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputEmail" placeholder="you@example.com">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputMessage" class="col-sm-2 col-form-label">Message</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="inputMessage"
                                    placeholder="What's on your mind?"></textarea>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-secondary">Submit</button>
                    </form>
                </div>
            </div>
            <div class="col-md-3">
                <img src="img/bishop.png" alt="silhouette of a bishop chess piece" class="img-responsive" id="bishop-img">
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