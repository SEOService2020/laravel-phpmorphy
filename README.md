# laravel-phpmorphy

[![Latest Stable Version](https://poser.pugx.org/seoservice2020/laravel-phpmorphy/version)](https://packagist.org/packages/seoservice2020/laravel-phpmorphy)
[![Total Downloads](https://poser.pugx.org/seoservice2020/laravel-phpmorphy/downloads)](https://packagist.org/packages/seoservice2020/laravel-phpmorphy)
[![tests](https://github.com/seoservice2020/laravel-phpmorphy/workflows/tests/badge.svg)](https://github.com/seoservice2020/laravel-phpmorphy/actions)
[![codecov](https://codecov.io/gh/seoservice2020/laravel-phpmorphy/branch/master/graph/badge.svg)](https://codecov.io/gh/seoservice2020/laravel-phpmorphy)
[![License](https://poser.pugx.org/seoservice2020/laravel-phpmorphy/license)](https://packagist.org/packages/seoservice2020/laravel-phpmorphy)

```laravel-phpmorphy``` is a Laravel wrapper for phpMorphy library with PHP7 support.

phpMorphy is a morphological analyzer library for Russian, Ukrainian, English and German languages.

## Installation

Run the following command from your terminal:

```bash
composer require seoservice2020/laravel-phpmorphy
```

Or add this to require section in your `composer.json` file:

```json
{
    "require": {
        "seoservice2020/laravel-phpmorphy": "~2.2"
    }
}
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
    'common_options' => [
        'storage' => phpMorphy::STORAGE_FILE,
        'predict_by_suffix' => true,
        'predict_by_db' => true,
        'graminfo_as_text' => true,
    ],

    'morphies' => [
        [
            // phpMorphy instance name
            // specific morphy can be accessed through Morphy::morphy($name) method
            'name' => SEOService2020\Morphy\Morphy::russianLang,

            // phpMorphy language
            // see Morphy class for available values
            'language' => SEOService2020\Morphy\Morphy::russianLang,

            // phpMorphy options
            // if not specified or null specified, default options will be used
            // to use common options from this config, specify []
            'options' => [],
            
            // dicts directory path
            // if not specified or null specified, default dicts path will be used
            'dicts_path' => null,

            // values are 'storage', 'filesystem'
            // 'storage': dicts will be taken from laravel storage (storage/app folder)
            // 'filesystem': dicts will be taken by specified path as-is
            // must be specified when dicts_path is not null
            'dicts_storage' => 'storage',
        ],
    ],
];
```

## Usage

Wrapper automatically prepares input word for phpMorphy: it applies `trim` to word and converts it to uppercase or lowercase, depending on the dictionary options.

Using the wrapper directly:

``` php
use SEOService2020\Morphy\Morphy;
$morphy = new Morphy(Morphy::englishLang);
echo $morphy->getPseudoRoot('fighty');
```

Or via Laravel Facade:

``` php
use SEOService2020\Morphy\Facade\Morphy as Morphies;
// first parameter is the name of morphy in config
Morphies::getPseudoRoot('ru', 'Бойцовый');

// get morphy and call methods in regular manner
Morphies::morphy('ru')->lemmatize('   бойцовый');  // word will be trimmed

// get all morphies, returns array like ['name' => Morphy]
Morphies::morphies();

// get all morphies with specific locale, returns array like ['name' => Morphy]
Morphies::morphies(Morphy::russianLang);

// you can call phpMorphy static methods as well
Morphies::getDefaultDictsDir();
```

Note:
> You can access morphy properties only directly from morphy object, not facade.

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
