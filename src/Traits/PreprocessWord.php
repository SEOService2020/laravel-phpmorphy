<?php

namespace SEOService2020\Morphy\Traits;

use Illuminate\Support\Str;


trait PreprocessWord
{
    protected function preprocessedWord(?string $word): ?string
    {
        if ($word === null) {
            return null;
        }

        return $this->isInUpperCase() ? Str::upper(trim($word)) : Str::lower(trim($word));
    }
}
