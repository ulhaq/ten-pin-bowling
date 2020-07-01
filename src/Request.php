<?php
namespace Bowling;

class Request {
  private static $ch;

  /**
   * call - Handle the requests to the API
   * @param  string $method The request method. Either GET or POST.
   * @param  array $data    Optional. Payload data.
   * @return object         Returns an object
   */
  private static function call(string $method, array $data = null) {
    self::$ch = curl_init("http://13.74.31.101/api/points");

    curl_setopt_array(self::$ch, [
      CURLOPT_CUSTOMREQUEST => $method,
      CURLOPT_RETURNTRANSFER => true
    ]);

    if($data) {
      curl_setopt(self::$ch, CURLOPT_POSTFIELDS, json_encode($data));
      $headers[] = "Content-Type: application/json";
      curl_setopt(self::$ch, CURLOPT_HTTPHEADER, $headers);
    }

    $exec = curl_exec(self::$ch);
    curl_close(self::$ch);

    return json_decode($exec);
  }

  /**
   * get - Get a list of random points and a token associated to the points.
   * @return object Returns an object with an array of random points and a token.
   */
  public static function get() {
    return self::call("GET");
  }

  /**
   * post - Post data to the API.
   * @param  array  $data An array of data to post to the API.
   * @return object       Returns an object with the success/failure details and an array consisting of the points.
   */
  public static function post(array $data) {
    return self::call("POST", $data);
  }
}
