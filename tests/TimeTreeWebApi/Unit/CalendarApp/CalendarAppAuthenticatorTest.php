<?php

namespace Tests\TimeTreeWebApi\Unit\CalendarApp;

use GuzzleHttp\Psr7\Response;
use Mockery;
use PHPUnit\Framework\TestCase;
use TimeTreeWebApi\CalendarApp\CalendarAppAuthenticator;
use Tests\TimeTreeWebApi\Unit\CalendarApp\Fixtures\CalendarAppFixtures;

class CalendarAppAuthenticatorTest extends TestCase
{

  protected $privateKey;

  protected function setUp(): void
  {
    $this->privateKey = CalendarAppFixtures::getSecretKey();
  }

  protected function tearDown(): void
  {
    Mockery::close();
  }

  public function testGenerateToken()
  {
    // response 200
    $response = new Response(200, [], '{"access_token":"valid_access_token"}');
    $this->mock = Mockery::mock("overload:TimeTreeWebApi\Request");
    $this->mock->shouldReceive('post')->withAnyArgs()->andReturn($response);

    $calendarAppAuth = new CalendarAppAuthenticator(1, $this->privateKey);
    $token = $calendarAppAuth->getAccessToken(123);

    $this->assertEquals($token, "valid_access_token");
  }

  public function testFaildGenerateToken()
  {
    // response not 200
    $response = new Response(401);
    $this->mock = Mockery::mock("overload:TimeTreeWebApi\Request");
    $this->mock->shouldReceive('post')->withAnyArgs()->andReturn($response);

    $calendarAppAuth = new CalendarAppAuthenticator(1, $this->privateKey);
    $token = $calendarAppAuth->getAccessToken(123);

    $this->assertEquals($token, "");
  }
}
