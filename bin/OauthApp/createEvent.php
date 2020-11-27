<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use GetOpt\ArgumentException;
use GetOpt\GetOpt;
use GetOpt\Option;
use TimeTreeWebApi\OauthApp\OauthClient;
use TimeTreeWebApi\OauthApp\Parameter\CreateEventParams;
use TimeTreeWebApi\OauthApp\Parameter\LabelsParams;

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

$response = $instance->createEvent(new CreateEventParams(
  $getOpt["calendarId"],
  "title",
  "schedule",
  true,
  new LabelsParams(1),
  new DateTime("2021-01-01"),
  null,
  new DateTime("2021-01-01"),
));

print_r($response);
