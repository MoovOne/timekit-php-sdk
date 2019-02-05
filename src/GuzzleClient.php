<?php

namespace MoovOne\TimekitPhpSdk;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface as HttpClientInterface;
use GuzzleHttp\Exception\GuzzleException;
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
     * @var array
     */
    private $headers;

    /**
     * GuzzleClient constructor.
     * @param HttpClientInterface $httpClient
     * @param string $apiKey
     */
    public function __construct(string $apiKey)
    {
        $this->httpClient = new Client([
            'base_uri' => ClientInterface::BASE_URI,
        ]);

        $this->headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic '.base64_encode(':'.$apiKey),
        ];
    }

    /**
     * @param HttpClientInterface $httpClient
     * @return $this
     */
    public function setHttpClient(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function createResource(array $payload): array
    {
        try {
            $response = $this->httpClient->request('POST', sprintf('%s/%s', ClientInterface::BASE_URI, ClientInterface::ENDPOINT_RESOURCE), [
                'headers' => $this->headers,
                RequestOptions::JSON => $payload,
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            return $data;
        } catch (GuzzleException $e) {
            throw new BadRequestException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @inheritdoc
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
     * @inheritdoc
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
     * @inheritdoc
     */
    public function getResource(string $resourceId): array
    {
        try {
            $response = $this->httpClient->request('GET', sprintf('%s/%s/%s?include=availability_constraints', ClientInterface::BASE_URI, ClientInterface::ENDPOINT_RESOURCE, $resourceId), [
                'headers' => $this->headers,
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            return $data;
        } catch (GuzzleException $e) {
            throw new BadRequestException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @inheritdoc
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
     * @inheritdoc
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
     * @inheritdoc
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
     * @inheritdoc
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
