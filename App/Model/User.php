<?php

namespace App\Model;

use App\Connection;
use PDO;

class User
{
  protected $db;

  private $id;

  private $email;

  private $name;

  private $password;

  public function __construct(PDO $db = null)
  {
    $this->db = $db;
  }

  public function getDb()
  {
    return $this->db;
  }

  public function getId()
  {
    return $this->id;
  }

  public function getEmail()
  {
    return $this->email;
  }

  public function setEmail($email)
  {
    $this->email = $email;

    return $this;
  }

  public function getName()
  {
    return $this->name;
  }

  public function setName($name)
  {
    $this->name = $name;

    return $this;
  }

  public function getPassword()
  {
    return $this->password;
  }

  public function setPassword($password)
  {
    $this->password = $password;

    return $this;
  }

  public function drinkCounter($id)
  {
    session_start();

    $id = $_SESSION['id'];

    $conn = new Connection();
    $conn = $conn->getConnection();
    $conn = new Connection();
    $conn = $conn->getConnection();
    $search = $conn->query("SELECT * FROM coffee WHERE id_user= '$id'");
    $search = $search->fetchAll(PDO::FETCH_ASSOC);

    $coffee = $search[0]['drank_coffee'];

    return $coffee;
  }
}
