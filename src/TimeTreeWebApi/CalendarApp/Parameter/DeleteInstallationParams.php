<?php

namespace TimeTreeWebApi\CalendarApp\Parameter;

class DeleteInstallationParams
{
  private $installationId;

  public function __construct(int $installationId)
  {
    $this->installationId = $installationId;
  }

  public function getInstallationId(): int
  {
    return $this->installationId;
  }
}
