<?php

session_start();

$this->validLogin();
$id = $_SESSION['id'];

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
    <form action="/edit" method="post">
      <div class="imgcontainer">
        <a href="<?= '/users/' . $id ?>"><img src=" ../img/coffe.png" alt="Avatar" class="avatar"></a>
      </div>

      <div class="container">
        <label for="email"><b>Email</b></label>
        <input type="email" name="email" required>

        <label for="password"><b>Name</b></label>
        <input type="text" name="name" required>

        <label for="password"><b>Password</b></label>
        <input type="password" name="password" required>

        <button type="submit">Edit User</button>
      </div>
    </form>
  </div>
</body>

</html>