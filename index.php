<?php

include './connection.php';

$sql_category = "SELECT * FROM category ORDER BY name";
$query_category = mysqli_query($conn, $sql_category);

$sql_post = "SELECT post.id, post.title, post.body, post.image, post.created_at, user.first_name AS 'author'
            FROM post
            LEFT JOIN user ON post.id_user = user.id
            ORDER BY id DESC
            LIMIT 6";
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
      <!-- Start Top Post -->
      <article class="row my-5">
        <div class="col-12 col-md post mb-3">
          <a href="#"><img src="./assets/img1.jpg" alt="" class="post__image-large" /></a>
          <p class="post__date">Aug 17, 2022</p>
          <a href="#">
            <p class="post__title">
              Pellentesque felis in ullamcorper erat eget tellus ultricies
              praesent
            </p>
          </a>
          <a href="#">
            <p class="post__body">
              Lorem ipsum dolor sit amet consectetur, adipisicing elit.
              Dolorem at necessitatibus rem, vero deleniti
            </p>
          </a>
        </div>

        <div class="col-12 col-md post">
          <div class="row mb-3">
            <div class="col-12 col-xl-6">
              <a href="#"><img src="./assets/img2.jpg" alt="" class="post__image" /></a>
            </div>
            <div class="col">
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

          <div class="row mb-3 pe-0">
            <div class="col-12 col-xl-6">
              <a href="#"><img src="./assets/img2.jpg" alt="" class="post__image" /></a>
            </div>
            <div class="col">
              <p class="post__date">Jun 2, 2022</p>
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

          <div class="row mb-3 pe-0">
            <div class="col-12 col-xl-6">
              <a href="#"><img src="./assets/a.jpg" alt="" class="post__image" /></a>
            </div>
            <div class="col">
              <p class="post__date">Jun 1, 2022</p>
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
        </div>
      </article>
      <!-- End Top Post -->

      <hr />

      <div class="row mt-0 mt-md-5">
        <!-- Start Aside -->
        <aside class="col-12 col-md-3 mt-5 mb-4">
          <form action="" method="post" class="search">
            <input type="text" name="search" class="input" placeholder="Search" />

            <img src="./assets/ic_search.svg" alt="" />
          </form>

          <div class="category">
            <p class="category__title">Blog Categories</p>

            <nav class="nav-side" aria-label="Category Navigation">
              <a href="category.php?name=All">
                <p>View All</p>
              </a>
              <?php while ($row = mysqli_fetch_array($query_category)) { ?>
                <a href="category.php?name=<?= $row['name'] ?>">
                  <p><?= $row['name'] ?></p>
                </a>
              <?php } ?>
            </nav>
          </div>
        </aside>
        <!-- End Aside -->

        <!-- Start Recent Post -->
        <article class="col-12 col-md-9 post">
          <p class="title-post">Recent Post</p>
          <div class="row mb-3">
            <?php while ($row_post = mysqli_fetch_array($query_post)) { ?>
              <div class="col-12 col-md-6 col-lg-4 mb-3 card-post">
                <a href="read.php?id=<?= $row_post['id'] ?>">
                  <img src="./assets/post_image/<?= $row_post['image'] ?>" alt="" class="post__image" />
                  <p class="post__date mt-2">by <u><?= $row_post['author'] ?></u> on <?= date("M d Y", strtotime($row_post['created_at'])) ?></p>
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