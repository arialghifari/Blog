<?php

include '../../connection.php';

$sql = "SELECT post.id, post.title, post.created_at, post.category, user.first_name AS 'author'
				FROM post
				LEFT JOIN user ON post.id_user = user.id
				ORDER BY created_at DESC";
$query = mysqli_query($conn, $sql);

function getCurrentUrl()
{
	$fullUrl = $_SERVER['REQUEST_URI'];
	return explode("/", $fullUrl)[4];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../../style/bootstrap.min.css" />
	<script src="../../style/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" href="../../style/main.css" />
	<title>The Blog</title>
</head>

<body>
	<div class="container">
		<!-- Start Top Navigation -->
		<nav class="nav-main" aria-label="main navigation">
			<a href="../"><img src="../../assets/logo.svg" alt="The Blog Logo" /></a>

			<div>
				<a href="#">About Us</a>
				<a href="#">Contact Us</a>
			</div>
		</nav>
		<!-- End Top Navigation -->

		<header>
			<section class="banner">
				<img src="../../assets/banner.jpg" alt="Banner" />
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
							<a href="./">
								<p class="active">Post</p>
							</a>
							<a href="../category/">
								<p>Category</p>
							</a>
							<a href="../user/">
								<p>User</p>
							</a>
						</nav>
					</div>
				</aside>

				<section class="col-12 col-md-9">
					<a href="./add_form.php" class="btn-primary mb-3">Add Post</a>

					<table class="table">
						<tr>
							<th>No</th>
							<th>Title</th>
							<th>Category</th>
							<th>Author</th>
							<th>Publised At</th>
							<th>Action</th>
						</tr>
						<?php
						$no = 1;

						while ($row = mysqli_fetch_array($query)) {
						?>

							<tr>
								<th><?= $no ?></th>
								<td><?= $row['title'] ?></td>
								<td><?= $row['category'] ?></td>
								<td><?= $row['author'] ?></td>
								<td><?= date("M d Y", strtotime($row['created_at'])) ?></td>
								<td>
									<a href="../../read.php?id=<?= $row['id'] ?>" target="_blank">view</a> |
									<a href="./edit_form.php?id=<?= $row['id'] ?>">edit</a> |
									<a href="./delete.php?id=<?= $row['id'] ?>">delete</a>
								</td>
							</tr>

						<?php
							$no++;
						}
						?>
					</table>
				</section>
		</main>

		<footer>
			<p>Copyright © <?= date('Y') ?> <a href="#">The Blog</a></p>
		</footer>
	</div>
</body>

</html>