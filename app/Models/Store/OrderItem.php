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

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model {
	protected $table = "osu_store.order_items";
	protected $primaryKey = "id";

	protected $casts = [
		"quantity" => "integer",
	];

	public function subtotal() {
		return $this->cost * $this->quantity;
	}

	public function order()
	{
		return $this->belongsTo('App\Models\Store\Order');
	}

	public function product()
	{
		return $this->belongsTo('App\Models\Store\Product');
	}

	public function refreshCost() {
		if ($this->product->cost === null) return;
		$this->cost = $this->product->cost;
	}

	public function getDisplayName() {
		return $this->product->name . ($this->extra_info !== null ? " ({$this->extra_info})" : "");
	}
}
