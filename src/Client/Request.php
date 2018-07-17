<?php

namespace Mobly\Buscape\Sdk\Client;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ClientException;
use Mobly\Buscape\Sdk\Client\Endpoint\EndpointAbstract;
use Mobly\Buscape\Sdk\Client\Request\Paginator;
use Mobly\Buscape\Sdk\Collection\ProductCollection;
use Mobly\Buscape\Sdk\Traits\LoggerTrait;
use Psr\Log\LoggerInterface;

/**
 * Request
 *
 * @package Mobly\Buscape\Sdk\Client
 * @author Wilton Garcia <wilton.oliveira@mobly.com.br>, <wiltonog@gmail.com>
 **/
class Request 
{
    use LoggerTrait;

    /**
     * Guzzle Client instance
     *
     * @var \GuzzleHttp\Client
     **/
    private $client;

    /**
     * Configuration instance
     *
     * @var \Mobly\Buscape\Sdk\Client\Configuration
     **/
    private $configuration;

    /**
     * Endpoint instance
     *
     * @var \Mobly\Buscape\Sdk\Client\Endpoint\EndpointAbstract
     **/
    private $endpoint;

    /**
     * Collection instance
     *
     * @var \Mobly\Buscape\Sdk\Collection\ProductCollection;
     **/
    private $collection;

    /**
     * List of response data from Buscape
     *
     * @var array
     **/
    protected $responseItems = [];

    /**
     * Request constructor.
     *
     * @param EndpointAbstract $endpoint
     * @param ProductCollection $collection
     * @param Configuration $configuration
     * @param LoggerInterface $logger
     *
     */
    public function __construct(
        EndpointAbstract $endpoint, 
        ProductCollection $collection,
        Configuration $configuration,
        LoggerInterface $logger = null
    )
    {
        $this->client = new GuzzleClient();    
        $this->endpoint = $endpoint;    
        $this->collection = $collection;    
        $this->configuration = $configuration;
        $this->initLogger($logger);
    }

    /**
     * @return array
     * @throws \Exception
     */
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
                    $data = json_decode($response->getBody()->getContents(), true);
                    $this->responseItems = array_merge(
                        array_values($this->responseItems),
                        array_values($data)
                    );
                }
            } catch (ClientException $e) {
                $response = $e->getResponse();
                $data = json_decode($response->getBody()->getContents(), true);
                if (json_last_error() != JSON_ERROR_NONE) {
                    throw new \Exception('Parse response error');
                }

                $this->parseResponseError($page, isset($data['errors']) ? $e : null, $data);
            } catch (\Exception $e) {
                $this->parseResponseError($page, $e);
            }      
        }

        return $this->responseItems;
    }

    /**
     * Parse error responses
     *
     * @param $page
     * @param null $e
     * @param array $response
     */
    protected function parseResponseError($page, $e = null, $response = [])
    {
        $exceptionErrors = null;
        if ($e !== null) {
            $exceptionErrors['errors'] = [[
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ]];
        }

        foreach ($page as $product) {
            if ($exceptionErrors === null) {
                $responseError = [];

                $arraySkus = array_map(function($element) {
                    return $element['sku'];
                }, $response);

                $responseKey = array_search($product['sku'], $arraySkus);
                if ($responseKey !== false) {
                    $responseError = $response[$responseKey]['errors'];
                }
            }

            $errorResponse = [
                'sku' => $product['sku'],
                'status' => false,
                'errors' => $exceptionErrors !== null ? $exceptionErrors['errors'] : $responseError
            ];

            $this->responseItems[] = $errorResponse;

            $this->debug('Error sku '. $product['sku'], $errorResponse);

        }
    }

    /**
     * @param $body
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    protected function doRequest($body)
    {
        $response = $this->client->request(
            $this->endpoint->method,
            $this->endpoint->getUrl($this->configuration),
            [
                'body' => $body,
                'timeout' => 2,
                'allow_redirects' => false,
                'headers' => [
                    'Accept' => $this->endpoint->accept,
                    'Content-type' => $this->endpoint->contentType,
                    'app-token' => $this->configuration->appToken,
                    'auth-token' => $this->configuration->authToken
                ]
            ]
        );

        $this->debug('Send request', [
            'Accept' => $this->endpoint->accept,
            'Content-type' => $this->endpoint->contentType,
            'app-token' => $this->configuration->appToken,
            'auth-token' => $this->configuration->authToken,
            'url' => $this->endpoint->getUrl($this->configuration),
            'method' => $this->endpoint->method,
            'body' => $body
        ]);

        return $response;
    }
}
