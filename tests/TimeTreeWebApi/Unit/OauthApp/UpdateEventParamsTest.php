<?php

namespace Tests\TimeTreeWebApi\Unit\OauthApp;

use DateTime;
use DateTimeZone;
use PHPUnit\Framework\TestCase;
use TimeTreeWebApi\OauthApp\Parameter\AttendeesParams;
use TimeTreeWebApi\OauthApp\Parameter\LabelsParams;
use TimeTreeWebApi\OauthApp\Parameter\UpdateEventParams;

class UpdateEventParamsTest extends TestCase
{
  private $instance;

  public function testGetParamsWhenNotAllday(): void
  {
    $this->instance = new UpdateEventParams(
      "abc-calendar-id",
      "abc-event-id",
      "test title",
      "schedule",
      false,
      new LabelsParams(1),
      new DateTime("2020-10-10 09:00:00"),
      new DateTimeZone("Asia/Tokyo"),
      new DateTime("2020-10-10 11:00:00"),
      new DateTimeZone("Asia/Tokyo"),
      "test description",
      "sagrada familia",
      "https://developers.timetreeapp.com/",
      new AttendeesParams([1, 2, 3])
    );
    $params = $this->instance->getParams();

    $this->assertEquals($params, [
      "data" => [
        "attributes" => [
          "title" => "test title",
          "category" => "schedule",
          "all_day" => false,
          "start_at" => "2020-10-10T09:00:00+0000",
          "start_timezone" => "Asia/Tokyo",
          "end_at" => "2020-10-10T11:00:00+0000",
          "end_timezone" => "Asia/Tokyo",
          "description" => "test description",
          "location" => "sagrada familia",
          "url" => "https://developers.timetreeapp.com/",
        ],
        "relationships" => [
          "attendees" => [
            "data" => [
              ["id" => 1, "type" => "user"],
              ["id" => 2, "type" => "user"],
              ["id" => 3, "type" => "user"],
            ]
          ],
          "label" => [
            "data" => [
              "id" => 1,
              "type" => "label"
            ]
          ]
        ]
      ]
    ]);
  }

  public function testGetParamsWhenAllday(): void
  {
    $this->instance = new UpdateEventParams(
      "abc-calendar-id",
      "abc-event-id",
      "test title",
      "schedule",
      true,
      new LabelsParams(1),
      new DateTime("2020-10-10"),
      null,
      new DateTime("2020-10-10"),
      null,
      "test description",
    );
    $params = $this->instance->getParams();

    $this->assertEquals($params, [
      "data" => [
        "attributes" => [
          "title" => "test title",
          "category" => "schedule",
          "all_day" => true,
          "start_at" => "2020-10-10T00:00:00+0000",
          "end_at" => "2020-10-10T00:00:00+0000",
          "description" => "test description",
        ],
        "relationships" => [
          "label" => [
            "data" => [
              "id" => 1,
              "type" => "label"
            ]
          ]
        ]
      ]
    ]);
  }

  public function testGetParamsWhenCategoryIsKeep(): void
  {
    $this->instance = new UpdateEventParams(
      "abc-calendar-id",
      "abc-event-id",
      "test title",
      "keep",
      true,
      new LabelsParams(1)
    );
    $params = $this->instance->getParams();

    $this->assertEquals($params, [
      "data" => [
        "attributes" => [
          "title" => "test title",
          "category" => "keep",
          "all_day" => true,
        ],
        "relationships" => [
          "label" => [
            "data" => [
              "id" => 1,
              "type" => "label"
            ]
          ]
        ]
      ]
    ]);
  }

  public function testGetCalendarId()
  {
    $this->instance = new UpdateEventParams(
      "abc-calendar-id",
      "abc-event-id",
      "test title",
      "schedule",
      false,
      new LabelsParams(1)
    );
    $params = $this->instance->getCalendarId();

    $this->assertEquals($params, "abc-calendar-id");
  }

  public function testGetEventId()
  {
    $this->instance = new UpdateEventParams(
      "abc-calendar-id",
      "abc-event-id",
      "test title",
      "schedule",
      false,
      new LabelsParams(1)
    );
    $params = $this->instance->getEventId();

    $this->assertEquals($params, "abc-event-id");
  }
}
