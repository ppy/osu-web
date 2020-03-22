<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
