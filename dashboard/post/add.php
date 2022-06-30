<?php

include "../../connection.php";


if (isset($_POST['submit'])) {
	$errorMessage = null;

	$title = $_POST['title'];
	$body = $_POST['body'];
	$category = $_POST['category'];
	$current_date = date('Y-m-d');

	// Start image upload
	$file_name = $_FILES['image']['name'];
	$file_name_format = rand(1, 1000) . $file_name;
	$file_size = $_FILES['image']['size'];
	$tmp = $_FILES['image']['tmp_name'];
	$extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

	if (empty($title) || empty($category) || empty($body) || empty($file_name)) {
		$errorMessage = "Please fill out all field";

		return header("Location: ./add_form.php?err=$errorMessage");
	};

	if ($extension != 'jpg' && $extension != 'jpeg' && $extension != 'png') {
		$errorMessage = "Please choose jpg, jpeg, or png file";

		return header("Location: ./add_form.php?err=$errorMessage");
	};

	if ($file_size > 2000000) {
		$errorMessage = "Image should be less than 2Mb";

		return header("Location: ./add_form.php?err=$errorMessage");
	}

	move_uploaded_file($tmp, "../../assets/post_image/" . $file_name);
	// End image upload

	$sql = "INSERT INTO post VALUES ('', '$title', '$body', '$file_name', '1', '$category', '$current_date')";

	if (mysqli_query($conn, $sql)) {
		return header("Location: ./");
	} else {
		echo "Error: " . $sql . "<br/>" . mysqli_error($conn);
	}
} else {
	header("Location: ./");
}
