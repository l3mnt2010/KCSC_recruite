<?php
include_once "db.php";
include_once "filter.php";

session_start();

if (isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = "SELECT * FROM users WHERE username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();

        if ($stmt->get_result()->num_rows > 0) {
            header("Location: /register.php?exists=");
            exit();
        }

        //Add user into database
        try {
            $query = "INSERT INTO users (username,password) VALUES (?,?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ss", $username, $password);
            $stmt->execute();
            header('Location: login.php');
            exit();
        } catch (Exception $e) {
            die("Error");
        }
    }
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
    <title>User Registration</title>
    <link href="/style/form.css" rel="stylesheet">
</head>

<body>
    <div class="wrapper fadeInDown">
        <div id="formContent">
            <div class="fadeIn first">
                <h2>Register</h2>
                <?php if(isset($_GET['exists'])) echo "<h5>User already exists</h5>"?>
            </div>

            <form action="register.php" method="post">
                <input type="text" id="username" class="fadeIn second" name="username" placeholder="username">
                <input type="password" id="password" class="fadeIn third" name="password" placeholder="password">
                <input type="submit" class="fadeIn fourth" value="Register">
            </form>

            <div id="formFooter">
                <a class="underlineHover" href="/login.php">Login</a>
            </div>

        </div>
    </div>
</body>

</html>