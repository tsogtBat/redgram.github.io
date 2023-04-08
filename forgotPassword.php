<?php
$server = "localhost";
$username = "creator";
$password = "password";
$database = "finalProj";

$connection = new mysqli($server, $username, $password, $database);
if (!$connection->connect_error) {
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $un = $_POST['username'];
        $email = $_POST['email'];
        $fn = $_POST['firstName'];
        $ln = $_POST['lastName'];
        $newpass = $_POST['newpassword'];
        $newpassCheck = $_POST['newpassword-check'];

        $sql = $connection->prepare("SELECT username FROM users WHERE username = ? AND lastName = ? AND firstName = ? AND email = ?");
        $sql->bind_param("ssss", $un, $ln, $fn, $email);
        $sql->execute();

        $results = $sql->get_result();
        $row = $results->fetch_assoc();
        if($row > 0){
            if($row['username'] === $un){
                if($newpassCheck === $newpass){
                    $newpass = md5($newpass);
                    $sql = $connection->prepare("UPDATE users SET password = ?  WHERE username = ?");
                    $sql->bind_param("ss", $newpass, $un);
                    $sql->execute();
                    echo "<script>alert('Username and/or password is incorrect.');</script>";
                    header("Location: login.html");
                    exit();
                }
            }
        }else{
            echo "<p>username and/or password is incorrect</p>"; 
        }

    } else {
        echo "<p> wrong request method</p>";
    }
}else{
    die("connection error: " . $connection->connect_error);
}
?>