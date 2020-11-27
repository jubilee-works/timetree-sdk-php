<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use GetOpt\ArgumentException;
use GetOpt\GetOpt;
use GetOpt\Option;
use TimeTreeWebApi\CalendarApp\CalendarAppAuthenticator;
use TimeTreeWebApi\CalendarApp\CalendarAppClient;
use TimeTreeWebApi\CalendarApp\Parameter\GetUpcomingEventsParams;

$getOpt = new GetOpt([
  Option::create('p', 'pemFilePath', GetOpt::REQUIRED_ARGUMENT)
    ->setDescription('Pem file generated when creating the application.'),
  Option::create('a', 'applicationId', GetOpt::REQUIRED_ARGUMENT)
    ->setDescription('Your Application ID'),
  Option::create('i', 'installationId', GetOpt::REQUIRED_ARGUMENT)
    ->setDescription('Users installation ID'),
  Option::create('H', 'host', GetOpt::REQUIRED_ARGUMENT)
    ->setDescription('Request destination host'),
  Option::create('h', 'help', GetOpt::NO_ARGUMENT)
    ->setDescription('Show this help and quit')
]);
try {
  $getOpt->process();
  if ($getOpt->getOption('help')) {
    echo $getOpt->getHelpText();
    exit;
  }
  if (count($getOpt->getOptions()) < 8) {
    throw new ArgumentException("Argment error.");
  }
} catch (ArgumentException $exception) {
  file_put_contents('php://stderr', $exception->getMessage() . PHP_EOL);
  echo PHP_EOL . $getOpt->getHelpText();
  exit;
}

$privateKey = file_get_contents($getOpt["pemFilePath"]);

$instance = new CalendarAppAuthenticator($getOpt["applicationId"], $privateKey, $getOpt["host"]);

$token = $instance->getAccessToken($getOpt["installationId"]);

$client = new CalendarAppClient($token, $getOpt["host"]);

$events = $client->getUpcomingEvents(new GetUpcomingEventsParams(new DateTimeZone("Asia/Tokyo"), 7));

print_r($events);
