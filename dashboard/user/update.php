<?php

include "../../connection.php";
session_start();

if (!isset($_SESSION['user_id'])) {
	return Header('Location: ../../');
}

if (isset($_POST['submit'])) {
	$errorMessage = null;

	$id = $_POST['id'];
	$email = $_POST['email'];
	$default_email = $_POST['default_email'];
	$password = $_POST['password'];
	$password_hash = password_hash($password, PASSWORD_DEFAULT);
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$set_as_admin = $_POST['set_as_admin'];

	if (empty($email) || empty($first_name) || empty($last_name)) {
		$errorMessage = "Please fill out some field";

		return header("Location: ./edit_form.php?id=$id&err=$errorMessage");
	};

	$sql_email = "SELECT email from user WHERE email='$email'";
	$query_email = mysqli_query($conn, $sql_email);
	if (mysqli_num_rows($query_email) > 0 && $email != $default_email) {
		$errorMessage = "Email has been registered";

		return header("Location: ./edit_form.php?id=$id&err=$errorMessage");
	};

	if (!$password) {
		if ($set_as_admin) {
			$sql = "UPDATE user SET email='$email', first_name='$first_name', last_name='$last_name', isAdmin='1' WHERE id = '$id'";
		} else {
			$sql = "UPDATE user SET email='$email', first_name='$first_name', last_name='$last_name', isAdmin='0' WHERE id = '$id'";
		}
	} else {
		if ($set_as_admin) {
			$sql = "UPDATE user SET email='$email', password='$password_hash', first_name='$first_name', last_name='$last_name', isAdmin='1' WHERE id = '$id'";
		} else {
			$sql = "UPDATE user SET email='$email', password='$password_hash', first_name='$first_name', last_name='$last_name', isAdmin='0' WHERE id = '$id'";
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
