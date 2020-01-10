<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

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
