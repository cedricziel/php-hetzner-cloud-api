<?php

namespace CedricZiel\HetznerCloudAPI\Api;

use Symfony\Component\OptionsResolver\OptionsResolver;

class SSHKeys extends AbstractApi
{
    public function all()
    {
        return $this->get('ssh_keys');
    }

    public function show($sshKeyId)
    {
        return $this->get(sprintf('ssh_keys/%s', $sshKeyId));
    }

    public function create(array $parameters = [])
    {
        $resolver = new OptionsResolver();

        $resolver
            ->setDefined('name')
            ->setAllowedTypes('name', 'string')
            ->setRequired(true)
        ;

        $resolver
            ->setDefined('public_key')
            ->setAllowedTypes('public_key', 'string')
            ->setRequired(true)
        ;

        return $this->post('ssh_keys', $resolver->resolve($parameters));
    }

    public function rename($keyId, string $newName)
    {
        return $this->put(sprintf('ssh_keys/%s', $keyId), ['name' => $newName]);
    }

    public function remove($keyId)
    {
        return $this->delete(sprintf('ssh_keys/%s', $keyId));
    }
}
