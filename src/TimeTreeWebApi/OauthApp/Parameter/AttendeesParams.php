<?php

namespace TimeTreeWebApi\OauthApp\Parameter;

class AttendeesParams
{
  private $userIds;

  public function __construct(array $userIds)
  {
    $this->userIds = $userIds;
  }

  public function getAttendees(): array
  {
    $data = [];
    foreach ($this->userIds as $index => $userId) {
      $data["data"][$index]["id"] = (string)$userId;
      $data["data"][$index]["type"] = "user";
    }
    return $data;
  }
}
