<?php
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "eddy_graphics";

$conn = new mysqli($servername,$username,$password,$dbname);
if($conn->connect_error)
{
die("connection failed " . $conn->connect_error);
}
$conn->close();
?>