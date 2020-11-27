<?php

namespace TimeTreeWebApi\OauthApp\Parameter;

class DeleteEventParams
{
  private $calendarId;
  private $eventId;

  public function __construct(string $calendarId, string $eventId)
  {
    $this->calendarId = $calendarId;
    $this->eventId = $eventId;
  }

  public function getCalendarId(): string
  {
    return $this->calendarId;
  }

  public function getEventId(): string
  {
    return $this->eventId;
  }
}
