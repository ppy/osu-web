<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Search;

use App\Models\Beatmapset;

class BeatmapsetQueryParser
{
    public static function parse(?string $query): array
    {
        $options = [];

        // reference: https://github.com/ppy/osu/blob/f6baf49ad6b42c662a729ad05e18bd99bc48b4c7/osu.Game/Screens/Select/FilterQueryParser.cs
        $keywords = preg_replace_callback('#\b(?<key>\w+)(?<op>(:|=|(>|<)(:|=)?))(?<value>(".*")|(\S*))#i', function ($m) use (&$options) {
            $key = strtolower($m['key']);
            $op = str_replace(':', '=', $m['op']);
            switch ($key) {
                case 'stars':
                    $option = static::makeFloatRangeOption($op, $m['value'], 0.01 / 2);
                    break;
                case 'ar':
                    $option = static::makeFloatRangeOption($op, $m['value'], 0.1 / 2);
                    break;
                case 'dr':
                case 'hp':
                    $key = 'dr';
                    $option = static::makeFloatRangeOption($op, $m['value'], 0.1 / 2);
                    break;
                case 'cs':
                    $option = static::makeFloatRangeOption($op, $m['value'], 0.1 / 2);
                    break;
                case 'bpm':
                    $option = static::makeFloatRangeOption($op, $m['value'], 0.01 / 2);
                    break;
                case 'length':
                    $parsed = static::parseLength($m['value']);
                    $option = static::makeFloatRangeOption($op, $parsed['value'], $parsed['scale'] / 2.0);
                    break;
                case 'keys':
                    $option = static::makeIntRangeOption($op, $m['value']);
                    break;
                case 'divisor':
                    $option = static::makeIntRangeOption($op, $m['value']);
                    break;
                case 'status':
                    $option = static::makeIntRangeOption($op, Beatmapset::STATES[$m['value']] ?? null);
                    break;
                case 'creator':
                    $option = static::makeTextOption($op, $m['value']);
                    break;
                case 'artist':
                    $option = static::makeTextOption($op, $m['value']);
                    break;
            }

            if (isset($option)) {
                if (is_array($option)) {
                    $options[$key] = array_merge($options[$key] ?? [], $option);
                } else {
                    $options[$key] = $option;
                }

                return '';
            }

            return $m[0];
        }, $query ?? '');

        return [
            'keywords' => presence(trim($keywords)),
            'options' => $options,
        ];
    }

    private static function makeFloatRangeOption($operator, $value, $tolerance)
    {
        // Some locales have `,` as decimal separator.
        // Note that thousand separator is not (yet?) supported.
        $value = str_replace(',', '.', $value);

        if (!is_numeric($value)) {
            return;
        }

        $value = get_float($value);

        switch ($operator) {
            case '=':
                return [
                    'gte' => $value - $tolerance,
                    'lte' => $value + $tolerance,
                ];
            case '<':
                return [
                    'lte' => $value - $tolerance,
                ];
            case '<=':
                return [
                    'lte' => $value + $tolerance,
                ];
            case '>':
                return [
                    'gte' => $value + $tolerance,
                ];
            case '>=':
                return [
                    'gte' => $value - $tolerance,
                ];
        }
    }

    private static function makeIntRangeOption($operator, $value)
    {
        if (!is_numeric($value)) {
            return;
        }

        $value = get_int($value);

        switch ($operator) {
            case '=':
                return [
                    'gte' => $value,
                    'lte' => $value,
                ];
            case '<':
                return [
                    'lt' => $value,
                ];
            case '<=':
                return [
                    'lte' => $value,
                ];
            case '>':
                return [
                    'gt' => $value,
                ];
            case '>=':
                return [
                    'gte' => $value,
                ];
        }
    }

    private static function makeTextOption($operator, $value)
    {
        if ($operator === '=') {
            return presence(trim($value, '"'));
        }
    }

    private static function parseLength($input)
    {
        static $scales = [
            'ms' => 0.001,
            's' => 1,
            'm' => 60,
            'h' => 3600,
        ];

        $value = get_float($input);

        if ($value !== null) {
            $scale = $scales[substr($input, -2)] ?? $scales[substr($input, -1)] ?? 1;
            $value *= $scale;
        }

        return [
            'value' => $value,
            'scale' => $scale ?? null,
        ];
    }
}
