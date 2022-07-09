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
<div class="register">
    <h1>Register</h1>
        <form action="login.php" method="post">		
            <table>
                <tr>
                    <td>Email</td>
                    <td><input type="text" name="email"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="text" name="password"></td>
                </tr>
                <tr>
                    <td>First Name</td>
                    <td><input type="text" name="firstName"></td>
                </tr>
                <tr>
                    <td>Last Name</td>
                    <td><input type="text" name="lastName"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="registere" value="Register"></td>
                </tr>
            </table>
        </form>
        <p>Already have account?<a href="login.php">Login</a></p>
</div>
</body>
</html>