<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\Search;

use App\Libraries\Elasticsearch\SearchParams;
use App\Libraries\Elasticsearch\Sort;
use App\Models\Solo\Score;
use App\Models\User;

class ScoreSearchParams extends SearchParams
{
    const VALID_TYPES = ['global', 'country', 'friend'];
    const DEFAULT_TYPE = 'global';

    public static function fromArray(array $rawParams): static
    {
        $params = new static();
        $params->beatmapIds = $rawParams['beatmap_ids'] ?? null;
        $params->excludeMods = $rawParams['exclude_mods'] ?? null;
        $params->isLegacy = $rawParams['is_legacy'] ?? null;
        $params->mods = $rawParams['mods'] ?? null;
        $params->rulesetId = $rawParams['ruleset_id'] ?? null;
        $params->userId = $rawParams['user_id'] ?? null;

        $params->setCountryCode($rawParams['country_code'] ?? null);
        $params->setType($rawParams['type'] ?? null);

        $params->beforeScore = $rawParams['before_score'] ?? null;
        $params->beforeTotalScore = $rawParams['before_total_score'] ?? null;
        $params->size = $rawParams['limit'] ?? $params->size;
        $params->user = $rawParams['user'] ?? null;
        $params->setSort($rawParams['sort'] ?? null);

        return $params;
    }

    public ?array $beatmapIds = null;
    public ?Score $beforeScore = null;
    public ?int $beforeTotalScore = null;
    public ?array $excludeMods = null;
    public ?bool $isLegacy = null;
    public ?array $mods = null;
    public ?int $rulesetId = null;
    public $size = 50;
    public ?User $user = null;
    public ?int $userId = null;

    private ?string $countryCode = null;
    private string $type = self::DEFAULT_TYPE;

    public function getCountryCode(): string
    {
        return $this->countryCode ?? $this->user->country_acronym;
    }

    public function getFriendIds(): array
    {
        return [...$this->user->friends()->allRelatedIds(), $this->user->getKey()];
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function isCacheable(): bool
    {
        return false;
    }

    public function setCountryCode(?string $countryCode): void
    {
        $this->countryCode = $countryCode;
    }

    public function setSort(?string $sort): void
    {
        switch ($sort) {
            case 'score_desc':
                $this->sorts = [
                    new Sort('total_score', 'desc'),
                    new Sort('id', 'asc'),
                ];
                break;
            case null:
                $this->sorts = [];
                break;
        }
    }

    public function setType(?string $type): void
    {
        if (in_array($type, static::VALID_TYPES, true)) {
            $this->type = $type;
        }
    }
}
