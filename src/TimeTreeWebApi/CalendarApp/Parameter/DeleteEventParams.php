<?php

namespace TimeTreeWebApi\CalendarApp\Parameter;

class DeleteEventParams
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
