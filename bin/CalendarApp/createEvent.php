<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use TimeTreeWebApi\CalendarApp\CalendarAppAuthenticator;
use TimeTreeWebApi\CalendarApp\CalendarAppClient;
use TimeTreeWebApi\CalendarApp\CreateEventParams;

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

$calendar = $client->getCalendar();

$params = new CreateEventParams(
  "タイトル",
  "schedule",
  "ディスクリプション",
  false,
  new DateTime("2020-10-10 09:00:00"),
  new DateTimeZone("Asia/Tokyo"),
  new DateTime("2020-10-10 10:00:00"),
  new DateTimeZone("Asia/Tokyo")
);

$response = $client->createEvent($params);

print_r($response);
