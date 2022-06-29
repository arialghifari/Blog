<?php

include '../connection.php';

$sql = "SELECT * FROM post";
$query = mysqli_query($conn, $sql);

function getCurrentUrl()
{
	$fullUrl = $_SERVER['REQUEST_URI'];
	return explode("/", $fullUrl)[3];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
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
								<p class="<?php if (getCurrentUrl() == 'post_view.php') echo 'active' ?>">Post</p>
							</a>
							<a href="#">
								<p class="">Category</p>
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
								<h2>100</h2>
							</div>
						</div>
						<div class="col-12 col-sm-4 mb-3">
							<div class="card-dashboard">
								<p>Category</p>
								<h2>9</h2>
							</div>
						</div>
						<div class="col-12 col-sm-4 mb-3">
							<div class="card-dashboard">
								<p>User</p>
								<h2>3</h2>
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