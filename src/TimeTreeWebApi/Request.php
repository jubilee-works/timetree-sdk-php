<?php

namespace TimeTreeWebApi;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Response;

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
    try {
      return $this->client->request(
        'GET',
        "{$this->baseURL}{$requestPath}",
        [
          "headers" => [
            'Authorization' => "Bearer {$authorization}",
            'Accept' => 'application/vnd.timetree.v1+json',
            'Content-Type' => "application/json"
          ],
        ]
      );
    } catch (RequestException $e) {
      return $e->getResponse();
    }
  }

  public function post(string $requestPath, string $authorization, array $data = [])
  {
    try {
      return $this->client->request(
        'POST',
        "{$this->baseURL}{$requestPath}",
        [
          "headers" => [
            'Authorization' => "Bearer {$authorization}",
            'Accept' => 'application/vnd.timetree.v1+json',
            'Content-Type' => "application/json"
          ],
          "http_errors" => false,
          "json" => $data,
        ]
      );
    } catch (RequestException $e) {
      return $e->getResponse();
    }
  }

  public function put(string $requestPath, string $authorization, array $data = [])
  {
    try {
      return $this->client->request(
        'PUT',
        "{$this->baseURL}{$requestPath}",
        [
          "headers" => [
            'Authorization' => "Bearer {$authorization}",
            'Accept' => 'application/vnd.timetree.v1+json',
            'Content-Type' => "application/json"
          ],
          "http_errors" => false,
          "json" => $data,
        ]
      );
    } catch (RequestException $e) {
      return $e->getResponse();
    }
  }

  public function delete(string $requestPath, string $authorization, array $data = [])
  {
    try {
      return $this->client->request(
        'DELETE',
        "{$this->baseURL}{$requestPath}",
        [
          "headers" => [
            'Authorization' => "Bearer {$authorization}",
            'Accept' => 'application/vnd.timetree.v1+json',
            'Content-Type' => "application/json"
          ],
          "http_errors" => false,
          "json" => $data,
        ]
      );
    } catch (RequestException $e) {
      return $e->getResponse();
    }
  }
}
