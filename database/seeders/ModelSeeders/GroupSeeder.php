<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Database\Seeders\ModelSeeders;

use App\Models\Group;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    public function run(): void
    {
        Group::truncate();
        foreach (Group::PRIV_IDENTIFIERS as $identifier) {
            Group::create([
                'group_desc' => '',
                'group_name' => $identifier,
                'group_type' => 2,
                'identifier' => $identifier,
                'short_name' => $identifier,
            ]);
        }
    }
}
