<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models;

use App\Libraries\BBCodeForDB;
use App\Libraries\Uploader;
use App\Libraries\UsernameValidation;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Model
{
    protected $casts = ['is_open' => 'bool'];

    private Uploader $header;
    private Uploader $logo;

    public function applications(): HasMany
    {
        return $this->hasMany(TeamApplication::class);
    }

    public function leader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'leader_id');
    }

    public function members(): HasMany
    {
        return $this->hasMany(TeamMember::class);
    }

    public function setHeaderAttribute(?string $value): void
    {
        if ($value === null) {
            $this->header()->delete();
        } else {
            $this->header()->store($value);
        }
    }

    public function setLogoAttribute(?string $value): void
    {
        if ($value === null) {
            $this->logo()->delete();
        } else {
            $this->logo()->store($value);
        }
    }

    public function setDefaultRulesetIdAttribute(?int $value): void
    {
        $this->attributes['default_ruleset_id'] = Beatmap::MODES[Beatmap::modeStr($value) ?? 'osu'];
    }

    public function setUrlAttribute(?string $value): void
    {
        $this->attributes['url'] = $value === null
            ? null
            : (is_http($value)
                ? $value
                : "https://{$value}"
            );
    }

    public function descriptionHtml(): string
    {
        $description = presence($this->description);

        return $description === null
            ? ''
            : bbcode((new BBCodeForDB($description))->generate());
    }

    public function delete()
    {
        $this->header()->delete();
        $this->logo()->delete();

        return $this->getConnection()->transaction(function () {
            $ret = parent::delete();

            if ($ret) {
                $this->members()->delete();
            }

            return $ret;
        });
    }

    public function emptySlots(): int
    {
        $max = $this->maxMembers();
        $current = $this->members->count();

        return max(0, $max - $current);
    }

    public function header(): Uploader
    {
        return $this->header ??= new Uploader(
            'teams/header',
            $this,
            'header_file',
            ['image' => ['maxDimensions' => [1000, 250]]],
        );
    }

    public function isValid(): bool
    {
        $this->validationErrors()->reset();

        $wordFilters = app('chat-filters');
        foreach (['name', 'short_name'] as $field) {
            $value = presence($this->$field);
            if ($value === null) {
                $this->validationErrors()->add($field, 'required');
            } elseif ($this->isDirty($field)) {
                if (!$wordFilters->isClean($value) || !UsernameValidation::allowedName($value)) {
                    $this->validationErrors()->add($field, '.word_not_allowed');
                } elseif (static::whereNot('id', $this->getKey())->where($field, $value)->exists()) {
                    $this->validationErrors()->add($field, '.used');
                }
            }
        }

        if ($this->isDirty('url')) {
            $url = $this->url;
            if ($url !== null && !is_http($url)) {
                $this->validationErrors()->add('url', 'url');
            }
        }

        if ($this->isDirty('ruleset_id')) {
            if (Beatmap::modeStr($this->ruleset_id) === null) {
                $this->validationErrors()->add('ruleset_id', '.unknown_ruleset_id');
            }
        }

        return $this->validationErrors()->isEmpty();
    }

    public function logo(): Uploader
    {
        return $this->logo ??= new Uploader(
            'teams/logo',
            $this,
            'logo_file',
            ['image' => ['maxDimensions' => [512, 256]]],
        );
    }

    public function maxMembers(): int
    {
        $this->loadMissing('members.user');

        return 8 + (4 * $this->members->filter(fn ($member) => $member->user?->osu_subscriber ?? false)->count());
    }

    public function save(array $options = [])
    {
        if (!$this->isValid()) {
            return false;
        }

        return parent::save($options);
    }

    public function validationErrorsTranslationPrefix(): string
    {
        return 'team';
    }
}
