<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models\Store;

use JsonSerializable;

class ExtraDataSupporterTag extends ExtraDataBase implements JsonSerializable
{
    const TYPE = 'supporter-tag';

    public int $duration;
    public int $targetId;
    public string $username;

    public function __construct(array $data)
    {
        $this->duration = get_int($data['duration']);
        $this->targetId = get_int($data['target_id']);
        $this->username = $data['username'];
    }

    public function jsonSerialize(): array
    {
        return array_merge(parent::jsonSerialize(), [
            'duration' => $this->duration,
            'target_id' => $this->targetId,
            'username' => $this->username,
        ]);
    }
}
