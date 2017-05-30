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

namespace App\Models\Store;

class ItemFormParams
{
    private $params;

    public function __construct(array $item_form)
    {
        $this->params = $item_form;
    }

    public function id()
    {
        return array_get($this->params, 'id');
    }

    public function quantity()
    {
        return array_get($this->params, 'quantity');
    }

    public function product()
    {
        return Product::find(array_get($this->params, 'product_id'));
    }

    public function extraInfo()
    {
        return array_get($this->params, 'extra_info');
    }

    public function extraData()
    {
        return array_get($this->params, 'extra_data');
    }

    public function cost()
    {
        return intval(array_get($this->params, 'cost'));
    }
}
