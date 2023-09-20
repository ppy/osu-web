<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Browser;

class ScaffoldDummy
{
    protected $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function getKey()
    {
        return $this->value;
    }

    public function getRouteKey(): string
    {
        return $this->getKey();
    }

    public function forceDelete()
    {
        return true;
    }
}
