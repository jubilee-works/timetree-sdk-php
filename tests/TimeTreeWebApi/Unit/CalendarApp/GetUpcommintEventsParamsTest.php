<?php

namespace Tests\TimeTreeWebApi\Unit\CalendarApp;

use DateTimeZone;
use PHPUnit\Framework\TestCase;
use TimeTreeWebApi\CalendarApp\Parameter\GetUpcomingEventsParams;

class GetUpcommintEventsParamsTest extends TestCase
{

  public function testGetParams()
  {
    $instance = new GetUpcomingEventsParams(new DateTimeZone("Asia/Tokyo"), 1, true, false, true);
    $params = $instance->getParams();

    $this->assertEquals($params, ["timezone" => "Asia/Tokyo", "days" => 1, "include" => ["creator", "attendees"]]);
  }
}
