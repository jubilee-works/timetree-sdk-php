<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use GetOpt\ArgumentException;
use GetOpt\GetOpt;
use GetOpt\Option;
use TimeTreeWebApi\OauthApp\OauthClient;
use TimeTreeWebApi\OauthApp\Parameter\GetUpcomingEventsParams;

$getOpt = new GetOpt([
  Option::create('t', 'token', GetOpt::REQUIRED_ARGUMENT)
    ->setDescription('Your AccessToken'),
  Option::create('c', 'calendarId', GetOpt::REQUIRED_ARGUMENT)
    ->setDescription('Calendar ID'),
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
  if (count($getOpt->getOptions()) < 6) {
    throw new ArgumentException("Argment error.");
  }
} catch (ArgumentException $exception) {
  file_put_contents('php://stderr', $exception->getMessage() . PHP_EOL);
  echo PHP_EOL . $getOpt->getHelpText();
  exit;
}

$instance = new OauthClient(
  $getOpt["token"],
  $getOpt["host"]
);

$response = $instance->getUpcomingEvents(new GetUpcomingEventsParams($getOpt["calendarId"], new DateTimeZone("Asia/Tokyo"), 7));

print_r($response);
