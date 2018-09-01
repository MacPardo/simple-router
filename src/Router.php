<?php
declare(strict_types=1);

namespace Router;

class Router {

  private $request;
  private $routes = []; // [method => [route => callback]]

  public function __construct() {
    $this->request = new Request();
  }

  private function filterEmptyString(array $array): array {
    return array_filter($array, function($el) {
      return $el !== '';
    });
  }

  private function getPathArray(string $path): array {
    return $this->filterEmptyString(explode('/', $path));
  }

  public function on(string $method, string $path, Callable $callback): Router {

    $method = strtoupper($method);

    if (!isset($this->routes[$method])) {
      $this->routes[$method] = [];
    }

    $path = trim($path, '/');

    $this->routes[$method][$path] = $callback;

    print_r($this->routes);
    return $this;
  }

  public function run(): bool {
    if (!isset($this->routes[$this->request->method])) {
      return false;
    }

    $routes = $this->routes[$this->request->method];


  }

}