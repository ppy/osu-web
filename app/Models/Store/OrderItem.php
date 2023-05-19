<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Store;

use App\Exceptions\InvariantException;
use App\Exceptions\ValidationException;
use App\Libraries\ChangeUsername;
use App\Models\SupporterTag;
use App\Traits\Validatable;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property float|null $cost
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property ExtraDataBase|null $extra_data
 * @property string|null $extra_info
 * @property int $id
 * @property Order $order
 * @property int $order_id
 * @property Product $product
 * @property int $product_id
 * @property int $quantity
 * @property bool $reserved
 * @property \Carbon\Carbon|null $updated_at
 */
class OrderItem extends Model
{
    use SoftDeletes, Validatable;

    protected $primaryKey = 'id';

    protected $casts = [
        'cost' => 'float',
        'extra_data' => ExtraDataBase::class,
        'reserved' => 'boolean',
    ];

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
        if (!$this->order->isCart()) {
            throw new InvariantException("Delete not allowed on Order ({$this->order->getKey()}).");
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
            return new ChangeUsername($this->order->user, $this->extra_info);
        }
    }

    public function getDisplayName(bool $html = false)
    {
        switch ($this->product->custom_class) {
            case Product::SUPPORTER_TAG_NAME:
                return SupporterTag::getDisplayName($this, $html);
            default:
                return $this->product->name.($this->extra_info !== null ? " ({$this->extra_info})" : '');
        }
    }

    public function getSubtext()
    {
        $extraData = $this->extra_data;
        if ($extraData instanceof ExtraDataSupporterTag && $extraData->message !== null) {
            return trans('store.order.item.subtext.supporter_tag', ['message' => $extraData->message]);
        }

        return null;
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

    public function validationErrorsTranslationPrefix(): string
    {
        return 'store.order_item';
    }

    public function __get($key)
    {
        // TODO: remove this after no more things are queued with old $casts
        $this->casts['extra_data'] = ExtraDataBase::class;

        return parent::__get($key);
    }
}
