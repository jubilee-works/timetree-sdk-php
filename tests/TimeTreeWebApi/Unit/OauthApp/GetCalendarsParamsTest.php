<?php

namespace Tests\TimeTreeWebApi\Unit\OauthApp;

use PHPUnit\Framework\TestCase;
use TimeTreeWebApi\OauthApp\Parameter\GetCalendarsParams;

class GetCalendarsParamsTest extends TestCase
{
  private $instance;

  protected function setUp(): void
  {
    $this->instance = new GetCalendarsParams(
      true,
      true
    );
  }

  public function testGetParams()
  {
    $params = $this->instance->getParams();
    $this->assertEquals($params, ["include" => "labels,members"]);
  }
}
