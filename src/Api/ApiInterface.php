<?php

declare(strict_types=1);

namespace CedricZiel\HetznerCloudAPI\Api;

use CedricZiel\HetznerCloudAPI\Client;
use Http\Message\StreamFactory;

interface ApiInterface
{
    public function __construct(Client $client, StreamFactory $streamFactory = null);
}
