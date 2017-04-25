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

namespace App\Models;

use App\Traits\MacroableModel;
use Illuminate\Database\Eloquent\Model as BaseModel;

abstract class Model extends BaseModel
{
    use MacroableModel;
    protected $connection = 'mysql';

    public function getMacros()
    {
        $macros = $this->macros ?? [];

        // default macros
        $macros[] = 'orderByField';

        return $macros;
    }

    public function macroOrderByField()
    {
        return function ($query, $field, $ids) {
            $bind = implode(',', array_fill(0, count($ids), '?'));
            $string = "FIELD({$field}, {$bind})";
            $values = array_map('strval', $ids);

            return $query
                ->orderByRaw($string, $values);
        };
    }
}
