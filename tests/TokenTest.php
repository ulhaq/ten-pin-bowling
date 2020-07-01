<?php
use Bowling\Token;

class TokenTest extends PHPUnit_Framework_TestCase {
  public function testTheGotTokenShouldBeSameAsTheSetToken() {
    Token::setToken("FakeToken");
    $this->assertSame("FakeToken", Token::getToken());
  }
}
