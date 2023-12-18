<?php
include("./classes/trainer.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["name"])) {
        $name = $_POST["name"];
        $starter = $_POST["starter"];
        $user = new Trainer($name, $starter);
        $serializedUser = serialize($user);
        $base64Encoded = base64_encode($serializedUser);
        setcookie("trainer_data", $base64Encoded, time() + 3600);
        header("Location: ./champ.php");
    }
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
    <script src="./public/js/app.js"></script>
    <title>Hall Of Fame</title>
</head>
<body>
    <div id="box">
            <div id="card" class="card nes-container with-title is-dark">
            <h3 class="title">Choose your starter</h3>
                <form method="post" action="">
                    <div >
                        <label for="name">Trainer name:</label>
                        <input type="text" id="name" name="name" class="nes-input is-dark" required>
                    </div>
                    <label for="starter">Starter:</label>
                    <div class="row justify-content-center">
                        <div class="col-2">
                                <label for="bulbasaur" class="img_label">
                                    <img src="./public/img/Bulbasaur.png" class="pokemon_pic is-error" onclick="toggleActive(this)">
                                </label>
                                <input type="radio" id="bulbasaur" name="starter" class="checkbox" value="Bulbasaur">
                        </div>
                        <div class="col-2">
                            <label for="charmander" class="img_label">
                                <img src="./public/img/Charmander.png" class="pokemon_pic is-error" onclick="toggleActive(this)">
                            </label>
                            <input type="radio" id="charmander" name="starter" class="checkbox" value="Charmander">
                        </div>
                        <div class="col-2">
                            <label for="squirtle" class="img_label">
                                <img src="./public/img/Squirtle.png" class="pokemon_pic is-error" onclick="toggleActive(this)">
                            </label>
                            <input type="radio" id="squirtle" name="starter" class="checkbox" value="Squirtle">
                        </div>
                    </div>
                    <div class="row">
                        <button type="submit" class="nes-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
</body>
</html>
