<?php

include "../../connection.php";
session_start();

if (!isset($_SESSION['user_id'])) {
	return Header('Location: ../../');
}

$id = $_GET['id'];
@$errorMessage = $_GET['err'];

$sql = "SELECT * FROM user WHERE id='$id'";

$row = mysqli_fetch_array(mysqli_query($conn, $sql));

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
							<a href="../post/">
								<p>Post</p>
							</a>
							<a href="../category/">
								<p>Category</p>
							</a>
							<a href="./">
								<p>User</p>
							</a>
						</nav>
					</div>
				</aside>

				<section class="col-12 col-md-9">
					<h3>Edit User</h3>
					<hr>

					<form action="./update.php" method="post">
						<input type="hidden" name="id" value="<?= $row['id'] ?>" class="input mt-1 mb-2">
						<input type="hidden" name="default_email" id="default-email" value="<?= $row['email'] ?>" class="input mt-1 mb-2">

						<label for="email">Email</label>
						<input type="email" name="email" id="email" value="<?= $row['email'] ?>" class="input mt-1 mb-2" required>

						<label for="password">Password</label>
						<input type="password" name="password" id="password" class="input mt-1 mb-2">
						<p><small>* Leave this blank if you don't want to change the password</small></p>

						<label for="first-name">First Name</label>
						<input type="first-name" name="first_name" id="first-name" value="<?= $row['first_name'] ?>" class="input mt-1 mb-2" required>

						<label for="last-name">Last Name</label>
						<input type="last-name" name="last_name" id="last-name" value="<?= $row['last_name'] ?>" class="input mt-1 mb-2" required>

						<input type="checkbox" name="set_as_admin" id="set-as-admin" <?php if ($row['isAdmin'] == '1') echo "checked" ?> class="form-check-input mt-2 me-1 text-start">
						<label for="set-as-admin" class="mt-1 mb-2">Set as admin🔑</label>

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
</body>

</html>