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

  public function deleteInstallation(DeleteInstallationParams $deleteInstallationParams)
  {
    $response = $this->request->get("/api/installations/{$deleteInstallationParams->getInstallationId()}", $this->accessToken);
    return json_decode($response->getBody()->getContents());
  }

  public function getCalendar()
  {
    $response = $this->request->get("/api/calendar", $this->accessToken);
    return json_decode($response->getBody()->getContents());
  }

  public function getLabels()
  {
    $response = $this->request->get("/api/calendar/labels", $this->accessToken);
    return json_decode($response->getBody()->getContents());
  }

  public function getMembers()
  {
    $response = $this->request->get("/api/calendar/members", $this->accessToken);
    return json_decode($response->getBody()->getContents());
  }

  public function getUpcomingEvents(GetUpcomingEventsParams $getUpcomingEventsParams)
  {
    $query = http_build_query($getUpcomingEventsParams->getParams());
    $response = $this->request->get("/api/calendar/upcoming_events?{$query}", $this->accessToken);
    return json_decode($response->getBody()->getContents());
  }

  public function getEvent(GetEventParams $getEventParams)
  {
    $response = $this->request->get("/api/calendar/events/{$getEventParams->getEventId()}", $this->accessToken);
    return json_decode($response->getBody()->getContents());
  }

  public function createEvent(CreateEventParams $createEventParams)
  {
    $response = $this->request->post("/api/calendar/events", $this->accessToken, $createEventParams->getParams());
    return json_decode($response->getBody()->getContents());
  }

  public function updateEvent(UpdateEventParams $updateEventParams)
  {
    $response = $this->request->put("/api/calendar/events/{$updateEventParams->getEventId()}", $this->accessToken, $updateEventParams->getParams());
    return json_decode($response->getBody()->getContents());
  }

  public function deleteEvent(DeleteEventParams $deleteEventParams)
  {
    $response = $this->request->delete("/api/calendar/events/{$deleteEventParams->getEventId()}", $this->accessToken);
    return json_decode($response->getBody()->getContents());
  }

  public function createActivity(CreateActivityParams $createActivityParams)
  {
    $response = $this->request->post("/api/calendar/events/{$createActivityParams->getEventId()}/activities", $this->accessToken, $createActivityParams->getParams());
    return json_decode($response->getBody()->getContents());
  }
}
