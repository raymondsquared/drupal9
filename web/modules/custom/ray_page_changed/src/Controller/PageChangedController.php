<?php

namespace Drupal\ray_page_changed\Controller;

use Drupal\Core\Controller\ControllerBase;

class PageChangedController extends ControllerBase {
  public function page() {
    return array(
      '#markup' => 'Welcome to our Website.'
    );
  }
}

?>
