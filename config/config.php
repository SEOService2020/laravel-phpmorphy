<?php

return [
    'common_options' => [
        'storage' => phpMorphy::STORAGE_FILE,
		'predict_by_suffix' => true,
		'predict_by_db' => true,
		'graminfo_as_text' => true,
    ],

    'morphies' => [
        // order determines search predecence when facade called directly
        [
            // by this name specific morphy can be accessed thorough Morphy::morphy method
            'name' => 'ru',
            'language' => SEOService2020\Morphy\Morphy::russianLang,
            // if [] specified, default options will be used
            // to use common options, specify null
            'options' => [],
            // when null specified, default morphy dicts path will be used
            'dicts_path' => null,
        ],
    ],
];
