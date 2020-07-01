<?php
namespace Bowling;

Class Token {
  private static $token;

  /**
   * setToken - Assign a token to the property $token
   * @param string $token A string with the token. This will typically come from the API.
   */
  public static function setToken(string $token): void {
    self::$token = $token;
  }

  /**
   * getToken - Get the token.
   * @return string Returns a string with the token.
   */
  public static function getToken(): ?string {
    return self::$token;
  }
}
