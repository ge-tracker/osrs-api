# OSRS API

This package is a Laravel/PHP wrapper for the OSRS API, to easily interact with the Grand Exchange and Hiscore APIs.

## Installation

You can install the package via composer:

```bash
composer require ge-tracker/osrs-api
```

If you wish to publish the package's configuration, you can run the following command:

```bash
php artisan vendor:publish --provider="GeTracker\OsrsApi\OsrsApiServiceProvider"
```

## Usage

We recommend using this package via dependency injection in your methods, as this is a cleaner interface than a facade.

### Accessing the Grand Exchange API

``` php
public function execute(OsrsApi $osrsApi)
{
    $item = $osrsApi->ge()->itemDetail(13576);
    echo $item->id . ': ' . $item->name;
}
```

### Fetching hiscores

All requests to the hiscores are cached for 60 seconds by default. 

``` php
public function execute(OsrsApi $osrsApi)
{
    $hiscores = $osrsApi->hiscores()->fetch('Lynx Titan');
    
    echo 'Attack: ' . $hiscores->stats->attack->level;
}
```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email james@ge-tracker.com instead of using the issue tracker.

## Credits

- [GE Tracker](https://github.com/ge-tracker)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
