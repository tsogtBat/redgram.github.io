<?php

$host = "cosc360.ok.ubc.ca";
$dbname = "db_16245342";
$username = "16245342";
$password = "16245342";

$mysqli = new mysqli(hostname: $host,
                     username: $username,
                     password: $password,
                     database: $dbname);
                     
if ($mysqli->connect_errno) {
    die("Connection error: " . $mysqli->connect_error);
}

return $mysqli;