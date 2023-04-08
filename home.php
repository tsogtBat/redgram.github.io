<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === false) {
    header("Location: home.php");
} else {
    
}
?>
<!DOCTYPE html>
<html>
<header>
</header>

<body>
    <p> home </p>
</body>

</html>