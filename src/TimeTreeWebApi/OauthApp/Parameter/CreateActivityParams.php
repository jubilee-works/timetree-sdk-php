<?php

namespace TimeTreeWebApi\OauthApp\Parameter;

class CreateActivityParams
{
  private $calendarId;
  private $eventId;
  private $content;

  public function __construct(string $calendarId, string $eventId, string $content)
  {
    $this->calendarId = $calendarId;
    $this->eventId = $eventId;
    $this->content = $content;
  }

  public function getCalendarId(): string
  {
    return $this->calendarId;
  }

  public function getEventId(): string
  {
    return $this->eventId;
  }

  public function getParams(): array
  {
    return [
      "data" => [
        "attributes" => [
          "content" => $this->content,
        ]
      ]
    ];
  }
}
