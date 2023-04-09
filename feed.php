<?php
session_start();
$server = "localhost";
$userName = "95050811";
$password = "95050811";
$database = "db_95050811";

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