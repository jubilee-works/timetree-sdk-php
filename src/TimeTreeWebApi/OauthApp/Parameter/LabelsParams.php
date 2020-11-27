<?php

namespace TimeTreeWebApi\OauthApp\Parameter;

class LabelsParams
{
  private $labelId;

  public function __construct(int $labelId)
  {
    $this->labelId = $labelId;
  }

  public function getLabel(): array
  {
    $data["data"]["id"] = (string)$this->labelId;
    $data["data"]["type"] = "label";
    return $data;
  }
}
