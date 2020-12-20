<?php

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
