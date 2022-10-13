<?php

namespace App;

use PDO;
use PDOException;

class Connection
{
  private $username = 'root';
  private $password = 'Ouro@1992';


  public function getConnection()
  {
    try {

      $conn = new PDO(
        "mysql:host=localhost;dbname=mosyle_coffee;charset=utf8",
        $this->getUsername(),
        $this->getPassword()
      );

      return $conn;
    } catch (PDOException $e) {
      return 'ERROR: ' . $e->getMessage();
    }
  }

  private function getUsername()
  {
    return $this->username;
  }

  private function getPassword()
  {
    return $this->password;
  }
}
