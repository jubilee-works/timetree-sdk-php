<?php

namespace TimeTreeWebApi\CalendarApp;

use DateTime;
use DateTimeZone;
use Jawira\CaseConverter\Convert;

class UpdateEventParams
{
  private $eventId;
  private $title;
  private $category;
  private $description;
  private $allDay;
  private $startAt;
  private $startTimezone;
  private $endAt;
  private $endTimezone;

  public function __construct(
    string $eventId,
    string $title,
    string $category,
    string $description,
    bool $allDay,
    DateTime $startAt,
    DateTimeZone $startTimezone,
    DateTime $endAt,
    DateTimeZone $endTimezone
  ) {
    $this->eventId = $eventId;
    $this->title = $title;
    $this->category = $category;
    $this->description = $description;
    $this->allDay = $allDay;
    $this->startAt = $startAt;
    $this->startTimezone = $startTimezone;
    $this->endAt = $endAt;
    $this->endTimezone = $endTimezone;
  }

  public function getEventId(): string
  {
    return $this->eventId;
  }

  public function getParams(): array
  {
    $attributes = $this->getAttributes();
    return [
      "data" => [
        "attributes" => $attributes,
      ]
    ];
  }

  private function getAttributes(): array
  {
    $data = [];
    foreach ($this as $key => $value) {
      $convertKey = new Convert($key);
      $snakeKey = $convertKey->toSnake();
      if ($key === "eventId") {
        continue;
      }

      if (is_object($value) && get_class($value) === "DateTime") {
        $data[$snakeKey] = $value->format(DateTime::ISO8601);
        continue;
      }

      if (is_object($value) && get_class($value) === "DateTimeZone") {
        $data[$snakeKey] = $value->getName();
        continue;
      }
      $data[$snakeKey] = $value;
    }
    return $data;
  }
}
