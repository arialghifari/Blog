<?php

include "../../connection.php";

if (isset($_POST['submit'])) {
	$title = $_POST['title'];
	$image = $_POST['image'];
	$body = $_POST['body'];
	$category = $_POST['category'];
	$current_date = date('Y-m-d');

	$sql = "INSERT INTO post VALUES ('', '$title', '$body', 'img2.jpg', '1', '1', '$current_date')";

	if (mysqli_query($conn, $sql)) {
		header("Location: ./");
	} else {
		echo "Error: " . $sql . "<br/>" . mysqli_error($conn);
	}
} else {
	header("Location: ./");
}
