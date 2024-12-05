<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models;

use App\Libraries\BBCodeForDB;
use App\Libraries\Uploader;
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

    public function descriptionHtml(): string
    {
        $description = presence($this->description);

        return $description === null
            ? ''
            : bbcode((new BBCodeForDB($description))->generate());
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

    public function logo(): Uploader
    {
        return $this->logo ??= new Uploader(
            'teams/logo',
            $this,
            'logo_file',
            ['image' => ['maxDimensions' => [256, 128]]],
        );
    }
}
