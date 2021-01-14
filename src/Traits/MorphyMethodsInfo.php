<?php

namespace SEOService2020\Morphy\Traits;

use ReflectionMethod;

use phpMorphy;


trait MorphyMethodsInfo
{
    public static function isStatic(string $methodName): bool
    {
        return (new ReflectionMethod(phpMorphy::class, $methodName))->isStatic();
    }

    public static function takesWordParameter(string $methodName): bool
    {
        return in_array($methodName, [
            'findWord',
            'lemmatize',
            'getBaseForm',
            'getAllForms',
            'getPseudoRoot',
            'getPartOfSpeech',
            'getAllFormsWithAncodes',
            'getAllFormsWithGramInfo',
            'getAncode',
            'getGramInfo',
            'getGramInfoMergeForms',
            'getAnnotForWord',
            'castFormByAncode',
            'castFormByGramInfo',
            'castFormByPattern',
        ]);
    }
}
