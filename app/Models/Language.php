<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License as published by
 *    the Free Software Foundation, version 3 of the License.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use App\Transformers\LanguageTransformer;

class Language extends Model
{
    protected $table = 'osu_languages';
    protected $primaryKey = 'language_id';
    public $timestamps = false;

    public function newQuery($excludeDeleted = true)
    {
        return parent::newQuery()->orderBy('display_order', 'asc');
    }

    public function listing()
    {
        $fractal = new Manager();
        $data = new Collection(parent::all(), new LanguageTransformer);
        $list = $fractal->createData($data)->toArray()['data'];

        return $list;
    }
}
