<?php
include "db.php";
include "filter.php";

session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

if ($_SESSION['username'] !== "aespa") {
    header('Location: index.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>CAT FLAG</title>
    <link href="/style/form.css" rel="stylesheet">
</head>

<body>
    <div class="wrapper fadeInDown">
        <div id="formContent">
            <div class="fadeIn first">
                <h2>Command</h2>
                <h3>
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] == "POST") {
                        $command = isset($_POST['cmd']) ? escapeshellcmd($_POST['cmd']) : "/hint_to_get_flag.txt";
                        system("cat " . $command);
                    }
                    ?>
                </h3>
            </div>

            <form action="admin.php" method="post">
                <input type="text" id="inputBox" class="fadeIn second" name="cmd" placeholder="/flag.txt">
                <input type="submit" class="fadeIn fourth" value="Execute">
            </form>

        </div>
    </div>
</body>

</html>