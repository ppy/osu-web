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
    public static function parseHeader(?string $header): array
    {
        if (!present($header)) {
            return [];
        }

        $header = preg_replace('/\s+/', '', $header);
        $header = explode(',', $header);
        try {
            $mappings = array_map(function ($language) {
                $exploded = explode(';q=', $language);
                $locale = strtolower($exploded[0]);
                $quality = (float) ($exploded[1] ?? 1.0);
                if (!preg_match('/^[a-z\-0-9]+|\*$/i', $locale)) {
                    throw new InvalidArgumentException('Not correctly formatted');
                }

                if ($locale === '*') {
                    $locale = null; // Ignore wildcards
                }

                return [$locale, $quality];
            }, $header);
        } catch (InvalidArgumentException $_e) {
            return [];
        }

        usort($mappings, function ($left, $right) {
            return $right[1] <=> $left[1];
        });

        return array_reject_null(array_map(fn ($mapping) => $mapping[0], $mappings));
    }

    private array $availableLanguages;

    public function __construct(?array $availableLanguages = null)
    {
        $this->availableLanguages = $availableLanguages ?? config('app.available_locales');
    }

    /**
     * Returns the first of the user preferred languages that is
     * also found in available languages.  Finds best fit by matching on
     * primary language first and secondarily on region.  If no matching region is
     * found, return the first language in the group matching that primary language.
     *
     * Example:
     *
     *   request.language_region_compatible($header)
     */
    public function languageRegionCompatibleFor(?string $header): ?string
    {
        foreach (static::parseHeader($header) as $preferred) {
            $preferredLanguage = explode('-', $preferred, 2)[0] ?? null;

            $langGroup = array_values(array_filter(
                $this->availableLanguages,
                // en
                fn ($available) => $preferredLanguage === explode('-', $available, 2)[0] ?? null,
            ));

            foreach ($langGroup as $lang) {
                if ($lang === $preferred) {
                    return $lang;
                }
            }

            if (isset($langGroup[0])) {
                return $langGroup[0];
            }
        }

        return null;
    }
}
