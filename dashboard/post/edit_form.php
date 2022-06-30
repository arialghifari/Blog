<?php

include "../../connection.php";

$id = $_GET['id'];
$sql = "SELECT * FROM post WHERE id='$id'";

$row = mysqli_fetch_array(mysqli_query($conn, $sql));

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
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
			<div class="row my-4">
				<!-- Start Aside -->
				<aside class="col-12 col-md-3 mb-4">
					<div class="manage">
						<p class="manage__title">Manage</p>

						<nav class="nav-side" aria-label="Manage Navigation">
							<a href="./">
								<p>Post</p>
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
					<h3>Edit Post</h3>
					<hr>

					<form action="./update.php" method="post">
						<input type="hidden" name="id" value="<?= $row['id'] ?>" class="input mt-1 mb-2">

						<label for="title">Title</label>
						<input type="text" name="title" id="title" value="<?= $row['title'] ?>" class="input mt-1 mb-2">

						<label for="image">Image</label>
						<input type="file" name="image" id="image" class="input mt-1 mb-2">

						<label for="body">Body</label>
						<textarea name="body" id="body" class="input mt-1 mb-2" cols="30" rows="10"><?= $row['body'] ?></textarea>

						<label for="category">Category</label>
						<select name="category" id="category" class="input mt-1 mb-2">
							<option value="Technology">Technology</option>
							<option value="Lifestyle">Lifestyle</option>
						</select>

						<input type="submit" name="submit" value="Update" class="btn-primary">
					</form>
				</section>
		</main>

		<footer>
			<p>Copyright © <?= date('Y') ?> <a href="#">The Blog</a></p>
		</footer>
	</div>
</body>

</html>