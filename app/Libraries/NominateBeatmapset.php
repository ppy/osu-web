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
        $this->nominatedRulesets = new Set(Ruleset::tryFromNames($playmodes));
    }

    private static function nominationCount(array $nominationsByType, string $type, ?string $mode): int
    {
        return count(array_filter($nominationsByType[$type], fn ($item) => $item === $mode));
    }


    public function handle()
    {
        $this->beatmapset->resetMemoized(); // ensure we're not using cached/stale event data

        $this->assertValidState();

        $this->isLegacyNominationMode = $this->beatmapset->isLegacyNominationMode();

        if ($this->isLegacyNominationMode) {
            $eventParams = $this->nominateLegacy();
        } else {
            $eventParams = $this->nominateRulesets();
        }

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
                    $this->beatmapset->lockForUpdate()->find($this->beatmapset->getKey())->qualify($this->user);
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

    private function nominateLegacy(): array
    {
        // in legacy mode, we check if a user can nominate for _any_ of the beatmapset's playmodes
        $canNominate = false;
        $canFullNominate = false;
        $playmodesStr = $this->beatmapset->playmodesStr();

        foreach ($playmodesStr as $mode) {
            if ($this->user->isFullBN($mode) || $this->user->isNAT($mode)) {
                $canNominate = true;
                $canFullNominate = true;
                break;
            } else if ($this->user->isLimitedBN($mode)) {
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

        return [
            'type' => BeatmapsetEvent::NOMINATE,
            'user_id' => $this->user->getKey(),
        ];
    }

    private function nominateRulesets(): array
    {
        $rulesets = $this->beatmapRulesets->intersect($this->nominatedRulesets);
        if ($rulesets->count() === 0) {
            throw new InvariantException(osu_trans('beatmapsets.nominate.hybrid_requires_modes'));
        }

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

        return [
            'comment' => ['modes' => array_map(fn ($ruleset) => $ruleset->legacyName(), $rulesets->toArray())],
            'type' => BeatmapsetEvent::NOMINATE,
            'user_id' => $this->user->getKey(),
        ];
    }

    private function shouldQualify(): bool
    {
        $nominationsByType = $this->beatmapset->nominationsByType();
        $requiredNominations = $this->beatmapset->requiredNominationCount();

        if ($this->isLegacyNominationMode) {
            return static::nominationCount($nominationsByType, 'full', null)
                + static::nominationCount($nominationsByType, 'limited', null)
                >= $requiredNominations;
        } else {
            $modesSatisfied = 0;
            foreach ($requiredNominations as $mode => $count) {
                $fullNominations = static::nominationCount($nominationsByType, 'full', $mode);
                $limitedNominations = static::nominationCount($nominationsByType, 'limited', $mode);
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
