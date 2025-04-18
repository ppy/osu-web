<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\Search;

use App\Libraries\Elasticsearch\SearchParams;
use App\Libraries\Elasticsearch\Sort;
use App\Models\Solo\Score;
use App\Models\User;
use App\Models\UserProfileCustomization;

class ScoreSearchParams extends SearchParams
{
    const DEFAULT_TYPE = 'global';
    const SUPPORTER_TYPES = ['country', 'friend'];
    const VALID_TYPES = ['global', 'country', 'friend', 'team'];

    public ?array $beatmapIds = null;
    public ?Score $beforeScore = null;
    public ?int $beforeTotalScore = null;
    public bool $excludeConverts = false;
    public ?array $excludeMods = null;
    public ?bool $isLegacy = null;
    public bool $excludeWithoutPp = false;
    public ?array $mods = null;
    public ?int $rulesetId = null;
    public $size = 50;
    public ?User $user = null;
    public ?int $userId = null;

    private ?string $countryCode = null;
    private string $type = self::DEFAULT_TYPE;

    public static function fromArray(array $rawParams): static
    {
        $params = new static();
        $params->beatmapIds = $rawParams['beatmap_ids'] ?? null;
        $params->excludeConverts = $rawParams['exclude_converts'] ?? $params->excludeConverts;
        $params->excludeMods = $rawParams['exclude_mods'] ?? null;
        $params->excludeWithoutPp = $rawParams['exclude_without_pp'] ?? $params->excludeWithoutPp;
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

    /**
     * This returns value for isLegacy based on user preference, request type, and `legacy_only` parameter
     */
    public static function showLegacyForUser(
        ?User $user = null,
        ?bool $legacyOnly = null,
        ?bool $isApiRequest = null
    ): null | true {
        $isApiRequest ??= is_api_request();
        // `null` is actual parameter value for the other two parameters so
        // only try filling them up if not passed at all.
        $argLen = func_num_args();
        if ($argLen < 2) {
            $legacyOnly = get_bool(Request('legacy_only'));

            if ($argLen < 1) {
                $user = \Auth::user();
            }
        }

        if ($legacyOnly !== null) {
            return $legacyOnly ? true : null;
        }

        if ($isApiRequest) {
            return null;
        }

        $profileCustomization = UserProfileCustomization::forUser($user);

        return $profileCustomization['legacy_score_only']
            ? true
            : null;
    }

    public function getCountryCode(): string
    {
        return $this->countryCode ?? $this->user->country_acronym;
    }

    public function getFriendIds(): array
    {
        return [...$this->user->friends()->allRelatedIds(), $this->user->getKey()];
    }

    public function getTeamMemberIds(): array
    {
        return $this->user?->team?->members()->pluck('user_id')->all() ?? [];
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
                $sortColumn = $this->isLegacy ? 'legacy_total_score' : 'total_score';
                $this->sorts = [
                    new Sort($sortColumn, 'desc'),
                    new Sort('id', 'asc'),
                ];
                break;
            case 'pp_desc':
                $this->sorts = [
                    new Sort('pp', 'desc'),
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
