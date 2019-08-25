<?php

namespace ishop\base;

abstract class View {
  
  public $route;
  public $controller;
  public $model;
  public $view;
  public $prefix;
  public $layout;
  public $data = [];
  public $meta = [];

  public function __construct($route, $layout = '', $view = '', $meta) {
    $this->route = $route;  
    $this->controller = $route['controller'];
    $this->model = $route['controller'];
    $this->view = $view;
    $this->prefix = $route['prefix'];
    $this->meta = $meta;
    if ($layout === false) {
      $this->layout = false;
    } else {
      $this->layout = $layout ?: LAYOUT;
    }
  }
}
