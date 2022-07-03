<?php

include "../../connection.php";

$sql = "SELECT * FROM category ORDER BY name";
$query = mysqli_query($conn, $sql);

@$errorMessage = $_GET['err'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../../style/bootstrap.min.css" />
	<script src="../../style/bootstrap.bundle.min.js"></script>
	<script src="https://cdn.tiny.cloud/1/9u2jycvj0mas1t05212h7sepjnmtmcm9md5teyhi7rnnlcpf/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
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
					<h3>Add Post</h3>
					<hr>

					<form action="./add.php" method="post" enctype="multipart/form-data">
						<label for="title">Title</label>
						<input type="text" name="title" id="title" class="input mt-1 mb-2" required>

						<label for="image">Image</label>
						<input type="file" name="image" id="image" class="input mt-1 mb-2" accept="image/png, image/jpg, image/jpeg, image/webp">

						<label for="body">Body</label>
						<textarea name="body" id="body" class="input mt-1 mb-2" cols="60" rows="10" required> </textarea>

						<label for="category">Category</label>
						<select name="category" id="category" class="input mt-1 mb-2" required>
							<option disabled selected>Choose</option>
							<?php while ($row = mysqli_fetch_array($query)) { ?>
								<option value="<?= $row['name'] ?>"><?= $row['name'] ?></option>
							<?php } ?>
						</select>

						<?php if ($errorMessage) { ?>
							<p class="error">* <?= $errorMessage ?></p>
						<?php } ?>
						<input type="submit" name="submit" id="submit" value="Publish" class="btn-primary">
					</form>
				</section>
		</main>

		<footer>
			<p>Copyright © <?= date('Y') ?> <a href="#">The Blog</a></p>
		</footer>
	</div>

	<script>
		tinymce.init({
			selector: 'textarea',
			height: 600,
		});
	</script>
</body>

</html>