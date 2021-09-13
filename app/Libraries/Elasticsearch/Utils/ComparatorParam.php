<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\Elasticsearch\Utils;

class ComparatorParam
{
    // operation => toleranceMultiplier
    const OPERATIONS = [
        'gt' => -1,
        'gte' => -1,
        'lt' => 1,
        'lte' => 1,
    ];

    public static function make($rawParam, string $type, int|float $tolerance = 0): ?array
    {
        if (!is_array($rawParam)) {
            return null;
        }

        $ret = [
            null,
            null,
        ];

        foreach (static::OPERATIONS as $op => $toleranceMultiplier) {
            if (isset($rawParam[$op])) {
                $value = get_param_value($rawParam[$op], $type);

                if ($value !== null) {
                    if (is_array($value)) {
                        $scale = $value['scale'];
                        $value = $value['value'];
                    } else {
                        $scale = 1;
                    }

                    $ret[0] ??= [];
                    $ret[0][$op] = $value + $toleranceMultiplier * $tolerance * $scale;

                    $ret[1] ??= [];
                    $ret[1][$op] = $rawParam[$op];
                }
            }
        }

        return $ret;
    }
}
