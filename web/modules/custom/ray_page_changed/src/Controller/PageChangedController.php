<?php

namespace Drupal\ray_page_changed\Controller;

use Drupal\Core\Controller\ControllerBase;

class PageChangedController extends ControllerBase {
  function publish() {
    $curl = curl_init();
    $headers  = [
      'Content-Type: application/json'
    ];
    $postData = [
      'data1' => 'value1',
      'data2' => 'value2'
    ];
    curl_setopt($curl, CURLOPT_URL,"https://eut0pp2ucd.execute-api.ap-southeast-2.amazonaws.com/test");
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($postData));           
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    $result     = curl_exec ($curl);
    $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    return $statusCode;
  }

  public function page() {
    $output = publish();

    return array(
      '#markup' => 'Welcome to our Website. Output = '  + $output
    );
  }
}

?>
