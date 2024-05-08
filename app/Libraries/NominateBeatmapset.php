<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries;

// use App\Enums\Ruleset;
use App\Exceptions\InvariantException;
use App\Jobs\Notifications\BeatmapsetNominate;
use App\Models\Beatmap;
use App\Models\Beatmapset;
use App\Models\BeatmapsetEvent;
use App\Models\User;
use Ds\Set;

class NominateBeatmapset
{
    /** @var Set<int> */
    private Set $beatmapRulesetIds;
    /** @var Set<int|null> */
    private Set $nominatedRulesetIds;

    public function __construct(private Beatmapset $beatmapset, private User $user, array $playmodes)
    {
        $this->beatmapRulesetIds = new Set($beatmapset->playmodes()->toArray());
        $this->nominatedRulesetIds = new Set(array_map(fn (string $name) => Beatmap::MODES[$name] ?? null, $playmodes));
    }

    public static function requiredNominationsConfig()
    {
        return [
            'main_ruleset' => $GLOBALS['cfg']['osu']['beatmapset']['required_nominations'],
            'non_main_ruleset' => 1,
        ];
    }

    private static function nominationCount(array $nominationsByType, string $type, ?string $mode): int
    {
        return count(array_filter($nominationsByType[$type], fn ($item) => $item === $mode));
    }

    public function handle()
    {
        $this->beatmapset->resetMemoized(); // ensure we're not using cached/stale event data

        $this->assertValidState();

        if ($this->beatmapset->isLegacyNominationMode()) {
            throw new InvariantException();
        }

        $eventParams = $this->nominateRulesets();

        $nomination = $this->beatmapset->beatmapsetNominations()->current()->where('user_id', $this->user->getKey());
        if (!$nomination->exists()) {
            $this->beatmapset->getConnection()->transaction(function () use ($eventParams) {
                $event = $this->beatmapset->events()->create($eventParams);
                $this->beatmapset->beatmapsetNominations()->create([
                    'event_id' => $event->getKey(),
                    'modes' => $eventParams['comment']['modes'] ?? null,
                    'user_id' => $this->user->getKey(),
                ]);

                if ($this->shouldQualify()) {
                    $beatmapset = $this->beatmapset->lockForUpdate()->find($this->beatmapset->getKey());
                    // Sanity check: something changed main ruleset after the qualify check.
                    if (
                        $beatmapset->eligible_main_rulesets === null
                            || count($beatmapset->eligible_main_rulesets) !== 1
                            || $beatmapset->eligible_main_rulesets[0] !== $this->beatmapset->mainRulesetId()
                    ) {
                        throw new InvariantException('main ruleset has changed.');
                    }

                    $beatmapset->qualify($this->user);
                } else {
                    (new BeatmapsetNominate($this->beatmapset, $this->user))->dispatch();
                }
            });
        }

        $this->beatmapset->refresh();
        $this->beatmapset->refreshCache();
    }

    private function assertValidState(): void
    {
        if (!$this->beatmapset->isPending()) {
            throw new InvariantException(osu_trans('beatmaps.nominations.incorrect_state'));
        }

        if ($this->beatmapset->hype < $this->beatmapset->requiredHype()) {
            throw new InvariantException(osu_trans('beatmaps.nominations.not_enough_hype'));
        }

        // check if there are any outstanding issues still
        if ($this->beatmapset->beatmapDiscussions()->openIssues()->count() > 0) {
            throw new InvariantException(osu_trans('beatmaps.nominations.unresolved_issues'));
        }
    }

    private function nominateRulesets(): array
    {
        $rulesetIds = $this->beatmapRulesetIds->intersect($this->nominatedRulesetIds);
        if ($rulesetIds->count() === 0) {
            throw new InvariantException(osu_trans('beatmapsets.nominate.hybrid_requires_modes'));
        }

        // Only one ruleset is allowed to have more than one nomination.
        // This needs to be enforced for Beatmapset::mainRulesetId()
        $nominationCount = $this->beatmapset->currentNominationCount();

        // add potential counts
        foreach ($rulesetIds as $rulesetId) {
            $nominationCount[Beatmap::modeStr($rulesetId)]++;
        }

        $eligibleRulesetIds = (new BeatmapsetMainRuleset($this->beatmapset))->currentEligible();

        $maybeHasMainRuleset = false;
        foreach ($nominationCount as $name => $count) {
            if ($count > 1) {
                if ($maybeHasMainRuleset || !$eligibleRulesetIds->contains(Beatmap::modeInt($name))) {
                    throw new InvariantException(osu_trans('beatmapsets.nominate.too_many_non_main_ruleset'));
                }

                $maybeHasMainRuleset = true;
            }
        }

        foreach ($rulesetIds as $rulesetId) {
            $name = Beatmap::modeStr($rulesetId);
            if (!$this->user->isFullBN($name) && !$this->user->isNAT($name)) {
                if (!$this->user->isLimitedBN($name)) {
                    throw new InvariantException(osu_trans('beatmapsets.nominate.incorrect_mode', ['mode' => $name]));
                }

                if ($this->beatmapset->requiresFullBNNomination($name)) {
                    throw new InvariantException(osu_trans('beatmapsets.nominate.full_bn_required'));
                }
            }
        }

        return [
            'comment' => ['modes' => array_map(fn ($rulesetId) => Beatmap::modeStr($rulesetId), $rulesetIds->toArray())],
            'type' => BeatmapsetEvent::NOMINATE,
            'user_id' => $this->user->getKey(),
        ];
    }

    private function shouldQualify(): bool
    {
        $mainRulesetId = $this->beatmapset->mainRulesetId();
        if ($mainRulesetId === null) {
            return false;
        }

        $nominationsByType = $this->beatmapset->nominationsByType();
        $requiredNominations = $this->beatmapset->requiredNominationCount();

        $modesSatisfied = 0;
        foreach ($requiredNominations as $mode => $count) {
            $fullNominations = static::nominationCount($nominationsByType, 'full', $mode);
            $limitedNominations = static::nominationCount($nominationsByType, 'limited', $mode);
            $totalNominations = $fullNominations + $limitedNominations;

            // Prevent maps with invalid nomination state from going into qualified.
            if (Beatmap::modeInt($mode) !== $mainRulesetId && $limitedNominations > 0) {
                throw new InvariantException(osu_trans('beatmapsets.nominate.invalid_limited_nomination'));
            }

            if ($totalNominations > $count) {
                throw new InvariantException(osu_trans('beatmapsets.nominate.too_many'));
            }

            if ($fullNominations === 0) {
                return false;
            }

            if ($totalNominations === $count) {
                $modesSatisfied++;
            }
        }

        return $modesSatisfied >= $this->beatmapset->playmodeCount();
    }
}
