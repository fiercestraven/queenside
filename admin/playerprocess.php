 <!-- FIXME saving for edit Page            
 <div class="col-sm-10" style="padding: 7px 12px;">
                    <?= $fide ?> -->

 <?php

    //create local variables-- no real_escape_string needed due to prepare/bind steps below
    $fideid = $_POST['fide'];
    $playername = $_POST['playername'];
    $federation = $_POST['country'];
    $birthyear = $_POST['birthyear'] ?? NULL;
    $title = $_POST['title'] ?? NULL;
    $ratingstd = $_POST['ratingstandard'] ?? NULL;
    $ratingrap = $_POST['ratingrapid'] ?? NULL;
    $ratingblitz = $_POST['ratingblitz'] ?? NULL;
    //set boolean to true/false depending on status
    if ($_POST['status'] == 'withdrawn') {
        $inactive = 1;
    } else {
        $inactive = 0;
    }

    $endpoint = 'http://fveit01.lampt.eeecs.qub.ac.uk/project/api/player.php';

    $data = http_build_query([
        'inputPlayerName' => $playername,
        'inputFederation' => $federation,
        'inputBirthYear' => $birthyear,
        'inputPlayerTitle' => $title,
        'ratingstandard' => $ratingstd,
        'ratingrap' => $ratingrap,
        'ratingblitz' => $ratingblitz
    ]);

    $options = [
        'http' => [
            'method' => 'PUT',
            'header' => [
                'Content-Type: application/x-www-form-urlencoded',
                'API-Key: MyAPIKey'
            ],
            'content' => $data,
            'ignore_errors' => true
        ]
    ];

    $context = stream_context_create($options);

    $result = file_get_contents("$endpoint?id=$fideid", false, $context);
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
        include("../_partials/nav.html");
        ?>

     <!-- return message after form submission -->
     <div class='m5 container my-container my-thanks'>
         <h2 class='my-response'><?= $result ?></h2>
     </div>

     <!-- Footer -->
     <?php
        include("../_partials/footer.html");
        ?>

     <!-- JS Bootstrap Bundle with Popper -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

 </body>

 </html>