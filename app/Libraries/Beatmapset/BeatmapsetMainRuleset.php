<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\Beatmapset;

use App\Models\Beatmap;
use App\Models\Beatmapset;
use Ds\Set;

class BeatmapsetMainRuleset
{
    /** @var ?Set<string> $eligibleRulesets */
    private ?Set $eligibleRulesets = null;

    public function __construct(private Beatmapset $beatmapset)
    {
        $values = $beatmapset->eligible_main_rulesets;

        if ($values !== null) {
            $this->eligibleRulesets = new Set($values);
        } else {
            $this->populateEligibleRulesets();
        }
    }

    /**
     * Gets all the Rulesets that are eligible to be the main ruleset.
     * This will additionally query the current beatmapset nominations if necessary.
     *
     * @return Set<string>
     */
    public function currentEligible(): Set
    {
        $mainRuleset = $this->mainRuleset();

        return $mainRuleset === null ? $this->eligibleRulesets : new Set([$mainRuleset]);
    }

    public function currentEligibleSorted(): array
    {
        $array = $this->currentEligible()->toArray();
        sort($array);

        return $array;
    }

    private function baseQuery()
    {
        return $this->beatmapset->beatmaps()
            ->groupBy('playmode')
            ->select('playmode', \DB::raw('count(*) as total'))
            ->orderBy('total', 'desc')
            ->orderBy('playmode', 'asc');
    }

    private function mainRuleset(): ?string
    {
        if ($this->eligibleRulesets->count() === 1) {
            return $this->eligibleRulesets->first();
        }

        // First mode with more nominations that others becomes main mode.
        // Implicity implies that limited BN nominations becomes main mode.
        $nominations = $this->beatmapset->beatmapsetNominations()->current()->orderBy('id', 'asc')->get();
        $nominationsByRuleset = [];

        foreach ($nominations as $nomination) {
            $rulesets = $nomination->modes;
            foreach ($rulesets as $ruleset) {
                if ($this->eligibleRulesets->contains($ruleset)) {
                    $nominationsByRuleset[$ruleset] ??= 0;
                    $nominationsByRuleset[$ruleset]++;
                }
            }

            // bailout as soon as there is a clear winner
            $nominatedRulesetsCount = count($nominationsByRuleset);
            if ($nominatedRulesetsCount === 1) {
                return array_keys($nominationsByRuleset)[0];
            } else if ($nominatedRulesetsCount > 1) {
                arsort($nominationsByRuleset);
                $values = array_values($nominationsByRuleset);
                if ($values[0] > $values[1]) {
                    return array_keys($nominationsByRuleset)[0];
                }
            }
        }

        return null;
    }

    private function populateEligibleRulesets(): void
    {
        $this->eligibleRulesets = new Set();
        $groups = $this->baseQuery()->get()->map->getAttributes();
        $groupsCount = $groups->count();

        // where's the beatmaps???
        if ($groupsCount === 0) {
            return;
        }

        // clear winner in playmode counts exists.
        if ($groups->count() === 1 || $groups[0]['total'] > $groups[1]['total']) {
            $this->eligibleRulesets->add(Beatmap::modeStr($groups[0]['playmode']));

            return;
        }

        // maps by host mapper
        $groupedHostOnly = $this->baseQuery()->where('user_id', $this->beatmapset->user_id)->get()->map->getAttributes();

        // clear mode with most maps by host
        if (
            $groupedHostOnly->count() === 1
                || $groupedHostOnly->count() > 1
                    && $groupedHostOnly[0]['total'] > $groupedHostOnly[1]['total']
        ) {
            $this->eligibleRulesets->add(Beatmap::modeStr($groupedHostOnly[0]['playmode']));

            return;
        }

        // filter out to only modes with same highest counts.
        $this->eligibleRulesets->add(
            ...$groupedHostOnly
                ->filter(fn ($group) => $group['total'] === $groupedHostOnly[0]['total'])
                ->map(fn ($group) => Beatmap::modeStr($group['playmode']))
                ->toArray()
        );
    }
}
