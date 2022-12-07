<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models\Store;

use JsonSerializable;

class ExtraDataTournamentBanner extends ExtraDataBase implements JsonSerializable
{
    public string $countryAcronym;
    public int $tournamentId;
    public ?string $type;

    public function __construct(array $data)
    {
        $this->tournamentId = get_int($data['tournament_id']);
        $this->countryAcronym = $data['cc'];
        // TODO: temporarily allow null to handle existing data
        $this->type = $data['type'] ?? null;
    }

    public function jsonSerialize(): array
    {
        return [
            'cc' => $this->countryAcronym,
            'tournament_id' => $this->tournamentId,
            'type' => $this->type,
        ];
    }
}
