<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries;

class LocaleMeta
{
    const MAPPINGS = [
        'ar' => [
            'flag' => 'SA',
            'name' => 'اَلْعَرَبِيَّةُ‎',
        ],
        'be' => [
            'flag' => 'BY',
            'name' => 'беларуская мова',
        ],
        'bg' => [
            'flag' => 'BG',
            'name' => 'български',
        ],
        'ca' => [
            'flag' => 'AD', // ES-CA in crowdin
            'name' => 'català',
        ],
        'cs' => [
            'flag' => 'CZ',
            'name' => 'česky',
        ],
        'da' => [
            'flag' => 'DK',
            'name' => 'dansk',
        ],
        'de' => [
            'flag' => 'DE',
            'name' => 'Deutsch',
        ],
        'el' => [
            'flag' => 'GR',
            'name' => 'ελληνικά',
        ],
        'en' => [
            'flag' => 'GB',
            'moment' => 'en-gb',
            'name' => 'English',
        ],
        'es' => [
            'flag' => 'ES',
            'name' => 'español',
        ],
        'fi' => [
            'flag' => 'FI',
            'name' => 'suomi',
        ],
        'fil' => [
            'flag' => 'PH',
            'name' => 'wikang Filipino',
        ],
        'fr' => [
            'flag' => 'FR',
            'name' => 'français',
        ],
        'he' => [
            'flag' => 'IL',
            'name' => 'עִבְרִית‎',
        ],
        'hu' => [
            'flag' => 'HU',
            'name' => 'magyar',
        ],
        'id' => [
            'flag' => 'ID',
            'name' => 'bahasa Indonesia',
        ],
        'it' => [
            'flag' => 'IT',
            'name' => 'italiano',
        ],
        'ja' => [
            'flag' => 'JP',
            'name' => '日本語',
        ],
        'ko' => [
            'flag' => 'KR',
            'name' => '한국어',
        ],
        'lt' => [
            'flag' => 'LT',
            'name' => 'lietuvių kalba',
        ],
        'nl' => [
            'flag' => 'NL',
            'name' => 'Nederlands',
        ],
        'no' => [
            'flag' => 'NO',
            'moment' => 'nb',
            'name' => 'norsk',
        ],
        'pl' => [
            'flag' => 'PL',
            'name' => 'polski',
        ],
        'pt' => [
            'flag' => 'PT',
            'name' => 'português',
        ],
        'pt-br' => [
            'flag' => 'BR',
            'html' => 'pt-BR',
            'laravelPlural' => 'pt_BR',
            'name' => 'português brasileiro',
        ],
        'ro' => [
            'flag' => 'RO',
            'name' => 'română',
        ],
        'ru' => [
            'flag' => 'RU',
            'name' => 'русский',
        ],
        'sk' => [
            'flag' => 'SK',
            'name' => 'slovenčina',
        ],
        'sl' => [
            'flag' => 'SI',
            'name' => 'slovenščina',
        ],
        'sr' => [
            'flag' => 'RS',
            'moment' => 'sr-cyrl',
            'name' => 'српски',
        ],
        'sv' => [
            'flag' => 'SE',
            'name' => 'svenska',
        ],
        'th' => [
            'flag' => 'TH',
            'name' => 'ไทย',
        ],
        'tl' => [
            'flag' => 'PH',
            'name' => 'Tagalog',
        ],
        'tr' => [
            'flag' => 'TR',
            'name' => 'Türkçe',
        ],
        'uk' => [
            'flag' => 'UA',
            'name' => 'українська мова',
        ],
        'vi' => [
            'flag' => 'VN',
            'name' => 'tiếng Việt',
        ],
        'zh' => [
            'flag' => 'CN',
            'moment' => 'zh-cn',
            'name' => '简体中文',
        ],
        'zh-hk' => [
            'flag' => 'HK',
            'html' => 'zh-HK',
            'laravelPlural' => 'zh_HK',
            'name' => '繁體中文（香港）',
        ],
        'zh-tw' => [
            'flag' => 'TW',
            'html' => 'zh-TW',
            'laravelPlural' => 'zh_TW',
            'name' => '繁體中文（台灣）',
        ],
    ];

    private array $data;
    private string $locale;

    /**
     * Return cached instance of specified locale.
     *
     * Only valid locale listed as key in MAPPINGS constant is accepted.
     * Passing in invalid locale will result in error.
     */
    public static function find(string $locale): self
    {
        static $instances = [];

        return $instances[$locale] ??= new static($locale);
    }

    public static function isValid(?string $locale): bool
    {
        return isset(static::MAPPINGS[$locale]);
    }

    public static function sanitizeCode(?string $locale): ?string
    {
        if ($locale === null) {
            return null;
        }

        $ret = strtolower($locale);

        return static::isValid($ret) ? $ret : null;
    }

    public function __construct($locale)
    {
        $this->locale = $locale;
        $this->data = static::MAPPINGS[$locale];
    }

    public function flag(): string
    {
        return $this->data['flag'];
    }

    public function html(): string
    {
        return $this->data['html'] ?? $this->locale;
    }

    public function laravelPlural(): string
    {
        return $this->data['laravelPlural'] ?? $this->locale;
    }

    public function locale(): string
    {
        return $this->locale;
    }

    public function moment(): string
    {
        return $this->data['moment'] ?? $this->locale;
    }

    public function name(): string
    {
        return $this->data['name'];
    }
}
