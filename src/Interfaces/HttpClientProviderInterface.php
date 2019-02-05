<?php

namespace MoovOne\TimekitPhpSdk\Interfaces;

/**
 * Interface HttpClientProviderInterface
 * @package MoovOne\TimekitPhpSdk\Interfaces
 */
interface HttpClientProviderInterface
{
    /**
     * @param string $uri
     * @return array
     */
    public function get(string $uri): array;

    /**
     * @param string $uri
     * @param array $payload
     * @return array
     */
    public function post(string $uri, array $payload): array;

    /**
     * @param string $uri
     * @param array $payload
     * @return array
     */
    public function put(string $uri, array $payload): array;

    /**
     * @param string $uri
     */
    public function delete(string $uri): void;
}