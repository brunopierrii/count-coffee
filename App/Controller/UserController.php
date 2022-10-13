<?php

namespace App\Controller;

use App\Connection;
use App\Model\User;
use MC\Controller\Action;
use PDO;

class UserController extends Action
{
  public function index($view)
  {

    session_start();

    $this->validLogin();

    $currentId = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $currentId = str_replace('/users/', '', $currentId);

    switch ($view) {
      case 'welcome':
        $this->render($view);
        break;
      case 'register':
        $this->render($view);
        break;
    }
  }

  public function createNewUser()
  {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $password = $this->hashPass($_POST['password']);
    $token = $this->hashPass($name);

    if (!isset($email)  || !isset($password)) {
      header('Location: /?login=incomplete');
    }

    $arrayForm = [
      'email' => $email,
      'name' => $name,
      'password' => $password,
      'token' => $token

    ];
    $json = json_encode($arrayForm);

    // instância de conexão, e busca de query
    $conn = new Connection();
    $conn = $conn->getConnection();
    $dataset = $conn->query("SELECT * FROM user");
    $dataset = $dataset->fetchAll();

    foreach ($dataset as $data) {
      $result = $data['email'];
    }
    if ($email !== $result) {

      $info[] = json_decode($json);

      foreach ($info as $index) {
        $email = $index->email;
        $name = $index->name;
        $password = $index->password;
      }

      $sql = "INSERT INTO user(email,name,password) VALUES ('$email','$name','$password')";
      $query = $conn->prepare($sql);
      $query->execute();

      return header("Location: /");
    } else {
      return header('Location: /users?register=error');
    }
  }

  public function getUser($idUser)
  {
    session_start();
    $user = new User();
    $drinkCounter = $user->drinkCounter($idUser);

    $conn = new Connection();
    $conn = $conn->getConnection();
    $search = $conn->query("SELECT * FROM user WHERE id = $idUser");
    $search = $search->fetchAll(PDO::FETCH_ASSOC);

    foreach ($search as $key) {
      $result['id'] = $key['id'];
      $result['name'] = $key['name'];
      $result['email'] = $key['email'];
      $result['drinkCounter'] = $drinkCounter;
    }


    $json = json_encode($result);
    return $json;
  }

  public function listUsers($view)
  {
    return $this->render($view);
  }

  public function getAllUser()
  {
    session_start();

    $conn = new Connection();
    $conn = $conn->getConnection();
    $search = $conn->query("SELECT * FROM user");
    $search = $search->fetchAll(PDO::FETCH_ASSOC);

    $json = json_encode($search);
    return $json;
  }

  public function getDrink($id)
  {
    session_start();

    $id = $_SESSION['id'];

    $conn = new Connection();
    $conn = $conn->getConnection();
    $conn = new Connection();
    $conn = $conn->getConnection();
    $search = $conn->query("SELECT * FROM coffee");
    $search = $search->fetchAll(PDO::FETCH_ASSOC);

    $coffee = $search[0]['drank_coffee'];

    return $coffee;
  }

  public function editUser()
  {
    session_start();
    $this->render('editUser');


    $id = $_SESSION['id'];
    $email = $_POST['email'];
    $name = $_POST['name'];
    $password = $this->hashPass($_POST['password']);

    if (isset($email) && isset($name) && isset($password)) {
      $conn = new Connection();
      $conn = $conn->getConnection();

      $query = $conn->prepare("UPDATE user SET name = '$name', email= '$email', password= '$password' WHERE id= '$id'");
      $query->execute();

      return header("Location: /users/$id");
    }
  }

  public function deleteUser($view)
  {
    session_start();
    $this->render($view);


    $id = $_POST['id'];
    $idSession = $_SESSION['id'];

    if (isset($id)) {
      $conn = new Connection();
      $conn = $conn->getConnection();

      if ($id == $idSession) {
        $query = $conn->prepare("DELETE FROM  user WHERE id= '$id'");
        $query->execute();

        session_destroy();
        header("Location: /");
      } else {
        $query = $conn->prepare("DELETE FROM  user WHERE id= '$id'");
        $query->execute();

        header("Location: /delete");
      }
    }
  }

  public function drinkCoffee()
  {
    session_start();



    $id = $_SESSION['id'];
    $pathUrl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $dateTime = date('Y-m-d h:i:s');

    $currentId = $this->getUser($id);
    var_dump($currentId);

    $user = new User();
    $drinkCounter = $user->drinkCounter($id);

    var_dump($drinkCounter);

    $conn = new Connection();
    $conn = $conn->getConnection();

    if ($pathUrl == '/drinkCoffee') {
      $drinkCoffee = 0;

      if ($drinkCounter == 0) {
        $drinkCoffee++;

        $sql = "INSERT INTO coffee(id_user,drank_coffee,date_time) VALUES ('$id','$drinkCoffee','$dateTime')";
        $query = $conn->prepare($sql);
        $query->execute();
        $conn = null;

        header("Location: /users/$id");
      } else {

        $drinkCoffee = $drinkCounter + 1;

        $query = $conn->prepare("UPDATE coffee SET drank_coffee = '$drinkCoffee' WHERE id_user = '$id'");
        $query->execute();
        $conn = null;

        header("Location: /users/$id");
      }
    }
  }
}
