<?php

namespace Drupal\ray_page_changed\Controller;

use Drupal\Core\Controller\ControllerBase;

class PageChangedController extends ControllerBase {
  function publish_data($url, $post_data) {
    try {
      $curl = curl_init();
      $headers  = [
        'Content-Type: application/json'
      ];
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, 1);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($post_data));           
      curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
      $result     = curl_exec ($curl);
      $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    } catch (Exception $e) {
      echo 'Caught exception: ', $e->getMessage(), "\n";
      $statusCode = 500;
    }

    return $statusCode;
  }

  public function page() {
    $webhook_consumer_url = getenv('WEBHOOK_CONSUMER_URL', true) ?: getenv('WEBHOOK_CONSUMER_URL');
    $markup = "Listening to page change events. URL: $webhook_consumer_url";

    if($webhook_consumer_url == false) {
      $markup = "Invalid WEBHOOK_CONSUMER_URL!";
    } else {
      $post_data = [
        'data1' => 'value1',
        'data2' => 'value2'
      ];
      $publish_output = $this->publish_data($webhook_consumer_url, $post_data);
      $markup = "${markup}, publish_output status code: $publish_output";
    }
    
    return array(
      '#markup' => $markup
    );
  }
}

?>
