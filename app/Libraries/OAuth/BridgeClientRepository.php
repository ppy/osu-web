<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\OAuth;

use Laravel\Passport\Bridge\ClientRepository as BaseClientRepository;

class BridgeClientRepository extends BaseClientRepository
{
    #[\Override]
    public function validateClient(string $clientIdentifier, ?string $clientSecret, ?string $grantType): bool
    {
        $record = $this->clients->findActive($clientIdentifier);

        return $record !== null && hash_equals($record->secret, $clientSecret ?? '');
    }
}
