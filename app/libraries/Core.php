<?php
/*
 * Core application class
 * Create URL & loads core Controller
 * URL FORMAT - /controller/method/params
 */
class Core {
  protected $currentController = 'Pages';
  protected $currentMethod = 'index';
  protected $params = [];

  public function __construct() {
    // print_r($this->getUrl());

    $url = $this->getUrl();

    // Look in controllers for first time
    if ( file_exists(APPROOT . '/controllers/' . ucwords($url[0]) . '.php' )) {
      // If exists, set as controller
      $this->currentController = ucwords($url[0]);
      // Unset 0 index
      unset( $url[0] );
    }

    // Require the controller
    require_once APPROOT . '/controllers/' . $this->currentController . '.php';

    // Instantiate the controller class
    $this->currentController = new $this->currentController;

    // Check for second part of url
    if ( isset($url[1]) ) {
      // Check to see if method exists in controllers
      if ( method_exists($this->currentController, $url[1]) ) {
        $this->currentMethod = $url[1];
        // Unset 1 index from url
        unset($url[1]);
      }
    }

    // Get parameters
    $this->params = $url ? array_values($url) : [];

    // Call a callback with array of parameters
    call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
  }

  public function getUrl() {
    if ( isset($_GET['url']) ) {
      $url = rtrim($_GET['url'], '/');
      $url = filter_var($url, FILTER_SANITIZE_URL);
      $url = explode('/', $url);
      return $url;
    }
  }
}
