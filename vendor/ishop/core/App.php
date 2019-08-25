<?php

namespace ishop;

class App {

  public static $app;
  
  public function __construct() {
    session_start();
    self::$app = Registry::instance();
    $this->getParams();
    new ErrorHandler();
    $query = $this->getQuery();
    Router::dispatch($query);
  }

  protected function getParams() {
    $params = require_once CONF . '/params.php';
    if (!empty($params)) {
      foreach ($params as $k => $v) {
        self::$app->setProperty($k, $v);
      }
    }
  }

  protected function getQuery() {
    $query = $_SERVER['REQUEST_URI'];
    $query = substr($query, 1);  
    $query = rtrim($query, '/');

    return $query;
  }
}
