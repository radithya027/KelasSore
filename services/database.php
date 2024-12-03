<?php
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "";


$db = mysqli_connect($hostname, $username, $password, $dbname);

if ($db->connect_error) {
    echo "Connection failed: " . $db->connect_error;
    die("Connection failed: " . $db->connect_error);
}

?>