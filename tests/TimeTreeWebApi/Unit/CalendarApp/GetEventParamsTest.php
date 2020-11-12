<?php

namespace Tests\TimeTreeWebApi\Unit\CalendarApp;

use PHPUnit\Framework\TestCase;
use TimeTreeWebApi\CalendarApp\GetEventParams;

class GetEventParamsTest extends TestCase
{
  public function testGetEventId()
  {
    $instance = new GetEventParams("eventIdString");
    $params = $instance->getEventId();

    $this->assertEquals($params, "eventIdString");
  }
}
