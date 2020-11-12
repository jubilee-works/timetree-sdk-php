<?php

namespace Tests\TimeTreeWebApi\Unit\CalendarApp;

use PHPUnit\Framework\TestCase;
use TimeTreeWebApi\CalendarApp\CreateActivityParams;

class CreateActivityParamsTest extends TestCase
{
  private $instance;

  protected function setUp(): void
  {
    $this->instance = new CreateActivityParams(
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

  public function testGetEventId()
  {
    $params = $this->instance->getEventId();

    $this->assertEquals($params, "abc-event-id");
  }
}
