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

## License

MIT
