<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

/**
 * This is a port of HttpAcceptLanguage::Parser from the http_accept_language gem
 * https://github.com/iain/http_accept_language/blob/v2.1.1/lib/http_accept_language/parser.rb.
 */

namespace App\Libraries\AcceptHttpLanguage;

use InvalidArgumentException;

class Parser
{
    /** @var string */
    public $header;

    /** @var array */
    private $userPreferredLanguages;

    public function __construct(?string $header = null)
    {
        $this->header = $header;
    }

    /**
     * Returns a sorted array based on user preference in HTTP_ACCEPT_LANGUAGE.
     * Browsers send this HTTP header, so don't think this is holy.
     *
     * Example:
     *
     * request.userPreferredLanguages
     * $ => [ 'nl-NL', 'nl-BE', 'nl', 'en-US', 'en' ]
     */
    public function userPreferredLanguages()
    {
        if ($this->userPreferredLanguages === null) {
            try {
                $this->userPreferredLanguages = $this->parseHeader();
            } catch (InvalidArgumentException $_e) {
                $this->userPreferredLanguages = [];
            }
        }

        return $this->userPreferredLanguages;
    }

    public function setUserPreferredLanguages(array $languages)
    {
        $this->userPreferredLanguages = $languages;
    }

    /**
     * Finds the locale specifically requested by the browser.
     *
     * Example:
     *
     *   request.preferred_language_from I18n.available_locales
     *   $ => 'nl'
     */
    public function preferredLanguageFrom(array $array)
    {
        return array_values(array_intersect($this->userPreferredLanguages(), $array))[0] ?? null;
    }

    /**
     * Returns the first of the userPreferredLanguages that is compatible
     * with the available locales. Ignores region.
     *
     * Example:
     *
     *   request.compatibleLanguageFrom I18n.available_locales
     */
    public function compatibleLanguageFrom(array $availableLanguages)
    {
        $compatible = array_map(function ($preferred) use ($availableLanguages) {
            // en-US
            $preferred = strtolower($preferred);
            $preferredLanguage = explode('-', $preferred, 2)[0];

            foreach ($availableLanguages as $available) {
                if ($preferred === strtolower($available) || $preferredLanguage === explode('-', $available, 2)[0]) {
                    return $available;
                }
            }
        }, $this->userPreferredLanguages());

        return array_values(array_filter($compatible))[0] ?? null; // .compact.first
    }

    /**
     * Returns a supplied list of available locals without any extra application info
     * that may be attached to the locale for storage in the application.
     *
     * Example:
     * [ja_JP-x1, en-US-x4, en_UK-x5, fr-FR-x3] => [ja-JP, en-US, en-UK, fr-FR]
     */
    public function sanitizeAvailableLocales(array $availableLanguages)
    {
        return array_map(function ($available) {
            return implode('-', array_filter(preg_split('/[_-]/', $available), function ($part) {
                return !starts_with($part, 'x');
            }));
        }, $availableLanguages);
    }

    /**
     * Returns the first of the user preferred languages that is
     * also found in available languages.  Finds best fit by matching on
     * primary language first and secondarily on region.  If no matching region is
     * found, return the first language in the group matching that primary language.
     *
     * Example:
     *
     *   request.language_region_compatible($availableLanguages)
     */
    public function languageRegionCompatibleFrom($availableLanguages)
    {
        $availableLanguages = $this->sanitizeAvailableLocales($availableLanguages);
        $array = array_map(function ($preferred) use ($availableLanguages) {
            // en-US
            $preferred = strtolower($preferred);
            $preferredLanguage = explode('-', $preferred, 2)[0] ?? null;

            $langGroup = array_values(array_filter($availableLanguages, function ($available) use ($preferredLanguage) {
                // en
                return $preferredLanguage === explode('-', strtolower($available), 2)[0] ?? null;
            }));

            foreach ($langGroup as $lang) {
                if (strtolower($lang) === $preferred) {
                    $result = $lang;
                    break;
                }
            }

            return $result ?? ($langGroup[0] ?? null);
        }, $this->userPreferredLanguages());

        return array_values(array_filter($array))[0] ?? null; // .compact.first
    }

    private function parseHeader()
    {
        $header = preg_replace('/\s+/', '', $this->header);
        $header = explode(',', $header);
        $mappings = array_map(function ($language) {
            $exploded = explode(';q=', $language);
            $locale = $exploded[0];
            $quality = (float) ($exploded[1] ?? 1.0);
            if (!preg_match('/^[a-z\-0-9]+|\*$/i', $locale)) {
                throw new InvalidArgumentException('Not correctly formatted');
            }

            $locale = preg_replace_callback('/-[a-z0-9]+$/i', function ($match) {
                return strtoupper($match[0]);
            }, $locale); // Uppercase territory
            if ($locale === '*') {
                $locale = null; // Ignore wildcards
            }

            return [$locale, $quality];
        }, $header);

        usort($mappings, function ($left, $right) {
            return $right[1] <=> $left[1];
        });

        return array_filter(array_map(function ($mapping) {
            return $mapping[0];
        }, $mappings));
    }
}
