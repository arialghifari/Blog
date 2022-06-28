<?php

date_default_timezone_set("Asia/Makassar");

$server = "localhost";
$username = "root";
$password = "";
$dbname = "theblog";

$conn = mysqli_connect($server, $username, $password, $dbname);

if (!$conn) {
	die("Koneksi gagal " . mysqli_connect_error());
}
