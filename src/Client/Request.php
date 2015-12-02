<?php

namespace Mobly\Buscape\Sdk\Client;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ParseException;
use GuzzleHttp\Psr7\Request as GuzzleRequest;
use Mobly\Buscape\Sdk\Client\Endpoint\EndpointAbstract;
use Mobly\Buscape\Sdk\Client\Request\Paginator;
use Mobly\Buscape\Sdk\Collection\Product as ProductCollection;

/**
 * Request
 *
 * @package Mobly\Buscape\Sdk\Client
 * @author Wilton Garcia <wilton.oliveira@mobly.com.br>, <wiltonog@gmail.com>
 **/
class Request 
{
    /**
     * Guzzle Client instance
     *
     * @var GuzzleHttp\Client
     **/
    private $client;

    /**
     * Configuration instance
     *
     * @var Mobly\Buscape\Sdk\Client\Configuration
     **/
    private $configuration;

    /**
     * Endpoint instance
     *
     * @var Mobly\Buscape\Sdk\Client\Endpoint\EndpointAbstract
     **/
    private $endpoint;

    /**
     * Collection instance
     *
     * @var Mobly\Buscape\Sdk\Collection\Product;
     **/
    private $collection;

    /**
     * List of response data from Buscape
     *
     * @var array
     **/
    protected $responseItems = [];    

    /**
     * Class constructor
     *
     * @param Mobly\Buscape\Sdk\Client\Endpoint\EndpointAbstract $endpoint
     * @param Mobly\Buscape\Sdk\Collection\Product $collection
     * @return void
     **/
    public function __construct(
        EndpointAbstract $endpoint, 
        ProductCollection $collection
    )
    {
        $this->client = new GuzzleClient();    
        $this->endpoint = $endpoint;    
        $this->collection = $collection;    
        $this->configuration = Configuration::getInstance();
    }

    /**
     * Get pages and send
     *
     * @return array
     **/
    public function send()
    {
        $paginator = new Paginator(
            $this->collection->toArray(),
            $this->endpoint->chunk
        );

        foreach ($paginator as $key => $page) {
            try {
                $response = $this->doRequest(
                    json_encode($page)
                );
                if (200 === $response->getStatusCode()) {
                    $this->responseItems = array_merge(
                        array_values($this->responseItems),
                        array_values($response->json())
                    );
                }
            } catch (ClientException $e) {
                $response = $e->getResponse();
                try {
                    $data = $response->json();
                } catch (ParseException $e) {
                    $data['errors'] = [[
                        'code' => $e->getCode(),
                        'message' => $e->getMessage()
                    ]]; 
                }
                foreach ($page as $product) {
                    $this->responseItems[] = [
                        'sku' => $product->getSku(),
                        'status' => false,
                        'errors' => !empty($data['errors']) ? $data['errors'] : []
                    ];   
                }
            } catch (\Exception $e) {
                foreach ($page as $product) {
                    $this->responseItems[] = [
                        'sku' => $product->getSku(),
                        'status' => false,
                        'errors' => [[
                            'code' => $e->getCode(),
                            'message' => $e->getMessage()
                        ]]
                    ];   
                }
            }      
        }

        return $this->responseItems;

    }

    /**
     * Send request to Buscapé
     *
     * @param string $body
     * @return GuzzleHttp\Message\Response
     **/
    protected function doRequest($body)
    {
        $request = $this->client->createRequest(
            $this->endpoint->method,
            $this->endpoint->getUrl(),
            [
                'body' => $body
            ]
        );
        $request->setHeaders(
            [
                'Accept' => $this->endpoint->accept,
                'Content-type' => $this->endpoint->contentType,
                'app-token' => $this->configuration->appToken,
                'auth-token' => $this->configuration->authToken     
            ]
        );

        return $this->client->send(
            $request, 
            [
                'timeout' => 2,
                'allow_redirects' => false
            ]
        ); 
    }
}
