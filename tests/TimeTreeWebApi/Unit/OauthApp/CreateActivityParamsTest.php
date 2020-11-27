<?php

namespace Tests\TimeTreeWebApi\Unit\OauthApp;

use PHPUnit\Framework\TestCase;
use TimeTreeWebApi\OauthApp\Parameter\CreateActivityParams;

class CreateActivityParamsTest extends TestCase
{
  private $instance;

  protected function setUp(): void
  {
    $this->instance = new CreateActivityParams(
      "abc-calendar-id",
      "abc-event-id",
      "test content",
    );
  }

  public function testGetParams()
  {
    $params = $this->instance->getParams();

    $this->assertEquals($params, [
      "data" => [
        "attributes" => [
          "content" => "test content"
        ]
      ]
    ]);
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
