<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Models;

use App\Models\User;
use Tests\TestCase;

class UserProfileCustomizationTest extends TestCase
{
    public function testUpdateNullOptions(): void
    {
        $profileCustomization = User::factory()->create()->profileCustomization();
        $profileCustomization->update(['options' => null]);

        $audioVolume = $profileCustomization->audio_volume + 1;
        $profileCustomization->fresh()->update(['audio_volume' => $audioVolume]);

        $this->assertSame($audioVolume, $profileCustomization->fresh()->audio_volume);
    }

    public function testUpdateOption(): void
    {
        $profileCustomization = User::factory()->create()->profileCustomization();

        $audioVolume = $profileCustomization->audio_volume + 1;
        $profileCustomization->fresh()->update(['audio_volume' => $audioVolume]);

        $this->assertSame($audioVolume, $profileCustomization->fresh()->audio_volume);
    }
}
