<?php

namespace TimeTreeWebApi\OauthApp\Parameter;

use Jawira\CaseConverter\Convert;

class OAuthAuthenticatorParams
{
  private $clientId;
  private $clientSecret;
  private $redirectUri;
  private $code;
  private $grantType;
  private $codeVerifier;

  public function __construct(
    string $clientId,
    string $clientSecret,
    string $redirectUri,
    string $code,
    string $grantType,
    string $codeVerifier
  ) {
    $this->clientId = $clientId;
    $this->clientSecret = $clientSecret;
    $this->redirectUri = $redirectUri;
    $this->code = $code;
    $this->grantType = $grantType;
    $this->codeVerifier = $codeVerifier;
  }

  public function getTokenParams()
  {
    $data = [];
    foreach ($this as $key => $value) {
      if ($key === "codeVerifier" && $value === "") {
        continue;
      }
      $convertKey = new Convert($key);
      $snakeKey = $convertKey->toSnake();
      $data[$snakeKey] = $value;
    }
    return $data;
  }
}
