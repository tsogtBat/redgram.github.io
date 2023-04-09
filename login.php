<?php
$server = "localhost";
$username = "creator";
$password = "password";
$database = "finalProj";
$connection = new mysqli($server, $username, $password, $database);
$method = $_SERVER['REQUEST_METHOD'];
if ($method === 'POST') {
    if (!$connection->connect_error) {
        $un = $_POST['userName'];
        $pass = $_POST['password'];
        if (!empty($un) && !empty($pass)) {
            try {
                $pass = md5($pass);
                $sql = $connection->prepare("SELECT userName from Users where userName = ? AND password = ?");
                $sql->bind_param("ss", $un, $pass);
                $sql->execute();


                $result = $sql->get_result();
                $user = $result->fetch_assoc();

                if ($result->num_rows > 0) {
                    if ($user['userName'] === $un) {
                        $_SESSION['loggedin'] = true;
                        $_SESSION['userName'] = $un;
                        header("Location: home.html");
                        exit();
                    }
                } else {
                    echo "<script>alert('Username and/or password is incorrect.');</script>";
                    $_SESSION['loggedin'] = false;
                    header('Location: login.html');
                    exit();
                }
            } catch (mysqli_sql_exception) {
                echo "<p>username and/or password is invalid</p>";
            }
        }
    } else {
        die("connection failed: " . $connection->connect_error);
    }
} else {
    echo "<p> wrong method for form</p>";
}
?>