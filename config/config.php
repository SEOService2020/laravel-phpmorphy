<?php

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
