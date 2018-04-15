<?php

declare(strict_types=1);

namespace CedricZiel\HetznerCloudAPI\Api;

class Actions extends AbstractApi
{
    public const STATUS_RUNNING = 'running';
    public const STATUS_SUCCESS = 'success';
    public const STATUS_ERROR = 'error';

    public function all(?string $status, ?string  $sort)
    {
        return $this->get('actions');
    }

    public function show(int $actionId)
    {
        return $this->get(sprintf('actions/%s', $actionId));
    }
}
