<?php

include './connection.php';
session_start();

$id = $_GET['id'];
$category = $_GET['category'];

$sql_category = "SELECT * FROM category ORDER BY name";
$query_category = mysqli_query($conn, $sql_category);

$sql_post = "SELECT post.id, post.title, post.body, post.image, post.created_at, post.category, user.first_name AS 'author'
			FROM post
			LEFT JOIN user ON post.id_user = user.id
			WHERE post.id='$id'";
$row_post = mysqli_fetch_array(mysqli_query($conn, $sql_post));

$sql_category_post = "SELECT post.id, post.title, post.body, post.image, post.category, post.created_at, user.first_name AS 'author'
            FROM post
            LEFT JOIN user ON post.id_user = user.id
			WHERE category LIKE '$category' AND post.id NOT LIKE '$id'
            ORDER BY created_at DESC
            LIMIT 3";
$query_category_post = mysqli_query($conn, $sql_category_post);

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
				<?php if (isset($_SESSION['user_id'])) { ?>
					<p class="m-0 rounded-0 dropdown-toggle cursor-pointer" data-bs-toggle="dropdown" aria-expanded="false"><?= $_SESSION['user_first_name']; ?></p>
					<ul class="dropdown-menu dropdown-menu-end rounded-0">
						<li><a href="./dashboard/"><button class="dropdown-item" type="button">Dashboard</button></a></li>
						<li><a href="./logout/"><button class="dropdown-item" type="button">Logout</button></a></li>
					</ul>
				<?php } else { ?>
					<a href="./login/" class="start-writing">Start Writing</a>
				<?php }  ?>
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
							<p class="read__category">Tag: <?= $row_post['category'] ?></p>
						</div>
					</div>
					<hr />
					<div class="row">
						<?= $row_post['body'] ?>
					</div>
				</div>
			</article>
			<!-- End Post -->

			<hr class="mb-5" />

			<!-- Start Related Post -->
			<article class="row d-flex justify-content-center post">
				<p class="title-post">Related Post</p>
				<div class="row mb-3 p-0">
					<?php if (mysqli_num_rows($query_category_post) <= 0) { ?> <p>No post found</p> <?php } ?>
					<?php while ($row_category = mysqli_fetch_array($query_category_post)) { ?>
						<div class="col-12 col-md-6 col-lg-4 mb-3 card-post">
							<a href="read.php?id=<?= $row_category['id'] ?>&category=<?= $row_category['category'] ?>">
								<img src="./assets/post_image/<?= $row_category['image'] ?>" alt="" class="post__image" />
								<p class="post__date pt-2 m-0">by <u><?= $row_category['author'] ?></u> on <?= date("M d Y", strtotime($row_category['created_at'])) ?></p>
								<p class="post__title"><?= $row_category['title'] ?></p>
								<p class="post__body wrap">
									<?= implode(' ', array_slice(explode(' ', strip_tags($row_category['body'])), 0, 15)); ?>...
								</p>
							</a>
						</div>
					<?php } ?>
				</div>
			</article>
		</main>
		<!-- End Related Post -->

		<footer>
			<p>Copyright © <?= date('Y') ?> <a href="#">The Blog</a></p>
		</footer>
	</div>
</body>

</html>