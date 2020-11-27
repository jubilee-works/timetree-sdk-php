<?php

namespace Tests\TimeTreeWebApi\Unit\OauthApp;

use PHPUnit\Framework\TestCase;
use TimeTreeWebApi\OauthApp\Parameter\GetEventParams;

class GetEventParamsTest extends TestCase
{
  private $instance;

  protected function setUp(): void
  {
    $this->instance = new GetEventParams(
      "abc-calendar-id",
      "abc-event-id",
      true,
      true
    );
  }

  public function testGetCalendarId()
  {
    $params = $this->instance->getCalendarId();

    $this->assertEquals($params, "abc-calendar-id");
  }

  public function testGetEventId()
  {
    $params = $this->instance->getEventId();

    $this->assertEquals($params, "abc-event-id");
  }

  public function testGetInclude()
  {
    $params = $this->instance->getInclude();

    $this->assertEquals($params, ["include" => "labels,members"]);
  }
}
