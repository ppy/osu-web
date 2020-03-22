<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use App\Exceptions\InvariantException;
use App\Models\BeatmapDiscussion;
use App\Models\BeatmapDiscussionPost;
use App\Models\Beatmapset;
use App\Models\User;
use DB;

class BeatmapsetDiscussionReview
{
    public static function create(Beatmapset $beatmapset, array $document, User $user)
    {
        if (!$document || !is_array($document) || empty($document)) {
            throw new InvariantException(trans('beatmap_discussions.review.validation.invalid_document'));
        }

        $output = [];
        try {
            DB::beginTransaction();

            // create the issues for the embeds first
            $childIds = [];
            $blockCount = 0;

            foreach ($document as $block) {
                if (!isset($block['type'])) {
                    throw new InvariantException(trans('beatmap_discussions.review.validation.invalid_block_type'));
                }

                $message = get_string($block['text'] ?? null);
                if ($message === null) {
                    throw new InvariantException(trans('beatmap_discussions.review.validation.missing_text'));
                }

                switch ($block['type']) {
                    case 'embed':
                        $beatmapId = $block['beatmap_id'] ?? null;

                        $discussion = new BeatmapDiscussion([
                            'beatmapset_id' => $beatmapset->getKey(),
                            'user_id' => $user->getKey(),
                            'resolved' => false,
                            'message_type' => $block['discussion_type'],
                            'timestamp' => $block['timestamp'] ?? null,
                            'beatmap_id' => $beatmapId,
                        ]);
                        $discussion->saveOrExplode();

                        $postParams = [
                            'user_id' => $user->getKey(),
                            'message' => $message,
                        ];
                        $post = new BeatmapDiscussionPost($postParams);
                        $post->beatmapDiscussion()->associate($discussion);
                        $post->saveOrExplode();

                        $issues[] = [
                            'discussion' => $discussion->getKey(),
                            'post' => $post->getKey(),
                        ];
                        $childIds[] = $discussion->getKey();
                        break;

                    case 'paragraph':
                        break;

                    default:
                        // invalid block type
                        throw new InvariantException(trans('beatmap_discussions.review.validation.invalid_block_type'));
                }
                $blockCount++;
            }

            $minIssues = config('osu.beatmapset.discussion_review_min_issues');
            if (empty($childIds) || count($childIds) < $minIssues) {
                throw new InvariantException(trans_choice('beatmap_discussions.review.validation.minimum_issues', $minIssues));
            }

            $maxBlocks = config('osu.beatmapset.discussion_review_max_blocks');
            if ($blockCount > $maxBlocks) {
                throw new InvariantException(trans_choice('beatmap_discussions.review.validation.too_many_blocks', $maxBlocks));
            }

            // generate the post body now that the issues have been created
            foreach ($document as $block) {
                switch ($block['type']) {
                    case 'paragraph':
                        array_push($output, [
                            'type' => 'paragraph',
                            'text' => $block['text'],
                        ]);
                        break;

                    case 'embed':
                        array_push($output, [
                            'type' => 'embed',
                            'discussion_id' => array_shift($issues)['discussion'],
                        ]);
                        break;
                }
            }

            // create the review post
            $review = new BeatmapDiscussion([
                'beatmapset_id' => $beatmapset->getKey(),
                'user_id' => $user->getKey(),
                'resolved' => false,
                'message_type' => 'review',
            ]);
            $review->saveOrExplode();
            $post = new BeatmapDiscussionPost([
                'user_id' => $user->getKey(),
                'message' => json_encode($output),
            ]);
            $post->beatmapDiscussion()->associate($review);
            $post->saveOrExplode();

            // associate children with parent
            BeatmapDiscussion::whereIn('id', $childIds)
                ->update(['parent_id' => $review->getKey()]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
