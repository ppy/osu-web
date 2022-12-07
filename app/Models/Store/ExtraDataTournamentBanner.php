<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models\Store;

use JsonSerializable;

class ExtraDataTournamentBanner extends ExtraDataBase implements JsonSerializable
{
    public ?string $countryAcronym;
    public ?int $tournamentId;

    public function __construct(array $data)
    {
        $this->tournamentId = $data['tournament_id'] ?? null;
        $this->countryAcronym = $data['cc'] ?? null;
    }

    public function jsonSerialize(): array
    {
        return [
            'cc' => $this->countryAcronym,
            'tournament_id' => $this->tournamentId,
        ];
    }
}
