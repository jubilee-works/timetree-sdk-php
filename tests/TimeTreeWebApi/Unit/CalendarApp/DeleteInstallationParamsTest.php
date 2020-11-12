<?php

namespace Tests\TimeTreeWebApi\Unit\CalendarApp;

use DateTimeZone;
use PHPUnit\Framework\TestCase;
use TimeTreeWebApi\CalendarApp\DeleteInstallationParams;
use TimeTreeWebApi\CalendarApp\GetUpcomingEventsParams;

class DeleteInstallationParamsTest extends TestCase
{
  public function testGetInstallationId()
  {
    $instance = new DeleteInstallationParams(1);
    $params = $instance->getInstallationId();

    $this->assertEquals($params, 1);
  }
}
