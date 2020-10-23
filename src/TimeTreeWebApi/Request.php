<?php

namespace TimeTreeWebApi;

use GuzzleHttp\Client;

class Request
{
  const BASE_URL = "https://timetreeapis.com";

  private $client;
  private $baseURL;

  public function __construct($baseURL = self::BASE_URL)
  {
    $this->client = new Client();
    $this->baseURL = $baseURL;
  }

  public function get(string $requestPath, string $authorization)
  {
    return $response = $this->client->request(
      'GET',
      "{$this->baseURL}{$requestPath}",
      [
        "headers" => [
          'Authorization' => "Bearer {$authorization}",
          'Accept' => 'application/vnd.timetree.v1+json',
          'Content-Type' => "application/json"
        ]
      ]
    );
  }

  public function post(string $requestPath, string $authorization, array $data = [])
  {
    return $response = $this->client->request(
      'POST',
      "{$this->baseURL}{$requestPath}",
      [
        "headers" => [
          'Authorization' => "Bearer {$authorization}",
          'Accept' => 'application/vnd.timetree.v1+json',
          'Content-Type' => "application/json"
        ],
        "json" => $data,
      ]
    );
  }
}
