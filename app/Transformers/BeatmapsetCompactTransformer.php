<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\Beatmap;
use App\Models\BeatmapDiscussion;
use App\Models\Beatmapset;
use App\Models\BeatmapsetEvent;
use App\Models\BeatmapsetWatch;
use App\Models\DeletedUser;
use App\Models\User;
use Auth;
use League\Fractal;

class BeatmapsetCompactTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'beatmaps',
        'converts',
        'current_user_attributes',
        'description',
        'discussions',
        'events',
        'genre',
        'has_favourited',
        'language',
        'nominations',
        'ratings',
        'recent_favourites',
        'related_users',
        'user',
    ];

    protected $beatmapTransformer = BeatmapCompactTransformer::class;

    protected $permissions = [
        'current_user_attributes' => 'IsNotOAuth',
        'has_favourited' => 'IsSpecialScope', // TODO: make a scope for this.
    ];

    public function transform(Beatmapset $beatmapset)
    {
        return [
            'artist' => $beatmapset->artist,
            'artist_unicode' => $beatmapset->artist_unicode,
            'covers' => $beatmapset->allCoverURLs(),
            'creator' => $beatmapset->creator,
            'favourite_count' => $beatmapset->favourite_count,
            'hype' => $beatmapset->canBeHyped() ? [
                'current' => $beatmapset->hype,
                'required' => $beatmapset->requiredHype(),
            ] : null,
            'id' => $beatmapset->beatmapset_id,
            'nsfw' => $beatmapset->nsfw,
            'offset' => $beatmapset->offset,
            'play_count' => $beatmapset->play_count,
            'preview_url' => $beatmapset->previewURL(),
            'source' => $beatmapset->source,
            'status' => $beatmapset->status(),
            'title' => $beatmapset->title,
            'title_unicode' => $beatmapset->title_unicode,
            'user_id' => $beatmapset->user_id,
            'video' => $beatmapset->video,
        ];
    }

    public function includeBeatmaps(Beatmapset $beatmapset, Fractal\ParamBag $params)
    {
        $rel = $params->get('with_trashed') ? 'allBeatmaps' : 'beatmaps';

        return $this->collection($beatmapset->$rel, new $this->beatmapTransformer());
    }

    public function includeConverts(Beatmapset $beatmapset)
    {
        $converts = [];

        foreach ($beatmapset->beatmaps as $beatmap) {
            if ($beatmap->mode !== 'osu') {
                continue;
            }

            foreach (Beatmap::MODES as $modeStr => $modeInt) {
                if ($modeStr === 'osu') {
                    continue;
                }

                $beatmap = clone $beatmap;

                $beatmap->playmode = $modeInt;
                $beatmap->convert = true;

                array_push($converts, $beatmap);
            }
        }

        return $this->collection($converts, new BeatmapTransformer());
    }

    public function includeCurrentUserAttributes(Beatmapset $beatmapset)
    {
        $currentUser = Auth::user();

        if ($currentUser === null) {
            return;
        }

        $hypeValidation = $beatmapset->validateHypeBy($currentUser);

        return $this->primitive([
            'can_beatmap_update_owner' => priv_check('BeatmapUpdateOwner', $beatmapset)->can(),
            'can_delete' => !$beatmapset->isScoreable() && priv_check('BeatmapsetDelete', $beatmapset)->can(),
            'can_edit_metadata' => priv_check('BeatmapsetMetadataEdit', $beatmapset)->can(),
            'can_hype' => $hypeValidation['result'],
            'can_hype_reason' => $hypeValidation['message'] ?? null,
            'can_love' => $beatmapset->isLoveable() && priv_check('BeatmapsetLove')->can(),
            'can_remove_from_loved' => $beatmapset->isLoved() && priv_check('BeatmapsetLove')->can(),
            'is_watching' => BeatmapsetWatch::check($beatmapset, Auth::user()),
            'new_hype_time' => json_time($currentUser->newHypeTime()),
            'nomination_modes' => $currentUser->nominationModes(),
            'remaining_hype' => $currentUser->remainingHype(),
        ]);
    }

    public function includeDescription(Beatmapset $beatmapset)
    {
        return $this->item($beatmapset, new BeatmapsetDescriptionTransformer());
    }

    public function includeDiscussions(Beatmapset $beatmapset)
    {
        return $this->collection(
            $beatmapset->beatmapDiscussions,
            new BeatmapDiscussionTransformer()
        );
    }

    public function includeEvents(Beatmapset $beatmapset)
    {
        return $this->collection(
            $beatmapset->events->all(),
            new BeatmapsetEventTransformer()
        );
    }

    public function includeHasFavourited(Beatmapset $beatmapset)
    {
        return $this->primitive(auth()->user()->hasFavourited($beatmapset));
    }

    public function includeGenre(Beatmapset $beatmapset)
    {
        return $this->item($beatmapset->genre, new GenreTransformer());
    }

    public function includeLanguage(Beatmapset $beatmapset)
    {
        return $this->item($beatmapset->language, new LanguageTransformer());
    }

    public function includeNominations(Beatmapset $beatmapset)
    {
        $result = $beatmapset->nominationsMeta();

        if ($beatmapset->isPending()) {
            $currentUser = Auth::user();
            $disqualificationEvent = $beatmapset->disqualificationEvent();
            $resetEvent = $beatmapset->resetEvent();

            if ($resetEvent !== null && $resetEvent->type === BeatmapsetEvent::NOMINATION_RESET) {
                $result['nomination_reset'] = json_item($resetEvent, 'BeatmapsetEvent');
            }
            if ($disqualificationEvent !== null) {
                $result['disqualification'] = json_item($disqualificationEvent, 'BeatmapsetEvent');
            }
            if ($currentUser !== null) {
                $result['nominated'] = $beatmapset->beatmapsetNominations()->current()->where('user_id', $currentUser->getKey())->exists();
            }
        } elseif ($beatmapset->isQualified()) {
            $queueStatus = $beatmapset->rankingQueueStatus();

            $result['ranking_eta'] = json_time($queueStatus['eta']);
            $result['ranking_queue_position'] = $queueStatus['position'];
        }

        return $this->primitive($result);
    }

    public function includeUser(Beatmapset $beatmapset)
    {
        return $this->item(
            $beatmapset->user ?? (new DeletedUser()),
            new UserCompactTransformer()
        );
    }

    public function includeRatings(Beatmapset $beatmapset)
    {
        return $this->primitive($beatmapset->ratingsCount());
    }

    public function includeRecentFavourites(Beatmapset $beatmapset)
    {
        return $this->collection(
            $beatmapset->recentFavourites(),
            new UserCompactTransformer()
        );
    }

    public function includeRelatedUsers(Beatmapset $beatmapset)
    {
        $userIds = $beatmapset->allBeatmaps->pluck('user_id')->toArray();
        $userIds[] = $beatmapset->user_id;

        foreach ($beatmapset->beatmapDiscussions as $discussion) {
            if (!priv_check('BeatmapDiscussionShow', $discussion)->can()) {
                continue;
            }

            $userIds[] = $discussion->user_id;
            $userIds[] = $discussion->deleted_by_id;

            foreach ($discussion->beatmapDiscussionPosts as $post) {
                if (!priv_check('BeatmapDiscussionPostShow', $post)->can()) {
                    continue;
                }

                $userIds[] = $post->user_id;
                $userIds[] = $post->last_editor_id;
                $userIds[] = $post->deleted_by_id;
            }

            foreach ($discussion->beatmapDiscussionVotes->sortByDesc('created_at')->take(BeatmapDiscussion::VOTES_TO_SHOW) as $vote) {
                $userIds[] = $vote->user_id;
            }
        }

        foreach ($beatmapset->events as $event) {
            if (priv_check('BeatmapsetEventViewUserId', $event)->can()) {
                $userIds[] = $event->user_id;
            }
        }

        $userIds = array_unique($userIds);
        $users = User::with('userGroups')->whereIn('user_id', $userIds)->get();

        return $this->collection($users, new UserCompactTransformer());
    }
}
