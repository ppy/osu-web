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

use App\Exceptions\ValidationException;
use App\Libraries\ChangeUsername;
use App\Models\SupporterTag;
use App\Traits\Validatable;
use Exception;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends Model
{
    use SoftDeletes, Validatable;

    protected $primaryKey = 'id';

    protected $casts = [
        'cost' => 'float',
        'extra_data' => 'array',
        'reserved' => 'boolean',
    ];

    // The format for extra_data is:
    // [
    //     'type' => 'custom-extra-info',
    //     ...additional fields
    // ]

    public function scopeHasShipping($query)
    {
        return $query->whereHas('product', function ($q) {
            return $q->hasShipping();
        });
    }

    public function isValid()
    {
        $this->validationErrors()->reset();

        if ($this->quantity < 0) {
            $this->validationErrors()->add('quantity', 'not_negative');
        }

        if ($this->cost < 0) {
            $this->validationErrors()->add('cost', 'not_negative');
        }

        return $this->validationErrors()->isEmpty();
    }

    public function delete()
    {
        if ($this->order->status !== 'incart') {
            throw new Exception("Delete not allowed on Order ({$this->order->getKey()}).");
        }

        parent::delete();
    }

    public function save(array $options = [])
    {
        $skipValidations = $options['skipValidations'] ?? false;
        if (!$skipValidations && !$this->isValid()) {
            // FIXME: Simpler to just throw instead of fixing all the save() calls right now.
            throw new ValidationException($this->validationErrors());
        }

        return parent::save($options);
    }

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

    public function scopeCustomClass($query, $name)
    {
        return $query->whereHas('product', function ($q) use ($name) {
            $q->customClass($name);
        });
    }

    public function refreshCost()
    {
        if ($this->product->cost === null) {
            return;
        }
        $this->cost = $this->product->cost;
    }

    public function getCustomClassInstance()
    {
        // only one for now
        if ($this->product->custom_class === 'username-change') {
            return new ChangeUsername($this->order->user, $this->extra_info, 'paid');
        }
    }

    public function getDisplayName()
    {
        switch ($this->product->custom_class) {
            case 'supporter-tag':
                // FIXME: probably should move out...somewhere
                $duration = (int) $this->extra_data['duration'];
                $text = SupporterTag::getDurationText($duration);

                return trans('store.order.item.display_name.supporter_tag', [
                    'name' => $this->product->name,
                    // test data didn't include username, so ?? ''
                    'username' => $this->extra_data['username'] ?? '',
                    'duration' => $text,
                ]);
            default:
                return $this->product->name.($this->extra_info !== null ? " ({$this->extra_info})" : '');
        }
    }

    public function releaseProduct()
    {
        if ($this->reserved) {
            $this->product->release($this->quantity);
            $this->reserved = false;
            $this->saveOrExplode();
        }
    }

    public function reserveProduct()
    {
        if (!$this->reserved) {
            $this->product->reserve($this->quantity);
            $this->reserved = true;
            $this->saveOrExplode();
        }
    }

    public function validationErrorsTranslationPrefix()
    {
        return 'store/order_item';
    }

    public function validationErrorsKeyBase()
    {
        return 'model_validation/';
    }
}
