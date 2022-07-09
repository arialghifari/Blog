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
    
<header>
      <section class="banner">
        <img src="./assets/banner.jpg" alt="Banner" />
        <h1 class="display-1">THE BLOG</h1>
      </section>
</header>
<div class="login">
    <h1>Login</h1>
        <form action="login.php" method="post">		
            <table>
                <tr class="col-12 col-md-3 mt-5 mb-4">
                    <td>Email</td>
                    <td ><input type="text" name="email"></td>
                </tr>
                <tr class="col-12 col-md-3 mt-5 mb-4">
                    <td>Password</td>
                    <td><input type="password" name="password"></td>
                </tr>
                <tr class="col-12 col-md-3 mt-5 mb-4">
                    <td><input type="submit" name="login" value="Log In"></td>
                </tr>
            </table>
        </form>
        <p>Don't have account?<a href="register.php">Register</a></p>
</div>
</body>
</html>