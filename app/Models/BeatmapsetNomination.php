<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

/**
 * @property Beatmapset $beatmapset
 * @property int $beatmapset_id
 * @property \Carbon\Carbon|null $created_at
 * @property int $id
 * @property array $modes
 * @property bool $reset
 * @property \Carbon\Carbon|null $reset_at
 * @property User|null $reset_by
 * @property int|null $reset_user_id
 * @property \Carbon\Carbon|null $updated_at
 * @property User $user
 * @property int $user_id
 */
class BeatmapsetNomination extends Model
{
    protected $casts = [
        'modes' => 'array',
    ];

    public static function migrate()
    {
        BeatmapsetEvent::whereIn('type', [BeatmapsetEvent::NOMINATE, BeatmapsetEvent::NOMINATION_RESET, BeatmapsetEvent::DISQUALIFY])
            ->with('beatmapset')
            ->chunkById(1000, function ($chunk) {
                /** @var BeatmapsetEvent $event */
                foreach ($chunk as $event) {
                    switch ($event->type) {
                        case BeatmapsetEvent::NOMINATE:
                            \Log::debug('nominate', ['beatmapset_id' => $event->beatmapset_id, 'user_id' => $event->user_id]);
                            $event->beatmapset->beatmapsetNominations()->create([
                                'user_id' => $event->user_id,
                            ]);
                            break;
                        case BeatmapsetEvent::DISQUALIFY:
                        case BeatmapsetEvent::NOMINATION_RESET:
                            \Log::debug('nomination reset', ['beatmapset_id' => $event->beatmapset_id, 'user_id' => $event->user_id]);
                            static::where('beatmapset_id', $event->beatmapset->getKey())->current()->update([
                                'reset' => true,
                                'reset_at' => $event->created_at,
                                'reset_user_id' => $event->user_id,
                            ]);
                            break;
                    }
                }
            });
    }

    public function beatmapset()
    {
        return $this->belongsTo(Beatmapset::class);
    }

    public function scopeCurrent($query)
    {
        return $query->where('reset', false);
    }

    public function resetBy()
    {
        return $this->belongsTo(User::class, 'reset_user_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
