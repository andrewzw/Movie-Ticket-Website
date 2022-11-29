<?php
require_once("settings.php");

$conn = @mysqli_connect($host, $user, $pwd, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

return $conn;