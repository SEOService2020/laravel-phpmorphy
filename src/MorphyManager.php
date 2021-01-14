<?php

namespace SEOService2020\Morphy;

use BadMethodCallException;
use InvalidArgumentException;

use SEOService2020\Morphy\Traits\MorphyMethodsInfo;
use phpMorphy;


class MorphyManager
{
    use MorphyMethodsInfo;

    protected $morphies;

    public function __construct(array $morphies)
    {
        $this->morphies = $morphies;
    }

    public function morphies($language = null): array
    {
        if ($language === null) {
            return $this->morphies;
        }

        return array_filter(
            $this->morphies,
            function ($morphy) use ($language) {
                return $morphy->getLocale() == $language;
            }
        );
    }

    public function morphy(string $name): ?Morphy
    {
        return isset($this->morphies[$name]) ? $this->morphies[$name] : null;
    }

    public function __call($name, $arguments)
    {
        if (MorphyMethodsInfo::isStatic($name)) {
            return self::__callStatic($name, $arguments);
        }

        if (count($arguments) < 1) {
            throw new BadMethodCallException(
                "Too few arguments provided: at least morphy name expected"
            );
        }

        $morphyName = array_shift($arguments);
        if (!array_key_exists($morphyName, $this->morphies)) {
            throw new InvalidArgumentException("Unknown morphy: $morphyName");
        }

        return call_user_func_array([$this->morphies[$morphyName], $name], $arguments);
    }

    public static function __callStatic($name, $arguments)
    {
        return phpMorphy::$name(...$arguments);
    }
}
