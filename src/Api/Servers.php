<?php

declare(strict_types=1);

namespace CedricZiel\HetznerCloudAPI\Api;

use Symfony\Component\OptionsResolver\OptionsResolver;

class Servers extends AbstractApi
{
    public function all()
    {
        return $this->get('servers');
    }

    public function show($serverId)
    {
        return $this->get('servers/'.$this->encodePath($serverId));
    }

    public function actions($serverId)
    {
        return $this->get($this->getServerPath($serverId, 'actions'));
    }

    public function showAction($serverId, $actionId)
    {
        return $this->get($this->getServerPath($serverId, 'actions/'.$this->encodePath($actionId)));
    }

    public function create(array $parameters = [])
    {
        $resolver = new OptionsResolver();

        $resolver
            ->setDefined('name')
            ->setAllowedTypes('name', 'string')
            ->setRequired('name')
        ;

        $resolver
            ->setDefined('server_type')
            ->setAllowedTypes('server_type', 'string')
            ->setRequired('server_type')
        ;

        $resolver
            ->setDefined('location')
            ->setAllowedTypes('location', 'string')
        ;

        $resolver
            ->setDefined('datacenter')
            ->setAllowedTypes('datacenter', 'string')
        ;

        $resolver
            ->setDefined('start_after_create')
            ->setAllowedTypes('start_after_create', 'boolean')
        ;

        $resolver
            ->setDefined('image')
            ->setAllowedTypes('image', 'string')
            ->setRequired('image')
        ;

        $resolver
            ->setDefined('ssh_keys')
            ->setAllowedTypes('ssh_keys', 'array')
        ;

        $resolver
            ->setDefined('user_data')
            ->setAllowedTypes('user_data', 'string')
        ;

        return $this->post('servers', $resolver->resolve($parameters));
    }

    public function rename($serverId, string $name)
    {
        return $this->put(sprintf('servers/%s', $serverId), ['name' => $name]);
    }

    public function remove($serverId)
    {
        return $this->delete(sprintf('servers/%s', $serverId));
    }
}
