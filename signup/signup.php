<?php

include '../connection.php';
session_start();

if (isset($_SESSION['user_id'])) {
	return header('Location: ../dashboard/');
}

if (isset($_POST['submit'])) {
	$errorMessage = null;

	$email = $_POST['email'];
	$password = $_POST['password'];
	$password_hash = password_hash($password, PASSWORD_DEFAULT);
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$date = new DateTime();
	$current_date = $date->format('Y-m-d H:i:s');

	if (empty($email) || empty($password) || empty($first_name) || empty($last_name)) {
		$errorMessage = "Please fill out all field";

		return header("Location: ./index.php?err=$errorMessage");
	};

	$sql_email = "SELECT email from user WHERE email='$email'";
	$query_email = mysqli_query($conn, $sql_email);
	if (mysqli_num_rows($query_email) > 0) {
		$errorMessage = "Email has been registered";

		return header("Location: ./index.php?err=$errorMessage");
	};

	$sql = "INSERT INTO user VALUES ('', '$email', '$password_hash', '$first_name', '$last_name', '0', '$current_date')";

	if (mysqli_query($conn, $sql)) {
		$sql_user = "SELECT * FROM user WHERE email='$email'";
		$query_user = mysqli_query($conn, $sql_user);
		$fetch_user = mysqli_fetch_array($query_user);

		// Set session
		$_SESSION['user_id'] = $fetch_user['id'];
		$_SESSION['user_email'] = $fetch_user['email'];
		$_SESSION['user_first_name'] = $fetch_user['first_name'];
		$_SESSION['user_last_name'] = $fetch_user['last_name'];
		$_SESSION['user_isAdmin'] = $fetch_user['isAdmin'];

		return header("Location: ../dashboard/");
	} else {
		echo "Error: " . $sql . "<br/>" . mysqli_error($conn);
	}
} else {
	header("Location: ./");
}
