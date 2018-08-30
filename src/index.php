<?php

namespace Router;

require_once 'vendor/autoload.php';

echo 'hello<br>';

$router = new Router();

$router->on('GET', '/teste/lalal', function() {

});