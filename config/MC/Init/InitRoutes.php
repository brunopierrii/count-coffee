<?php

namespace MC\Init;

abstract class InitRoutes
{
  private $routes;

  abstract protected function createRoutes();

  public function __construct()
  {
    $this->createRoutes();
    $this->start($this->getUrl());
  }

  public function setRoutes(array $routes)
  {
    $this->routes = $routes;
  }

  public function getRoutes()
  {
    return $this->routes;
  }

  /*
   getUrl, recebe local onde o usuário se encontra, através do path da URI,
   podendo assim processar novos requests para o sistema.
  */
  protected function getUrl()
  {
    // parse_url interpreta uma URL e retorna seus componentes; recebendo segundo parâmetro para retorno apenas do path.
    return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
  }

  protected function start($url)
  {
    /*
    ao receber a url, percorre por um foreach o array de arrays setado para o atributo $routes, 
    atribuindo  variável $route os respectivos valores. Podendo assim fazer uma verificação,
    sendo atendida, irá criar dinamicamente uma instancia da classe controller, 
    respondendo a action requisitada.
    */
    foreach ($this->getRoutes() as $key => $route) {
      if ($url == '/') {
        $class = 'App\\Controller\\LoginController';

        $controller = new $class;

        $action = 'index';

        $controller->$action('login');
      } elseif ($url == $route['route']) {
        $class = 'App\\Controller\\' . ucfirst($route['controller']);

        $controller = new $class;

        $action = $route['action'];

        $controller->$action($route['view']);
      }
    }
  }
}
