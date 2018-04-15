<?php

declare(strict_types=1);

namespace CedricZiel\HetznerCloudAPI\Api;

class DataCenters extends AbstractApi
{
    public function all()
    {
        return $this->get('datacenters');
    }

    public function show($id)
    {
        return $this->get(sprintf('datacenters/%s', $id));
    }
}
