<?php

declare(strict_types=1);

namespace CedricZiel\HetznerCloudAPI\Api;

class Images extends AbstractApi
{
    public const TYPE_BACKUP = 'backup';

    public const TYPE_SNAPSHOT = 'snapshot';

    public function all()
    {
        return $this->get('images');
    }

    public function show($imageId)
    {
        return $this->get(sprintf('images/%s', $imageId));
    }
}
