<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Libraries\Beatmapset\NominateBeatmapset;
use App\Models\Beatmap;
use App\Models\BeatmapDiscussion;
use App\Models\Beatmapset;
use App\Models\BeatmapsetEvent;
use App\Models\BeatmapsetWatch;
use App\Models\DeletedUser;
use App\Models\User;
use Auth;
use Ds\Set;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use League\Fractal;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Primitive;

class BeatmapsetCompactTransformer extends TransformerAbstract
{
    protected array $availableIncludes = [
        'availability',
        'beatmaps',
        'converts',
        'current_nominations',
        'current_user_attributes',
        'description',
        'discussions',
        'eligible_main_rulesets',
        'events',
        'genre',
        'has_favourited',
        'language',
        'pack_tags',
        'main_ruleset',
        'nominations',
        'ratings',
        'recent_favourites',
        'related_users',
        'related_tags',
        'user',
        'version_count',
    ];

    // TODO: switch to enum after php 8.1
    public string $relatedUsersType = 'discussions';

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
            'genre_id' => $beatmapset->genre_id,
            'hype' => $beatmapset->canBeHyped() ? [
                'current' => $beatmapset->hype,
                'required' => $beatmapset->requiredHype(),
            ] : null,
            'id' => $beatmapset->beatmapset_id,
            'language_id' => $beatmapset->language_id,
            'nsfw' => $beatmapset->nsfw,
            'offset' => $beatmapset->offset,
            'play_count' => $beatmapset->play_count,
            'preview_url' => $beatmapset->previewURL(),
            'source' => $beatmapset->source,
            'spotlight' => $beatmapset->spotlight,
            'status' => $beatmapset->status(),
            'title' => $beatmapset->title,
            'title_unicode' => $beatmapset->title_unicode,
            'track_id' => $beatmapset->track_id,
            'user_id' => $beatmapset->user_id,
            'video' => $beatmapset->video,
        ];
    }

    public function includeAvailability(Beatmapset $beatmapset)
    {
        return $this->primitive([
            'download_disabled' => $beatmapset->download_disabled,
            'more_information' => $beatmapset->download_disabled_url,
        ]);
    }

    public function includeBeatmaps(Beatmapset $beatmapset, Fractal\ParamBag $params)
    {
        return $this->collection($this->beatmaps($beatmapset, $params), new $this->beatmapTransformer());
    }

    public function includeConverts(Beatmapset $beatmapset)
    {
        $converts = [];

        foreach ($this->beatmaps($beatmapset) as $beatmap) {
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

    public function includeCurrentNominations(Beatmapset $beatmapset): Collection
    {
        return $this->collection($beatmapset->beatmapsetNominationsCurrent, new BeatmapsetNominationTransformer());
    }

    public function includeCurrentUserAttributes(Beatmapset $beatmapset)
    {
        $currentUser = Auth::user();

        $hypeValidation = $beatmapset->validateHypeBy($currentUser);

        return $this->primitive([
            'can_beatmap_update_owner' => priv_check('BeatmapUpdateOwner', $beatmapset)->can(),
            'can_delete' => !$beatmapset->isScoreable() && priv_check('BeatmapsetDelete', $beatmapset)->can(),
            'can_edit_metadata' => priv_check('BeatmapsetMetadataEdit', $beatmapset)->can(),
            'can_edit_offset' => priv_check('BeatmapsetOffsetEdit')->can(),
            'can_edit_tags' => priv_check('BeatmapsetTagsEdit')->can(),
            'can_hype' => $hypeValidation['result'],
            'can_hype_reason' => $hypeValidation['message'] ?? null,
            'can_love' => $beatmapset->isLoveable() && priv_check('BeatmapsetLove')->can(),
            'can_remove_from_loved' => $beatmapset->isLoved() && priv_check('BeatmapsetRemoveFromLoved')->can(),
            'is_watching' => BeatmapsetWatch::check($beatmapset, Auth::user()),
            'new_hype_time' => json_time($currentUser?->newHypeTime()),
            'nomination_modes' => $currentUser?->nominationModes(),
            'remaining_hype' => $currentUser?->remainingHype() ?? 0,
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

    public function includeEligibleMainRulesets(Beatmapset $beatmapset)
    {
        return $this->primitive($beatmapset->eligibleMainRulesets());
    }

    public function includeNominations(Beatmapset $beatmapset)
    {
        $result = [
            'legacy_mode' => $beatmapset->isLegacyNominationMode(),
            'current' => $beatmapset->currentNominationCount(),
            'required_meta' => NominateBeatmapset::requiredNominationsConfig(),
        ];

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

    public function includePackTags(Beatmapset $beatmapset)
    {
        return $this->primitive($beatmapset->pack_tags);
    }

    public function includeUser(Beatmapset $beatmapset)
    {
        return $this->item(
            $beatmapset->user ?? new DeletedUser(),
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
        $userIds = new Set([$beatmapset->user_id]);
        switch ($this->relatedUsersType) {
            case 'discussions':
                $beatmaps = $beatmapset->allBeatmaps;
                $userIds->add(...$beatmaps->pluck('user_id'));
                $userIds->add(...$beatmaps->flatMap->beatmapOwners->pluck('user_id'));

                foreach ($beatmapset->beatmapDiscussions as $discussion) {
                    if (!priv_check('BeatmapDiscussionShow', $discussion)->can()) {
                        continue;
                    }

                    $userIds->add($discussion->user_id);
                    $userIds->add($discussion->deleted_by_id);

                    foreach ($discussion->beatmapDiscussionPosts as $post) {
                        if (!priv_check('BeatmapDiscussionPostShow', $post)->can()) {
                            continue;
                        }

                        $userIds->add($post->user_id);
                        $userIds->add($post->last_editor_id);
                        $userIds->add($post->deleted_by_id);
                    }

                    foreach ($discussion->beatmapDiscussionVotes->sortByDesc('created_at')->take(BeatmapDiscussion::VOTES_TO_SHOW) as $vote) {
                        $userIds->add($vote->user_id);
                    }
                }

                foreach ($beatmapset->events as $event) {
                    if (priv_check('BeatmapsetEventViewUserId', $event)->can()) {
                        $userIds->add($event->user_id);
                    }
                }
                break;
            case 'show':
                $beatmaps = $this->beatmaps($beatmapset);
                $userIds->add(...$beatmaps->pluck('user_id'));
                $userIds->add(...$beatmaps->flatMap->beatmapOwners->pluck('user_id'));
                $userIds->add(...$beatmapset->beatmapsetNominationsCurrent->pluck('user_id'));
                break;
        }

        $users = User::with('userGroups')->whereIn('user_id', $userIds->toArray())->get();

        return $this->collection($users, new UserCompactTransformer());
    }

    public function includeRelatedTags(Beatmapset $beatmapset)
    {
        $beatmaps = $this->beatmaps($beatmapset);
        $tagIdSet = new Set($beatmaps->flatMap->topTagIds()->pluck('tag_id'));

        $cachedTags = app('tags');
        $json = [];

        foreach ($tagIdSet as $tagId) {
            $tag = $cachedTags->get($tagId);
            if ($tag !== null) {
                $json[] = $tag;
            }
        }

        return $this->primitive($json);
    }

    public function includeVersionCount(Beatmapset $beatmapset): Primitive
    {
        return $this->primitive($beatmapset->versions()->count());
    }

    private function beatmaps(Beatmapset $beatmapset, ?Fractal\ParamBag $params = null): EloquentCollection
    {
        $rel = $beatmapset->trashed() || ($params !== null && $params->get('with_trashed')) ? 'allBeatmaps' : 'beatmaps';

        return $beatmapset->$rel;
    }
}
