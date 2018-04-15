<?php

declare(strict_types=1);

namespace CedricZiel\HetznerCloudAPI\Api;

use Symfony\Component\OptionsResolver\OptionsResolver;

class ServerActions extends AbstractApi
{
    public const BACKUP_WINDOWS = ['22-02', '02-06', '06-10', '10-14', '14-18', '18-22'];

    public function all($serverId)
    {
        return $this->get($this->getServerPath($serverId, 'actions'));
    }

    public function show($serverId, $actionId)
    {
        return $this->get($this->getServerPath($serverId, sprintf('actions/%s', $actionId)));
    }

    public function powerOn($serverId)
    {
        return $this->post($this->getServerPath($serverId, 'actions/poweron'));
    }

    public function reboot($serverId)
    {
        return $this->post($this->getServerPath($serverId, 'actions/reboot'));
    }

    public function reset($serverId)
    {
        return $this->post($this->getServerPath($serverId, 'actions/reset'));
    }

    public function shutdown($serverId)
    {
        return $this->post($this->getServerPath($serverId, 'actions/shutdown'));
    }

    public function powerOff($serverId)
    {
        return $this->post($this->getServerPath($serverId, 'actions/poweroff'));
    }

    public function resetPassword($serverId)
    {
        return $this->post($this->getServerPath($serverId, 'actions/reset_password'));
    }

    public function enableRescueMode($serverId)
    {
        return $this->post($this->getServerPath($serverId, 'actions/enable_rescue'));
    }

    public function disableRescueMode($serverId)
    {
        return $this->post($this->getServerPath($serverId, 'actions/disable_rescue'));
    }

    public function createImage($serverId, array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver
            ->setDefined('description')
            ->setAllowedTypes('description', 'string')
        ;
        $resolver
            ->setDefined('type')
            ->setAllowedTypes('type', 'string')
            ->setAllowedValues('type', [Images::TYPE_BACKUP, Images::TYPE_SNAPSHOT])
        ;

        return $this->post($this->getServerPath($serverId, 'actions/create_image'), $resolver->resolve($parameters));
    }

    public function rebuild($serverId, array $parameters = [])
    {
        $resolver = new OptionsResolver();
        $resolver
            ->setDefined('image')
            ->setAllowedTypes('image', 'string')
            ->setRequired('image')
        ;

        return $this->post($this->getServerPath($serverId, 'actions/rebuild'), $resolver->resolve($parameters));
    }

    public function changeType($serverId, array $parameters = [])
    {
        $resolver = new OptionsResolver();
        $resolver
            ->setDefined('upgrade_disk')
            ->setAllowedTypes('upgrade_disk', 'boolean')
            ->setRequired('upgrade_disk')
        ;
        $resolver
            ->setDefined('server_type')
            ->setAllowedTypes('image', 'string')
            ->setRequired('server_type')
        ;

        return $this->post($this->getServerPath($serverId, 'actions/change_type'), $resolver->resolve($parameters));
    }

    public function enableBackup($serverId, array $parameters = [])
    {
        $resolver = new OptionsResolver();
        $resolver
            ->setDefined('backup_window')
            ->setAllowedTypes('backup_window', 'string')
            ->setAllowedValues('backup_window', static::BACKUP_WINDOWS)
            ->setRequired('backup_window')
        ;

        return $this->post($this->getServerPath($serverId, 'actions/enable_backup'), $resolver->resolve($parameters));
    }

    public function disableBackup($serverId)
    {
        return $this->post($this->getServerPath($serverId, 'actions/disable_backup'));
    }

    public function attachIso($serverId, array $parameters = [])
    {
        $resolver = new OptionsResolver();
        $resolver
            ->setDefined('iso')
            ->setAllowedTypes('iso', 'string')
            ->setRequired('iso')
        ;

        return $this->post($this->getServerPath($serverId, 'actions/attach_iso'), $resolver->resolve($parameters));
    }

    public function detachIso($serverId)
    {
        return $this->post($this->getServerPath($serverId, 'actions/detach_iso'));
    }

    public function changeDnsPtr($serverId, array $parameters = [])
    {
        $resolver = new OptionsResolver();
        $resolver
            ->setDefined('ip')
            ->setAllowedTypes('ip', 'string')
            ->setRequired('ip')
        ;
        $resolver
            ->setDefined('dns_ptr')
            ->setAllowedTypes('dns_ptr', 'string')
        ;

        return $this->post($this->getServerPath($serverId, 'actions/change_dns_ptr'), $resolver->resolve($parameters));
    }

    public function changeProtection($serverId, array $parameters = [])
    {
        $resolver = new OptionsResolver();
        $resolver
            ->setDefined('delete')
            ->setAllowedTypes('delete', 'boolean')
        ;
        $resolver
            ->setDefined('rebuild')
            ->setAllowedTypes('rebuild', 'boolean')
        ;

        return $this->post($this->getServerPath($serverId, 'actions/change_protection'), $resolver->resolve($parameters));
    }

    public function requestConsole($serverId)
    {
        return $this->post($this->getServerPath($serverId, 'actions/request_console'));
    }
}
