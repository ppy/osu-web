<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\Beatmapset;

use App\Models\Beatmapset;
use Ds\Set;

class BeatmapsetMainRuleset
{
    /** @var ?Set<int> $eligibleRulesets */
    private ?Set $eligibleRulesets = null;

    public function __construct(private Beatmapset $beatmapset)
    {
        $values = $beatmapset->eligible_main_ruleset_ids;

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
     * @return Set<int>
     */
    public function currentEligible(): Set
    {
        $mainRuleset = $this->mainRulesetId();

        return $mainRuleset === null ? $this->eligibleRulesets : new Set([$mainRuleset]);
    }

    private function baseQuery()
    {
        return $this->beatmapset->beatmaps()
            ->groupBy('playmode')
            ->select('playmode', \DB::raw('count(*) as total'))
            ->orderBy('total', 'desc')
            ->orderBy('playmode', 'asc');
    }

    private function mainRulesetId(): ?int
    {
        if ($this->eligibleRulesets->count() === 1) {
            return $this->eligibleRulesets->first();
        }

        // First mode with more nominations that others becomes main mode.
        // Implicity implies that limited BN nominations becomes main mode.
        $nominations = $this->beatmapset->beatmapsetNominations()->current()->get();
        $nominationsByRuleset = [];

        foreach ($nominations as $nomination) {
            $rulesetIds = $nomination->rulesetIds();
            foreach ($rulesetIds as $rulesetId) {
                if ($this->eligibleRulesets->contains($rulesetId)) {
                    $nominationsByRuleset[$rulesetId] ??= 0;
                    $nominationsByRuleset[$rulesetId]++;
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
        $groups = $this->baseQuery()->get();
        $groupsCount = $groups->count();

        // where's the beatmaps???
        if ($groupsCount === 0) {
            return;
        }

        // clear winner in playmode counts exists.
        if ($groups->count() === 1 || $groups[0]->getRawAttribute('total') > $groups[1]->getRawAttribute('total')) {
            $this->eligibleRulesets->add($groups[0]->playmode);

            return;
        }

        // maps by host mapper
        $groupedHostOnly = $this->baseQuery()->where('user_id', $this->beatmapset->user_id)->get();

        // clear mode with most maps by host
        if (
            $groupedHostOnly->count() === 1
                || $groupedHostOnly->count() > 1
                    && $groupedHostOnly[0]->getRawAttribute('total') > $groupedHostOnly[1]->getRawAttribute('total')
        ) {
            $this->eligibleRulesets->add($groupedHostOnly[0]->playmode);

            return;
        }

        // filter out to only modes with same highest counts.
        $this->eligibleRulesets->add(
            ...$groupedHostOnly
                ->filter(fn ($group) => $group->getRawAttribute('total') === $groupedHostOnly[0]->getRawAttribute('total'))
                ->map(fn ($group) => $group->playmode)
                ->toArray()
        );
    }
}
