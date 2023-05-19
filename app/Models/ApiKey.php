<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models;

use App\Traits\Validatable;
use Cache;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $api_key
 * @property string $app_name
 * @property string $app_url
 * @property int $enabled
 * @property int $hit_count
 * @property int $key
 * @property int $miss_count
 * @property int $revoked
 * @property-read User|null $user
 * @property int $user_id
 */
class ApiKey extends Model
{
    use Validatable;

    const MAX_FIELD_LENGTHS = [
        'app_name' => 100,
        'app_url' => 512,
    ];

    public $casts = [
        'revoked' => 'boolean',
    ];
    public $timestamps = false;

    protected $table = 'osu_apikeys';
    protected $primaryKey = 'key';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeAvailable(Builder $query): Builder
    {
        return $query->where('revoked', false);
    }

    public function isValid(): bool
    {
        $this->validationErrors()->reset();

        $this->validateDbFieldLengths();

        foreach (['app_name', 'api_key'] as $field) {
            if (!present($this->$field)) {
                $this->validationErrors()->add($field, 'required');
            }
        }

        if (!filter_var($this->app_url ?? '', FILTER_VALIDATE_URL)) {
            $this->validationErrors()->add('app_url', 'url');
        }

        if (!$this->exists && static::where(['user_id' => $this->user_id])->available()->exists()) {
            $this->validationErrors()->add('base', '.exists');
        }

        return $this->validationErrors()->isEmpty();
    }

    public function save(array $options = [])
    {
        // Prevent multiple isValid check from running simultaneously
        // as it checks for some sort of uniqueness without database
        // constraint.
        $lock = Cache::lock("legacy_api_key_store:{$this->user_id}", 600);

        try {
            $lock->block(5);

            return $this->isValid() && parent::save($options);
        } finally {
            $lock->release();
        }
    }

    public function validationErrorsTranslationPrefix(): string
    {
        return 'legacy_api_key';
    }
}
