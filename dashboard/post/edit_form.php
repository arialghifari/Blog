<?php

include "../../connection.php";
session_start();

if (!isset($_SESSION['user_id'])) {
	return Header('Location: ../../');
}

$id = $_GET['id'];
$sql = "SELECT * FROM post WHERE id='$id'";
$row = mysqli_fetch_array(mysqli_query($conn, $sql));

$sql_category = "SELECT * FROM category ORDER BY name";
$query_category = mysqli_query($conn, $sql_category);

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
			<a href="../../"><img src="../../assets/logo.svg" alt="The Blog Logo" /></a>

			<div>
				<?php if ($_SESSION['user_id']) { ?>
					<p class="m-0 rounded-0 dropdown-toggle cursor-pointer" data-bs-toggle="dropdown" aria-expanded="false"><?= $_SESSION['user_first_name']; ?></p>
					<ul class="dropdown-menu dropdown-menu-end rounded-0">
						<li><a href="../"><button class="dropdown-item" type="button">Dashboard</button></a></li>
						<li><a href="../../logout/"><button class="dropdown-item" type="button">Logout</button></a></li>
					</ul>
				<?php } ?>
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
						<nav class="nav-side mb-4 p-0" aria-label="Manage Navigation">
							<a href="../">
								<p>Dashboard</p>
							</a>
						</nav>

						<p class="manage__title">Manage</p>
						<nav class="nav-side" aria-label="Manage Navigation">
							<?php if ($_SESSION['user_isAdmin']) { ?>
								<a href="./">
									<p>Post</p>
								</a>
								<a href="../category/">
									<p>Category</p>
								</a>
								<a href="#">
									<p>User</p>
								</a>
							<?php } else { ?>
								<a href="./">
									<p>Post</p>
								</a>
							<?php } ?>
						</nav>
					</div>
				</aside>

				<section class="col-12 col-md-9">
					<h3>Edit Post</h3>
					<hr>

					<form action="./update.php" method="post" enctype="multipart/form-data">
						<input type="hidden" name="id" value="<?= $row['id'] ?>" class="input mt-1 mb-2">

						<label for="title">Title</label>
						<input type="text" name="title" id="title" value="<?= $row['title'] ?>" class="input mt-1 mb-2" required>

						<label for="image">Image</label>
						<img src="../../assets/post_image/<?= $row['image'] ?>" class="preview__image" alt="" />
						<input type="file" name="image" id="image" class="input mt-1 mb-2" accept="image/webp, image/png, image/jpg, image/jpeg">
						<p><small>* Leave this blank if you don't want to change the image</small></p>

						<label for="body">Body</label>
						<textarea name="body" id="body" class="input mt-1 mb-2" cols="30" rows="10" required><?= $row['body'] ?></textarea>

						<label for="category">Category</label>
						<select name="category" id="category" class="input mt-1 mb-2" required>
							<option disabled>Choose</option>
							<?php while ($row_category = mysqli_fetch_array($query_category)) { ?>
								<option value="<?= $row_category['name'] ?>" <?php if ($row_category['name'] == $row['category']) echo 'selected' ?>>
									<?= $row_category['name'] ?>
								</option>
							<?php } ?>
						</select>

						<?php if ($_SESSION['user_isAdmin']) { ?>
							<input type="checkbox" <?= $row['isMain'] == 1 ? "checked" : "" ?> name="set_to_main" id="set-to-main" class="form-check-input mt-2 me-1 text-start">
							<label for="set-to-main" class="mt-1 mb-2">Set this to main post🔥</label>
						<?php } ?>

						<?php if ($errorMessage) { ?>
							<p class="error">* <?= $errorMessage ?></p>
						<?php } ?>
						<input type="submit" name="submit" value="Update" class="btn-primary">
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