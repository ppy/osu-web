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

class OrderItem extends Model
{
    protected $primaryKey = 'id';

    protected $casts = [
        'extra_data' => 'array',
    ];
    // The format for extra_data is:
    // [
    //     'type' => 'custom-extra-info',
    //     ...additional fields
    // ]

    public function subtotal()
    {
        return $this->cost * $this->quantity;
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function refreshCost()
    {
        if ($this->product->cost === null) {
            return;
        }
        $this->cost = $this->product->cost;
    }

    public function getDisplayName()
    {
        switch ($this->product->custom_class) {
            case 'supporter-tag':
                // FIXME: probably should move out...somewhere
                $duration = (int) $this->extra_data['duration'];
                $years = floor($duration / 12);
                $months = $duration % 12;
                $yearsText = trans_choice('supporter_tag.duration.years', $years, ['length' => $years]);
                $monthsText = trans_choice('supporter_tag.duration.months', $months, ['length' => $months]);
                $text = implode(', ', array_filter([$yearsText, $monthsText]));

                return __('store.order.item.display_name.supporter_tag', [
                    'name' => $this->product->name,
                    'username' => $this->extra_data['username'],
                    'duration' => $text,
                ]);
            default:
                return $this->product->name.($this->extra_info !== null ? " ({$this->extra_info})" : '');
        }
    }
}
