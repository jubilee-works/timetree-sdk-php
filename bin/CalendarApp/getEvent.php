<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use TimeTreeWebApi\CalendarApp\CalendarAppAuthenticator;
use TimeTreeWebApi\CalendarApp\CalendarAppClient;
use TimeTreeWebApi\CalendarApp\GetEventParams;

$longArgs = [
  "pemFilePath:",
  "applicationId:",
  "host:",
  "installationId:",
  "eventId:",
];

$options = getopt("", $longArgs);
if (count($options) !== 5) {
  echo ("Argment error.");
  return;
}

$privateKey = file_get_contents($options["pemFilePath"]);

$instance = new CalendarAppAuthenticator($options["applicationId"], $privateKey, $options["host"]);

$token = $instance->getAccessToken($options["installationId"]);

$client = new CalendarAppClient($token, $options["host"]);

$event = $client->getEvent(new GetEventParams($options["eventId"]));

print_r($event);
