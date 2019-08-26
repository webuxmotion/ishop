<?php

namespace ishop\base;

class View {
  
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

  public function render($data) {

    $viewFile = APP . "/views/{$this->prefix}{$this->controller}/{$this->view}.php";

    if (is_file($viewFile)) {
      ob_start();
      require $viewFile;
      $content = ob_get_clean();
    } else {
      throw new \Exception("File {$viewFile} does not found!", 500);
    }

    if (false !== $this->layout) {
      $layoutFile = APP . "/views/layouts/{$this->layout}.php";

      if (is_file($layoutFile)) {
        require $layoutFile;
      } else {
        throw new \Exception("Layout {$layoutFile} does not found!", 500);
      }
    }
  }

  public function getMeta() {

  }
}
