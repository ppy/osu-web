<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Traits;

trait Memoizes
{
    private static $memoizedStatic = [];

    private $memoized = [];

    protected static function memoizeStatic(string $key, callable $function)
    {
        $key = static::class.'-'.$key;

        if (!array_key_exists($key, static::$memoizedStatic)) {
            static::$memoizedStatic[$key] = $function();
        }

        return static::$memoizedStatic[$key];
    }

    protected function memoize(string $key, callable $function)
    {
        if (!array_key_exists($key, $this->memoized)) {
            $this->memoized[$key] = $function();
        }

        return $this->memoized[$key];
    }

    protected function resetMemoized(): void
    {
        $this->memoized = [];
    }
}
