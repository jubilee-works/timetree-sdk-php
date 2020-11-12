<?php

namespace TimeTreeWebApi\CalendarApp;

class GetEventParams
{
  private $eventId;

  public function __construct(string $eventId)
  {
    $this->eventId = $eventId;
  }

  public function getEventId()
  {
    return $this->eventId;
  }
}
