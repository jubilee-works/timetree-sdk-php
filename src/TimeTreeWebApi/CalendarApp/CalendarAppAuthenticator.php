<?php

namespace TimeTreeWebApi\CalendarApp;

use \Firebase\JWT\JWT;
use TimeTreeWebApi\Request;

class CalendarAppAuthenticator
{
  const DEFAULT_ACCESS_TOKEN_LIFETIME = 600;
  const BASE_URL = "https://timetreeapis.com";

  private $applicationId;
  private $privateKey;
  private $accessTokenLifetimeInSec;
  private $request;

  public function __construct(
    string $applicationId,
    string $privateKey,
    string $baseURL = self::BASE_URL,
    int $accessTokenLifetimeInSec = self::DEFAULT_ACCESS_TOKEN_LIFETIME
  ) {
    $this->applicationId = $applicationId;
    $this->privateKey = $privateKey;
    $this->accessTokenLifetimeInSec = $accessTokenLifetimeInSec;
    $this->request = new Request($baseURL);
  }

  public function getAccessToken(int $installationId)
  {
    $jwt = $this->generateToken();

    $response = $this->request->post("/api/installations/${installationId}/access_tokens", $jwt);

    if ($response->getStatusCode() === 200) {
      return json_decode($response->getBody()->getContents())->access_token;
    }
    return "";
  }

  private function generateToken()
  {
    $payload = array(
      "iss" => $this->applicationId,
      "iat" => time(),
      "exp" => time() + $this->accessTokenLifetimeInSec
    );

    return JWT::encode($payload, $this->privateKey, "RS256");
  }
}
