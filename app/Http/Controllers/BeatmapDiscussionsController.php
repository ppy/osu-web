<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace App\Http\Controllers;

use App\Exceptions\ModelNotSavedException;
use App\Models\BeatmapDiscussion;
use App\Models\BeatmapDiscussionPost;
use App\Models\Beatmapset;
use Auth;
use DB;
use Illuminate\Pagination\Paginator;
use Request;

class BeatmapDiscussionsController extends Controller
{
    protected $section = 'beatmaps';

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);

        return parent::__construct();
    }

    public function allowKudosu($id)
    {
        $discussion = BeatmapDiscussion::findOrFail($id);
        priv_check('BeatmapDiscussionAllowOrDenyKudosu', $discussion)->ensureCan();

        try {
            $discussion->allowKudosu(Auth::user());
        } catch (ModelNotSavedException $e) {
            return error_popup($e->getMessage());
        }

        return $discussion->beatmapset->defaultDiscussionJson();
    }

    public function denyKudosu($id)
    {
        $discussion = BeatmapDiscussion::findOrFail($id);
        priv_check('BeatmapDiscussionAllowOrDenyKudosu', $discussion)->ensureCan();

        try {
            $discussion->denyKudosu(Auth::user());
        } catch (ModelNotSavedException $e) {
            return error_popup($e->getMessage());
        }

        return $discussion->beatmapset->defaultDiscussionJson();
    }

    public function destroy($id)
    {
        $discussion = BeatmapDiscussion::whereNull('deleted_at')->findOrFail($id);
        priv_check('BeatmapDiscussionDestroy', $discussion)->ensureCan();

        try {
            $discussion->softDeleteOrExplode(Auth::user());
        } catch (ModelNotSavedException $e) {
            return error_popup($e->getMessage());
        }

        return $discussion->beatmapset->defaultDiscussionJson();
    }

    public function index()
    {
        $isModerator = priv_check('BeatmapDiscussionModerate')->can();
        $params = request();
        $params['is_moderator'] = $isModerator;

        if (!$isModerator) {
            $params['with_deleted'] = false;
        }

        $search = BeatmapDiscussion::search($params);

        $query = $search['query']->with([
            'user',
            'beatmapset',
            'startingPost',
        ])->limit($search['params']['limit'] + 1);

        $discussions = new Paginator(
            $query->get(),
            $search['params']['limit'],
            $search['params']['page'],
            [
                'path' => Paginator::resolveCurrentPath(),
                'query' => $search['params'],
            ]
        );

        return view('beatmap_discussions.index', compact('discussions', 'search'));
    }

    public function restore($id)
    {
        $discussion = BeatmapDiscussion::whereNotNull('deleted_at')->findOrFail($id);
        priv_check('BeatmapDiscussionRestore', $discussion)->ensureCan();

        $discussion->restore(Auth::user());

        return $discussion->beatmapset->defaultDiscussionJson();
    }

    public function review()
    {
        // TODO: remove this when reviews are released
        if (!config('osu.beatmapset.discussion_review_enabled')) {
            abort(404);
        }

        $document = request()->input('document');
        $beatmapsetId = request()->input('beatmapset_id');

        $beatmapset = Beatmapset
            ::where('discussion_enabled', true)
            ->findOrFail($beatmapsetId);

        if (!$document || !is_array($document) || empty($document)) {
            return error_popup(trans('beatmap_discussions.review.validation.invalid_document'), 422);
        }

        $output = [];
        try {
            DB::beginTransaction();

            // create the issues for the embeds first
            $childIds = [];
            $blockCount = 0;
            foreach ($document as $block) {
                if (!isset($block['type'])) {
                    throw new \Exception(trans('beatmap_discussions.review.validation.invalid_block_type'));
                }
                switch ($block['type']) {
                    case 'embed':
                        $message = $block['text'];
                        $beatmapId = $block['beatmapId'] ?? null;

                        $discussion = new BeatmapDiscussion([
                            'beatmapset_id' => $beatmapset->getKey(),
                            'user_id' => Auth::user()->getKey(),
                            'resolved' => false,
                            'message_type' => $block['discussionType'],
                            'timestamp' => $block['timestamp'],
                            'beatmap_id' => $beatmapId,
                        ]);
                        $discussion->saveOrExplode();

                        $postParams = [
                            'user_id' => Auth::user()->user_id,
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
                }
                $blockCount++;
            }

            $minIssues = config('osu.beatmapset.discussion_review_min_issues');
            if (empty($childIds) || count($childIds) < $minIssues) {
                return error_popup(trans_choice('beatmap_discussions.review.validation.minimum_issues', $minIssues), 422);
            }

            $maxBlocks = config('osu.beatmapset.discussion_review_max_blocks');
            if ($blockCount > $maxBlocks) {
                return error_popup(trans_choice('beatmap_discussions.review.validation.too_many_blocks', $maxBlocks), 422);
            }

            // generate the post body now that the issues have been created
            foreach ($document as $block) {
                switch ($block['type']) {
                    case 'paragraph':
                        if (!$block['text']) {
                            throw new \Exception(trans('beatmap_discussions.review.validation.paragraph_missing_text'));
                        }
                        // escape embed injection attempts
                        $text = preg_replace('/%\[\]\(#(\d+)\)/', '%\[\]\(#$1\)', $block['text']);
                        $output[] = "{$text}\n";
                        break;

                    case 'embed':
                        $discussionId = array_shift($issues)['discussion'];
                        $output[] = "%[](#{$discussionId})\n";
                        break;

                    default:
                        // invalid block type
                        throw new \Exception(trans('beatmap_discussions.review.validation.invalid_block_type'));
                }
            }

            // create the review post
            $review = new BeatmapDiscussion([
                'beatmapset_id' => $beatmapset->getKey(),
                'user_id' => Auth::user()->getKey(),
                'resolved' => false,
                'message_type' => 'review',
            ]);
            $review->saveOrExplode();
            $post = new BeatmapDiscussionPost([
                'user_id' => Auth::user()->user_id,
                'message' => implode('', $output),
            ]);
            $post->beatmapDiscussion()->associate($review);
            $post->saveOrExplode();

            // associate children with parent
            BeatmapDiscussion::whereIn('id', $childIds)
                ->update(['parent_id' => $review->getKey()]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return error_popup($e->getMessage(), 422);
        }

        return $beatmapset->defaultDiscussionJson();
    }

    public function show($id)
    {
        $discussion = BeatmapDiscussion::findOrFail($id);

        if ($discussion->beatmapset === null) {
            abort(404);
        }

        return ujs_redirect(route('beatmapsets.discussion', $discussion->beatmapset).'#/'.$id);
    }

    public function vote($id)
    {
        $discussion = BeatmapDiscussion::findOrFail($id);

        priv_check('BeatmapDiscussionVote', $discussion)->ensureCan();

        $params = get_params(Request::all(), 'beatmap_discussion_vote', ['score:int']);
        $params['user_id'] = Auth::user()->user_id;

        if ($params['score'] < 0) {
            priv_check('BeatmapDiscussionVoteDown', $discussion)->ensureCan();
        }

        if ($discussion->vote($params)) {
            return $discussion->beatmapset->defaultDiscussionJson();
        } else {
            return error_popup(trans('beatmaps.discussion-votes.update.error'));
        }
    }
}
