<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Exceptions\InvariantException;
use App\Jobs\Notifications\BeatmapOwnerChange;
use App\Libraries\BeatmapDifficultyAttributes;
use App\Libraries\Score\BeatmapScores;
use App\Models\Beatmap;
use App\Models\BeatmapsetEvent;
use App\Models\Score\Best\Model as BestModel;
use App\Models\User;
use App\Transformers\BeatmapTransformer;
use App\Transformers\ScoreTransformer;

/**
 * @group Beatmaps
 */
class BeatmapsController extends Controller
{
    const DEFAULT_API_INCLUDES = ['beatmapset.ratings', 'failtimes', 'max_combo'];
    const DEFAULT_SCORE_INCLUDES = ['user', 'user.country', 'user.cover'];

    public function __construct()
    {
        parent::__construct();

        $this->middleware('require-scopes:public');
    }

    /**
     * Get Beatmap Attributes
     *
     * Returns difficulty attributes of beatmap with specific mode and mods combination.
     *
     * ---
     *
     * ### Response format
     *
     * Field      | Type
     * ---------- | ----
     * Attributes | [DifficultyAttributes](#beatmapdifficultyattributes)
     *
     * @urlParam beatmap integer required Beatmap id. Example: 2
     * @bodyParam mods number|string[]|Mod[] Mod combination. Can be either a bitset of mods, array of mod acronyms, or array of mods. Defaults to no mods. Example: 1
     * @bodyParam ruleset GameMode Ruleset of the difficulty attributes. Only valid if it's the beatmap ruleset or the beatmap can be converted to the specified ruleset. Defaults to ruleset of the specified beatmap. Example: osu
     * @bodyParam ruleset_id integer The same as `ruleset` but in integer form. No-example
     *
     * @response {
     *   "attributes": {
     *       "max_combo": 100,
     *       ...
     *   }
     * }
     */
    public function attributes($id)
    {
        $beatmap = Beatmap::whereHas('beatmapset')->findOrFail($id);

        $params = get_params(request()->all(), null, [
            'mods:any',
            'ruleset:string',
            'ruleset_id:int',
        ], ['null_missing' => true]);

        $rulesetId = $params['ruleset_id'];
        abort_if(
            $rulesetId !== null && Beatmap::modeStr($rulesetId) === null,
            422,
            'invalid ruleset_id specified'
        );

        if ($rulesetId === null && $params['ruleset'] !== null) {
            $rulesetId = Beatmap::modeInt($params['ruleset']);
            abort_if($rulesetId === null, 422, 'invalid ruleset specified');
        }

        if ($rulesetId === null) {
            $rulesetId = $beatmap->playmode;
        } else {
            abort_if(
                $rulesetId !== $beatmap->playmode && !$beatmap->canBeConverted(),
                422,
                "specified beatmap can't be converted to the specified ruleset"
            );
        }

        if (isset($params['mods'])) {
            if (is_numeric($params['mods'])) {
                $params['mods'] = app('mods')->bitsetToIds((int) $params['mods']);
            }
            if (is_array($params['mods'])) {
                if (count($params['mods']) > 0 && is_string(array_first($params['mods']))) {
                    $params['mods'] = array_map(fn ($m) => ['acronym' => $m], $params['mods']);
                }

                $mods = app('mods')->parseInputArray($rulesetId, $params['mods']);
            } else {
                abort(422, 'invalid mods specified');
            }
        }

        return ['attributes' => BeatmapDifficultyAttributes::get($beatmap->getKey(), $rulesetId, $mods ?? [])];
    }

    /**
     * Get Beatmaps
     *
     * Returns a list of beatmaps.
     *
     * ---
     *
     * ### Response format
     *
     * Field    | Type                  | Description
     * -------- | --------------------- | -----------
     * beatmaps | [Beatmap](#beatmap)[] | Includes `beatmapset` (with `ratings`), `failtimes`, and `max_combo`.
     *
     * @queryParam ids[] integer Beatmap IDs to be returned. Specify once for each beatmap ID requested. Up to 50 beatmaps can be requested at once. Example: 1
     *
     * @response {
     *   "beatmaps": [
     *     {
     *       "id": 1,
     *       // Other Beatmap attributes...
     *     }
     *   ]
     * }
     */
    public function index()
    {
        $ids = array_slice(get_arr(request('ids'), 'get_int') ?? [], 0, 50);

        if (count($ids) > 0) {
            $beatmaps = Beatmap
                ::whereIn('beatmap_id', $ids)
                ->whereHas('beatmapset')
                ->with([
                    'beatmapset',
                    'beatmapset.userRatings' => fn ($q) => $q->select('beatmapset_id', 'rating'),
                    'failtimes',
                ])->withMaxCombo()
                ->orderBy('beatmap_id')
                ->get();
        }

        return [
            'beatmaps' => json_collection($beatmaps ?? [], new BeatmapTransformer(), static::DEFAULT_API_INCLUDES),
        ];
    }

    /**
     * Lookup Beatmap
     *
     * Returns beatmap.
     *
     * ---
     *
     * ### Response format
     *
     * See [Get Beatmap](#get-beatmap)
     *
     * @queryParam checksum A beatmap checksum.
     * @queryParam filename A filename to lookup.
     * @queryParam id A beatmap ID to lookup.
     *
     * @response "See Beatmap object section"
     */
    public function lookup()
    {
        static $keyMap = [
            'checksum' => 'checksum',
            'filename' => 'filename',
            'id' => 'beatmap_id',
        ];

        $params = get_params(request()->all(), null, ['checksum:string', 'filename:string', 'id:int']);

        foreach ($params as $key => $value) {
            $beatmap = Beatmap::whereHas('beatmapset')->firstWhere($keyMap[$key], $value);

            if ($beatmap !== null) {
                break;
            }
        }

        if (!isset($beatmap)) {
            abort(404);
        }

        return json_item($beatmap, new BeatmapTransformer(), static::DEFAULT_API_INCLUDES);
    }

    /**
     * Get Beatmap
     *
     * Gets beatmap data for the specified beatmap ID.
     *
     * ---
     *
     * ### Response format
     *
     * Returns [Beatmap](#beatmap) object.
     * Following attributes are included in the response object when applicable,
     *
     * Attribute                            | Notes
     * -------------------------------------|------
     * beatmapset                           | Includes ratings property.
     * failtimes                            | |
     * max_combo                            | |
     *
     * @urlParam beatmap integer required The ID of the beatmap.
     *
     * @response "See Beatmap object section."
     */
    public function show($id)
    {
        $beatmap = Beatmap::whereHas('beatmapset')->findOrFail($id);

        if (is_api_request()) {
            return json_item($beatmap, new BeatmapTransformer(), static::DEFAULT_API_INCLUDES);
        }

        $beatmapset = $beatmap->beatmapset;

        if ($beatmapset === null) {
            abort(404);
        }

        if ($beatmap->mode === 'osu') {
            $params = get_params(request()->all(), null, [
                'm:int', // legacy parameter
                'mode:string',
            ], ['null_missing' => true]);

            $mode = Beatmap::isModeValid($params['mode'])
                ? $params['mode']
                : Beatmap::modeStr($params['m']);
        }

        $mode ??= $beatmap->mode;

        return ujs_redirect(route('beatmapsets.show', ['beatmapset' => $beatmapset->getKey()]).'#'.$mode.'/'.$beatmap->getKey());
    }

    /**
     * Get Beatmap scores
     *
     * Returns the top scores for a beatmap
     *
     * ---
     *
     * ### Response Format
     *
     * Returns [BeatmapScores](#beatmapscores). `Score` object inside includes `user` and the included `user` includes `country` and `cover`.
     *
     * @urlParam beatmap integer required Id of the [Beatmap](#beatmap).
     *
     * @queryParam mode The [GameMode](#gamemode) to get scores for.
     * @queryParam mods An array of matching Mods, or none // TODO.
     * @queryParam type Beatmap score ranking type // TODO.
     */
    public function scores($id)
    {
        $beatmap = Beatmap::findOrFail($id);
        if ($beatmap->approved <= 0) {
            return ['scores' => []];
        }

        $params = get_params(request()->all(), null, [
            'limit:int',
            'mode:string',
            'mods:string[]',
            'type:string',
        ], ['null_missing' => true]);

        $mode = presence($params['mode']) ?? $beatmap->mode;
        $mods = array_values(array_filter($params['mods'] ?? []));
        $type = presence($params['type']) ?? 'global';
        $currentUser = auth()->user();

        $this->assertSupporterOnlyOptions($currentUser, $type, $mods);

        $query = static::baseScoreQuery($beatmap, $mode, $mods, $type);

        if ($currentUser !== null) {
            // own score shouldn't be filtered by visibleUsers()
            $userScore = (clone $query)->where('user_id', $currentUser->user_id)->first();
        }

        $scoreTransformer = new ScoreTransformer();

        $results = [
            'scores' => json_collection(
                $query->visibleUsers()->forListing($params['limit']),
                $scoreTransformer,
                static::DEFAULT_SCORE_INCLUDES
            ),
        ];

        if (isset($userScore)) {
            $results['user_score'] = [
                'position' => $userScore->userRank(compact('type', 'mods')),
                'score' => json_item($userScore, $scoreTransformer, static::DEFAULT_SCORE_INCLUDES),
            ];
            // TODO: remove this old camelCased json field
            $results['userScore'] = $results['user_score'];
        }

        return $results;
    }

    /**
     * Get Beatmap scores (temp)
     *
     * Returns the top scores for a beatmap from newer client.
     *
     * This is a temporary endpoint.
     *
     * ---
     *
     * ### Response Format
     *
     * Returns [BeatmapScores](#beatmapscores). `Score` object inside includes `user` and the included `user` includes `country` and `cover`.
     *
     * @urlParam beatmap integer required Id of the [Beatmap](#beatmap).
     *
     * @queryParam mode The [GameMode](#gamemode) to get scores for.
     * @queryParam mods An array of matching Mods, or none // TODO.
     * @queryParam type Beatmap score ranking type // TODO.
     */
    public function soloScores($id)
    {
        $beatmap = Beatmap::findOrFail($id);
        if ($beatmap->approved <= 0) {
            return ['scores' => []];
        }

        $params = get_params(request()->all(), null, [
            'limit:int',
            'mode',
            'mods:string[]',
            'type:string',
        ], ['null_missing' => true]);

        if ($params['mode'] !== null) {
            $rulesetId = Beatmap::MODES[$params['mode']] ?? null;
            if ($rulesetId === null) {
                throw new InvariantException('invalid mode specified');
            }
        }
        $rulesetId ??= $beatmap->playmode;
        $mods = array_values(array_filter($params['mods'] ?? []));
        $type = presence($params['type'], 'global');
        $currentUser = auth()->user();

        $this->assertSupporterOnlyOptions($currentUser, $type, $mods);

        $esFetch = new BeatmapScores([
            'beatmap_ids' => [$beatmap->getKey()],
            'is_legacy' => false,
            'limit' => $params['limit'],
            'mods' => $mods,
            'ruleset_id' => $rulesetId,
            'type' => $type,
            'user' => $currentUser,
        ]);
        $scores = $esFetch->all()->loadMissing(['beatmap', 'performance', 'user.country', 'user.userProfileCustomization']);
        $userScore = $esFetch->userBest();
        $scoreTransformer = new ScoreTransformer(ScoreTransformer::TYPE_SOLO);

        $results = [
            'scores' => json_collection(
                $scores,
                $scoreTransformer,
                static::DEFAULT_SCORE_INCLUDES
            ),
        ];

        if (isset($userScore)) {
            $results['user_score'] = [
                'position' => $esFetch->rank($userScore),
                'score' => json_item($userScore, $scoreTransformer, static::DEFAULT_SCORE_INCLUDES),
            ];
            // TODO: remove this old camelCased json field
            $results['userScore'] = $results['user_score'];
        }

        return $results;
    }

    public function updateOwner($id)
    {
        $beatmap = Beatmap::findOrFail($id);
        $currentUser = auth()->user();

        priv_check('BeatmapUpdateOwner', $beatmap->beatmapset)->ensureCan();

        $newUserId = get_int(request('beatmap.user_id'));

        $beatmap->getConnection()->transaction(function () use ($beatmap, $currentUser, $newUserId) {
            $beatmap->setOwner($newUserId);

            BeatmapsetEvent::log(BeatmapsetEvent::BEATMAP_OWNER_CHANGE, $currentUser, $beatmap->beatmapset, [
                'beatmap_id' => $beatmap->getKey(),
                'beatmap_version' => $beatmap->version,
                'new_user_id' => $beatmap->user_id,
                'new_user_username' => $beatmap->user->username,
            ])->saveOrExplode();
        });

        if ($beatmap->user_id !== $currentUser->getKey()) {
            (new BeatmapOwnerChange($beatmap, $currentUser))->dispatch();
        }

        return $beatmap->beatmapset->defaultDiscussionJson();
    }

    /**
     * Get a User Beatmap score
     *
     * Return a [User](#user)'s score on a Beatmap
     *
     * ---
     *
     * ### Response Format
     *
     * Returns [BeatmapUserScore](#beatmapuserscore)
     *
     * The position returned depends on the requested mode and mods.
     *
     * @urlParam beatmap integer required Id of the [Beatmap](#beatmap).
     * @urlParam user integer required Id of the [User](#user).
     *
     * @queryParam mode The [GameMode](#gamemode) to get scores for.
     * @queryParam mods An array of matching Mods, or none // TODO.
     */
    public function userScore($beatmapId, $userId)
    {
        $beatmap = Beatmap::scoreable()->findOrFail($beatmapId);

        $params = get_params(request()->all(), null, [
            'mode:string',
            'mods:string[]',
        ]);

        $mode = presence($params['mode'] ?? null, $beatmap->mode);
        $mods = array_values(array_filter($params['mods'] ?? []));

        $score = static::baseScoreQuery($beatmap, $mode, $mods)
            ->visibleUsers()
            ->where('user_id', $userId)
            ->firstOrFail();

        return [
            'position' => $score->userRank(compact('mods')),
            'score' => json_item(
                $score,
                new ScoreTransformer(),
                ['beatmap', ...static::DEFAULT_SCORE_INCLUDES]
            ),
        ];
    }

    /**
     * Get a User Beatmap scores
     *
     * Return a [User](#user)'s scores on a Beatmap
     *
     * ---
     *
     * ### Response Format
     *
     * Field  | Type
     * ------ | ----
     * scores | [Score](#score)[]
     *
     * @urlParam beatmap integer required Id of the [Beatmap](#beatmap).
     * @urlParam user integer required Id of the [User](#user).
     *
     * @queryParam mode The [GameMode](#gamemode) to get scores for. Defaults to beatmap mode
     */
    public function userScoreAll($beatmapId, $userId)
    {
        $beatmap = Beatmap::scoreable()->findOrFail($beatmapId);
        $mode = presence(get_string(request('mode'))) ?? $beatmap->mode;
        $scores = BestModel::getClass($mode)
            ::default()
            ->where([
                'beatmap_id' => $beatmap->getKey(),
                'user_id' => $userId,
            ])->get();

        return [
            'scores' => json_collection($scores, new ScoreTransformer()),
        ];
    }

    private static function baseScoreQuery(Beatmap $beatmap, $mode, $mods, $type = null)
    {
        $query = BestModel::getClass($mode)
            ::default()
            ->where('beatmap_id', $beatmap->getKey())
            ->with(['beatmap', 'user.country', 'user.userProfileCustomization'])
            ->withMods($mods);

        if ($type !== null) {
            $query->withType($type, ['user' => auth()->user()]);
        }

        return $query;
    }

    private function assertSupporterOnlyOptions(?User $currentUser, string $type, array $mods): void
    {
        $isSupporter = $currentUser?->isSupporter() ?? false;
        if ($type !== 'global' && !$isSupporter) {
            throw new InvariantException(osu_trans('errors.supporter_only'));
        }
        if (!empty($mods) && !is_api_request() && !$isSupporter) {
            throw new InvariantException(osu_trans('errors.supporter_only'));
        }
    }
}
