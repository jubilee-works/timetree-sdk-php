<?php

namespace TimeTreeWebApi\OauthApp;

use TimeTreeWebApi\OauthApp\Parameter\CreateActivityParams;
use TimeTreeWebApi\OauthApp\Parameter\CreateEventParams;
use TimeTreeWebApi\OauthApp\Parameter\DeleteEventParams;
use TimeTreeWebApi\OauthApp\Parameter\GetCalendarParams;
use TimeTreeWebApi\OauthApp\Parameter\GetCalendarsParams;
use TimeTreeWebApi\OauthApp\Parameter\GetEventParams;
use TimeTreeWebApi\OauthApp\Parameter\GetLabelsParams;
use TimeTreeWebApi\OauthApp\Parameter\GetMembersParams;
use TimeTreeWebApi\OauthApp\Parameter\GetUpcomingEventsParams;
use TimeTreeWebApi\OauthApp\Parameter\UpdateEventParams;
use TimeTreeWebApi\Request;

class OauthClient
{
  private $accessToken;
  private $request;

  const BASE_URL = "https://timetreeapis.com";

  public function __construct(string $accessToken, string $baseURL = self::BASE_URL)
  {
    $this->accessToken = $accessToken;
    $this->request = new Request($baseURL);
  }

  public function getUser()
  {
    $response = $this->request->get("/user", $this->accessToken);
    return json_decode($response->getBody()->getContents());
  }

  public function getCalendars(GetCalendarsParams $getCalendarsParams)
  {
    $query = http_build_query($getCalendarsParams->getParams());
    $response = $this->request->get("/calendars?{$query}", $this->accessToken);
    return json_decode($response->getBody()->getContents());
  }

  public function getCalendar(GetCalendarParams $getCalendarParams)
  {
    $query = http_build_query($getCalendarParams->getInclude());
    $response = $this->request->get("/calendars/{$getCalendarParams->getCalendarId()}/?{$query}", $this->accessToken);
    return json_decode($response->getBody()->getContents());
  }

  public function getLabels(GetLabelsParams $getLabelsParams)
  {
    $response = $this->request->get("/calendars/{$getLabelsParams->getCalendarId()}/labels", $this->accessToken);
    return json_decode($response->getBody()->getContents());
  }

  public function getMembers(GetMembersParams $getMembersParams)
  {
    $response = $this->request->get("/calendars/{$getMembersParams->getCalendarId()}/members", $this->accessToken);
    return json_decode($response->getBody()->getContents());
  }

  public function getUpcomingEvents(GetUpcomingEventsParams $getUpcomingEventsParams)
  {
    $query = http_build_query($getUpcomingEventsParams->getParams());
    $response = $this->request->get("/calendars/{$getUpcomingEventsParams->getCalendarId()}/upcoming_events?{$query}", $this->accessToken);
    return json_decode($response->getBody()->getContents());
  }

  public function getEvent(GetEventParams $getEventParams)
  {
    $query = http_build_query($getEventParams->getInclude());
    $response = $this->request->get(
      "/calendars/{$getEventParams->getCalendarId()}/events/{$getEventParams->getEventId()}/?{$query}",
      $this->accessToken
    );
    return json_decode($response->getBody()->getContents());
  }

  public function createEvent(CreateEventParams $createEventParams)
  {
    $response = $this->request->post(
      "/calendars/{$createEventParams->getCalendarId()}/events",
      $this->accessToken,
      $createEventParams->getParams()
    );
    return json_decode($response->getBody()->getContents());
  }

  public function updateEvent(UpdateEventParams $updateEventParams)
  {
    $response = $this->request->put(
      "/calendars/{$updateEventParams->getCalendarId()}/events/{$updateEventParams->getEventId()}",
      $this->accessToken,
      $updateEventParams->getParams()
    );
    return json_decode($response->getBody()->getContents());
  }

  public function deleteEvent(DeleteEventParams $deleteEventParams)
  {
    $response = $this->request->delete(
      "/calendars/{$deleteEventParams->getCalendarId()}/events/{$deleteEventParams->getEventId()}",
      $this->accessToken,
    );
    return json_decode($response->getBody()->getContents());
  }

  public function createActivity(CreateActivityParams $createActivityParams)
  {
    $response = $this->request->post(
      "/calendars/{$createActivityParams->getCalendarId()}/events/{$createActivityParams->getEventId()}/activities",
      $this->accessToken,
      $createActivityParams->getParams()
    );
    return json_decode($response->getBody()->getContents());
  }
}
