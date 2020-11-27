<?php

namespace Tests\TimeTreeWebApi\Unit\OauthApp;

use DateTimeZone;
use PHPUnit\Framework\TestCase;
use TimeTreeWebApi\OauthApp\Parameter\GetUpcomingEventsParams;

class GetUpcommintEventsParamsTest extends TestCase
{

  public function testGetParams()
  {
    $instance = new GetUpcomingEventsParams(
      "abc-calendar-id",
      new DateTimeZone("Asia/Tokyo"),
      1,
      true,
      true,
      true
    );
    $params = $instance->getParams();

    $this->assertEquals($params, ["timezone" => "Asia/Tokyo", "days" => 1, "include" => ["creator", "label", "attendees"]]);
  }
}
