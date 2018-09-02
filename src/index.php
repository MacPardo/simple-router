<?php

namespace Router;

require_once 'vendor/autoload.php';

$router = new Router();

$router->on('GET', '/teste/lalal', function() {

});


$router->on('GET', '/teste/lalal', function() {

});

$router->on('GET', '/books/:book_name', function($req) {
?>
<h1><?= $req->params['book_name'] ?></h1>
<?php
});

$router->on('GET', ':param/:param/', function() {
  echo 'This other stuff is working too';
});

$router->run();