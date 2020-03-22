<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Elasticsearch;

class Sort implements Queryable
{
    public $extras;
    public $field;
    public $order;

    public function __construct(?string $field = null, ?string $order = null, array $extras = [])
    {
        $this->field = $field;
        $this->order = $order;
        $this->extras = $extras;
    }

    public function isBlank()
    {
        return $this->field === null;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray(): array
    {
        if ($this->field === null) {
            return [];
        }

        if ($this->order === null) {
            return [$this->field];
        }

        $options = array_merge(['order' => $this->order], $this->extras);

        return [$this->field => $options];
    }
}
