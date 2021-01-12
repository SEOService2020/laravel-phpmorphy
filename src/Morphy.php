<?php

namespace SEOService2020\Morphy;

use InvalidArgumentException;

use phpMorphy;
use phpMorphy_GrammemsProvider_GrammemsProviderInterface;


class Morphy extends phpMorphy
{
    use PreprocessWord;

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

    protected $name;
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
        string $name,
        string $language = self::russianLang,
        ?array $options = null,
        ?string $dictsPath = null
    ) {
        $this->name = $name;
        $this->language = $this->checkedLanguage($language);
        $this->options = $this->checkedOptions($options);
        $this->dictsPath = $dictsPath;

        parent::__construct($this->dictsPath, $this->language, $this->options);
    }

    public function name(): string {
        return $this->name;
    }

    public function findWord($word, $type = self::NORMAL) {
        return parent::findWord(self::preprocessedWord($word, $this), $type);
    }

    public function getBaseForm($word, $type = self::NORMAL) {
        return parent::getBaseForm(self::preprocessedWord($word, $this), $type);
    }

    public function getAllForms($word, $type = self::NORMAL) {
        return parent::getAllForms(self::preprocessedWord($word, $this), $type);
    }

    public function getPseudoRoot($word, $type = self::NORMAL) {
        return parent::getPseudoRoot(self::preprocessedWord($word, $this), $type);
    }

    public function getPartOfSpeech($word, $type = self::NORMAL) {
        return parent::getPartOfSpeech(self::preprocessedWord($word, $this), $type);
    }

    public function getAllFormsWithAncodes($word, $type = self::NORMAL) {
        return parent::getAllFormsWithAncodes(self::preprocessedWord($word, $this), $type);
    }

    public function getAllFormsWithGramInfo($word, $asText = true, $type = self::NORMAL) {
        return parent::getAllFormsWithGramInfo(
            self::preprocessedWord($word, $this), $asText, $type
        );
    }

    public function getAncode($word, $type = self::NORMAL) {
        return parent::getAncode(self::preprocessedWord($word, $this), $type);
    }

    public function getGramInfo($word, $type = self::NORMAL) {
        return parent::getGramInfo(self::preprocessedWord($word, $this), $type);
    }

    public function getGramInfoMergeForms($word, $type = self::NORMAL) {
        return parent::getGramInfoMergeForms(self::preprocessedWord($word, $this), $type);
    }

    public function castFormByAncode(
        $word,
        $ancode,
        $commonAncode = null,
        $returnOnlyWord = false,
        $callback = null,
        $type = self::NORMAL
    ) {
        return parent::castFormByAncode(
            self::preprocessedWord($word, $this),
            self::preprocessedWord($ancode, $this),
            self::preprocessedWord($commonAncode, $this),
            $returnOnlyWord,
            $callback,
            $type
        );
    }

    public function castFormByGramInfo(
        $word,
        $partOfSpeech,
        $grammems,
        $returnOnlyWord = false,
        $callback = null,
        $type = self::NORMAL
    ) {
        return parent::castFormByGramInfo(
            self::preprocessedWord($word, $this),
            self::preprocessedWord($partOfSpeech, $this),
            $grammems,
            $returnOnlyWord,
            $callback,
            $type
        );
    }

    public function castFormByPattern(
        $word,
        $patternWord,
        phpMorphy_GrammemsProvider_GrammemsProviderInterface $grammemsProvider = null,
        $returnOnlyWord = false,
        $callback = null,
        $type = self::NORMAL
    ) {
        return parent::castFormByPattern(
            self::preprocessedWord($word, $this),
            self::preprocessedWord($patternWord, $this),
            $grammemsProvider,
            $returnOnlyWord,
            $callback,
            $type
        );
    }
}
