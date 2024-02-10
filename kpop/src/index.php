<?php
include "db.php";

session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Last Christmas</title>
    <link rel="stylesheet" href="style/style.css">
    <script src="js/index.js"></script>
</head>

<body>
    <p>Last Christmas I gave you my heart. But the very next day you gave it away.</p>
    <iframe width="1080" height="720" src="https://www.youtube.com/embed/fvtzZFhrKLE?si=wgsvL6Wg7fUqHGWg&amp;controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
    <div class="bottom-buttons">
        <?php if ($_SESSION['username'] == 'aespa') echo "<button onclick=\"goTo('/admin.php')\">Admin</button>\n" ?>
        <button onclick="goTo('/history.php')">History</button>
        <button onclick="goTo('/index.php')">Home</button>
        <button onclick="goTo('/logout.php')">Logout</button>
    </div>
</body>

</html>