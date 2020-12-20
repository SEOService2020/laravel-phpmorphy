<?php

namespace SEOService2020\Morphy;

use InvalidArgumentException;
use phpMorphy;


class Morphy extends phpMorphy
{
    public const russianLang = 'ru_RU';
    public const englishLang = 'en_EN';
    public const ukrainianLang = 'uk_UA';
    public const germanLang = 'de_DE';

    protected static $dictionaries = [
        self::russianLang,
        self::englishLang,
        self::ukrainianLang,
        self::germanLang,
    ];

    protected $language;
    protected $options;
    protected $dictsPath;

    protected function checkedLanguage(string $language): string
    {
        if (!in_array($language, self::$dictionaries)) {
            throw new InvalidArgumentException("Unsupported language: $language");
        }

        return $language;
    }

    protected function checkedOptions(?array $options): array
    {
        $options = $options ?? [];

        if (!array_key_exists('storage', $options)) {
            $options['storage'] = phpMorphy::STORAGE_FILE;
        }

        return $options;
    }

    public function __construct(
        string $language = self::russianLang,
        ?array $options = null,
        ?string $dictsPath = null
    ) {
        $this->language = $this->checkedLanguage($language);
        $this->options = $this->checkedOptions($options);
        $this->dictsPath = $dictsPath;

        parent::__construct($this->dictsPath, $this->language, $this->options);
    }

    public function morphy(): self
    {
        return $this;
    }

    public function withLanguage(string $language): self
    {
        return new self($language, $this->options, $this->dictsPath);
    }

    public function withOptions(array $options): self
    {
        return new self($this->language, $options, $this->dictsPath);
    }

    public function withDicts(?string $dictsPath = null): self
    {
        return new self($this->language, $this->options, $dictsPath);
    }
}
