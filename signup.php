<?php
$servername = "localhost";
$database = "finalProj";
$username = "creator";
$password = "password";

$conn = mysqli_connect($servername, $username, $password, $database);

$method = $_SERVER['REQUEST_METHOD'];
if ($conn->connect_error) {
    echo '<p> connection error </p>';
} else {

    if ($method === 'POST') {
        $fn = $_POST['userName'];
        $ln = $_POST['lastName'];
        $un = $_POST['userName'];
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $passCheck = $_POST['passwordCheck'];
        try {
            $sql = $conn->prepare("SELECT userName FROM Users WHERE userName = ?");     
            $sql->bind_param('s', $un);
            $sql->execute();

            $results =$sql->get_result();
            $arr = $results->fetch_assoc();

            if($arr >0){
                echo '<p> user already exists </p>';
            }
        }catch(mysqli_sql_exception){

        }
        if($arr === null){
            $pass = md5($pass);
            $insertUser = "INSERT into Users (userName, firstName, lastName, email, password) VALUES ('$un', '$fn', '$ln', '$email', '$pass')";
    
            $restuls = $conn->query($insertUser);
            echo '<p> your account has been created </p>';
        }
        $conn->close();
    }else{
        echo '<p> wrong method </p>';
    }
}
?>