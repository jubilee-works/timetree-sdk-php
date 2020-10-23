<?php

namespace TimeTreeWebApi\CalendarApp;

use TimeTreeWebApi\Request;

class CalendarAppClient
{
  private $accessToken;
  private $request;

  const BASE_URL = "https://timetreeapis.com";

  public function __construct(string $accessToken, string $baseURL = self::BASE_URL)
  {
    $this->accessToken = $accessToken;
    $this->request = new Request($baseURL);
  }

  public function getCalendar()
  {
    $response = $this->request->get("/api/calendar", $this->accessToken);
    return json_decode($response->getBody()->getContents());
  }

  public function createEvent(CreateEventParams $requestEventParams)
  {
    $response = $this->request->post("/api/calendar/events", $this->accessToken, $requestEventParams->getParams());
    return $response->getStatusCode();
  }
}
