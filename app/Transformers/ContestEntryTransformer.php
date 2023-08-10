<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\ContestEntry;
use App\Models\DeletedUser;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use Sentry\State\Scope;

class ContestEntryTransformer extends TransformerAbstract
{
    protected array $availableIncludes = [
        'artMeta',
        'current_user_judge_vote',
        'judge_votes',
        'results',
        'user',
    ];

    public function transform(ContestEntry $entry)
    {
        $return = [
            'contest_id' => $entry->contest_id,
            'id' => $entry->getKey(),
            'title' => $entry->contest->unmasked ? $entry->name : $entry->masked_name,
            'preview' => $entry->entry_url,
        ];

        if ($entry->contest->hasThumbnails()) {
            $return['thumbnail'] = mini_asset($entry->thumbnail());
        }

        return $return;
    }

    public function includeCurrentUserJudgeVote(ContestEntry $entry): ?Item
    {
        $currentUser = auth()->user();

        if ($currentUser === null) {
            return null;
        }

        $judgeVote = $entry->judgeVotes->where('user_id', $currentUser->getKey())->first();

        if ($judgeVote === null) {
            return null;
        }

        return $this->item($judgeVote, new ContestJudgeVoteTransformer());
    }

    public function includeJudgeVotes(ContestEntry $entry): Collection
    {
        return $this->collection($entry->judgeVotes, new ContestJudgeVoteTransformer());
    }

    public function includeResults(ContestEntry $entry)
    {
        $votes = $entry->contest->isJudged()
            ? $entry->category_votes_sum_value
            : $entry->votes_count;

        return $this->primitive([
            'actual_name' => $entry->name,
            'votes' => (int) $votes,
        ]);
    }

    public function includeUser(ContestEntry $entry)
    {
        return $this->primitive([
            'id' => $entry->user_id,
            'username' => ($entry->user ?? (new DeletedUser()))->username,
        ]);
    }

    public function includeArtMeta(ContestEntry $entry)
    {
        if (!$entry->contest->hasThumbnails() || !presence($entry->entry_url)) {
            return $this->primitive([]);
        }

        $thumbnailUrl = $entry->thumbnail();
        // suffix urls when contests are made live to ensure image dimensions are forcibly rechecked
        if ($entry->contest->visible) {
            $urlSuffix = str_contains($thumbnailUrl, '?') ? '&live' : '?live';
        }

        $size = fast_imagesize($thumbnailUrl.($urlSuffix ?? ''));

        if ($size === null) {
            app('sentry')->getClient()->captureMessage(
                'Failed fetching image size of contest entry',
                null,
                (new Scope())
                    ->setExtra('id', $entry->getKey())
                    ->setExtra('url', $thumbnailUrl),
            );
        }

        return $this->primitive([
            'width' => $size[0] ?? 0,
            'height' => $size[1] ?? 0,
        ]);
    }
}
