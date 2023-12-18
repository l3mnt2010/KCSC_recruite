<?php
include("./classes/trainer.php");
include("./classes/utils.php");
function isChampion($user) {
    return $user->getChampion();
}

if (isset($_COOKIE["trainer_data"])) {
    $base64Encoded = $_COOKIE["trainer_data"];
    $serializedUser = base64_decode($base64Encoded);
    $user = unserialize($serializedUser);
    if (isChampion($user)) {
        $title = "Champion Pannel";
        $msg = "Hello, " . $user->getname() . " KCSC{level1_fakeflag}";
    } else {
        $title = "Trainer Pannel";
        $msg = "Access denied. You are not a champion.";
    }
} else {
    $title = "Something's wrong!!!";
    $msg = "No trainer data found. Please choose your starter.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Press Start 2P' rel='stylesheet'>
    <link rel="stylesheet" href="./public/css/main.css">
    <link rel="stylesheet" href="./public/css/nes.css">
    <link rel="icon" type="image/x-icon" href="./public/img/pokeball.png">
    <title>Hall Of Fame</title>
</head>
<body>
    <div id="box">
            <div id="card" class="card nes-container with-title is-dark is-rounded pannel">
            <h3 class="title"><?php echo(htmlspecialchars($title)); ?></h3>
                <?php echo(htmlspecialchars($msg)); ?>
            </div>
        </div>
</body>
</html>