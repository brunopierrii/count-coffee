<?php

session_start();

$this->validLogin();

$id = $_SESSION['id'];
$user = $this->getUser($_SESSION['id']);

echo '<br>';

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


    <form action="" method="get">
      <div class="imgcontainer">
        <img src="../img/coffe.png" alt="Avatar" class="avatar">
      </div>

      <a class="registerbtn container" href="/logout/">logout</a>

      <a class="registerbtn container" style="margin-left: 20px" href="/drinkCoffee">Drink Coffee</a>

      <a class="registerbtn container" style="margin-left: 5px" href="/user/list/">List Users</a>




      <table>
        <thead>
          <th>Id</th>
          <th>Name</th>
          <th>Email</th>
          <th>Amount of coffee</th>
        </thead>
        <tbody>
          <?php
          $array = json_decode($user);
          foreach ($array as $value) {
            $data[] = $value;
          }
          ?>
          <tr>
            <td><?php echo $data[0] ?></td>
            <td><?php echo $data[1] ?></td>
            <td><?php echo $data[2] ?></td>
            <td><?php echo $data[3] ?></td>
          </tr>
        </tbody>
      </table>

      <div class="container">
        <div>
          <a class="registerbtn" href="/users">Register</a><br><br>
          <a class="registerbtn" href="/edit">Edit Current User</a><br><br>
          <a class="registerbtn" href="/delete">Delete Users</a>
        </div>
      </div>
    </form>
  </div>
</body>

</html>