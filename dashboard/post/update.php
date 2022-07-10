<?php

include "../../connection.php";
session_start();

if (!isset($_SESSION['user_id'])) {
	return Header('Location: ../../');
}

if (isset($_POST['submit'])) {
	$id = $_POST['id'];
	$title = $_POST['title'];
	$body = $_POST['body'];
	$category = $_POST['category'];
	$date = new DateTime();
	$current_date = $date->format('Y-m-d H:i:s');
	@$setToMain = $_POST['set_to_main'];

	if (empty($title) || empty($category) || empty($body)) {
		$errorMessage = "Please fill out all field";

		return header("Location: ./edit_form.php?err=$errorMessage");
	};

	function deleteImage()
	{
		global $id, $conn;

		$image = "SELECT image FROM post WHERE id='$id'";
		$query = mysqli_fetch_array(mysqli_query($conn, $image))[0];
		unlink("../../assets/post_image/" . $query);
	}

	$file_name = $_FILES['image']['name'];
	if ($file_name) {
		// Start image upload

		// delete image first
		deleteImage();

		$file_name_format = rand(1, 1000) . $file_name;
		$file_size = $_FILES['image']['size'];
		$tmp = $_FILES['image']['tmp_name'];
		$extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

		if ($extension != 'jpg' && $extension != 'jpeg' && $extension != 'png' && $extension != 'webp') {
			$errorMessage = "Please choose jpg, jpeg, png, or webp file";

			return header("Location: ./edit_form.php?id=$id&err=$errorMessage");
		};

		if ($file_size > 2000000) {
			$errorMessage = "Image should be less than 2Mb";

			return header("Location: ./edit_form.php?id=$id&err=$errorMessage");
		}

		move_uploaded_file($tmp, "../../assets/post_image/" . $file_name_format);
		// End image upload

		if (isset($setToMain)) {
			$sql = "UPDATE post SET title='$title', body='$body', image='$file_name_format', category='$category', isMain='1', created_main_at='$current_date' WHERE id='$id'";
		} else {
			$sql = "UPDATE post SET title='$title', body='$body', image='$file_name_format', category='$category', isMain='0', created_main_at='NULL' WHERE id='$id'";
		}
	} else {
		if (isset($setToMain)) {
			$sql = "UPDATE post SET title='$title', body='$body', category='$category', isMain='1', created_main_at='$current_date' WHERE id='$id'";
		} else {
			$sql = "UPDATE post SET title='$title', body='$body', category='$category', isMain='0', created_main_at='NULL' WHERE id='$id'";
		}
	}


	if (mysqli_query($conn, $sql)) {
		header("Location: ./");
	} else {
		echo "Error: " . $sql . "<br/>" . mysqli_error($conn);
	}
} else {
	header("Location: ./");
}
