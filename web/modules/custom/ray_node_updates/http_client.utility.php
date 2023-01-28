<?php

class HttpClient {

  // Publish data function accepts a URL and a data
  // it will then encode the data as a JSON and do a POST request to the given URL
  public static function post($url, $data) {
    $statusCode = 0;

    try {
      $curl = curl_init($url);
      $headers  = [
        'Content-Type: application/json'
      ];

      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, 1);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));           
      curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

      $result     = curl_exec ($curl);
      $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    } catch (Exception $e) {
      echo 'Caught exception: ', $e->getMessage(), "\n";
      $statusCode = 500;
    }

    return $statusCode;
  } 
}

?>
