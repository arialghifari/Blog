<?php

include "../../connection.php";

$id = $_GET['id'];

if (isset($id)) {
	$sql = "DELETE FROM category WHERE id='$id'";

	if (mysqli_query($conn, $sql)) {
		header("Location: ./");
	} else {
		echo "Error: " . $sql . "<br/>" . mysqli_error($conn);
	}
} else {
	header("Location: ./");
}
