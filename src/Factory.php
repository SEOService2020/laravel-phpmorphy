<?php

namespace SEOService2020\Morphy;


class Factory
{
    public static function makeMorphy(array $config, ?array $commonOptions = null): Morphy
    {
        return new Morphy(
            $config['language'],
            ($config['options'] ?? null) === null ?
                null :
                array_replace_recursive($commonOptions ?? [], $config['options'] ?? []),
            $config['dicts_path'] ?? null
        );
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
