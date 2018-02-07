<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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

class Query
{
    protected $filters = [];
    protected $musts = [];
    protected $mustNots = [];
    protected $shoulds = [];
    protected $minimum = null;

    /**
     * @return $this
     */
    public function filter(array $clause)
    {
        $this->filters[] = $clause;

        return $this;
    }

    /**
     * @return $this
     */
    public function must(array $clause)
    {
        $this->musts[] = $clause;

        return $this;
    }

    /**
     * @return $this
     */
    public function mustNot(array $clause)
    {
        $this->mustNots[] = $clause;

        return $this;
    }

    /**
     * @return $this
     */
    public function should(array $clause)
    {
        $this->shoulds[] = $clause;

        return $this;
    }

    /**
     * minimum_should_match.
     *
     * @return $this
     */
    public function shouldMatch(?int $count)
    {
        $this->minimum = $count;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray() : array
    {
        $bool = [
            'bool' => [
                'should' => $this->shoulds,
                'must' => $this->musts,
                'must_not' => $this->mustNots,
                'filter' => $this->filters,
            ],
        ];

        if ($this->minimum !== null) {
            $bool['bool']['minimum_should_match'] = $this->minimum;
        }

        return $bool;
    }
}
