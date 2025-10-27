<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Support;

use Illuminate\Database\Eloquent\Collection;

class CollectionWithInjectedSelf extends Collection
{
    public function __construct($items = [])
    {
        parent::__construct($items);

        foreach ($this->items as $item) {
            static::injectSelf($item);
        }
    }

    #[\Override]
    public function add($item)
    {
        return parent::add(static::injectSelf($item));
    }

    #[\Override]
    public function offsetSet($key, $value): void
    {
        parent::offsetSet($key, static::injectSelf($value));
    }

    #[\Override]
    public function push(...$values)
    {
        foreach ($values as $value) {
            $this->items[] = static::injectSelf($value);
        }
    }

    protected function injectSelf(mixed $value): mixed
    {
        $value->collection = $this;

        return $value;
    }
}
