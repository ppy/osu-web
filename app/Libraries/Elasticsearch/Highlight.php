<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
