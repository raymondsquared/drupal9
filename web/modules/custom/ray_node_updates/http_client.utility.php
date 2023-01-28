<?php


// TO DO: Unit test this class (ideally with TDD with some mocking library)
class HttpClient {

  // Publish data function accepts a URL and the data
  // it will then encode the data as a JSON and do a POST request to the given URL
  public static function post($url, $data) {
    $status_code = 0;

    if(empty($url) || empty($data)) {
      $status_code = 400;
      return $status_code;
    }

    try {
      $curl = curl_init($url);
      $headers  = [
        'Content-Type: application/json',
        // FIX ME: Ideally read this from key management vault 
        // or even environment variable is a better option
        "x-api-key: uuid-1-2-3",
      ];

      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, 1);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));           
      curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

      $result     = curl_exec ($curl);
      $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    } catch (Exception $e) {
      echo 'Caught exception: ', $e->getMessage(), "\n";
      $status_code = 500;
    }

    return $status_code;
  } 
}

?>
