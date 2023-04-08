<?php
$servername = "localhost";
$database = "finalProj";
$un = "creator";
$password = 'password';

$conn = mysqli_connect($servername, $un, $password, $database);

$method = $_SERVER['REQUEST_METHOD'];
if ($conn->connect_error) {
    echo '<p> connection error </p>';
} else {
    if ($method === 'POST') {
        $userName = $_POST['userName'];

        $sql = $conn->prepare("SELECT userName FROM Users WHERE userName = ?");
        $sql->bind_param("s", $userName);
        $sql->execute();
        $result = $sql->get_result();
        $arr = $result->fetch_assoc();
        if($arr > 0){
            if($arr['userName'] === $userName){
                echo '<p> User Name has already been used </p>';
            }
            else{
                echo '<p> user name not taken </p>';
            }
        }
    } else {
        echo "<p> wrong method</p>";
    }
}$conn->close();
?>