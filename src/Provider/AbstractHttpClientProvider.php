<?php

namespace MoovOne\TimekitPhpSdk\Model;

use MoovOne\TimekitPhpSdk\Interfaces\HttpClientProviderInterface;

/**
 * Class AbstractHttpClientProvider
 * @package MoovOne\TimekitPhpSdk\Model
 */
class AbstractHttpClientProvider implements HttpClientProviderInterface
{
    /**
     * @var mixed
     */
    protected $httpClient;

    /**
     * @var array
     */
    protected $headers;

    /**
     * @var string
     */
    protected $apiUrl;

    /**
     * @var string
     */
    protected $apiKey;

    /**
     * AbstractHttpClientProvider constructor.
     * @param array $options
     * @param string $apiKey
     * @param string $apiUrl
     */
    public function __construct(array $options, string $apiKey, string $apiUrl)
    {
        $this->apiKey = $apiKey;
        $this->apiUrl = $apiUrl;
        if (empty($options['headers'])) {
            $options['headers'] = [
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic '.base64_encode(':'.$this->apiKey),
            ];
        }
        $this->headers = $options['headers'];
    }

    /**
     * @param string $uri
     * @return array
     * @throws \Exception
     */
    public function get(string $uri): array
    {
        throw new \Exception('Method must be implemented!');
    }

    /**
     * @param string $uri
     * @param array $payload
     * @return array
     * @throws \Exception
     */
    public function post(string $uri, array $payload): array
    {
        throw new \Exception('Method must be implemented!');
    }

    /**
     * @param string $uri
     * @param array $payload
     * @return array
     * @throws \Exception
     */
    public function put(string $uri, array $payload): array
    {
        throw new \Exception('Method must be implemented!');
    }

    /**
     * @param string $uri
     * @return void
     * @throws \Exception
     */
    public function delete(string $uri): void
    {
        throw new \Exception('Method must be implemented!');
    }

}