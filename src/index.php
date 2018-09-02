<?php

namespace Router;

require_once 'vendor/autoload.php';

echo 'hello<br>';

$router = new Router();

$router->on('GET', '/teste/lalal', function() {

});


$router->on('GET', '/teste/lalal', function() {

});

$router->on('GET', '/books/:param', function() {
  echo 'The books stuff is working';
});

$router->on('GET', ':param/:param/', function() {
  echo 'This other stuff is working too';
});

$router->run();