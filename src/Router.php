<?php
declare(strict_types=1);

namespace Router;

class Router {

  private $request;
  private $routes = []; // [method => [route => callback]]
  private $basePath = "";
  private $subRouters = [];

  public function __construct() {
    $this->request = new Request();
  }

  private function filterEmptyString(array $array): array {
    return array_filter($array, function($el) {
      return $el !== '';
    });
  }

  public function on(string $method, string $path, Callable $callback): Router {

    $method = strtoupper($method);

    $path_array = $this->filterEmptyString(explode('/', $path));
    print_r($path_array);

    if (!isset($this->routes[$method])) {
      $this->routes[$method] = [];
    }

    $this->routes[$method][] = $path_array;

    return $this;
  }

  public function run(): bool {
        
    return false;
  }

  public function basePath(string $base_path) {
    $this->basePath = $basePath;
  }

  public function use(Router $router) {
    $this->subRouters[] = $router;
  }

}