<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Store;

use App\Exceptions\InsufficientStockException;
use Carbon\Carbon;

/**
 * @property bool $allow_multiple
 * @property \Carbon\Carbon|null $available_until
 * @property float $base_shipping
 * @property float|null $cost
 * @property \Carbon\Carbon $created_at
 * @property string|null $custom_class
 * @property \Carbon\Carbon|null $deleted_at
 * @property string|null $description
 * @property int $display_order
 * @property bool $enabled
 * @property string|null $header_description
 * @property string|null $header_image
 * @property string|null $image
 * @property string|null $images_json
 * @property self $masterProduct
 * @property int|null $master_product_id
 * @property int $max_quantity
 * @property string $name
 * @property float $next_shipping
 * @property \Illuminate\Database\Eloquent\Collection $notificationRequests NotificationRequest
 * @property int $product_id
 * @property bool $promoted
 * @property string|null $shopify_id
 * @property int|null $stock
 * @property string|null $type_mappings_json
 * @property \Carbon\Carbon|null $updated_at
 * @property \Illuminate\Database\Eloquent\Collection $variations static
 * @property int|null $weight
 */
class Product extends Model
{
    const BUTTON_DISABLED = [self::SUPPORTER_TAG_NAME, self::USERNAME_CHANGE];
    const REDIRECT_PLACEHOLDER = 'redirect';
    const SUPPORTER_TAG_NAME = 'supporter-tag';
    const USERNAME_CHANGE = 'username-change';

    protected $primaryKey = 'product_id';

    protected $casts = [
        'available_until' => 'datetime',
        'cost' => 'float',
        'base_shipping' => 'float',
        'next_shipping' => 'float',
        'promoted' => 'boolean',
        'enabled' => 'boolean',
        'allow_multiple' => 'boolean',
    ];

    private $images;
    private array|false $types;

    public function masterProduct()
    {
        return $this->belongsTo(static::class, 'master_product_id');
    }

    public function variations()
    {
        return $this->hasMany(static::class, 'master_product_id');
    }

    public function notificationRequests()
    {
        return $this->hasMany(NotificationRequest::class);
    }

    public function isRedirectPlaceholder()
    {
        return $this->custom_class === static::REDIRECT_PLACEHOLDER;
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
        return presence($value) ?? $this->masterProduct?->description;
    }

    public function isAvailable(): bool
    {
        return $this->enabled
            && ($this->available_until === null ? true : $this->available_until->isFuture());
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

    public function scopeAvailable($query)
    {
        return $query
            ->where('enabled', true)
            ->where(function ($q) {
                return $q->whereNull('available_until')->orWhere('available_until', '>=', Carbon::now());
            });
    }

    public function scopeNotAvailable($query)
    {
        return $query->where('available_until', '<', Carbon::now());
    }

    public function scopeListing($query)
    {
        return $query
            ->available()
            ->where('master_product_id', null)
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

    /**
     * Returns the Shopify product variant GraphQL gid for this Product, null if it is not a Shopify item.
     * This is currently implemented as convenience for checking the gid matches the one from the Storefront API.
     *
     * @return string|null
     */
    public function getShopifyVariantGid(): ?string
    {
        return $this->isShopify() ? base64_encode("gid://shopify/ProductVariant/{$this->shopify_id}") : null;
    }

    public function isShopify(): bool
    {
        return $this->shopify_id !== null;
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
        if (
            $this->stock === null
            // stock may have been directly updated to 0.
            // TODO: should count reservations and available stock separately or something.
            || $this->stock <= 0
        ) {
            return;
        }

        $this->incrementInstance('stock', $quantity);
    }

    public function reserve($quantity)
    {
        if ($this->stock === null) {
            return;
        }

        $this->decrementInstance('stock', $quantity);

        // operating under the assumtion that the caller will prevent concurrent updates.
        if ($this->stock < 0) {
            throw new InsufficientStockException();
        }
    }

    /**
     * Generate array of types with corresponding products
     *
     * This is based on `type_mappings_json` column of the model or its parent model.
     * The column contains either these fields:
     * - main_types: TypeName[]
     *   - TypeName is string which all possible values are always listed even if
     *     there's no product which has overlapping remaining types
     *   - it means selecting the non-overlapping product will also change other
     *     types, not just this specific type
     * - products: Record<RelatedProductId, ProductType>
     *   - RelatedProductId: id of related products
     *   - ProductType: Record<TypeName, TypeValue>
     *     - TypeName: name of the type. Used as dropdown option label
     *     - TypeValue: value of the type. Used as dropdown option values
     * An alternative content for the column is:
     * - Record<RelatedProductId, ProductType>
     *   - just the products field of the above
     *
     * The return format is:
     * - Record<TypeName, Record<TypeValue, Product>>
     *
     * The Product should always only have one different TypeValue compared
     * to current Product unless TypeName is listed in main_types.
     */
    public function types(): ?array
    {
        if (!isset($this->types)) {
            $mappings = $this->typeMappings();
            if ($mappings === null) {
                $this->types = false;
            } else {
                // check if its of the newer json format
                if (isset($mappings['main_types'])) {
                    $mainTypes = array_flip($mappings['main_types']);
                    $mappings = $mappings['products'];
                } else {
                    $mainTypes = [];
                }

                $currentMapping = $mappings[$this->getKey()];
                $this->types = [];

                $productById = static::whereKey(array_keys($mappings))->get()->keyBy('product_id');
                $productById[$this->getKey()] = $this;

                foreach ($mappings as $productId => $mapping) {
                    foreach ($mapping as $type => $value) {
                        $this->types[$type] ??= [];
                        if (isset($mainTypes[$type])) {
                            $this->types[$type][$value] ??= $productById[$productId];
                        }

                        $mappingDiff = array_diff_assoc($mapping, $currentMapping);
                        if ((count($mappingDiff) === 0) || (count($mappingDiff) === 1 && isset($mappingDiff[$type]))) {
                            $this->types[$type][$value] = $productById[$productId];
                        }
                    }
                }
            }
        }

        return null_if_false($this->types);
    }

    public function url(): string
    {
        return $this->isRedirectPlaceholder()
            ? $this->description
            : route('store.products.show', $this);
    }
}
