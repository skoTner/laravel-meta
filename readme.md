# Create meta tags on all Laravel models

The `skoTner/laravel-meta` package provides easy to use functions for setting, getting and deleting meta tags on all your Eloquent models.
The Package stores all meta tags in the `meta` table, or you can choose custom table if needed.

Here's a demo of how you can use it:

```php
$model->setMeta('foo', 'bar');
$model->getMeta('foo'); // Returns 'bar'
```

You can also set multiple tags at once:
```php
$model->setMeta([
	'animal' => 'sheep',
	'flower' => 'rose',
	'drink'  => 'milk'
]);
```

## Documentation
You'll find the documentation on [https://github.com/skoTner/laravel-meta](https://github.com/skoTner/laravel-meta).

Find yourself stuck using the package? Found a bug? Do you have general questions or suggestions for improving? Feel free to [create an issue on GitHub](https://github.com/skoTner/laravel-meta/issues), I'll try to address it as soon as possible.

If you've found a security issue please mail [andreas@skotner.net](mailto:andreas@skotner.net) instead of using the issue tracker.


## Installation

You can install the package via composer:

``` bash
composer require skoTner/laravel-meta
```

The package will automatically register itself.

You can publish the migration and config with:
```bash
php artisan vendor:publish --provider="Skotner\Meta\MetaServiceProvider"
```

*Note*: The default migration assumes you are using integers for your model IDs. If you are using UUIDs, or some other format, adjust the format of the model_id field in the published migration before continuing.

After publishing the migration you can create the `meta` table by running the migrations:


```bash
php artisan migrate
```

You can optionally change the table name in the config file:

```php
return [

	/*
	* Table name where the meta tags are stored.
	*/
	'table_name' => 'meta',
	
];
```

## Usage

First, you add the `Skotner\Meta\Meta` trait to your model(s):

```php
use Illuminate\Foundation\Auth\User as Authenticatable;
use Skotner\Meta\Meta;

class User extends Authenticatable
{
    use Meta;

    // ...
}
```

This allows you to set, get and delete meta tags on the model. To use these functions, it is as easy as:

### Set a meta tag

You can either set a single meta tag to a model, or you can assign multiple meta tags in one go:

```php
// Adding a single meta tag
$user->setMeta('foo', 'bar');

// Adding multiple meta tags at once
$user->setMeta([
	'animal' => 'sheep',
	'flower' => 'rose',
	'drink'  => 'milk'
]);
```

### Get a meta tag

Getting a meta tag is as easy as it can be:

```php
$user->getMeta('foo'); // Will return "bar" if set as above, or will return null if it doesn't exist
```

### Deleting a meta tag
```php
$user->deleteMeta('foo'); // Deletes the meta tag with key "foo" if it exists
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information about recent changes.

## Security

If you discover any security related issues, please email andreas@skotner.net instead of using the issue tracker.

## Free to use

You're free to use this package, but if it makes it to your production environment we highly appreciate you stating credits to us:

We are: Skotner Gruppen AS - www.skotner.no - Norway

## Credits

- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
