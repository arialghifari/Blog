<?php

include "../../connection.php";

if (isset($_POST['submit'])) {
	$id = $_POST['id'];
	$name = $_POST['name'];

	$sql = "UPDATE category SET name='$name' WHERE id='$id'";

	if (mysqli_query($conn, $sql)) {
		header("Location: ./");
	} else {
		echo "Error: " . $sql . "<br/>" . mysqli_error($conn);
	}
} else {
	header("Location: ./");
}
