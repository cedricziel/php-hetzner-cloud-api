<?php

declare(strict_types=1);

namespace CedricZiel\HetznerCloudAPI\HttpClient\Plugin;

use CedricZiel\HetznerCloudAPI\Client;
use Http\Client\Common\Plugin;
use Psr\Http\Message\RequestInterface;

/**
 * Add authentication to the request.
 *
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 * @author Fabien Bourigault <bourigaultfabien@gmail.com>
 */
class Authentication implements Plugin
{
    /**
     * @var string
     */
    private $method;

    /**
     * @var string
     */
    private $token;

    /**
     * @param string $method
     * @param string $token
     */
    public function __construct($method, $token)
    {
        $this->method = $method;
        $this->token = $token;
    }

    /**
     * {@inheritdoc}
     */
    public function handleRequest(RequestInterface $request, callable $next, callable $first)
    {
        switch ($this->method) {
            case Client::AUTH_HTTP_TOKEN:
                $request = $request->withHeader('Authorization', sprintf('Bearer %s', $this->token));
                break;
        }

        return $next($request);
    }
}
