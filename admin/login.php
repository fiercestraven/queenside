<?php
    session_start();
    if (isset($_SESSION['admin_40275431'])) {
        header("Location: admin.php");
    }
?>

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
    include("../_partials/adminnav.html");
    ?>

    <?php
        if(isset($_GET['error'])) {
            echo "Invalid login credentials";
        }
    ?>

    <!-- Login -->
    <div class="card mb-3 my-detail-card" style="max-width: 800px; padding-bottom: 40px;">
        <div class="row g-0">
        <div class="col-md-3">
                <img src="../public/img/bishop.png" alt="silhouette of a bishop chess piece" class="img-responsive" id="bishop-img">
            </div>
            <div class="col-md-9">
                <div class="card-body">
                    <h2 class="card-title" style="margin-bottom: 15px;">Admin Login</h2>
                    <form action="sign.php" method="post">
                        <div class="row mb-3">
                            <label for="username" class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-10">
                                <input name="username" type="text" class="form-control" id="username">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="pass" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input name="pass" type="password" class="form-control" id="pass">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-secondary">Sign In</button>
                    </form>
                </div>
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