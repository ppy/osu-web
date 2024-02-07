<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries;

use App\Enums\Ruleset;
use App\Exceptions\InvariantException;
use App\Jobs\Notifications\BeatmapsetNominate;
use App\Models\Beatmapset;
use App\Models\BeatmapsetEvent;
use App\Models\User;
use Ds\Set;

class NominateBeatmapset
{
    private bool $isLegacyNominationMode;

    /** @var Set<Ruleset> */
    private Set $beatmapRulesets;
    /** @var Set<Ruleset|null> */
    private Set $nominatedRulesets;

    public function __construct(private Beatmapset $beatmapset, private User $user, array $playmodes)
    {
        $this->beatmapRulesets = new Set(array_map(fn ($playmode) => Ruleset::from($playmode), $beatmapset->playmodes()->toArray()));
        $this->nominatedRulesets = new Set(array_map(fn ($playmode) => Ruleset::tryFromName($playmode), $playmodes));
    }

    public function handle()
    {
        $this->beatmapset->resetMemoized(); // ensure we're not using cached/stale event data

        $this->assertValidState();

        $this->isLegacyNominationMode = $this->beatmapset->isLegacyNominationMode();

        $playmodes = [];

        if ($this->isLegacyNominationMode) {
            $this->nominateLegacy($this->user);
        } else {
            $rulesets = $this->beatmapRulesets->intersect($this->nominatedRulesets);
            if ($rulesets->count() === 0) {
                throw new InvariantException(osu_trans('beatmapsets.nominate.hybrid_requires_modes'));
            }

            // for the event
            $playmodes = array_map(fn ($ruleset) => $ruleset->legacyName(), $rulesets->toArray());

            foreach ($rulesets as $ruleset) {
                $name = $ruleset->legacyName();
                if (!$this->user->isFullBN($name) && !$this->user->isNAT($name)) {
                    if (!$this->user->isLimitedBN($name)) {
                        throw new InvariantException(osu_trans('beatmapsets.nominate.incorrect_mode', ['mode' => $name]));
                    }

                    if ($this->beatmapset->requiresFullBNNomination($name)) {
                        throw new InvariantException(osu_trans('beatmapsets.nominate.full_bn_required'));
                    }
                }
            }
        }

        $nomination = $this->beatmapset->beatmapsetNominations()->current()->where('user_id', $this->user->getKey());
        if (!$nomination->exists()) {
            $this->beatmapset->getConnection()->transaction(function () use ($playmodes) {
                $eventParams = [
                    'type' => BeatmapsetEvent::NOMINATE,
                    'user_id' => $this->user->getKey(),
                ];
                if (!$this->isLegacyNominationMode) {
                    $eventParams['comment'] = ['modes' => $playmodes];
                }

                $event = $this->beatmapset->events()->create($eventParams);
                $this->beatmapset->beatmapsetNominations()->create([
                    'event_id' => $event->getKey(),
                    'modes' => $this->isLegacyNominationMode ? null : $playmodes,
                    'user_id' => $this->user->getKey(),
                ]);

                if ($this->shouldQualify()) {
                    $this->beatmapset->lockForUpdate()->find($this->beatmapset->getKey())->qualify($this->user);
                } else {
                    (new BeatmapsetNominate($this->beatmapset, $this->user))->dispatch();
                }
            });
        }

        $this->beatmapset->refresh();
        $this->beatmapset->refreshCache();
    }

    private function assertValidState()
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

    private function nominateLegacy(User $user)
    {
        // in legacy mode, we check if a user can nominate for _any_ of the beatmapset's playmodes
        $canNominate = false;
        $canFullNominate = false;
        $playmodesStr = $this->beatmapset->playmodesStr();

        foreach ($playmodesStr as $mode) {
            if ($user->isFullBN($mode) || $user->isNAT($mode)) {
                $canNominate = true;
                $canFullNominate = true;
                break;
            } else if ($user->isLimitedBN($mode)) {
                $canNominate = true;
                break;
            }
        }

        if (!$canNominate) {
            throw new InvariantException(osu_trans('beatmapsets.nominate.incorrect_mode', ['mode' => implode(', ', $playmodesStr)]));
        }

        if (!$canFullNominate && $this->beatmapset->requiresFullBNNomination()) {
            throw new InvariantException(osu_trans('beatmapsets.nominate.full_bn_required'));
        }
    }

    private function shouldQualify()
    {
        $nominationsByType = $this->beatmapset->nominationsByType();
        $requiredNominations = $this->beatmapset->requiredNominationCount();

        if ($this->isLegacyNominationMode) {
            return count(array_filter($nominationsByType['full'], fn ($item) => $item === null))
                + count(array_filter($nominationsByType['limited'], fn ($item) => $item === null))
                >= $requiredNominations;
        } else {
            $modesSatisfied = 0;
            foreach ($requiredNominations as $mode => $count) {
                $fullNominations = count(array_filter($nominationsByType['full'], fn ($item) => $item === $mode));
                $limitedNominations = count(array_filter($nominationsByType['limited'], fn ($item) => $item === $mode));
                $totalNominations = $fullNominations + $limitedNominations;

                if ($fullNominations === 0) {
                    return false;
                }

                if ($totalNominations > $count) {
                    throw new InvariantException(osu_trans('beatmaps.nominations.too_many'));
                }

                if ($totalNominations === $count) {
                    $modesSatisfied++;
                }
            }

            return $modesSatisfied >= $this->beatmapset->playmodeCount();
        }
    }
}
