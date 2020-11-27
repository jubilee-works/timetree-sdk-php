<?php

namespace Tests\TimeTreeWebApi\Unit\CalendarApp;

use PHPUnit\Framework\TestCase;
use TimeTreeWebApi\CalendarApp\Parameter\DeleteEventParams;

class DeleteEventParamsTest extends TestCase
{
  public function testGetEventId()
  {
    $instance = new DeleteEventParams("eventIdString");
    $params = $instance->getEventId();

    $this->assertEquals($params, "eventIdString");
  }
}
