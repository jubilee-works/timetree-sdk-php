<?php

namespace TimeTreeWebApi\OauthApp\Parameter;

class GetEventParams
{
  private $calendarId;
  private $eventId;
  private $include;

  public function __construct(string $calendarId, string $eventId, bool $labels = false, bool $members = false)
  {
    $this->calendarId = $calendarId;
    $this->eventId = $eventId;
    $include = [];
    if ($labels === true) {
      array_push($include, "labels");
    }
    if ($members === true) {
      array_push($include, "members");
    }
    if ($include) {
      $this->include = implode(",", $include);
    }
  }

  public function getCalendarId(): string
  {
    return $this->calendarId;
  }

  public function getEventId(): string
  {
    return $this->eventId;
  }

  public function getInclude(): array
  {
    return ["include" => $this->include];
  }
}
