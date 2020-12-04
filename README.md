# timetree-sdk-php

`timetree/timetree-sdk-php` is simple HTTP client for requesting to TimeTree's [Web API](https://developers.timetreeapp.com/en/docs/api).

## Versions

`timetree-sdk-php` uses a modified version of [Semantic Versioning](https://semver.org/) for all changes.

## Installation
You can install timetree-sdk-php via composer or download this code.

### Via Composer
```
composer require timetree/timetree-sdk-php
```

## Usage
### Accessing API endpoints as a OAuth App 
Please see here for OauthApp. [docs](https://developers.timetreeapp.com/en/docs/api/oauth-app)
#### GetAccessToken
```php
<?php
use TimeTreeWebApi\OauthApp\OAuthAuthenticator;
$instance = new OAuthAuthenticator(
  "<clientId>",
  "<clientSecret>",
  "<redirectUri>",
  "<code>",
  "<grantType>",
  "<codeVerifier>",
);

$tokens = $instance->getToken();
// Please save this token
print_r($tokens);
```

#### GetCalendars
```php
<?php
use TimeTreeWebApi\OauthApp\OauthClient;
use TimeTreeWebApi\OauthApp\Parameter\GetCalendarsParams;

$instance = new OauthClient(
  "<your-access-token>",
);

$calendars = $instance->getCalendars(new GetCalendarsParams());

print_r($calendars);
```
#### CreateEvents
```php
<?php
use TimeTreeWebApi\OauthApp\OauthClient;
use TimeTreeWebApi\OauthApp\Parameter\CreateEventParams;
use TimeTreeWebApi\OauthApp\Parameter\LabelsParams;

$instance = new OauthClient(
  "<your-access-token>",
);

$event = $instance->createEvent(new CreateEventParams(
  "ABCD",                       // CalendarID
  "Event Title",                // Event Title
  "schedule",                   // "schedule" or "keep"
  true,                         // Allday: true or false
  new LabelsParams(1),          // Label ID you want to set.
  new DateTime("2021-01-01"),   // Start time of the event you want to create.
  null,                         // TimeZone of Start time
  new DateTime("2021-01-01"),   // End time of the event you want to create.
));

print_r($event);
```

### Accessing API endpoints as a Calendar App
Please see here for CalendarApp. [docs](https://developers.timetreeapp.com/en/docs/api/calendar-app)
#### GetCalendar
```php
<?php
use TimeTreeWebApi\CalendarApp\CalendarAppAuthenticator;
use TimeTreeWebApi\CalendarApp\CalendarAppClient;

$instance = new CalendarAppAuthenticator(
  "<your-calendar-app-id>",
  "-----BEGIN RSA PRIVATE KEY-----\n....-----END RSA PRIVATE KEY-----\n"
);
$token = $instance->getAccessToken("<installation-id>");
$client = new CalendarAppClient($token);
$calendar = $client->getCalendar();

print_r($calendar);
```

#### CreateEvents
```php
<?php
use TimeTreeWebApi\CalendarApp\CalendarAppAuthenticator;
use TimeTreeWebApi\CalendarApp\CalendarAppClient;
use TimeTreeWebApi\CalendarApp\Parameter\CreateEventParams;

$instance = new CalendarAppAuthenticator(
  "<your-calendar-app-id>",
  "-----BEGIN RSA PRIVATE KEY-----\n....-----END RSA PRIVATE KEY-----\n"
);
$token = $instance->getAccessToken("<installation-id>");
$client = new CalendarAppClient($token);
$params = new CreateEventParams(
  "Event Title",                // Event Title
  "schedule",                   // "schedule" or "keep"
  true,                         // Allday: true or false
  new LabelsParams(1),          // Label ID you want to set.
  new DateTime("2021-01-01"),   // Start time of the event you want to create.
  null,                         // TimeZone of Start time
  new DateTime("2021-01-01"),   // End time of the event you want to create.
);
$response = $client->createEvent($params);

print_r($response);
```

### Exception
`timetree-sdk-php` depends on [guzzle](https://docs.guzzlephp.org/en/stable/). So Exceptions also throw guzzle's as it is.

### LICENSE
Read [License](https://github.com/jubilee-works/timetree-sdk-php/blob/master/LICENSE) for more licensing information.