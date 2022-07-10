<?php

session_start();
if (isset($_SESSION['user_id'])) {
	return header('Location: ../dashboard/');
}

@$errorMessage = $_GET['err'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="../style/bootstrap.min.css" />
	<script src="../style/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" href="../style/main.css" />
	<title>The Blog</title>
</head>

<body>
	<div class="container">
		<!-- Start Top Navigation -->
		<nav class="nav-main" aria-label="main navigation">
			<a href="../"><img src="../assets/logo.svg" alt="The Blog Logo" /></a>

			<div>
				<a href="./" class="start-writing">Start Writing</a>
			</div>
		</nav>
		<!-- End Top Navigation -->

		<header>
			<section class="banner">
				<img src="../assets/banner.jpg" alt="Banner" />
				<h1 class="display-1">THE BLOG</h1>
			</section>
		</header>

		<main class="d-flex justify-content-center">
			<section class="login my-5">
				<h2 class="text-center fs-3 fw-semibold">Login</h2>
				<form action="./login.php" method="post">
					<label for="email">Email</label>
					<input type="email" name="email" id="email" class="input mt-1 mb-2" required>

					<label for="password">Password</label>
					<input type="password" name="password" id="password" class="input mt-1 mb-2" required>

					<?php if ($errorMessage) { ?>
						<p class="error">* <?= $errorMessage ?></p>
					<?php } ?>
					<input type="submit" name="submit" id="submit" value="Login" class="btn-primary my-2">
				</form>
				<p>Don't have account? <a href="../signup/">Sign Up</a></p>
			</section>
		</main>
	</div>
</body>

</html>