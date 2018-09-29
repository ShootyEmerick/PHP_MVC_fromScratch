<?php

\Core\Router::connect('/', ['controller' => 'app', 'action' => 'index']);
\Core\Router::connect('/user/', ['controller' => 'user', 'action' => 'index']);
\Core\Router::connect('/user/register/', ['controller' => 'user', 'action' => 'register']);
\Core\Router::connect('/user/login/', ['controller' => 'user', 'action' => 'login']);
\Core\Router::connect('/user/show/', ['controller' => 'user', 'action' => 'show']);
\Core\Router::connect('/user/profile/', ['controller' => 'user', 'action' => 'profile']);
\Core\Router::connect('/user/delete/', ['controller' => 'user', 'action' => 'delete']);




\Core\Router::connect('/user/add/', ['controller' => 'user', 'action' => 'add']);
\Core\Router::connect('/test/', ['controller' => '', 'action' => 'index']);
