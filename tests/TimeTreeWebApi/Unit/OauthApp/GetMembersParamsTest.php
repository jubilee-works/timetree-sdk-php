<?php

namespace Tests\TimeTreeWebApi\Unit\OauthApp;

use PHPUnit\Framework\TestCase;
use TimeTreeWebApi\OauthApp\Parameter\GetMembersParams;

class GetMembersParamsTest extends TestCase
{
  private $instance;

  protected function setUp(): void
  {
    $this->instance = new GetMembersParams(
      "abc-calendar-id"
    );
  }

  public function testGetCalendarId()
  {
    $params = $this->instance->getCalendarId();
    $this->assertEquals($params, "abc-calendar-id");
  }
}
