<?php

session_start();

$this->validLogin();
$id = $_SESSION['id'];
if ($_SESSION['authenticated'] == true) {
  header("Location: /users/$id");
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home - Coffe</title>
  <link rel="stylesheet" href="../css/style.css">
  <style>

  </style>
</head>

<body>
  <div class="container">


    <form action="/login" method="post">
      <div class="imgcontainer">
        <img src="../img/coffe.png" alt="Avatar" class="avatar">
      </div>

      <div class="container">

        <label for="email"><b>Email</b></label>
        <input type="email" name="email">

        <label for="password"><b>Password</b></label>
        <input type="password" name="password">

        <?php if (isset($_GET['login']) && $_GET['login'] == 'incomplete') { ?>

          <div>
            Invalid credentials, check your data
          </div>
        <?php } ?>

        <?php if (isset($_GET['login']) && $_GET['login'] == 'error') { ?>

          <div>
            Invalid email or password
          </div>
        <?php } ?>
        <button type="submit">Login</button>
        <div>
          <input type="checkbox" checked="checked" name="remember"> Remember me
        </div>
        <div>
          <a class="registerbtn" href="/users">Register.</a>
        </div>
      </div>
    </form>
  </div>
</body>

</html>