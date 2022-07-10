<?php

include '../connection.php';

if (isset($_POST['submit'])) {
	$email = $_POST['email'];
	$password = $_POST['password'];

	$errorMessage = null;
	$sql_user = "SELECT * FROM user WHERE email='$email'";
	$query_user = mysqli_query($conn, $sql_user);
	$fetch_user = mysqli_fetch_array($query_user);
	$check_password = password_verify($password, $fetch_user['password']);

	if (empty($email) || empty($password)) {
		$errorMessage = "Please fill out all field";

		return header("Location: ./index.php?err=$errorMessage");
	};

	if (mysqli_num_rows($query_user) <= 0) {
		$errorMessage = "Email is not registered";

		return header("Location: ./index.php?err=$errorMessage");
	};

	if (!$check_password) {
		$errorMessage = "Email and password doesn't match";

		return header("Location: ./index.php?err=$errorMessage");
	};

	// Set session
	session_start();
	$_SESSION['user_id'] = $fetch_user['id'];
	$_SESSION['user_email'] = $fetch_user['email'];
	$_SESSION['user_first_name'] = $fetch_user['first_name'];
	$_SESSION['user_last_name'] = $fetch_user['last_name'];
	$_SESSION['user_isAdmin'] = $fetch_user['isAdmin'];

	if ($query_user) {
		return header("Location: ../dashboard/");
	} else {
		echo "Error: " . $sql . "<br/>" . mysqli_error($conn);
	}
} else {
	header("Location: ./");
}
