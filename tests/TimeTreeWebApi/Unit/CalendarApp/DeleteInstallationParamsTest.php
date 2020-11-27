<?php

namespace Tests\TimeTreeWebApi\Unit\CalendarApp;

use PHPUnit\Framework\TestCase;
use TimeTreeWebApi\CalendarApp\Parameter\DeleteInstallationParams;

class DeleteInstallationParamsTest extends TestCase
{
  public function testGetInstallationId()
  {
    $instance = new DeleteInstallationParams(1);
    $params = $instance->getInstallationId();

    $this->assertEquals($params, 1);
  }
}
