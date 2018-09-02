<?php

namespace Router;

require_once 'vendor/autoload.php';

echo "{request_body}\n";
print_r(file_get_contents('php://input'));
echo "{/request_body}\n";
var_dump($_GET);
echo "\n";

$router = new Router();

$router->on('GET', '/teste/lalal', function() {

});


$router->on('GET', '/teste/lalal', function() {

});

$router->on('GET', '/books/:book_name', function($req) {
?>
<h1><?= $req->params['book_name'] ?></h1>
<p>the query is <?php print_r($req->query)?></p>
<?php
});

$router->on('GET', ':param/:param/', function() {
  echo 'This other stuff is working too';
});

$router->on('POST', '/:param', function($req) {
  echo 'the param is ' . $req->params['param'] . " and the body is \n";
  print_r($req->jsonBody);
});

$router->base('/api/');

$router->run();