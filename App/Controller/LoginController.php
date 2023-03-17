<?php

namespace App\Controller;

/*
foi criado uma classe "Action" onde há métodos, com lógicas para estruturação da view,
e organização dos controllers.
*/

use App\Connection;
use App\Model\User;
use MC\Controller\Action;
use PDO;

class LoginController extends Action
{

  public function index($view)
  {
    return $this->render($view);
  }

  public function login($view)
  {
    $email = $_POST['email'];
    $password = $_POST['password'];


    $conn = new Connection();
    $conn = $conn->getConnection();


    if (!isset($email)  || !isset($password)) {
      header('Location: /?login=incomplete');
    }


    $sql = "SELECT * FROM user WHERE email = '$email'";
    $query = $conn->prepare($sql);
    $query->execute();

    $row = $query->fetchAll();

    foreach ($row as $key) {
      $id = $key['id'];
      $emailDB = $key['email'];
      $nameDB = $key['name'];
      $hashedPass = $key['password'];
    }

    if ($email == $emailDB) {
      if (password_verify($password, $hashedPass)) {
        session_start();

        $token = base64_encode($emailDB . ':' . $password);

        $_SESSION['authenticated'] = true;
        $_SESSION['id'] = $id;
        $_SESSION['token'] = $token;

        $output = [
          'token' => $token,
          'idUser' => $id,
          'name' => $nameDB,
          'email' => $email
        ];
        $json = json_encode($output, JSON_PRETTY_PRINT);
        echo $json;


        return header("Location: /users/{$id}");
      } else {
        header('Location: /?login=error');
      }
    } else {
      header('Location: /?login=incomplete');
    }
  }

  public function logout()
  {
    session_start();
    session_destroy();
    header("Location: /");
  }
}
