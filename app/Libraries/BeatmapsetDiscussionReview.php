<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use App\Exceptions\InvariantException;
use App\Jobs\Notifications\BeatmapsetDiscussionQualifiedProblem;
use App\Jobs\Notifications\BeatmapsetDiscussionReviewNew;
use App\Models\BeatmapDiscussion;
use App\Models\BeatmapDiscussionPost;
use App\Models\Beatmapset;
use App\Models\BeatmapsetEvent;
use App\Models\User;
use DB;
use Exception;

class BeatmapsetDiscussionReview
{
    const BLOCK_TEXT_LENGTH_LIMIT = 750;

    private int $priorOpenProblemCount;
    private ?BeatmapDiscussion $problemDiscussion;

    public static function config()
    {
        return [
            'max_blocks' => config('osu.beatmapset.discussion_review_max_blocks'),
        ];
    }

    public static function create(Beatmapset $beatmapset, array $document, User $user)
    {
        $review = new static($beatmapset, $document, $user);

        return $review->process();
    }

    // TODO: combine with create()?
    public static function update(BeatmapDiscussion $discussion, array $document, User $user)
    {
        if (empty($document)) {
            throw new InvariantException(trans('beatmap_discussions.review.validation.invalid_document'));
        }

        $beatmapset = Beatmapset::findOrFail($discussion->beatmapset_id); // handle deleted beatmapsets

        $review = new static($beatmapset, $document, $user, $discussion);
        $review->updateWith($document);
    }

    private static function createPost($beatmapsetId, $discussionType, $message, $userId, $beatmapId = null, $timestamp = null)
    {
        $newDiscussion = new BeatmapDiscussion([
            'beatmapset_id' => $beatmapsetId,
            'user_id' => $userId,
            'resolved' => false,
            'message_type' => $discussionType,
            'timestamp' => $timestamp,
            'beatmap_id' => $beatmapId,
        ]);
        $newDiscussion->saveOrExplode();

        $postParams = [
            'user_id' => $userId,
            'message' => $message,
        ];
        $newPost = new BeatmapDiscussionPost($postParams);
        $newPost->beatmapDiscussion()->associate($newDiscussion);
        $newPost->saveOrExplode();

        return $newDiscussion;
    }

    public static function getStats(array $document)
    {
        $stats = [
            'praises' => 0,
            'suggestions' => 0,
            'problems' => 0,
        ];
        $embedIds = [];

        foreach ($document as $block) {
            if ($block['type'] === 'embed') {
                $embedIds[] = $block['discussion_id'];
            }
        }

        $embeds = BeatmapDiscussion::whereIn('id', $embedIds)->get();
        foreach ($embeds as $embed) {
            switch ($embed->message_type) {
                case 'praise':
                    $stats['praises']++;
                    break;

                case 'suggestion':
                    $stats['suggestions']++;
                    break;

                case 'problem':
                    $stats['problems']++;
                    break;
            }
        }

        return $stats;
    }

    public function __construct(private Beatmapset $beatmapset, private array $document, private User $user, private ?BeatmapDiscussion $discussion = null)
    {
        if (empty($document)) {
            throw new InvariantException(trans('beatmap_discussions.review.validation.invalid_document'));
        }
    }

    public function process()
    {
        // TODO: die if $this->discussion is not null.
        $this->priorOpenProblemCount = $this->getOpenProblemCount();

        try {
            DB::beginTransaction();

            [$output, $childIds] = $this->parseDocument(false);

            $this->discussion = self::createPost(
                $this->beatmapset->getKey(),
                'review',
                json_encode($output),
                $this->user->getKey()
            );

            // associate children with parent
            BeatmapDiscussion::whereIn('id', $childIds)
                ->update(['parent_id' => $this->discussion->getKey()]);

            $this->handleProblemDiscussion();

            DB::commit();

            (new BeatmapsetDiscussionReviewNew($this->discussion, $this->user))->dispatch();

            return $this->discussion;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function updateWith(array $document)
    {
        $this->document = $document;
        $post = $this->discussion->startingPost;

        $this->priorOpenProblemCount = $this->getOpenProblemCount();

        try {
            DB::beginTransaction();

            [$output, $childIds] = $this->parseDocument(true);

            // ensure all referenced embeds belong to this discussion
            $externalEmbeds = BeatmapDiscussion::whereIn('id', $childIds)->where('parent_id', '<>', $this->discussion->getKey())->count();
            if ($externalEmbeds > 0) {
                throw new InvariantException(trans('beatmap_discussions.review.validation.external_references'));
            }

            // update the review post
            $post['message'] = json_encode($output);
            $post['last_editor_id'] = $this->user->getKey();
            $post->saveOrExplode();

            // unlink any embeds that were removed from the review
            BeatmapDiscussion::where('parent_id', $this->discussion->getKey())
                ->whereNotIn('id', $childIds)
                ->update(['parent_id' => null]);

            // associate children with parent
            BeatmapDiscussion::whereIn('id', $childIds)
                ->update(['parent_id' => $this->discussion->getKey()]);

            $this->handleProblemDiscussion();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    private function getOpenProblemCount()
    {
        return $this->beatmapset->beatmapDiscussions()->openProblems()->count();
    }

    private function parseDocument(bool $updating)
    {
        $output = [];
        // create the issues for the embeds first
        foreach ($this->document as $block) {
            $output[] = $this->processBlock($block, $this->beatmapset, $this->user, $updating);
        }

        $childIds = array_values(array_filter(array_pluck($output, 'discussion_id')));

        $minIssues = config('osu.beatmapset.discussion_review_min_issues');
        if (empty($childIds) || count($childIds) < $minIssues) {
            throw new InvariantException(trans_choice('beatmap_discussions.review.validation.minimum_issues', $minIssues));
        }

        $maxBlocks = config('osu.beatmapset.discussion_review_max_blocks');
        $blockCount = count($this->document);
        if ($blockCount > $maxBlocks) {
            throw new InvariantException(trans_choice('beatmap_discussions.review.validation.too_many_blocks', $maxBlocks));
        }

        return [$output, $childIds];
    }

    private function handleProblemDiscussion()
    {
        // handle disqualifications and the resetting of nominations
        if ($this->problemDiscussion !== null) {
            $event = $this->problemDiscussion->getBeatmapsetEventType($this->user);
            if (in_array($event, [BeatmapsetEvent::DISQUALIFY, BeatmapsetEvent::NOMINATION_RESET], true)) {
                return $this->beatmapset->disqualifyOrResetNominations($this->user, $this->problemDiscussion);
            }

            if ($event === null && $this->priorOpenProblemCount === 0) {
                (new BeatmapsetDiscussionQualifiedProblem(
                    $this->problemDiscussion->startingPost,
                    $this->user
                ))->dispatch();
            }
        }
    }

    private function processBlock($block, Beatmapset $beatmapset, User $user, bool $updating = false)
    {
        if (!isset($block['type'])) {
            throw new InvariantException(trans('beatmap_discussions.review.validation.invalid_block_type'));
        }

        $message = get_string($block['text'] ?? null);
        // message check can be skipped for updates if block is embed and has discussion_id set.
        if ($message === null && !($updating && $block['type'] === 'embed' && isset($block['discussion_id']))) {
            throw new InvariantException(trans('beatmap_discussions.review.validation.missing_text'));
        }

        switch ($block['type']) {
            case 'embed':
                if ($updating && isset($block['discussion_id'])) {
                    $childId = $block['discussion_id'];
                } else {
                    if (!isset($block['discussion_type'])) {
                        throw new InvariantException(trans('beatmap_discussions.review.validation.invalid_discussion_type'));
                    }

                    $embedDiscussion = static::createPost(
                        $beatmapset->getKey(),
                        $block['discussion_type'],
                        $message,
                        $user->getKey(),
                        $block['beatmap_id'] ?? null,
                        $block['timestamp'] ?? null
                    );

                    $childId = $embedDiscussion->getKey();

                    // FIXME: separate from this loop
                    if ($block['discussion_type'] === 'problem' && $this->problemDiscussion === null) {
                        $this->problemDiscussion = $embedDiscussion;
                    }
                }

                return [
                    'type' => 'embed',
                    'discussion_id' => $childId,
                ];

            case 'paragraph':
                if (mb_strlen($block['text']) > static::BLOCK_TEXT_LENGTH_LIMIT) {
                    throw new InvariantException(trans('beatmap_discussions.review.validation.block_too_large', ['limit' => static::BLOCK_TEXT_LENGTH_LIMIT]));
                }
                return [
                    'type' => 'paragraph',
                    'text' => $block['text'],
                ];

            default:
                // invalid block type
                throw new InvariantException(trans('beatmap_discussions.review.validation.invalid_block_type'));
        }
    }
}
