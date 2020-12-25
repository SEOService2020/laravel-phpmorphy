<?php

namespace SEOService2020\Morphy;

use InvalidArgumentException;

use Illuminate\Support\Facades\Storage;


class Factory
{
    public static function makeMorphy(array $config, ?array $commonOptions = null): Morphy
    {
        if (!array_key_exists('language', $config)) {
            throw new InvalidArgumentException(
                "language must be specified for morphy {$config['name']}"
            );
        }

        if (!array_key_exists('dicts_storage', $config)) {
            throw new InvalidArgumentException(
                "dicts_storage must be specified for morphy {$config['name']}"
            );
        }

        $dictsStorage = $config['dicts_storage'];
        if (!in_array($dictsStorage, ['storage', 'filesystem'])) {
            throw new InvalidArgumentException(
                "Wrong dicts_storage specified for morphy {$config['name']}: $dictsStorage"
            );
        }

        $options = $config['options'] ?? null;
        $options = $options === null ?:
            array_replace_recursive($commonOptions ?? [], $options);

        $dictsPath = $config['dicts_path'] ?? null;
        $dictsPath = ($dictsPath === null || $dictsStorage !== 'storage') ?:
            Storage::path($dictsPath);

        return new Morphy($config['language'], $options, $dictsPath);
    }

    public static function fromArray(array $configs, ?array $commonOptions = null): array
    {
        $morphies = [];
        foreach ($configs as $config) {
            $morphies[$config['name']] = self::makeMorphy($config, $commonOptions);
        }
        return $morphies;
    }
}
