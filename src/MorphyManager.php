<?php

namespace SEOService2020\Morphy;

use ReflectionMethod;
use BadMethodCallException;
use InvalidArgumentException;
use phpMorphy;


class MorphyManager
{
    use PreprocessWord;

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
        if ((new ReflectionMethod(phpMorphy::class, $name))->isStatic()) {
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

        $morphy = $this->morphies[$morphyName];
        if (self::needWordPreprocess($name) && !empty($arguments)) {
            $arguments[0] = self::preprocessedWord($arguments[0], $morphy);
        }

        return call_user_func_array([$morphy, $name], $arguments);
    }

    public static function __callStatic($name, $arguments)
    {
        return phpMorphy::$name(...$arguments);
    }
}
