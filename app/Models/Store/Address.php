<?php

/**
*    Copyright 2015 ppy Pty. Ltd.
*
*    This file is part of osu!web. osu!web is distributed with the hope of
*    attracting more community contributions to the core ecosystem of osu!.
*
*    osu!web is free software: you can redistribute it and/or modify
*    it under the terms of the Affero GNU General Public License as published by
*    the Free Software Foundation, either version 3 of the License, or
*    (at your option) any later version.
*
*    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
*    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*    See the GNU Affero General Public License for more details.
*
*    You should have received a copy of the GNU Affero General Public License
*    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
*
*/

namespace App\Models\Store;

use App\Models\Country;

use Illuminate\Database\Eloquent\Model;

class Address extends Model {

	protected $table = "osu_store.addresses";
	protected $primaryKey = "address_id";
	protected $guarded = array('id', 'user_id');

	protected $casts = [
		"user_id" => "integer",
	];

	public function user()
	{
		return $this->belongsTo('App\Models\User');
	}

	public function country()
	{
		return $this->belongsTo('App\Models\Country', 'country_code');
	}

	public function shippingRate() {
		if ($this->country === null) {
			return 0;
		} else {
			return $this->country->shipping_rate;
		}
	}

	public function countryName() {
		if ($this->country !== null) {
			return $this->country->name;
		}
	}

	public static function sender() {
		return new self([
			"first_name" => "E",
			"last_name" => "Herbert",
			"street" => "Room 304, Build 700 Nishijin 7-7-1",
			"city" => "Sawara",
			"state" => "Fukuoka",
			"zip" => "814-0002",
			"country" => Country::find("JP"),
			"phone" => "+819064201305",
		]);
	}
}
