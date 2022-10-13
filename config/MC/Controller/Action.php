<?php

namespace MC\Controller;

abstract class Action
{
  protected $views;

  /*
  criacao de objeto padrao para atributo privado view, 
  podendo assim receber atributos de modo dinamico, fazendo que os atributos dinamicos
  possam trazer dados diversos, e ser utilizado dentro dos script que está sendo 
  incluido dentro do método render sem que sejam necessários passar por parâmetro.
  */
  public function __construct()
  {
    $this->views = new \stdClass();
  }

  protected function render($view)
  {
    $currentClass = get_class($this);
    $currentClass = str_replace('App\\Controller\\', '', $currentClass);
    $currentClass = strtolower(str_replace('Controller', '', $currentClass));

    require_once '../App/View/' . $currentClass . '/' . $view . '.php';
  }

  protected function hashPass($password)
  {
    return password_hash($password, PASSWORD_ARGON2ID);
  }

  public function validLogin()
  {
    session_start();

    $token = $_SESSION['token'];

    if (isset($token)) {

      header('Authorization: ' . $token);

      if (
        !isset($_SESSION['authenticated'])
        || $_SESSION['authenticated'] != true
      ) {
        header('Location: /?login=error');
      }
    }
  }

  public function validAuthToken()
  {
    session_start();

    $header = $http_response_header;
  }
}
