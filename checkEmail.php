<?php
$servername = "localhost";
$database = "finalProj";
$userName = "creator";
$password = 'password';

$conn = mysqli_connect($servername, $userName, $password, $database);

$method = $_SERVER['REQUEST_METHOD'];
if ($conn->connect_error) {
    echo '<p> connection error </p>';
} else {
    if ($method === 'POST') {
        $email = $_POST['email'];

        $sql = $conn->prepare("SELECT email FROM Users WHERE email = ?");
        $sql->bind_param("s", $email);
        $sql->execute();
        $result = $sql->get_result();
        $arr = $result->fetch_assoc();
        if($arr > 0){
            if($arr['email'] === $email){
                echo '<p> email has already been used </p>';
            }
        }
    } else {
        echo "<p> wrong method</p>";
    }
}$conn->close();
?>