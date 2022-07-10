<?php

include './connection.php';
session_start();

$category_name = $_GET['name'];

$sql_category = "SELECT * FROM category ORDER BY name";
$query_category = mysqli_query($conn, $sql_category);

if ($category_name == 'All') {
	$sql_post = "SELECT post.id, post.title, post.body, post.image, post.created_at, user.first_name AS 'author'
				FROM post
				LEFT JOIN user ON post.id_user = user.id
				ORDER BY created_at DESC";
} else {
	$sql_post = "SELECT post.id, post.title, post.body, post.image, post.created_at, user.first_name AS 'author'
				FROM post
				LEFT JOIN user ON post.id_user = user.id
				WHERE category = '$category_name'
				ORDER BY created_at DESC";
}
$query_post = mysqli_query($conn, $sql_post);

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
	<title>The Blog</title>
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
			<div class="row mt-0 mt-md-5">
				<!-- Start Aside -->
				<aside class="col-12 col-md-3 mt-5 mb-4">
					<form action="./search.php" method="get" class="search">
						<input type="text" name="name" class="input" placeholder="Search" />

						<img src="./assets/ic_search.svg" alt="" />
					</form>

					<div class="category">
						<p class="category__title">Blog Categories</p>

						<nav class="nav-side" aria-label="Category Navigation">
							<a href="category.php?name=All">
								<p class="<?php if ($category_name == 'All') echo 'active' ?>">View All</p>
							</a>
							<?php while ($row = mysqli_fetch_array($query_category)) { ?>
								<a href="category.php?name=<?= $row['name'] ?>">
									<p class='<?php if ($category_name == $row['name']) echo 'active' ?>'><?= $row['name'] ?></p>
								</a>
							<?php } ?>
						</nav>
					</div>
				</aside>
				<!-- End Aside -->

				<!-- Start Recent Post -->
				<article class="col-12 col-md-9 post">
					<?php if ($category_name == 'All') { ?>
						<p class="title-post">All Post</p>
					<?php } else { ?>
						<p class="title-post">Category "<?= $category_name ?>"</p>
					<?php } ?>
					<div class="row mb-3">
						<?php if (mysqli_num_rows($query_post) <= 0) { ?> <p>No post found</p> <?php } ?>
						<?php while ($row_post = mysqli_fetch_array($query_post)) { ?>
							<div class="col-12 col-md-6 col-lg-4 mb-3 card-post">
								<a href="read.php?id=<?= $row_post['id'] ?>">
									<img src="./assets/post_image/<?= $row_post['image'] ?>" alt="" class="post__image" />
									<p class="post__date pt-2 m-0">by <u><?= $row_post['author'] ?></u> on <?= date("M d Y", strtotime($row_post['created_at'])) ?></p>
									<p class="post__title"><?= $row_post['title'] ?></p>
									<p class="post__body wrap">
										<?= implode(' ', array_slice(explode(' ', strip_tags($row_post['body'])), 0, 15)); ?>...
									</p>
								</a>
							</div>
						<?php } ?>
					</div>
				</article>
				<!-- End Recent Post -->

			</div>
		</main>

		<footer>
			<p>Copyright © <?= date('Y') ?> <a href="#">The Blog</a></p>
		</footer>
	</div>
</body>

</html>