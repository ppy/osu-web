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

namespace App\Models\Store;

use App\Models\Country;
use App\Models\User;
use Auth;

/**
 * @property int $address_id
 * @property string|null $city
 * @property Country $country
 * @property string|null $country_code
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $phone
 * @property string|null $state
 * @property string|null $street
 * @property \Carbon\Carbon|null $updated_at
 * @property User $user
 * @property int|null $user_id
 * @property string|null $zip
 */
class Address extends Model
{
    protected $primaryKey = 'address_id';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_code');
    }

    public function shippingRate()
    {
        if ($this->country === null) {
            return 0;
        } else {
            return $this->country->shipping_rate;
        }
    }

    public function countryName()
    {
        if ($this->country !== null) {
            return $this->country->name;
        }
    }

    public static function sender()
    {
        //todo: move to database
        switch (Auth::user()->user_id) {
            default:
            case 4916903:
                return new self([
                    'first_name' => 'osu!store',
                    'last_name' => '',
                    'street' => 'Room 304, Build 700 Nishijin 7-7-1',
                    'city' => 'Sawara',
                    'state' => 'Fukuoka',
                    'zip' => '814-0002',
                    'country' => Country::find('JP'),
                    'phone' => '+819064201305',
                ]);
            case 2:
                return new self([
                    'first_name' => 'osu!store',
                    'last_name' => '',
                    'street' => 'Nishi-Ooi 4-21-3 Birdie House A',
                    'city' => 'Shinagawa',
                    'state' => 'Tokyo',
                    'zip' => '140-0015',
                    'country' => Country::find('JP'),
                    'phone' => '+818013811430',
                ]);
        }
    }
}
