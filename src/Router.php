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

    $path_array = $this->getPathArray($path);
    print_r($path_array);

    if (!isset($this->routes[$method])) {
      $this->routes[$method] = [];
    }

    $this->routes[$method][] = $path_array;

    return $this;
  }

  public function run(): bool {
    return subRun($this->getPathArray($this->request->path));
  }
  
}