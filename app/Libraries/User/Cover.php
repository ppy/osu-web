<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\User;

use App\Models\UserProfileCustomization;
use Illuminate\Http\UploadedFile;

/**
 * This class doesn't sync with underlying model to save attribute casting time
 */
class Cover
{
    const CUSTOM_COVER_MAX_DIMENSIONS = [2400, 640];

    private const AVAILABLE_PRESET_IDS = ['1', '2', '3', '4', '5', '6', '7', '8'];

    private ?array $json;

    public function __construct(private UserProfileCustomization $userProfileCustomization)
    {
        $this->json = $this->userProfileCustomization->cover_json;
    }

    public static function isValidPresetId(?string $presetId): bool
    {
        return $presetId !== null
            && in_array($presetId, static::AVAILABLE_PRESET_IDS, true);
    }

    public function customUrl(): ?string
    {
        return $this->userProfileCustomization->customCover()->url();
    }

    public function presetId(): ?string
    {
        if ($this->hasCustomCover()) {
            return null;
        }

        $id = $this->userProfileCustomization->getKey();

        if ($id === null || $id < 1) {
            return null;
        }

        $presetId = $this->json['id'] ?? null;

        return static::isValidPresetId($presetId)
            ? $presetId
            : static::AVAILABLE_PRESET_IDS[$id % count(static::AVAILABLE_PRESET_IDS)];
    }

    public function set(?string $presetId, ?UploadedFile $file)
    {
        $this->userProfileCustomization->cover_json = [
            ...($this->json ?? []),
            'id' => static::isValidPresetId($presetId) ? $presetId : null,
        ];

        if ($file !== null) {
            $this->userProfileCustomization->customCover()->store($file->getRealPath());
        }

        $this->json = $this->userProfileCustomization->cover_json;
    }

    public function url(): ?string
    {
        return $this->hasCustomCover()
            ? $this->customUrl()
            : $this->presetUrl();
    }

    private function hasCustomCover(): bool
    {
        return !isset($this->json['id']) && isset($this->json['file']);
    }

    private function presetUrl(): ?string
    {
        $presetId = $this->presetId();

        return $presetId === null
            ? null
            : "{$GLOBALS['cfg']['app']['url']}/images/headers/profile-covers/c{$presetId}.jpg";
    }
}
