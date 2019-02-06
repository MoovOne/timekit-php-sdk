<?php

namespace MoovOne\TimekitPhpSdk\Tests;

use GuzzleHttp\Exception\ClientException;
use MoovOne\TimekitPhpSdk\ClientInterface;
use MoovOne\TimekitPhpSdk\Exception\BadRequestException;
use MoovOne\TimekitPhpSdk\GuzzleClient;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class GuzzleClientTest extends TestCase
{
    public function test_create_resource_successfully()
    {
        // building mocks
        $httpClient = $this->createMock(\GuzzleHttp\ClientInterface::class);
        $response = $this->createMock(ResponseInterface::class);
        $stream = $this->createMock(StreamInterface::class);
        $payload = [
            'timezone' => 'Europe/Paris',
            'name' => 'John Doe',
        ];

        // configuring mocks
        $stream->method('getContents')->willReturn(json_encode($payload));
        $response->method('getBody')->willReturn($stream);
        $httpClient->expects($this->once())
            ->method('request')
            ->with(
                'POST',
                sprintf('%s', ClientInterface::ENDPOINT_RESOURCE),
                $this->anything()
            )
            ->willReturn($response);

        $sut = (new GuzzleClient('fake-api-key'))->setHttpClient($httpClient);

        $response = $sut->createResource($payload);

        $expected = $payload;

        $this->assertSame($expected, $response);
    }

    public function test_create_resource_with_exception()
    {
        // building mocks
        $httpClient = $this->createMock(\GuzzleHttp\ClientInterface::class);
        $exception = new ClientException('a-fake-message', $this->createMock(RequestInterface::class));
        $payload = [
            'timezone' => 'Europe/Paris',
            'name' => 'John Doe',
        ];

        // configuring mocks
        $httpClient->expects($this->once())
            ->method('request')
            ->with(
                'POST',
                sprintf('%s', ClientInterface::ENDPOINT_RESOURCE),
                $this->anything()
            )
            ->willThrowException($exception);

        $sut = (new GuzzleClient('fake-api-key'))->setHttpClient($httpClient);

        $this->expectException(BadRequestException::class);

        $sut->createResource($payload);
    }

    public function test_get_resource_successfully()
    {
        // building mocks
        $httpClient = $this->createMock(\GuzzleHttp\ClientInterface::class);
        $response = $this->createMock(ResponseInterface::class);
        $stream = $this->createMock(StreamInterface::class);
        $resourceId = 'fake-resource-id';
        $json = json_encode([
            'id' => $resourceId,
        ]);

        // configuring mocks
        $stream->method('getContents')->willReturn($json);
        $response->method('getBody')->willReturn($stream);
        $httpClient->expects($this->once())
            ->method('request')
            ->with(
                'GET',
                sprintf('%s/%s?include=availability_constraints', ClientInterface::ENDPOINT_RESOURCE, $resourceId),
                $this->anything()
            )
            ->willReturn($response);

        $sut = (new GuzzleClient('fake-api-key'))->setHttpClient($httpClient);

        $response = $sut->getResource($resourceId);

        $expected = json_decode($json, true);

        $this->assertSame($expected, $response);
    }

    public function test_get_resource_with_exception()
    {
        // building mocks
        $httpClient = $this->createMock(\GuzzleHttp\ClientInterface::class);
        $exception = new ClientException('a-fake-message', $this->createMock(RequestInterface::class));
        $resourceId = 'fake-resource-id';

        // configuring mocks
        $httpClient->expects($this->once())
            ->method('request')
            ->with(
                'GET',
                sprintf('%s/%s?include=availability_constraints', ClientInterface::ENDPOINT_RESOURCE, $resourceId),
                $this->anything()
            )
            ->willThrowException($exception);

        $sut = (new GuzzleClient('fake-api-key'))->setHttpClient($httpClient);

        $this->expectException(BadRequestException::class);

        $sut->getResource($resourceId);
    }
}