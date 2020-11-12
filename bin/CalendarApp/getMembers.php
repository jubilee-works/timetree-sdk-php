<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use TimeTreeWebApi\CalendarApp\CalendarAppAuthenticator;
use TimeTreeWebApi\CalendarApp\CalendarAppClient;

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

$members = $client->getMembers();

print_r($members);
