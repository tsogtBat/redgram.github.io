<?php
session_start();
$servername = "localhost";
$database = "finalProj";
$username = "creator";
$password = "password";

$conn = mysqli_connect($server, $userName, $password, $database);
if($conn->connect_error){
    echo '<p> error connecting </p>';
}
else{
    $sql = $conn->prepare("SELECT content FROM content ORDER BY timestamp");
    $sql->execute();
    $sql->close();
}
?>