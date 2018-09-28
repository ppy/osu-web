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

use App\Models\Country;
use App\Models\User;
use Auth;

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
