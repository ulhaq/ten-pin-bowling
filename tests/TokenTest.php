<?php
use Bowling\Token;
use PHPUnit\Framework\TestCase;

class TokenTest extends TestCase {
  public function testTheGotTokenShouldBeSameAsTheSetToken() {
    Token::setToken("FakeToken");
    $this->assertSame("FakeToken", Token::getToken());
  }
}
