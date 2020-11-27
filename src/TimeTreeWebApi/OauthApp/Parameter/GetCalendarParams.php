<?php

namespace TimeTreeWebApi\OauthApp\Parameter;

class GetCalendarParams
{
  private $calendarId;
  private $include;

  public function __construct(string $calendarId, bool $labels = false, bool $members = false)
  {
    $this->calendarId = $calendarId;
    $include = [];
    if ($labels === true) {
      array_push($include, "labels");
    }
    if ($members === true) {
      array_push($include, "members");
    }
    if ($include) {
      $this->include = implode(",", $include);
    }
  }

  public function getCalendarId()
  {
    return $this->calendarId;
  }

  public function getInclude()
  {
    return ["include" => $this->include];
  }
}
