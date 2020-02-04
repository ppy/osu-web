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

/**
 * Wrapper around a SearchResponse hit to help make it
 * easier to iterate over a SearchResponse without crazy index nesting.
 */
class Highlight implements Queryable
{
    protected $fields = [];
    protected $numberOfFragments = 5;
    protected $fragmentSize = 100;

    /**
     * @return $this
     */
    public function field(string $name, ?array $options = null)
    {
        if ($options === null) {
            $options = new \stdClass();
        }

        $this->fields[$name] = $options;

        return $this;
    }

    /**
     * Sets the highlight fragment size.
     *
     * The Elasticsearch highlighter will include text beyond the size set if the text is
     * considered within the boundary of the fragment.
     *
     * @return $this
     */
    public function fragmentSize(int $size)
    {
        $this->fragmentSize = $size;

        return $this;
    }

    /**
     * @return $this
     */
    public function numberOfFragments(int $count)
    {
        $this->numberOfFragments = $count;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray(): array
    {
        return [
            'encoder' => 'html',
            'fragment_size' => $this->fragmentSize,
            'fields' => $this->fields,
            'number_of_fragments' => $this->numberOfFragments,
        ];
    }
}
