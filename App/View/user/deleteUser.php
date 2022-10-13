<?php

session_start();

$this->validLogin();
$id = $_SESSION['id'];
$users = $this->getAllUser();

echo '<br>';

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home - Coffe</title>
  <link rel="stylesheet" href="../../css/style.css">
  <style>

  </style>
</head>

<body>
  <div class="container">


    <form action="delete" method="post">
      <div class="imgcontainer">
        <a href="<?= '/users/' . $id ?>"><img src="../../img/coffe.png" alt="Avatar" class="avatar"></a>
      </div>

      <a class="registerbtn container" href="/logout/">logout</a>

      <a class="registerbtn container" style="margin-left: 20px" href="">Drink Coffee</a>

      <a class="registerbtn container" style="margin-left: 5px" href="">List Users</a>




      <table>
        <thead>
          <th>Id</th>
          <th>Name</th>
          <th>Email</th>
        </thead>
        <tbody>
          <?php
          $list = json_decode($users, true);


          foreach ($list as $key => $value) {
            $data = [
              $value['id'],
              $value['name'],
              $value['email']
            ];
          ?>
            <tr>
              <th><?= $data[0] ?></th>
              <th><?= $data[1] ?></th>
              <th><?= $data[2] ?></th>
            </tr>
          <?php } ?>
        </tbody>
      </table>

      <div class="container">
        <div>
          <a class="registerbtn" href="/users">Register</a><br><br>
          <input type="number" name="id">
          <button type="submit" style="width: 80px" href="/delete">Delete</button>
        </div>
      </div>
    </form>
  </div>
</body>

</html>