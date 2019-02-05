<?php

namespace MoovOne\TimekitPhpSdk\Provider;

/**
 * Interface HttpClientProviderInterface
 * @package MoovOne\TimekitPhpSdk\Interface
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