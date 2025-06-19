<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\BeatmapDiscussion;
use App\Models\BeatmapDiscussionPost;
use App\Models\Beatmapset;
use App\Models\Solo\Score;
use App\Models\User;
use Illuminate\Console\Command;

class BeatmapsetUnrank extends Command
{
    protected $signature = 'beatmapset:unrank {id} {reason}';
    protected $description = 'Unrank beatmapset.';

    public function handle(): int
    {
        $id = get_int($this->argument('id'));
        $reason = presence(get_string($this->argument('reason')));
        $beatmapset = Beatmapset::ranked()->findOrFail($id);
        $scoreCount = Score::whereIn('beatmap_id', $beatmapset->beatmaps()->select('beatmap_id'))->count();

        $this->info('Unranking beatmapset:');
        $this->info("- Title: {$beatmapset->title} ({$beatmapset->title_unicode})");
        $this->info("- Artist: {$beatmapset->artist} ({$beatmapset->artist_unicode})");
        $this->info("- Main Mapper: {$beatmapset->creator} ({$beatmapset->user_id})");
        $this->info('- Beatmaps: '.i18n_number_format($beatmapset->beatmaps()->count()));
        $this->info('- Scores: '.i18n_number_format($scoreCount));
        if (!$this->confirm('Unrank the beatmapset?')) {
            $this->error('Aborted.');
            return static::FAILURE;
        }

        $user = User::findOrFail($GLOBALS['cfg']['osu']['legacy']['bancho_bot_user_id']);

        $discussion = new BeatmapDiscussion([
            'beatmapset_id' => $beatmapset->getKey(),
            'message_type' => 'problem',
            'user_id' => $user->getKey(),
            'resolved' => false,
        ]);

        $post = new BeatmapDiscussionPost([
            'message' => $reason,
            'user_id' => $user->getKey(),
        ]);

        $discussion->getConnection()->transaction(function () use ($beatmapset, $discussion, $post, $user) {
            $discussion->saveOrExplode();
            $post->beatmap_discussion_id = $discussion->getKey();
            $post->saveOrExplode();

            $beatmapset->disqualifyOrResetNominations($user, $discussion, true);
        });

        $this->info('Done.');

        return static::SUCCESS;
    }
}
