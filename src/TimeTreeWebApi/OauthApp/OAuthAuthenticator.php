<?php

namespace TimeTreeWebApi\OauthApp;

use stdClass;
use TimeTreeWebApi\OauthApp\Parameter\OAuthAuthenticatorParams;
use TimeTreeWebApi\Request;

class OAuthAuthenticator
{

  const BASE_URL = "https://timetreeappp.com";

  private $authorizeParams;
  private $request;
  private $baseURL;

  public function __construct(
    string $clientId,
    string $clientSecret,
    string $redirectUri,
    string $code,
    string $grantType,
    string $codeVerifier,
    string $baseURL = self::BASE_URL
  ) {
    $this->authorizeParams = new OAuthAuthenticatorParams(
      $clientId,
      $clientSecret,
      $redirectUri,
      $code,
      $grantType,
      $codeVerifier,
    );
    $this->baseURL = self::BASE_URL;
    $this->request = new Request($baseURL);
  }

  public function getToken()
  {
    $response = $this->request->post("/oauth/token", "", $this->authorizeParams->getTokenParams());
    return json_decode($response->getBody()->getContents());
  }

  public function authorizeParams()
  {
    $data = [];
    foreach ($this as $key => $value) {
      if ($key === "")
        $data[$key] = $value;
    }
    return $data;
  }
}
