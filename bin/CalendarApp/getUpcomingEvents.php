<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use TimeTreeWebApi\CalendarApp\CalendarAppAuthenticator;
use TimeTreeWebApi\CalendarApp\CalendarAppClient;
use TimeTreeWebApi\CalendarApp\GetUpcomingEventsParams;

$longArgs = [
  "pemFilePath:",
  "applicationId:",
  "host:",
  "installationId:",
];

$options = getopt("", $longArgs);
if (count($options) !== 4) {
  echo ("Argment error.");
  return;
}

$privateKey = file_get_contents($options["pemFilePath"]);

$instance = new CalendarAppAuthenticator($options["applicationId"], $privateKey, $options["host"]);

$token = $instance->getAccessToken($options["installationId"]);

$client = new CalendarAppClient($token, $options["host"]);

$events = $client->getUpcomingEvents(new GetUpcomingEventsParams(new DateTimeZone("Asia/Tokyo"), 7));

print_r($events);
