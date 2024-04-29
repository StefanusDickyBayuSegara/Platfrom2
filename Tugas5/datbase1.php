<?php

$hostname = "localhost";
$username =  "root";
$password = "";
$database_name = "platfrom2";

$db = mysqli_connect($hostname, $username, $password, $database_name);

if ($db->connect_error) {
    echo "Connect ERROR";
    die("ERROR");
}else{
    echo "Koneksi Aman Bray";
}

?>