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
            // by this name specific morphy can be accessed through Morphy::morphy method
            // it may be any string
            'name' => SEOService2020\Morphy\Morphy::russianLang,
            'language' => SEOService2020\Morphy\Morphy::russianLang,
            // if no options key or null value specified, default options will be used
            // to use common options from this config, specify []
            'options' => [],
            // when null specified, default morphy dicts path will be used
            'dicts_path' => null,
        ],
    ],
];
