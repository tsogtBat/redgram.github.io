<?php
session_start();
$servername = "localhost";
$database = "finalProj";
$username = "creator";
$password = "password";

$conn = mysqli_connect($servername, $username, $password, $database);
if($conn->connect_error){
    echo '<p> error connecting </p>';
}{
    $title = $_POST['title'];
    $content = $_POST['content'];
    $sql = $conn->prepare("INSERT INTO content (title, content) VALUES (?,?)");
    $sql->bind_param("ss", $title, $content);
    $sql->execute();
    $conn->close();
    header("Location: feed.html");
} 
// s
?>