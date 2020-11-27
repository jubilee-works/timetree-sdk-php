<?php

namespace TimeTreeWebApi\CalendarApp\Parameter;

class CreateActivityParams
{
  private $eventId;
  private $content;

  public function __construct(
    string $eventId,
    string $content
  ) {
    $this->eventId = $eventId;
    $this->content = $content;
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
