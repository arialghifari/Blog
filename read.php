<?php

include './connection.php';

$id = $_GET['id'];

$sql_category = "SELECT * FROM category ORDER BY name";
$query_category = mysqli_query($conn, $sql_category);

$sql_post = "SELECT post.id, post.title, post.body, post.image, post.created_at, post.category, user.first_name AS 'author'
						FROM post
						LEFT JOIN user ON post.id_user = user.id
						WHERE post.id='$id'";
$row_post = mysqli_fetch_array(mysqli_query($conn, $sql_post));

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="./style/bootstrap.min.css" />
	<script src="./style/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" href="./style/main.css" />
	<title><?= $row_post['title'] ?> — The Blog</title>
</head>

<body>
	<div class="container">
		<!-- Start Top Navigation -->
		<nav class="nav-main" aria-label="main navigation">
			<a href="./"><img src="./assets/logo.svg" alt="The Blog Logo" /></a>

			<div>
				<a href="#">About Us</a>
				<a href="#">Contact Us</a>
			</div>
		</nav>
		<!-- End Top Navigation -->

		<header>
			<section class="banner">
				<img src="./assets/banner.jpg" alt="Banner" />
				<h1 class="display-1">THE BLOG</h1>
			</section>
		</header>

		<main>
			<!-- Start Post -->
			<article class="row read d-flex justify-content-center">
				<div class="col-md-8">
					<div class="row mt-5 mb-2">
						<h1 class="read__title"><?= $row_post['title'] ?></h1>
					</div>
					<div class="row m-0 mt-3">
						<img class="read__image" src="./assets/post_image/<?= $row_post['image'] ?>" alt="">
					</div>
					<div class="row mt-3">
						<div class="col d-block d-md-flex justify-content-between align-items-center">
							<p class="m-0 mb-2 mb-md-0">by <u><?= $row_post['author'] ?></u> on <?= date("M d Y", strtotime($row_post['created_at'])) ?></p>
							<a href="./category.php?name=<?= $row_post['category'] ?>" class="read__category"><?= $row_post['category'] ?></a>
						</div>
					</div>
					<hr />
					<div class="row">
						<?= $row_post['body'] ?>
					</div>
				</div>
			</article>
			<!-- End Post -->
		</main>

		<footer>
			<p>Copyright © <?= date('Y') ?> <a href="#">The Blog</a></p>
		</footer>
	</div>
</body>

</html>