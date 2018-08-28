<?php
declare(strict_types=1);

namespace Router;

class Router {

  private $request;
  private $response;
  private $paths;

  public function __construct() {
    $this->request = new Request();
  }

  public function on(string $method, string $path, Callable $callback) {

  }

  public function run() {

  }

  public function basePath(string $base_path) {

  }

  public function use(Router $router) {
    
  }

}