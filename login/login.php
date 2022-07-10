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
		$errorMessage = "Email has not been registered";

		return header("Location: ./index.php?err=$errorMessage");
	};

	if (!$check_password) {
		$errorMessage = "Email and password doesn't match";

		return header("Location: ./index.php?err=$errorMessage");
	};


	// set session
	// ...

	if ($query_user) {
		return header("Location: ../dashboard/");
	} else {
		echo "Error: " . $sql . "<br/>" . mysqli_error($conn);
	}
} else {
	header("Location: ./");
}
