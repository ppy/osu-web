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

use App\Exceptions\InsufficientStockException;

class Product extends Model
{
    protected $primaryKey = 'product_id';

    protected $casts = [
        'cost' => 'float',
        'base_shipping' => 'float',
        'next_shipping' => 'float',
        'promoted' => 'boolean',
        'enabled' => 'boolean',
        'allow_multiple' => 'boolean',
    ];

    private $images;
    private $types;

    public function masterProduct()
    {
        return $this->belongsTo(self::class, 'master_product_id', 'product_id');
    }

    public function variations()
    {
        return $this->hasMany(static::class, 'master_product_id', 'product_id');
    }

    public function category()
    {
        return $this->hasOne('Category');
    }

    public function notificationRequests()
    {
        return $this->hasMany(NotificationRequest::class, 'product_id');
    }

    public function inStock($quantity = 1, $includeVariations = false)
    {
        $inStock = $this->stock === null || $this->stock >= $quantity;

        if ($inStock === false && $includeVariations === true) {
            $inStock = ($this->masterProduct ?? $this)
                ->variations
                ->contains(function ($variation) use ($quantity) {
                    return $variation->inStock($quantity);
                });
        }

        return $inStock;
    }

    public function getHeaderImageAttribute($value)
    {
        if ($this->masterProduct) {
            return $this->masterProduct->header_image;
        } else {
            return $value;
        }
    }

    public function getHeaderDescriptionAttribute($value)
    {
        if ($this->masterProduct) {
            return $this->masterProduct->header_description;
        } else {
            return $value;
        }
    }

    public function getDescriptionAttribute($value)
    {
        if ($this->masterProduct) {
            return $this->masterProduct->description;
        } else {
            return $value;
        }
    }

    public function typeMappings()
    {
        if ($this->masterProduct) {
            return $this->masterProduct->typeMappings();
        } else {
            return json_decode($this->type_mappings_json, true);
        }
    }

    public function images()
    {
        if (!$this->images_json && $this->masterProduct) {
            return $this->masterProduct->images();
        } else {
            if (!$this->images && $this->images_json) {
                $this->images = json_decode($this->images_json, true);
            }

            return $this->images ?? [];
        }
    }

    public function requiresShipping()
    {
        return $this->weight !== null;
    }

    public function scopeLatest($query)
    {
        return $query
            ->where('master_product_id', null)
            ->where('enabled', true)
            ->with('masterProduct')
            ->with('variations')
            ->orderBy('promoted', 'desc')
            ->orderBy('display_order', 'desc');
    }

    public function scopeCustomClass($query, $name)
    {
        return $query
            ->where('custom_class', $name);
    }

    public function scopeEnabled($query)
    {
        return $query->where('enabled', true);
    }

    public function scopeHasShipping($query)
    {
        return $query->whereNotNull('weight');
    }

    public function productsInRange()
    {
        if (!($mappings = $this->typeMappings())) {
            return [];
        }

        return self::whereIn('product_id', array_keys($mappings))->get();
    }

    public function release($quantity)
    {
        if ($this->stock === null) {
            return true;
        }

        $this->increment('stock', $quantity);
    }

    public function reserve($quantity)
    {
        if ($this->stock === null) {
            return true;
        }

        $this->decrement('stock', $quantity);

        // operating under the assumtion that the caller will prevent concurrent updates.
        if ($this->stock < 0) {
            throw new InsufficientStockException();
        }
    }

    public function types()
    {
        $mappings = $this->typeMappings();
        if ($mappings === null) {
            return;
        }

        if ($this->types !== null) {
            return $this->types;
        }

        $currentMapping = $mappings[strval($this->product_id)];
        $this->types = [];

        foreach ($mappings as $product_id => $mapping) {
            foreach ($mapping as $type => $value) {
                if (!isset($this->types[$type])) {
                    $this->types[$type] = [];
                }
                $mappingDiff = array_diff_assoc($mapping, $currentMapping);
                if ((count($mappingDiff) === 0) || (count($mappingDiff) === 1 && isset($mappingDiff[$type]))) {
                    $this->types[$type][$value] = intval($product_id);
                }
            }
        }

        return $this->types;
    }
}
