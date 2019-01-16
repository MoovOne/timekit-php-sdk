<?php

namespace MoovOne\TimekitPhpSdk;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use MoovOne\TimekitPhpSdk\Exception\BadRequestException;
use MoovOne\TimekitPhpSdk\Model\AbstractHttpClientProvider;

/**
 * Class GuzzleHttpClientProvider
 * @package MoovOne\TimekitPhpSdk
 */
class GuzzleHttpClientProvider extends AbstractHttpClientProvider
{
    /**
     * @var Client
     */
    private $httpClient;

    /**
     * GuzzleHttpClientProvider constructor.
     * @param array $httpOptions
     *  -
     * @param string $apiKey
     * @param string $apiUrl
     */
    public function __construct(array $httpOptions, string $apiKey, string $apiUrl)
    {
        parent::__construct($httpOptions, $apiUrl, $apiKey);
        $this->httpClient = new Client(['base_uri' => $apiUrl,]);
    }

    /**
     * @param string $uri
     * @param array $payload
     * @return array
     * @throws BadRequestException
     */
    public function post(string $uri, array $payload): array
    {
        try {
            $response = $this->httpClient->post(
                $uri,
                [
                    'headers' => $this->headers,
                    RequestOptions::JSON => $payload,
                ]
            );
            $data = json_decode($response->getBody()->getContents(), true);

            return $data;
        } catch (\Throwable $e) {
            throw new BadRequestException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @param string $uri
     * @param array $payload
     * @return array
     * @throws BadRequestException
     */
    public function put(string $uri, array $payload): array
    {
        try {
            $response = $this->httpClient->put(
                $uri,
                [
                    'headers' => $this->headers,
                    RequestOptions::JSON => $payload,
                ]
            );
            $data = json_decode($response->getBody()->getContents(), true);

            return $data;
        } catch (\Throwable $e) {
            throw new BadRequestException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @param string $uri
     * @return void
     * @throws BadRequestException
     */
    public function delete(string $uri): void
    {
        try {
            $this->httpClient->delete(
                $uri,
                [
                    'headers' => $this->headers,
                ]
            );
        } catch (\Throwable $e) {
            throw new BadRequestException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @param string $uri
     * @return array
     * @throws BadRequestException
     */
    public function get(string $uri): array
    {
        try {
            $response = $this->httpClient->get(
                $uri,
                [
                    'headers' => $this->headers,
                ]
            );
            $data = json_decode($response->getBody()->getContents(), true);

            return $data;
        } catch (\Throwable $e) {
            throw new BadRequestException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
