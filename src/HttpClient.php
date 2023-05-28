<?php

namespace Microit\StoreBase;

use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class HttpClient
{
    private ClientInterface $client;

    private RequestFactoryInterface $requestFactory;

    protected string $baseUrl;

    public function __construct(
        string $baseUrl = null,
        ?ClientInterface $client = null,
        ?RequestFactoryInterface $requestFactory = null
    ) {
        $this->baseUrl = $baseUrl ?: '';
        $this->client = $client ?: Psr18ClientDiscovery::find();
        $this->requestFactory = $requestFactory ?: Psr17FactoryDiscovery::findRequestFactory();
    }

    public function setBaseUrl(string $baseUrl): self
    {
        $this->baseUrl = $baseUrl;

        return $this;
    }

    public function createRequest(string $method, string $uri): RequestInterface
    {
        return $this->requestFactory->createRequest(strtoupper($method), sprintf('%s/%s', $this->baseUrl, ltrim($uri, '/')));
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function getResponse(RequestInterface $request): ResponseInterface
    {
        return $this->client->sendRequest($request);
    }
}
