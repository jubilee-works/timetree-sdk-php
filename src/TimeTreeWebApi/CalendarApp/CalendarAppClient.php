<?php

namespace TimeTreeWebApi\CalendarApp;

use TimeTreeWebApi\Request;
use TimeTreeWebApi\CalendarApp\Parameter\CreateActivityParams;
use TimeTreeWebApi\CalendarApp\Parameter\CreateEventParams;
use TimeTreeWebApi\CalendarApp\Parameter\DeleteEventParams;
use TimeTreeWebApi\CalendarApp\Parameter\DeleteInstallationParams;
use TimeTreeWebApi\CalendarApp\Parameter\GetEventParams;
use TimeTreeWebApi\CalendarApp\Parameter\GetUpcomingEventsParams;
use TimeTreeWebApi\CalendarApp\Parameter\UpdateEventParams;

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

  public function deleteInstallation(DeleteInstallationParams $deleteInstallationParams)
  {
    $response = $this->request->get("/installations/{$deleteInstallationParams->getInstallationId()}", $this->accessToken);
    return json_decode($response->getBody()->getContents());
  }

  public function getCalendar()
  {
    $response = $this->request->get("/calendar", $this->accessToken);
    return json_decode($response->getBody()->getContents());
  }

  public function getLabels()
  {
    $response = $this->request->get("/calendar/labels", $this->accessToken);
    return json_decode($response->getBody()->getContents());
  }

  public function getMembers()
  {
    $response = $this->request->get("/calendar/members", $this->accessToken);
    return json_decode($response->getBody()->getContents());
  }

  public function getUpcomingEvents(GetUpcomingEventsParams $getUpcomingEventsParams)
  {
    $query = http_build_query($getUpcomingEventsParams->getParams());
    $response = $this->request->get("/calendar/upcoming_events?{$query}", $this->accessToken);
    return json_decode($response->getBody()->getContents());
  }

  public function getEvent(GetEventParams $getEventParams)
  {
    $response = $this->request->get("/calendar/events/{$getEventParams->getEventId()}", $this->accessToken);
    return json_decode($response->getBody()->getContents());
  }

  public function createEvent(CreateEventParams $createEventParams)
  {
    var_dump($createEventParams->getParams());
    $response = $this->request->post("/calendar/events", $this->accessToken, $createEventParams->getParams());
    return json_decode($response->getBody()->getContents());
  }

  public function updateEvent(UpdateEventParams $updateEventParams)
  {
    $response = $this->request->put("/calendar/events/{$updateEventParams->getEventId()}", $this->accessToken, $updateEventParams->getParams());
    return json_decode($response->getBody()->getContents());
  }

  public function deleteEvent(DeleteEventParams $deleteEventParams)
  {
    $response = $this->request->delete("/calendar/events/{$deleteEventParams->getEventId()}", $this->accessToken);
    return json_decode($response->getBody()->getContents());
  }

  public function createActivity(CreateActivityParams $createActivityParams)
  {
    $response = $this->request->post("/calendar/events/{$createActivityParams->getEventId()}/activities", $this->accessToken, $createActivityParams->getParams());
    return json_decode($response->getBody()->getContents());
  }
}
