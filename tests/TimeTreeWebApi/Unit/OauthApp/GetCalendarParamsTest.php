<?php

namespace Tests\TimeTreeWebApi\Unit\OauthApp;

use PHPUnit\Framework\TestCase;
use TimeTreeWebApi\OauthApp\Parameter\GetCalendarParams;

class GetCalendarParamsTest extends TestCase
{
  private $instance;

  protected function setUp(): void
  {
    $this->instance = new GetCalendarParams(
      "abc-calendar-id",
      false,
      true
    );
  }

  public function testGetCalendarId()
  {
    $params = $this->instance->getCalendarId();

    $this->assertEquals($params, "abc-calendar-id");
  }

  public function testGetInclude()
  {
    $params = $this->instance->getInclude();

    $this->assertEquals($params, ["include" => "members"]);
  }
}
