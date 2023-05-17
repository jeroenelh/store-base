<?php
namespace Microit\StoreBase;

use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18Client;
use Http\Discovery\Psr18ClientDiscovery;
use Nyholm\Psr7\Stream;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class HttpClient {
    private ClientInterface $client;
    private RequestFactoryInterface $requestFactory;

    public function __construct(
        readonly string $baseUrl,
        ?ClientInterface $client = null,
        ?RequestFactoryInterface $requestFactory = null
    )
    {
        $this->client = $client ?: Psr18ClientDiscovery::find();
        $this->requestFactory = $requestFactory ?: Psr17FactoryDiscovery::findRequestFactory();
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
