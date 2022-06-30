<?php

include '../connection.php';

function getRecordCount($table)
{
	global $conn;
	
	$sql = "SELECT COUNT(*) FROM $table";
	return mysqli_fetch_array(mysqli_query($conn, $sql))[0];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../style/bootstrap.min.css" />
  <script src="../style/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" href="../style/main.css" />
	<title>The Blog</title>
</head>

<body>
	<div class="container">
		<!-- Start Top Navigation -->
		<nav class="nav-main" aria-label="main navigation">
			<a href="#"><img src="../assets/logo.svg" alt="The Blog Logo" /></a>

			<div>
				<a href="#">About Us</a>
				<a href="#">Contact Us</a>
			</div>
		</nav>
		<!-- End Top Navigation -->

		<header>
			<section class="banner">
				<img src="../assets/banner.jpg" alt="Banner" />
				<h1 class="display-1">THE BLOG</h1>
			</section>
		</header>

		<main>
			<div class="row my-5">
				<!-- Start Aside -->
				<aside class="col-12 col-md-3 mb-4">
					<div class="manage">
						<p class="manage__title">Manage</p>

						<nav class="nav-side" aria-label="Manage Navigation">
							<a href="./post/">
								<p>Post</p>
							</a>
							<a href="./category/">
								<p>Category</p>
							</a>
							<a href="#">
								<p>User</p>
							</a>
						</nav>
					</div>
				</aside>

				<section class="col-12 col-md-9">
					<div class="row text-center">
						<div class="col-12 col-sm-4 mb-3">
							<div class="card-dashboard">
								<p>Post</p>
								<h2><?= getRecordCount('post') ?></h2>
							</div>
						</div>
						<div class="col-12 col-sm-4 mb-3">
							<div class="card-dashboard">
								<p>Category</p>
								<h2><?= getRecordCount('category') ?></h2>
							</div>
						</div>
						<div class="col-12 col-sm-4 mb-3">
							<div class="card-dashboard">
								<p>User</p>
								<h2><?= getRecordCount('user') ?></h2>
							</div>
						</div>
					</div>
				</section>
		</main>

		<footer>
			<p>Copyright © <?= date('Y') ?> <a href="#">The Blog</a></p>
		</footer>
	</div>
</body>

</html>