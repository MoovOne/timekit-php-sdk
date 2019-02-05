<?php

namespace MoovOne\TimekitPhpSdk;

use MoovOne\TimekitPhpSdk\Provider\HttpClientProviderInterface;
use MoovOne\TimekitPhpSdk\Exception\BadRequestException;
use MoovOne\TimekitPhpSdk\Model\Booking;

/**
 * Class TimekitApiService
 * @package MoovOne\TimekitPhpSdk
 */
class TimekitApiService
{
    /**
     * @var string
     */
    const BASE_URI = 'https://api.timekit.io/v2/';

    /**
     * @var HttpClientProviderInterface
     */
    private $httpClient;

    /**
     * TimekitApiService constructor.
     * @param array $options
     *  - $options = [
     *          'apiKey' => string,
     *          'httpClient' => HttpClientProviderInterface
     *      ]
     * @throws \Exception
     */
    public function __construct(array $options)
    {
        if (empty($options['apiKey'])) {
            throw new \Exception('Missing apiKey');
        }
        if (empty($options['httpClient'])) {
            $this->httpClient = new GuzzleHttpClientProvider($options, $options['apiKey'], self::BASE_URI);
        }
        if ($options['httpClient'] instanceof HttpClientProviderInterface) {
            $this->httpClient = new $options['httpClient'];
        }
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
            return $this->httpClient->post('resources', $payload);
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
            $this->httpClient->post(sprintf('resources/%s', $resourceId), $payload);
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
            $this->httpClient->delete(sprintf('resources/%s', $resourceId));
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
            return $this->httpClient->get(sprintf('resources/%s?include=availability_constraints', $resourceId));
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
            return $this->httpClient->post('availability', $payload);
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
            return $this->httpClient->post('bookings', $payload);
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
            $this->httpClient->delete(sprintf('bookings/%s', $bookingId));
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
            if (false === in_array($state, Booking::getAvailableStates())) {
                throw new BadRequestException('State not allowed.', 422);
            }

            return $this->httpClient->put(sprintf('bookings/%s/%s', $bookingId, $state), []);
        } catch (\Throwable $e) {
            throw new BadRequestException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
