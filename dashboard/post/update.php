<?php

include "../../connection.php";

if (isset($_POST['submit'])) {
	$id = $_POST['id'];
	$title = $_POST['title'];
	$body = $_POST['body'];
	$category = $_POST['category'];

	$sql = "UPDATE post SET title='$title', body='$body', id_category='$category' WHERE id='$id'";

	if (mysqli_query($conn, $sql)) {
		header("Location: ./");
	} else {
		echo "Error: " . $sql . "<br/>" . mysqli_error($conn);
	}
} else {
	header("Location: ./");
}
