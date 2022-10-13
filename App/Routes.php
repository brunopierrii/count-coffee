<?php

namespace App;

/*
foi criado uma pasta config, onde contém um diretorio MF/Init, 
onde contém a lógica de iniacialização do sistema,
dentro de uma classe abstrata onde herdo a mesma para class Routes.
*/

use MC\Init\InitRoutes;

/*
class Route, cria as rotas para o usuário
*/

class Routes extends InitRoutes
{
  // inicia as rotas
  protected function createRoutes()
  {

    $pathUrl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $id = str_replace('/users/', '', $pathUrl);

    $routes['home_page'] = [
      'route' => '/',
      'controller' => 'loginController',
      'action' => 'index',
      'view' => 'login'
    ];

    $routes['login'] = [
      'route' => '/login',
      'controller' => 'loginController',
      'action' => 'login',
      'view' => 'login'
    ];

    $routes['logout'] = [
      'route' => '/logout/',
      'controller' => 'loginController',
      'action' => 'logout',
      'view' => 'login'
    ];

    $routes['users'] = [
      'route' => '/users',
      'controller' => 'userController',
      'action' => 'index',
      'view' => 'register'
    ];

    $routes['users_create'] = [
      'route' => '/users/',
      'controller' => 'userController',
      'action' => 'createNewUser',
      'view' => 'register'
    ];

    $routes['user_welcome'] = [
      'route' => "/users/$id",
      'controller' => 'userController',
      'action' => 'index',
      'view' => 'welcome'
    ];

    $routes['user_list'] = [
      'route' => '/user/list/',
      'controller' => 'userController',
      'action' => 'listUsers',
      'view' => 'listUsers'
    ];

    $routes['user_edit'] = [
      'route' => "/edit",
      'controller' => 'userController',
      'action' => 'editUser',
      'view' => 'editUser'
    ];

    $routes['user_delete'] = [
      'route' => "/delete",
      'controller' => 'userController',
      'action' => 'deleteUser',
      'view' => 'deleteUser'
    ];

    $routes['drink_coffee'] = [
      'route' => "/drinkCoffee",
      'controller' => 'userController',
      'action' => 'drinkCoffee',
      'view' => 'welcome'
    ];



    $this->setRoutes($routes);
  }
}
