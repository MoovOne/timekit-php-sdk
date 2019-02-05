<?php

namespace MoovOne\TimekitPhpSdk;

interface ClientInterface
{
    public const ENDPOINT_RESOURCE = 'resources';
    public const ENDPOINT_AVAILABILITY = 'availability';
    public const ENDPOINT_BOOKING = 'bookings';

    public function createResource(array $payload): array;

    public function updateResource(string $resourceId, array $payload): void;

    public function deleteResource(string $resourceId): void;

    public function getResource(string $resourceId): array;

    public function getAvailabilities(array $payload): array;

    public function createBooking(array $payload): array;

    public function deleteBooking(string $bookingId): void;

    public function updateBookingState(string $bookingId, string $state): array;
}