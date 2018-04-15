<?php

declare(strict_types=1);

namespace CedricZiel\HetznerCloudAPI\Api;

class ServerTypes extends AbstractApi
{
    public function all()
    {
        return $this->get('server_types');
    }

    public function show($id)
    {
        return $this->get(sprintf('server_types/%s', $id));
    }
}
