<!-- sending api key via a url query-->

<!-- find the api and return data  -->
<?php
    $endpoint = "http://fveit01.lampt.eeecs.qub.ac.uk/project/admin/players.php/?api_k=Z9qA(cyE3QXke";

    $result = file_get_contents($endpoint);
    
    $data = json_decode($result, true);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>push</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/yegor256/tacit@gh-pages/tacit-css-1.5.3.min.css" />
 
</head>
<body>
<?php
    print_r($data);
?>
</body>
</html>