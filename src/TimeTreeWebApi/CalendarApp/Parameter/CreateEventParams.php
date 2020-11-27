<?php

namespace TimeTreeWebApi\CalendarApp\Parameter;

use DateTime;
use DateTimeZone;
use Jawira\CaseConverter\Convert;

class CreateEventParams
{
  const CATEGORY_SCHEDULE = "schedule";
  const CATEGORY_KEEP = "keep";
  const CATEGORY_MASTER = [self::CATEGORY_SCHEDULE, self::CATEGORY_KEEP];
  const ATTRIBUTES = ["title", "category", "allDay", "startAt", "startTimezone", "endAt", "endTimezone", "description", "location", "url"];
  const RELATIONSHIPS = ["attendees"];

  private $title;
  private $category;
  private $allDay;
  private $startAt;
  private $startTimezone;
  private $endAt;
  private $endTimezone;
  private $description;
  private $location;
  private $url;
  private $attendees;

  public function __construct(
    string $title,
    string $category,
    bool $allDay,
    DateTime $startAt = null,
    DateTimeZone $startTimezone = null,
    DateTime $endAt = null,
    DateTimeZone $endTimezone = null,
    string $description = null,
    string $location = null,
    string $url = null,
    AttendeesParams $attendees = null
  ) {
    $this->title = $title;
    $this->category = $category;
    $this->allDay = $allDay;
    $this->startAt = $startAt;
    $this->startTimezone = $startTimezone;
    $this->endAt = $endAt;
    $this->endTimezone = $endTimezone;
    $this->description = $description;
    $this->location = $location;
    $this->url = $url;
    $this->attendees = $attendees;
  }

  public function getParams(): array
  {
    $data = [
      "data" => [
        "attributes" => $this->getAttributes(),
      ]
    ];
    $relationships = $this->getRelationships();
    if (!empty($relationships)) {
      $data["data"]["relationships"] = $relationships;
    }
    return $data;
  }

  private function getAttributes(): array
  {
    $data = [];
    foreach ($this as $key => $value) {
      if (!in_array($key, self::ATTRIBUTES, true) || $value === null) {
        continue;
      }
      $convertKey = new Convert($key);
      $snakeKey = $convertKey->toSnake();
      if (is_object($value) && get_class($value) === "DateTime") {
        $dateTime = $this->allDay ? new DateTime($value->format("Y-m-d")) : $value;
        $data[$snakeKey] = $dateTime->format(DateTime::ISO8601);
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

  private function getRelationships(): array
  {
    $data = [];
    foreach ($this as $key => $value) {
      if (!in_array($key, self::RELATIONSHIPS, true) || $value === null) {
        continue;
      }
      $convertKey = new Convert($key);
      $snakeKey = $convertKey->toSnake();
      if ($key === "attendees") {
        $data[$snakeKey] = $value->getAttendees();
        continue;
      }
      $data[$snakeKey] = $value;
    }
    return $data;
  }
}
