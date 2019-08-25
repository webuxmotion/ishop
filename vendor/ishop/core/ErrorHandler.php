<?php

namespace ishop;

class ErrorHandler {

  public function __construct() {
    if (DEBUG) {
      error_reporting(-1);
    } else {
      error_reporting(0);
    }
    set_exception_handler([$this, 'exceptionHandler']);
  }

  public function exceptionHandler($e) {
    $this->logErrors($e->getMessage(), $e->getFile(), $e->getLine());
    $this->displayError('Exception', $e->getMessage(), $e->getFile(), $e->getLine(), $e->getCode());
  }

  protected function logErrors($message = '', $file = '', $line = '') {
    $mes = "[" . date('Y-m-d H:i:s') . "] Message: {$message} | File: {$file} | Line: {$line} \n============\n";
    $destination = ROOT . '/tmp/errors.log';  

    error_log($mes, 3, $destination);
  }

  protected function displayError($errno, $errstr, $errfile, $errline, $responce = 404) {

    http_response_code($responce);

    if ($responce == 404 && !DEBUG) {
      require WWW . '/errors/404.php';   
      die;
    }
    if (DEBUG) {
      require WWW . '/errors/dev.php';
    } else {
      require WWW . '/errors/prod.php';
    }
    die;
  }
}
