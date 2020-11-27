<?php

namespace Tests\TimeTreeWebApi\Unit\OauthApp;

use PHPUnit\Framework\TestCase;
use TimeTreeWebApi\OauthApp\Parameter\GetLabelsParams;

class GetLabelsParamsTest extends TestCase
{
  private $instance;

  protected function setUp(): void
  {
    $this->instance = new GetLabelsParams(
      "abc-calendar-id"
    );
  }

  public function testGetCalendarId()
  {
    $params = $this->instance->getCalendarId();
    $this->assertEquals($params, "abc-calendar-id");
  }
}
