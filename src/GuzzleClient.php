<?php

namespace MoovOne\TimekitPhpSdk;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use MoovOne\TimekitPhpSdk\Exception\BadRequestException;
use MoovOne\TimekitPhpSdk\Model\Booking;

class GuzzleClient implements ClientInterface
{
    /**
     * @var Client
     */
    private $httpClient;
    /**
     * @var string
     */
    private $apiKey;
    /**
     * @var array
     */
    private $headers;

    /**
     * GuzzleClient constructor.
     *
     * @param $apiKey
     */
    public function __construct($apiKey)
    {
        $this->httpClient = new Client([
            'base_uri' => 'https://api.timekit.io/v2/',
        ]);
        $this->apiKey = $apiKey;

        $this->headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic '.base64_encode(':'.$this->apiKey),
        ];
    }

    /**
     * @param array $payload
     *
     * @return array
     *
     * @throws BadRequestException
     */
    public function createResource(array $payload): array
    {
        try {
            $response = $this->httpClient->post(ClientInterface::ENDPOINT_RESOURCE, [
                'headers' => $this->headers,
                RequestOptions::JSON => $payload,
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            return $data;
        } catch (\Throwable $e) {
            throw new BadRequestException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @param string $resourceId
     * @param array $payload
     *
     * @throws BadRequestException
     */
    public function updateResource(string $resourceId, array $payload): void
    {
        try {
            $this->httpClient->put(sprintf('%s/%s', ClientInterface::ENDPOINT_RESOURCE, $resourceId), [
                'headers' => $this->headers,
                RequestOptions::JSON => $payload,
            ]);
        } catch (\Throwable $e) {
            throw new BadRequestException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @param string $resourceId
     *
     * @throws BadRequestException
     */
    public function deleteResource(string $resourceId): void
    {
        try {
            $this->httpClient->delete(sprintf('%s/%s', ClientInterface::ENDPOINT_RESOURCE, $resourceId), [
                'headers' => $this->headers,
            ]);
        } catch (\Throwable $e) {
            throw new BadRequestException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @param string $resourceId
     *
     * @return array
     *
     * @throws BadRequestException
     */
    public function getResource(string $resourceId): array
    {
        try {
            $response = $this->httpClient->get(sprintf('%s/%s?include=availability_constraints', ClientInterface::ENDPOINT_RESOURCE, $resourceId), [
                'headers' => $this->headers,
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            return $data;
        } catch (\Throwable $e) {
            throw new BadRequestException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @param array $payload
     *
     * @return array
     *
     * @throws BadRequestException
     */
    public function getAvailabilities(array $payload): array
    {
        try {
            $response = $this->httpClient->post(ClientInterface::ENDPOINT_AVAILABILITY, [
                'headers' => $this->headers,
                RequestOptions::JSON => $payload,
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            return $data;
        } catch (\Throwable $e) {
            throw new BadRequestException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @param array $payload
     *
     * @return array
     *
     * @throws BadRequestException
     */
    public function createBooking(array $payload): array
    {
        try {
            $response = $this->httpClient->post(ClientInterface::ENDPOINT_BOOKING, [
                'headers' => $this->headers,
                RequestOptions::JSON => $payload,
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            return $data;
        } catch (\Throwable $e) {
            throw new BadRequestException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @param string $bookingId
     *
     * @throws BadRequestException
     */
    public function deleteBooking(string $bookingId): void
    {
        try {
            $this->httpClient->delete(sprintf('%s/%s', ClientInterface::ENDPOINT_BOOKING, $bookingId), [
                'headers' => $this->headers,
            ]);
        } catch (\Throwable $e) {
            throw new BadRequestException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @param string $bookingId
     * @param string $state
     *
     * @return array
     *
     * @throws BadRequestException
     */
    public function updateBookingState(string $bookingId, string $state): array
    {
        try {
            if (false === in_array($state, Booking::AVAILABLE_STATES)) {
                throw new \InvalidArgumentException('Bad value for $state parameter. allowed values are: '.implode(', ', Booking::AVAILABLE_STATES));
            }

            $response = $this->httpClient->put(sprintf('%s/%s/%s', ClientInterface::ENDPOINT_BOOKING, $bookingId, $state), [
                'headers' => $this->headers,
                RequestOptions::JSON => [],
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            return $data;
        } catch (\Throwable $e) {
            throw new BadRequestException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
