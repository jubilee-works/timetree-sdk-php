<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use GetOpt\ArgumentException;
use GetOpt\GetOpt;
use GetOpt\Option;
use TimeTreeWebApi\OauthApp\OAuthAuthenticator;

$getOpt = new GetOpt([
  Option::create('c', 'clientId', GetOpt::REQUIRED_ARGUMENT)
    ->setDescription('Your ClientID'),
  Option::create('s', 'clientSecret', GetOpt::REQUIRED_ARGUMENT)
    ->setDescription('Calendar Secret'),
  Option::create('r', 'redirectUri', GetOpt::REQUIRED_ARGUMENT)
    ->setDescription('Redirect URI'),
  Option::create('C', 'code', GetOpt::REQUIRED_ARGUMENT)
    ->setDescription('Your App Code'),
  Option::create('g', 'grantType', GetOpt::REQUIRED_ARGUMENT)
    ->setDescription('GrantType'),
  Option::create('v', 'codeVerifier', GetOpt::OPTIONAL_ARGUMENT)
    ->setDescription('CodeVerifier')
    ->setDefaultValue(''),
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
  if (count($getOpt->getOptions()) < 14) {
    throw new ArgumentException("Argment error.");
  }
} catch (ArgumentException $exception) {
  file_put_contents('php://stderr', $exception->getMessage() . PHP_EOL);
  echo PHP_EOL . $getOpt->getHelpText();
  exit;
}

$instance = new OAuthAuthenticator(
  $getOpt["clientId"],
  $getOpt["clientSecret"],
  $getOpt["redirectUri"],
  $getOpt["code"],
  $getOpt["grantType"],
  $getOpt["codeVerifier"],
  $getOpt["host"]
);

$tokens = $instance->getToken();

print_r($tokens);
