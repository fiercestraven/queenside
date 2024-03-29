    <!-- logo and search -->
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <a href="/project/public/index.php"><img src="/project/public/img/QueensideLogo.png" class="img-responsive my-logo"
                        alt="Queenside logo"></a>
            </div>
            <?php
                //add search box if the page is public-facing
                if (strpos($_SERVER['REQUEST_URI'], 'admin') == false) { ?>
                    <div class="col-md-4 my-search">
                    <form class="form-inline justify-content-center md-form form-sm" action="../public/players.php" method="GET">
                        <input class="form-control form-control-sm w-75" type="text" placeholder="Player name or FIDE ID" aria-label="Search" name="playersearch">
                        <i class="fa fa-search fa-lg" aria-hidden="true"></i>
                    </form>
                </div>
                <?php } ?>
        </div>
    </div>

    <!-- navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark 
    <?php 
        if(strpos($_SERVER['REQUEST_URI'], 'admin') == false) {
            echo "my-navbar";
        } else {
            echo "my-admin-navbar";
        }
    ?>">
        <div class="container">
            <button class="navbar-toggler my-nav-button" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto ms-1 mb-2 mb-lg-0">
                    <li class="nav-item my-nav-item">
                        <a class="nav-link" href="/project/public/index.php"><i class="fa fa-home" aria-hidden="true"></i></a>
                    </li>
                    <li class="nav-item my-nav-item">
                        <a class="nav-link" href="/project/public/discover.php">Discover</a>
                    </li>
                    <li class="nav-item my-nav-item">
                        <a class="nav-link" href="/project/public/outpost.php">Outpost</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>