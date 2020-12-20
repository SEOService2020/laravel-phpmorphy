# laravel-phpmorphy

[![Latest Stable Version](https://poser.pugx.org/seoservice2020/laravel-phpmorphy/version)](https://packagist.org/packages/seoservice2020/laravel-phpmorphy)
[![Total Downloads](https://poser.pugx.org/seoservice2020/laravel-phpmorphy/downloads)](https://packagist.org/packages/seoservice2020/laravel-phpmorphy)
[![tests](https://github.com/seoservice2020/laravel-phpmorphy/workflows/tests/badge.svg)](https://github.com/seoservice2020/laravel-phpmorphy/actions)
[![codecov](https://codecov.io/gh/seoservice2020/laravel-phpmorphy/branch/master/graph/badge.svg)](https://codecov.io/gh/seoservice2020/laravel-phpmorphy)
[![License](https://poser.pugx.org/seoservice2020/laravel-phpmorphy/license)](https://packagist.org/packages/seoservice2020/laravel-phpmorphy)

```laravel-phpmorphy``` is a Laravel wrapper for phpMorphy library with PHP7 support.

phpMorphy is a morphological analyzer library for Russian, English, German and Ukrainian languages.

**Make sure you have appropriate dictionaries for languages you wish to use. PhpMorphy library may not contain all neeed dictionaries!**

## Installation

Run the following command from your terminal:

```bash
composer require seoservice2020/laravel-phpmorphy
```

or add this to require section in your composer.json file:

```bash
"seoservice2020/laravel-phpmorphy": "~1.0"
```

then run ```composer update```

## Configuration

The defaults are set in `config/morphy.php`. Copy this file to your own config directory to modify the values. You can publish the config using this command:

```bash
php artisan vendor:publish --provider="SEOService2020\Morphy\MorphyServiceProvider"
```

This is the contents of the published file:

```php
return [
    // phpMorphy language
    'language' => SEOService2020\Morphy\Morphy::russianLang,
    // phpMorphy options
    'options' => [
        'storage' => phpMorphy::STORAGE_FILE,
        'predict_by_suffix' => true,
        'predict_by_db' => true,
        'graminfo_as_text' => true,
    ],
    // when null, default dicts wil be loaded
    'dicts_path' => null,
];
```

## Usage

Using the wrapper directly:

``` php
use SEOService2020\Morphy\Morphy;
$morphy = new Morphy(Morphy::englishLang);
echo $morphy->getPseudoRoot('FIGHTY');
```

Or via Laravel Facade:

``` php
use SEOService2020\Morphy\Facade\Morphy;
Morphy::getPseudoRoot('БОЙЦОВЫЙ');
```

### Add facade support

This package allows Laravel to support facade out of the box, but you may explicitly add facade support to config/app.php:

Section ```providers```

``` php
SEOService2020\Morphy\MorphyServiceProvider::class,
```

Section ```aliases```

``` php
'Morphy' => SEOService2020\Morphy\Facade\Morphy::class,
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email sergotail@mail.ru instead of using the issue tracker.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
