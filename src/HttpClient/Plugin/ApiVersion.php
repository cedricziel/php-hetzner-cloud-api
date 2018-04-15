<?php

declare(strict_types=1);

namespace CedricZiel\HetznerCloudAPI\HttpClient\Plugin;

use Http\Client\Common\Plugin;
use Psr\Http\Message\RequestInterface;

/**
 * Prefix requests path with the given API version if required.
 *
 * @author Fabien Bourigault <bourigaultfabien@gmail.com>
 */
class ApiVersion implements Plugin
{
    /**
     * @var string
     */
    private $version;

    /**
     * @param string $version
     */
    public function __construct(string $version = 'v1')
    {
        $this->version = $version;
    }

    /**
     * {@inheritdoc}
     */
    public function handleRequest(RequestInterface $request, callable $next, callable $first)
    {
        $uri = $request->getUri();

        $versionPath = sprintf('/%s/', $this->version);

        if (0 !== strpos($uri->getPath(), $versionPath)) {
            $request = $request->withUri($uri->withPath($versionPath.$uri->getPath()));
        }

        return $next($request);
    }
}
