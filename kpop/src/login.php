<?php
include_once "db.php";
include_once "filter.php";

session_start();

if (isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

function genLogCode()
{
    $length = 8;
    $randomNumber = '';

    for ($i = 0; $i < $length; $i++) {
        $digit = rand(0, 9);
        $randomNumber .= strval($digit);
    }

    return $randomNumber;
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $logcode = isset($_POST['logcode']) ? $_POST['logcode'] : genLogCode();

        //Check credentials
        try {
            $query = "SELECT * FROM users WHERE username=? and password =?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ss", $username, $password);
            $stmt->execute();
        } catch (Exception $e) {
            die("Error");
        }
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            try {
                $row = $result->fetch_assoc();
                $query = "INSERT INTO logs (logcode,username) VALUES (" . $logcode . ",?)";
                $stmt->prepare($query);
                $stmt->bind_param("s", $username);
                $stmt->execute();

                $_SESSION['username'] = $username;
                header("Location: index.php");
                exit();
            } catch (Exception $e) {
                die("Error");
            }
        } else {
            header("Location: /login.php?error=");
            exit();
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
    <title>User Login</title>
    <link href="/style/form.css" rel="stylesheet">
</head>

<body>
    <div class="wrapper fadeInDown">
        <div id="formContent">
            <!-- Tabs Titles -->
            <div class="fadeIn first">
                <h2>Login</h2>
                <?php if(isset($_GET['error'])) echo "<h5>Wrong username or password</h5>"?>
            </div>

            <form action="login.php" method="post" onsubmit="setLogCode()">
                <input type="text" id="username" class="fadeIn second" name="username" placeholder="username">
                <input type="password" id="password" class="fadeIn third" name="password" placeholder="password">
                <input type="hidden" id="logcode" name="logcode" value="">
                <input type="submit" class="fadeIn fourth" value="Log In">
            </form>

            <div id="formFooter">
                <a class="underlineHover" href="/register.php">Register</a>
            </div>

        </div>
    </div>
</body>

<script>
    function setLogCode() {
        document.getElementById('logcode').value = <?php echo genLogCode() ?>;
    }
</script>

</html>