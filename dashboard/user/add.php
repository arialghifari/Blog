<?php

include "../../connection.php";
session_start();

if (!isset($_SESSION['user_id'])) {
	return Header('Location: ../../');
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
	$set_as_admin = $_POST['set_as_admin'];

	if (empty($email) || empty($password) || empty($first_name) || empty($last_name)) {
		$errorMessage = "Please fill out all field";

		return header("Location: ./add_form.php?err=$errorMessage");
	};

	$sql_email = "SELECT email from user WHERE email='$email'";
	$query_email = mysqli_query($conn, $sql_email);
	if (mysqli_num_rows($query_email) > 0) {
		$errorMessage = "Email has been registered";

		return header("Location: ./add_form.php?err=$errorMessage");
	};

	if ($set_as_admin) {
		$sql = "INSERT INTO user VALUES ('', '$email', '$password_hash', '$first_name', '$last_name', '1', '$current_date')";
	} else {
		$sql = "INSERT INTO user VALUES ('', '$email', '$password_hash', '$first_name', '$last_name', '0', '$current_date')";
	}

	if (mysqli_query($conn, $sql)) {
		header("Location: ./");
	} else {
		echo "Error: " . $sql . "<br/>" . mysqli_error($conn);
	}
} else {
	header("Location: ./");
}
