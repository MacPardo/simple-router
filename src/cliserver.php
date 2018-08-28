<?php

if (php_sapi_name() !== 'cli-server') {
  die('only for the built-in php server');
}

if (is_file($_SERVER['DOCUMENT_ROOT'] . '/' . $_SERVER['SCRIPT_NAME'])) {
  return false;
}

$_SERVER['SCRIPT_NAME'] = '/index.php';

require 'index.php';

//php -S localhost:8080 src/cliserver.php