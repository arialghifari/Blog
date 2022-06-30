<?php

include "../../connection.php";

$id = $_GET['id'];

function deleteImage()
{
	global $id, $conn;

	$image = "SELECT image FROM post WHERE id='$id'";
	$query = mysqli_fetch_array(mysqli_query($conn, $image))[0];
	unlink("../../assets/post_image/" . $query);
}

if (isset($id)) {
	deleteImage();
	$sql = "DELETE FROM post WHERE id='$id'";

	if (mysqli_query($conn, $sql)) {
		header("Location: ./");
	} else {
		echo "Error: " . $sql . "<br/>" . mysqli_error($conn);
	}
} else {
	header("Location: ./");
}
