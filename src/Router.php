<?php
declare(strict_types=1);

namespace Router;

class Router {

  private $request;
  private $routes = []; // [method => [route => callback]]
  private $subRouters = [];
  private $basePath = '';

  public function __construct() {
    $this->request = new Request();
  }

  public function on(string $method, string $path, Callable $callback): Router {

    $method = strtoupper($method);

    if (!isset($this->routes[$method])) {
      $this->routes[$method] = [];
    }

    $path = trim($path, '/');

    $this->routes[$method][$path] = $callback;

    return $this;
  }

  private function getParams(string $path) {

    $params = [];

    foreach (explode('/', $path) as $part) {
      if (preg_match('@^:@', $part)) {
        $params[] = ltrim($part, ':');
      }
    }

    return $params;
  }

  public function relativeRun(string $relativePath): bool {
    if (!isset($this->routes[$this->request->method])) {
      return false;
    }

    $routes = $this->routes[$this->request->method];

    foreach ($routes as $path => $callback) {

      $path = trim(
        trim($this->basePath, '/') . '/' . $path,
        '/'
      );

      $params = $this->getParams($path);
      $regex = '@^' . preg_replace('(:\w+)', '(\w+)', $path) . '$@';

      if (preg_match($regex, $relativePath, $matches)) {
        array_shift($matches);

        foreach ($matches as $index => $val) {
          $this->request->addParam($params[$index], $val);
        }
        call_user_func_array($callback, [$this->request]);

        return true;
      }
    }

    return false;
  }

  public function run(): bool {
    return $this->relativeRun($this->request->path);
  }

  public function use(Router $router): Router {
    $this->subRouters[] = $router;
    return $this;
  }

  public function base(string $basePath): Router {
    $this->basePath = $basePath;
    return $this;
  }

}