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
			<a href="#"><img src="./assets/logo.svg" alt="The Blog Logo" /></a>

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
			<div class="row mt-0 mt-md-5">
				<!-- Start Aside -->
				<aside class="col-12 col-md-3 mb-4">
					<div class="category">
						<p class="manage__title">Blog Categories</p>

						<nav class="nav-side" aria-label="Category Navigation">
							<a href="#">
								<p class="active">View All</p>
							</a>
							<a href="#">
								<p>Technology</p>
							</a>
							<a href="#">
								<p>Intermezzo</p>
							</a>
							<a href="#">
								<p>Politics</p>
							</a>
							<a href="#">
								<p>Lifestyle</p>
							</a>
							<a href="#">
								<p>Food</p>
							</a>
						</nav>
					</div>
				</aside>
				<!-- End Aside -->

				<!-- Start Recent Post -->
				<article class="col-12 col-md-9 post">
					<p class="title-post">Recent Post</p>
					<div class="row mb-3">
						<div class="col-12 col-md-6 col-lg-4 mb-3">
							<a href="#"><img src="./assets/img2.jpg" alt="" class="post__image" /></a>
							<p class="post__date">Jun 1, 20231</p>
							<a href="#">
								<p class="post__title">Pellentesque felis</p>
							</a>
							<a href="#">
								<p class="post__body">
									Lorem ipsum dolor sit amet consectetur, adipisicing elit.
									Dolorem at necessitatibus rem, vero delenitiLorem ipsum
									dolor sit amet consectetur, adipisicing elit. Dolorem at
									necessitatibus rem, vero delenitiLorem ipsum dolor sit amet consectetur, adipisicing elit.
									Dolorem at necessitatibus rem, vero deleniti
								</p>
							</a>
						</div>

						<div class="col-12 col-md-6 col-lg-4 mb-3">
							<a href="#"><img src="./assets/img2.jpg" alt="" class="post__image" /></a>
							<p class="post__date">Jun 1, 20231</p>
							<a href="#">
								<p class="post__title">
									Pellentesque felis in ullamcorper erat eget
								</p>
							</a>
							<a href="#">
								<p class="post__body">
									Lorem ipsum dolor sit amet consectetur, adipisicing elit.
									Dolorem at necessitatibus rem, vero deleniti
								</p>
							</a>
						</div>

						<div class="col-12 col-md-6 col-lg-4 mb-3">
							<a href="#"><img src="./assets/img2.jpg" alt="" class="post__image" /></a>
							<p class="post__date">Jun 1, 20231</p>
							<a href="#">
								<p class="post__title">
									Pellentesque felis in ullamcorper erat eget
								</p>
							</a>
							<a href="#">
								<p class="post__body">
									Lorem ipsum dolor sit amet consectetur, adipisicing elit.
									Dolorem at necessitatibus rem, vero deleniti
								</p>
							</a>
						</div>

						<div class="col-12 col-md-6 col-lg-4 mb-3">
							<a href="#"><img src="./assets/img2.jpg" alt="" class="post__image" /></a>
							<p class="post__date">Jun 1, 20231</p>
							<a href="#">
								<p class="post__title">
									Pellentesque felis in ullamcorper erat eget
								</p>
							</a>
							<a href="#">
								<p class="post__body">
									Lorem ipsum dolor sit amet consectetur, adipisicing elit.
									Dolorem at necessitatibus rem, vero deleniti
								</p>
							</a>
						</div>

						<div class="col-12 col-md-6 col-lg-4 mb-3">
							<a href="#"><img src="./assets/img2.jpg" alt="" class="post__image" /></a>
							<p class="post__date">Jun 1, 20231</p>
							<a href="#">
								<p class="post__title">
									Pellentesque felis in ullamcorper erat eget
								</p>
							</a>
							<a href="#">
								<p class="post__body">
									Lorem ipsum dolor sit amet consectetur, adipisicing elit.
									Dolorem at necessitatibus rem, vero deleniti
								</p>
							</a>
						</div>

						<div class="col-12 col-md-6 col-lg-4 mb-3">
							<a href="#"><img src="./assets/img2.jpg" alt="" class="post__image" /></a>
							<p class="post__date">Jun 1, 20231</p>
							<a href="#">
								<p class="post__title">
									Pellentesque felis in ullamcorper erat eget
								</p>
							</a>
							<a href="#">
								<p class="post__body">
									Lorem ipsum dolor sit amet consectetur, adipisicing elit.
									Dolorem at necessitatibus rem, vero deleniti
								</p>
							</a>
						</div>
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