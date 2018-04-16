# Hetzner Cloud API for PHP

A API client library for the Hetzner Cloud APIs.

API keys can be obtained through the project settings.

## Installation

```bash
composer require cedricziel/php-hetzner-cloud-api
```

## Configuration and Basic Usage

```php
$token = '...';

// create an api client
$client = new \CedricZiel\HetznerCloudAPI\Client();

// set the credentials on your client
$client->authenticate($token);

// retrieve a list of servers
$client->servers->all();
```

## Available clients

### Actions

> Actions show the results and progress of asynchronous requests to the API.

[Source (HCloud API Documentation)](https://docs.hetzner.cloud/#resources-actions)

```php
// retrieve all actions
$actions = $client->actions->all();

// get one action
$action = $client->actions->show($actionId);
```

### Images

> Images are blueprints for your VM disks.

[Source (HCloud API Documentation)](https://docs.hetzner.cloud/#resources-images)

```php
// retrieve all images
$images = $client->images->all();

// get one image
$image = $client->images->show($imageId);
```

### Pricing

> Returns prices for all resources available on the platform. VAT and currency of the project owner are used for calculations.
>  
> Both net and gross prices are included in the response.

[Source (HCloud API Documentation)](https://docs.hetzner.cloud/#resources-pricing-get)

```php
// retrieve all prices
$prices = $client->pricing->all();
```

### Servers

> Servers are virtual machines that can be provisioned.

[Source (HCloud API Documentation)](https://docs.hetzner.cloud/#resources-servers)

```php
// retrieve all servers
$server = $client->servers->all();

// get one server
$server = $client->servers->show($serverId);

// create a server
$server = $client->servers->create($parameters);

// rename a server
$server = $client->servers->rename($serverId, $newName);

// remove a server
$client->servers->remove($serverId);
```

### ServerActions

Apply actions to your servers and retrieve progress/status messages.

[Source (HCloud API Documentation)](https://docs.hetzner.cloud/#resources-server-actions)

```php
// retrieve all server actions
$actions = $client->server_actions->all();

// get one server action
$action = $client->server_actions->show($actionId);

// powerOn
$action = $client->server_actions->powerOn($serverId);

// reboot
$action = $client->server_actions->reboot($serverId);

// reset
$action = $client->server_actions->reset($serverId);

// powerOn
$action = $client->server_actions->powerOn($serverId);

// shutdown
$action = $client->server_actions->shutdown($serverId);

// powerOff
$action = $client->server_actions->powerOff($serverId);

// resetPassword
$action = $client->server_actions->resetPassword($serverId);

// enableRescueMode
$action = $client->server_actions->enableRescueMode($serverId);

// disableRescueMode
$action = $client->server_actions->disableRescueMode($serverId);

// createImage
$action = $client->server_actions->createImage($serverId, $parameters);

// rebuild
$action = $client->server_actions->rebuild($serverId, $parameters);

// changeType
$action = $client->server_actions->changeType($serverId, $parameters);

// enableBackup
$action = $client->server_actions->enableBackup($serverId, $parameters);

// disableBackup
$action = $client->server_actions->disableBackup($serverId);

// attachIso
$action = $client->server_actions->attachIso($serverId, $parameters);

// detachIso
$action = $client->server_actions->detachIso($serverId);

// changeDnsPtr
$action = $client->server_actions->changeDnsPtr($serverId, $parameters);

// changeProtection
$action = $client->server_actions->detachIso($serverId, $parameters);

// requestConsole
$action = $client->server_actions->requestConsole($serverId);
```

### SSH Keys

> SSH keys are public keys you provide to the cloud system.

[Source (HCloud API Documentation)](https://docs.hetzner.cloud/#resources-ssh-keys)

```php
// retrieve all SSH Keys
$keys = $client->ssh_keys->all();

// get one SSH Key
$key = $client->ssh_keys->show($keyId);

// create a SSH Key
$key = $client->ssh_keys->create($parameters);

// rename a SSH Key
$key = $client->ssh_keys->rename($keyId, $name);

// remove a SSH Key
$key = $client->ssh_keys->remove($keyId);
```

## Usage with Symfony

This library uses the [httpplug](http://httplug.io/) client library. The project provides a [Symfony bundle](http://docs.php-http.org/en/latest/integrations/symfony-bundle.html).
When installed, you can directly integrate the client library to make the API queries visible and debuggable:

```yaml
# in config/services.yaml

parameters:
    hetzner_token: '...'

# Hetzner API Base Client
CedricZiel\HetznerCloudAPI\Client:
    factory: ['CedricZiel\HetznerCloudAPI\Client', 'createWithHttpClient']
    arguments:
      - '@httplug.client.app'
    calls:
      - ['authenticate', ['%hetzner_token%', !php/const CedricZiel\HetznerCloudAPI\Client::AUTH_HTTP_TOKEN]]

# You can add a client service for the different resource types if you like:
CedricZiel\HetznerCloudAPI\Api\DataCenters:
    factory: ['@CedricZiel\HetznerCloudAPI\Client', 'api']
    arguments:
      - 'data_centers'

CedricZiel\HetznerCloudAPI\Api\ServerTypes:
    factory: ['@CedricZiel\HetznerCloudAPI\Client', 'api']
    arguments:
      - 'server_types'

```

## Credits

The project is **heavily** inspired by the [Gitlab PHP API Client](https://github.com/m4tthumphrey/php-gitlab-api) by @m4tthumphrey.

## License

MIT
