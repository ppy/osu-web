<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\Beatmapset;

use App\Exceptions\InvariantException;
use App\Exceptions\UnsupportedNominationException;
use App\Jobs\Notifications\BeatmapsetNominate;
use App\Models\Beatmapset;
use App\Models\BeatmapsetEvent;
use App\Models\User;
use Ds\Set;

class NominateBeatmapset
{
    /** @var Set<string> */
    private Set $beatmapRulesets;

    /** @var Set<string> */
    private Set $nominatedRulesets;

    public function __construct(private Beatmapset $beatmapset, private User $user, array $rulesets)
    {
        if ($this->beatmapset->isLegacyNominationMode()) {
            throw new UnsupportedNominationException();
        }

        $this->beatmapRulesets = new Set($beatmapset->playmodesStr());
        $this->nominatedRulesets = new Set($rulesets);

        if ($this->beatmapRulesets->intersect($this->nominatedRulesets)->count() === 0) {
            throw new InvariantException(osu_trans('beatmapsets.nominate.hybrid_requires_modes'));
        }

        if ($this->nominatedRulesets->diff($this->beatmapRulesets)->count() > 0) {
            throw new InvariantException(osu_trans('beatmapsets.nominate.invalid_ruleset'));
        }
    }

    public static function requiredNominationsConfig()
    {
        static $config = [
            'main_ruleset' => $GLOBALS['cfg']['osu']['beatmapset']['required_nominations'],
            'non_main_ruleset' => 1, // js-side DiscussionsState assumes this is 1.
        ];

        return $config;
    }

    private static function nominationCount(array $nominationsByType, string $type, string $ruleset): int
    {
        return count(array_filter($nominationsByType[$type], fn ($item) => $item === $ruleset));
    }

    public function handle()
    {
        $this->assertValidState();
        $this->assertRulesetNomination();

        $nomination = $this->beatmapset->beatmapsetNominations()->current()->where('user_id', $this->user->getKey());
        if (!$nomination->exists()) {
            $this->beatmapset->getConnection()->transaction(function () {
                $modes = array_filter($this->user->nominationModes(), fn ($ruleset) => $this->nominatedRulesets->contains($ruleset), ARRAY_FILTER_USE_KEY);

                $eventParams = [
                    'comment' => ['modes' => array_keys($modes)],
                    'type' => BeatmapsetEvent::NOMINATE,
                    'user_id' => $this->user->getKey(),
                ];

                $event = $this->beatmapset->events()->create($eventParams);
                $this->beatmapset->beatmapsetNominations()->create([
                    'event_id' => $event->getKey(),
                    'modes' => $modes,
                    'user_id' => $this->user->getKey(),
                ]);

                $this->beatmapset->refreshCache(true);

                if ($this->shouldQualify()) {
                    $beatmapset = $this->beatmapset->lockForUpdate()->find($this->beatmapset->getKey());
                    // Sanity check: something changed main ruleset after the qualify check.
                    if (
                        $beatmapset->eligible_main_rulesets === null
                            || count($beatmapset->eligible_main_rulesets) !== 1
                            || $beatmapset->eligible_main_rulesets[0] !== $this->beatmapset->mainRuleset()
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

    private function assertRulesetNomination()
    {
        // NOTE: This assumption is only valid for the current nomination rules. (see requiredNominationsConfig)
        // LimitedBNs cannot be the only nominator for a non-main ruleset and since they only require 1 nomination,
        // it implies LimitedBNs can only nominate one ruleset (effectively the main).
        if ($this->user->isLimitedBN() && $this->nominatedRulesets->count() > 1) {
            throw new InvariantException(osu_trans('beatmapsets.nominate.bng_limited_too_many_rulesets'));
        }

        // Only one ruleset is allowed to have more than one nomination.
        // This needs to be enforced for Beatmapset::mainRuleset()
        $nominationCount = $this->beatmapset->currentNominationCount();

        // add potential counts
        foreach ($this->nominatedRulesets as $ruleset) {
            $nominationCount[$ruleset]++;
        }

        $eligibleRulesets = (new BeatmapsetMainRuleset($this->beatmapset))->currentEligible();

        // assert counts
        $mainRuleset = $eligibleRulesets->count() === 1 ? $eligibleRulesets->first() : null;
        $config = static::requiredNominationsConfig();

        foreach ($nominationCount as $ruleset => $count) {
            if ($mainRuleset === $ruleset) {
                continue;
            }

            if ($count > $config['non_main_ruleset']) {
                if ($mainRuleset !== null || !$eligibleRulesets->contains($ruleset)) {
                    throw new InvariantException(osu_trans('beatmapsets.nominate.too_many_non_main_ruleset'));
                }

                $mainRuleset = $ruleset;
            }
        }

        $nominationsByType = $this->beatmapset->nominationsByType();

        // assert rulesets have correct nominators
        foreach ($this->nominatedRulesets as $ruleset) {
            if (!$this->user->isFullBN($ruleset) && !$this->user->isNAT($ruleset)) {
                if (!$this->user->isLimitedBN($ruleset)) {
                    throw new InvariantException(osu_trans('beatmapsets.nominate.incorrect_mode', ['mode' => $ruleset]));
                }

                if ($mainRuleset !== null) {
                    $requiredCount = $mainRuleset === $ruleset ? $config['main_ruleset'] : $config['non_main_ruleset'];
                    if (
                        $nominationCount[$ruleset] >= $requiredCount
                        && (static::nominationCount($nominationsByType, 'full', $ruleset) === 0)
                    ) {
                        throw new InvariantException(osu_trans('beatmapsets.nominate.full_nomination_required'));
                    }
                }
            }
        }
    }

    private function shouldQualify(): bool
    {
        $mainRuleset = $this->beatmapset->mainRuleset();

        if ($mainRuleset === null) {
            return false;
        }

        $requiredNominationsConfig = static::requiredNominationsConfig();
        $nominationsByType = $this->beatmapset->nominationsByType();

        $rulesetsSatisfied = 0;
        foreach ($this->beatmapset->playmodesStr() as $ruleset) {
            $requiredCount = $ruleset === $mainRuleset
                ? $requiredNominationsConfig['main_ruleset']
                : $requiredNominationsConfig['non_main_ruleset'];

            $fullNominations = static::nominationCount($nominationsByType, 'full', $ruleset);
            $limitedNominations = static::nominationCount($nominationsByType, 'limited', $ruleset);
            $totalNominations = $fullNominations + $limitedNominations;

            // Prevent maps with invalid nomination state from going into qualified.
            if ($ruleset !== $mainRuleset && $limitedNominations > 0) {
                throw new InvariantException(osu_trans('beatmapsets.nominate.invalid_limited_nomination'));
            }

            if ($totalNominations > $requiredCount) {
                throw new InvariantException(osu_trans('beatmapsets.nominate.too_many'));
            }

            if ($fullNominations === 0) {
                return false;
            }

            if ($totalNominations === $requiredCount) {
                $rulesetsSatisfied++;
            }
        }

        return $rulesetsSatisfied >= $this->beatmapset->playmodeCount();
    }
}
