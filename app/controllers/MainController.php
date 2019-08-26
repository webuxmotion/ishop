<?php

namespace app\controllers;

use ishop\App;

class MainController extends AppController {

  public function indexAction() {
    $this->setMeta(App::$app->getProperty('shop_name') . ' | Main page', 'Some description', 'MyDesks, Test keyword');

    $name = 'John';
    $age = 30;
    $this->set(compact('name', 'age'));     
  }
}
