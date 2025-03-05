<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\User;

use App\Models\User;
use App\Models\UserCoverPreset;

class Cover
{
    const CUSTOM_COVER_MAX_DIMENSIONS = [2000, 500];
    const CUSTOM_COVER_MAX_FILESIZE = 4_000_000;

    public function __construct(private User $user)
    {
        $this->setDefaultPresetId();
    }

    public function customUrl(): ?string
    {
        return $this->user->customCover()->url();
    }

    public function presetId(): ?int
    {
        if ($this->hasCustomCover()) {
            return null;
        }

        return $this->user->cover_preset_id;
    }

    public function set(?int $presetId, ?string $filePath): void
    {
        $this->user->cover_preset_id = isset($presetId)
            ? UserCoverPreset::active()->find($presetId)?->getKey()
            : null;

        if ($filePath !== null) {
            $this->user->customCover()->store($filePath);
        }
    }

    public function url(): ?string
    {
        return $this->hasCustomCover()
            ? $this->customUrl()
            : $this->presetUrl();
    }

    private function hasCustomCover(): bool
    {
        return !isset($this->user->cover_preset_id) && isset($this->user->custom_cover_filename);
    }

    private function presetUrl(): ?string
    {
        $presetId = $this->presetId();

        return isset($presetId)
            ? app('user-cover-presets')->find($presetId)?->file()->url()
            : null;
    }

    private function setDefaultPresetId(): void
    {
        if (!$this->user->exists || isset($this->user->cover_preset_id) || isset($this->user->custom_cover_filename)) {
            return;
        }

        $id = app('user-cover-presets')->defaultForUser($this->user)->getKey();
        $this->user->update(['cover_preset_id' => $id]);
    }
}
