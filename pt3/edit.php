<?php
session_start();
$server = "localhost";
$userName = "95050811";
$password = "95050811";
$database = "db_95050811";

$conn = mysqli_connect($server, $userName, $password, $database);

if ($_SERVER['loggedin'] === true) {
    if ($conn->connect_error) {
        echo "<p> error connecting </p>";
        $conn->close();
    }
    if (isset($_POST['newUser'])) {
        $un = $_POST['newUser'];
        $newUserName = true;

    }
    if (isset($_POST['newPass'])) {
        $password = $_POST['newPass'];
        $newPassword = true;
    }
    if (isset($_POST['changeEmail'])) {
        $email = $_POST['changeEmail'];
        $newEmail = true;
    }
    try {
        if ($newUserName) {
            $sql = $conn->prepare("SELECT userName FROM users WHERE userName = ?");
            $sql->bind_param("s", $_SERVER['userName']);
            $sql->execute();
            $result = $sql->get_result();
            $arr = $result->fetch_assoc();
            if ($arr > 0) {
                $sql = $conn->prepare("UPDATE users SET userName = '" . $un . "'");
                header("Location: profile.html");
                exit();
            } else {
                echo '<p> error updating user name </p>';
            }
        }
        if ($newPassword) {
            $sql = $conn->prepare("SELECT userName FROM users WHERE userName = ?");
            $sql->bind_param("s", $_SERVER['userName']);
            $sql->execute();
            $result = $sql->get_result();
            $arr = $result->fetch_assoc();
            if ($arr > 0) {
                $sql = $conn->prepare("UPDATE users SET password = '" . $newPassword . "'");
                header("Location: profile.html");
                exit();
            } else {
                echo '<p> error updating user name </p>';
            }
        }
        if ($newUserName) {
            $sql = $conn->prepare("SELECT userName FROM users WHERE userName = ?");
            $sql->bind_param("s", $_SERVER['userName']);
            $sql->execute();
            $result = $sql->get_result();
            $arr = $result->fetch_assoc();
            if ($arr > 0) {
                $sql = $conn->prepare("UPDATE users SET email = '" . $newEmail . "'");
                header("Location: profile.html");
                exit();
            } else {
                echo '<p> error updating user name </p>';
            }
        }
    }
} else {
    header("Location: login.html");
}
?>