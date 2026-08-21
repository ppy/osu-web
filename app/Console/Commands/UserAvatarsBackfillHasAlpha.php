<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Console\Commands;

use App\Libraries\User\AvatarHelper;
use App\Models\User;
use Illuminate\Console\Command;

class UserAvatarsBackfillHasAlpha extends Command
{
    protected $signature = 'user:avatars-backfill-has-alpha {--dry-run : Report changes without saving}';

    protected $description = 'Detect and store has_alpha for existing user avatars.';

    public function handle(): int
    {
        $dryRun = $this->option('dry-run');
        $disk = storage_disk('avatar');
        $scanned = 0;
        $updated = 0;
        $missing = 0;

        User::query()
            ->where('user_avatar', '<>', '')
            ->orderBy('user_id')
            ->chunkById(100, function ($users) use ($disk, $dryRun, &$scanned, &$updated, &$missing) {
                foreach ($users as $user) {
                    $scanned++;
                    $key = (string) $user->getKey();

                    if (!$disk->exists($key)) {
                        $missing++;
                        continue;
                    }

                    $tmp = tempnam(sys_get_temp_dir(), 'avatar-has-alpha-');
                    if ($tmp === false) {
                        throw new \RuntimeException('failed to create temporary file');
                    }

                    try {
                        file_put_contents($tmp, $disk->get($key));
                        $hasAlpha = AvatarHelper::detectAlpha($tmp);
                    } finally {
                        @unlink($tmp);
                    }

                    if ((bool) $user->has_alpha === $hasAlpha) {
                        continue;
                    }

                    $updated++;
                    if (!$dryRun) {
                        $user->update(['has_alpha' => $hasAlpha]);
                    }
                }
            }, 'user_id');

        $this->info("scanned={$scanned} updated={$updated} missing={$missing}".($dryRun ? ' (dry-run)' : ''));

        return 0;
    }
}
