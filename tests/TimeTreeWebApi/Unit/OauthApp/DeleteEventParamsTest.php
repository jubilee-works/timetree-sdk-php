<?php

namespace Tests\TimeTreeWebApi\Unit\OauthApp;

use PHPUnit\Framework\TestCase;
use TimeTreeWebApi\OauthApp\Parameter\DeleteEventParams;

class DeleteEventParamsTest extends TestCase
{
  private $instance;

  protected function setUp(): void
  {
    $this->instance = new DeleteEventParams(
      "abc-calendar-id",
      "abc-event-id",
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
}
