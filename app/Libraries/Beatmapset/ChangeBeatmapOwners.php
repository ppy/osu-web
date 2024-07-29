<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\Beatmapset;

use App\Exceptions\InvariantException;
use App\Jobs\Notifications\BeatmapOwnerChange;
use App\Models\Beatmap;
use App\Models\BeatmapOwner;
use App\Models\BeatmapsetEvent;
use App\Models\User;
use Ds\Set;

class ChangeBeatmapOwners
{
    private Set $userIds;

    public function __construct(private Beatmap $beatmap, array $newUserIds, private User $source)
    {
        priv_check_user($source, 'BeatmapUpdateOwner', $beatmap->beatmapset)->ensureCan();

        $this->userIds = new Set($newUserIds);

        if ($this->userIds->isEmpty()) {
            throw new InvariantException('user_ids must be specified');
        }

        if (User::whereIn('user_id', $this->userIds->toArray())->count() !== $this->userIds->count()) {
            throw new InvariantException('invalid user_id');
        }
    }

    public function handle(): void
    {
        $currentOwners = new Set($this->beatmap->mappers->pluck('user_id'));
        if ($currentOwners->xor($this->userIds)->isEmpty()) {
            return;
        }

        $this->beatmap->getConnection()->transaction(function () {
            $userIds = $this->userIds->toArray();
            $params = [];

            foreach ($userIds as $userId) {
                $params[] = ['beatmap_id' => $this->beatmap->getKey(), 'user_id' => $userId];
            }

            $this->beatmap->fill(['user_id' => $userIds[0]])->saveOrExplode();
            $this->beatmap->beatmapOwners()->delete();
            BeatmapOwner::insert($params);

            $this->beatmap->refresh();

            // TODO: use select instead (needs newer laravel)
            $newUsers = $this->beatmap->mappers->map(fn ($user) => $user->only('user_id', 'username'))->all();
            $beatmapset = $this->beatmap->beatmapset;

            BeatmapsetEvent::log(BeatmapsetEvent::BEATMAP_OWNER_CHANGE, $this->source, $beatmapset, [
                'beatmap_id' => $this->beatmap->getKey(),
                'beatmap_version' => $this->beatmap->version,
                'new_user_id' => $this->beatmap->user_id,
                'new_user_username' => $this->beatmap->user->username,
                'new_users' => $newUsers,
            ])->saveOrExplode();

            $beatmapset->update(['eligible_main_rulesets' => null]);
        });

        (new BeatmapOwnerChange($this->beatmap, $this->source))->dispatch();
    }
}
