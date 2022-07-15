<?php

include '../connection.php';
session_start();

if (!isset($_SESSION['user_id'])) {
	return Header('Location: ../');
}

function getRecordCount($table)
{
	global $conn;
	$user_id = $_SESSION['user_id'];

	if ($_SESSION['user_isAdmin']) {
		$sql = "SELECT COUNT(*) FROM $table";
	} else {
		$sql = "SELECT COUNT(*) FROM $table WHERE id_user='$user_id'";
	}
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
			<a href="../"><img src="../assets/logo.svg" alt="The Blog Logo" /></a>

			<div>
				<?php if ($_SESSION['user_id']) { ?>
					<p class="m-0 rounded-0 dropdown-toggle cursor-pointer" data-bs-toggle="dropdown" aria-expanded="false"><?= $_SESSION['user_first_name']; ?></p>
					<ul class="dropdown-menu dropdown-menu-end rounded-0">
						<li><a href="./"><button class="dropdown-item" type="button">Dashboard</button></a></li>
						<li><a href="../logout/"><button class="dropdown-item" type="button">Logout</button></a></li>
					</ul>
				<?php } ?>
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
						<nav class="nav-side mb-4 p-0" aria-label="Manage Navigation">
							<a href="./">
								<p class="active">Dashboard</p>
							</a>
						</nav>

						<p class="manage__title">Manage</p>
						<nav class="nav-side" aria-label="Manage Navigation">
							<?php if ($_SESSION['user_isAdmin']) { ?>
								<a href="./post/">
									<p>Post</p>
								</a>
								<a href="./category/">
									<p>Category</p>
								</a>
								<a href="./user/">
									<p>User</p>
								</a>
							<?php } else { ?>
								<a href="./post/">
									<p>Post</p>
								</a>
							<?php } ?>
						</nav>
					</div>
				</aside>

				<section class="col-12 col-md-9">
					<div class="row text-center">
						<?php if ($_SESSION['user_isAdmin']) { ?>
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
						<?php } else { ?>
							<div class="col-12 col-sm-4 mb-3">
								<div class="card-dashboard">
									<p>Post</p>
									<h2><?= getRecordCount('post') ?></h2>
								</div>
							</div>
						<?php } ?>
					</div>
				</section>
		</main>

		<footer>
			<p>Copyright © <?= date('Y') ?> <a href="#">The Blog</a></p>
		</footer>
	</div>
</body>

</html>