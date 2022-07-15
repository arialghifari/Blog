<?php

include '../../connection.php';
session_start();

if (!isset($_SESSION['user_id'])) {
	return Header('Location: ../../');
}

if ($_SESSION['user_isAdmin']) {
	$sql = "SELECT post.id, post.title, post.created_at, post.category, post.isMain,user.first_name AS 'author'
			FROM post
			LEFT JOIN user ON post.id_user = user.id
			ORDER BY created_at DESC";
} else {
	$user_id = $_SESSION['user_id'];

	$sql = "SELECT post.id, post.title, post.created_at, post.category, post.isMain,user.first_name AS 'author'
			FROM post
			LEFT JOIN user ON post.id_user = user.id
			WHERE id_user='$user_id'
			ORDER BY created_at DESC";
}
$query = mysqli_query($conn, $sql);

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
									<p class="active">Post</p>
								</a>
								<a href="../category/">
									<p>Category</p>
								</a>
								<a href="../user/">
									<p>User</p>
								</a>
							<?php } else { ?>
								<a href="./">
									<p class="active">Post</p>
								</a>
							<?php } ?>
						</nav>
					</div>
				</aside>

				<section class="col-12 col-md-9">
					<a href="./add_form.php" class="btn-primary mb-3">Add Post</a>

					<div class="overflow-auto">
						<table class="table">
							<tr>
								<th>No</th>
								<th>Title</th>
								<th>Category</th>
								<?php if ($_SESSION['user_isAdmin']) { ?>
									<th>Author</th>
								<?php } ?>
								<th>Publised At</th>
								<th class="text-center">Action</th>
							</tr>
							<?php
							$no = 1;

							while ($row = mysqli_fetch_array($query)) {
								$title = $row['title'];
							?>

								<tr>
									<th><?= $no ?></th>
									<td><?= $row['isMain'] == 1 ? "🔥" : ""; ?>
										<?= $row['title'] ?>
									</td>
									<td><?= $row['category'] ?></td>
									<?php if ($_SESSION['user_isAdmin']) { ?>
										<td><?= $row['author'] ?></td>
									<?php } ?>
									<td><?= date("M d Y", strtotime($row['created_at'])) ?></td>
									<td>
										<div class="d-flex justify-content-center align-items-center gap-2">
											<a href="../../read.php?id=<?= $row['id'] ?>" target="_blank" title="view"><img src="../../assets/ic_eye.svg" alt="" /></a>
											<a href="./edit_form.php?id=<?= $row['id'] ?>" title="edit"><img src="../../assets/ic_edit.svg" alt="" /></a>
											<a href="./delete.php?id=<?= $row['id'] ?>" title="delete" onclick="return confirm('Do you want to delete _<?= $title ?>_ post?')"><img src="../../assets/ic_trash.svg" alt="" /></a>
										</div>
									</td>
								</tr>

							<?php
								$no++;
							}
							?>
						</table>
					</div>
				</section>
		</main>

		<footer>
			<p>Copyright © <?= date('Y') ?> <a href="#">The Blog</a></p>
		</footer>
	</div>
</body>

</html>