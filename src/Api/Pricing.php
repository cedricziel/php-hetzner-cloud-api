<?php

declare(strict_types=1);

namespace CedricZiel\HetznerCloudAPI\Api;

class Pricing extends AbstractApi
{
    public function all()
    {
        return $this->get('pricing');
    }
}
