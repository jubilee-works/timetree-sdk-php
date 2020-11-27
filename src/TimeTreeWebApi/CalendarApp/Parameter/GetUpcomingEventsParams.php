<?php

namespace TimeTreeWebApi\CalendarApp\Parameter;

use DateTimeZone;

class GetUpcomingEventsParams
{
  const MAX = 7;
  const MIN = 1;

  private $timezone;
  private $days;
  private $include;

  public function __construct(DateTimeZone $timezone, int $days, bool $creator = false, bool $label = false, bool $attendees = false)
  {
    $this->timezone = $timezone->getName();
    $this->days = (self::MIN <= $days) && ($days <= self::MAX) ? $days : 1;
    $this->include = [];
    if ($creator === true) {
      array_push($this->include, "creator");
    }
    if ($label === true) {
      array_push($this->include, "label");
    }
    if ($attendees === true) {
      array_push($this->include, "attendees");
    }
  }

  public function getParams(): array
  {
    $data = [];
    foreach ($this as $key => $value) {
      $data[$key] = $value;
    }
    return $data;
  }
}
