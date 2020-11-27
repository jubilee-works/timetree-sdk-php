<?php

namespace TimeTreeWebApi\OauthApp\Parameter;

class GetCalendarsParams
{
  private $include;

  public function __construct(bool $labels = false, bool $members = false)
  {
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

  public function getParams()
  {
    return ["include" => $this->include];
  }
}
