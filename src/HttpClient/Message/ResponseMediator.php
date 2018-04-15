<?php

declare(strict_types=1);

namespace CedricZiel\HetznerCloudAPI\HttpClient\Message;

use Psr\Http\Message\ResponseInterface;

class ResponseMediator
{
    /**
     * Return the response body as a string or json array if content type is application/json.
     *
     * @param ResponseInterface $response
     *
     * @return array|string
     */
    public static function getContent(ResponseInterface $response)
    {
        $body = $response->getBody()->__toString();
        if (0 === strpos($response->getHeaderLine('Content-Type'), 'application/json')) {
            $content = json_decode($body, true);

            if (JSON_ERROR_NONE === json_last_error()) {
                return $content;
            }
        }

        return $body;
    }
}
