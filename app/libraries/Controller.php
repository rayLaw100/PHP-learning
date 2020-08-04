<?php
/*
 * Base Controller
 * Loads the model and views
 */
class Controller {

  // Load model
  public function model($model) {
    // Require model file
    require_once APPROOT . '/models/' . $model . '.php';

    // Instantiate the model
    return new $model();
  }

  // Load view
  public function view($view, $data = []) {
    // Check for view file
    if ( file_exists(APPROOT . '/views/' . $view . '.php') ) {
      require_once APPROOT . '/views/' . $view . '.php';
    } else {
      // View does not exist
      die('View ' . $view . ' does not exist');
    }
  }

  // Redirect page
  public function redirect($view = '') {
    header('Location: ' .  URLROOT .  $view);
  }
}
