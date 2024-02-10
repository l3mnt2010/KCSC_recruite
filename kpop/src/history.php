<?php
include_once "db.php";
include_once "filter.php";

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
    <title>History</title>
    <link rel="stylesheet" href="style/style.css">
    <script src="/js/index.js"></script>
</head>

<body>
    <p>Logs</p>
    
    <?php
    if (isset($_REQUEST['view_by_logcode']) && isset($_POST['logcode'])) {
        $view = 1;
    }

    $query = "SELECT * FROM logs WHERE ";

    if (@$view) {
        $query .= "logcode = ?";
        $paramValue = $_REQUEST['logcode'];
    } else {
        $query .= "username = ?";
        $paramValue = $_SESSION['username'];
    }

    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $paramValue);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        echo "<table><tr><th>LogCode</th><th>Username</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["logcode"] . "</td><td>" . $row["username"] . "</td></tr>";
        }

        echo "</table>";
    } else {
        echo "<p>0 log found</p>";
    }
    ?>
    
    <div class="bottom-buttons">
        <?php if ($_SESSION['username'] == 'aespa') echo "<button onclick=\"goTo('/admin.php')\">Admin</button>\n" ?>
        <button onclick="goTo('/history.php')">History</button>
        <button onclick="goTo('/index.php')">Home</button>
        <button onclick="goTo('/logout.php')">Logout</button>
    </div>
</body>
</html>