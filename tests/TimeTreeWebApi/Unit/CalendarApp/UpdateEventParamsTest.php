<?php

namespace Tests\TimeTreeWebApi\Unit\CalendarApp;

use DateTime;
use DateTimeZone;
use PHPUnit\Framework\TestCase;
use TimeTreeWebApi\CalendarApp\UpdateEventParams;

class UpdateEventParamsTest extends TestCase
{
  private $instance;

  protected function setUp(): void
  {
    $this->instance = new UpdateEventParams(
      "abc-event-id",
      "test title",
      "events",
      "test description",
      false,
      new DateTime("2020-10-10 09:00:00"),
      new DateTimeZone("Asia/Tokyo"),
      new DateTime("2020-10-10 11:00:00"),
      new DateTimeZone("Asia/Tokyo"),
    );
  }

  public function testGetParams()
  {
    $params = $this->instance->getParams();

    $this->assertEquals($params, [
      "data" => [
        "attributes" => [
          "title" => "test title",
          "category" => "events",
          "description" => "test description",
          "all_day" => false,
          "start_at" => "2020-10-10T09:00:00+0000",
          "start_timezone" => "Asia/Tokyo",
          "end_at" => "2020-10-10T11:00:00+0000",
          "end_timezone" => "Asia/Tokyo",
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
