<?php

namespace MoovOne\TimekitPhpSdk;

use MoovOne\TimekitPhpSdk\Exception\BadRequestException;

/**
 * Interface ClientInterface
 * @package MoovOne\TimekitPhpSdk
 */
interface ClientInterface
{
    public const BASE_URI = 'https://api.timekit.io/v2/';

    public const ENDPOINT_RESOURCE = 'resources';
    public const ENDPOINT_AVAILABILITY = 'availability';
    public const ENDPOINT_BOOKING = 'bookings';
    public const ENDPOINT_PROJECT = 'projects';

    /**
     * @param array $payload
     * @return array
     * @throws BadRequestException
     */
    public function createResource(array $payload): array;

    /**
     * @param string $resourceId
     * @param array $payload
     * @throws BadRequestException
     */
    public function updateResource(string $resourceId, array $payload): void;

    /**
     * @param string $resourceId
     * @throws BadRequestException
     */
    public function deleteResource(string $resourceId): void;

    /**
     * @param string $resourceId
     * @return array
     * @throws BadRequestException
     */
    public function getResource(string $resourceId): array;

    /**
     * @param array $payload
     * @return array
     * @throws BadRequestException
     */
    public function getAvailabilities(array $payload): array;

    /**
     * @param array $payload
     * @return array
     * @throws BadRequestException
     */
    public function createBooking(array $payload): array;

    /**
     * @param string $bookingId
     * @throws BadRequestException
     */
    public function deleteBooking(string $bookingId): void;

    /**
     * @param string $bookingId
     * @param string $state
     * @return array
     * @throws BadRequestException
     */
    public function updateBookingState(string $bookingId, string $state): array;

    /**
     * @param string $search
     * @return array
     * @throws BadRequestException
     */
    public function getProjects(string $search = ''): array;
}