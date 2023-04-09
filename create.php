<?php
session_start();
$server = "localhost";
$userName = "95050811";
$password = "95050811";
$database = "db_95050811";

$conn = mysqli_connect($server, $userName, $password, $database);
if($conn->connect_error){
    echo '<p> error connecting </p>';
}{
if ($_SERVER['loggedin'] === true) {
    $un = $_SERVER['userName'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $sql = $conn->prepare("INSERT INTO content (userName, title, body) VALUES (?,?,?)");
    $sql->bind_param("sss", $un, $title, $content);
    $sql->execute();
    $conn->close();
    header("Location: profile.html");
} else {
    header("Location: login.html");
}
}
?>