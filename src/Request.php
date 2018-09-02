<?php
declare(strict_types=1);

namespace Router;

class Request {

  private $path; // string
  private $query = []; // [string => string]
  private $method; // string
  private $params = []; // [string => string]

  public function __construct() {

    $this->method = $_SERVER['REQUEST_METHOD'];
    
    $uri = $_SERVER['REQUEST_URI'];
    $parsed_url = parse_url($uri);

    $this->path = trim($parsed_url['path'], '/');

    if (isset($parsed_url['query'])) {
      $query_parts = explode('&', $parsed_url['query']);
      array_map(function($part) {
        $pair = explode('=', $part);
        $this->query[$pair[0]] = $pair[1];
      }, $query_parts);
    }
  }

  public function __get($name) {
    return $this->$name;
  }

  public function addParam(string $name, string $value) {
    $this->params[$name] = $value;
  }
}
