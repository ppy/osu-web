<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models\Store;

use App\Exceptions\InvariantException;
use App\Models\SupporterTag;
use App\Models\User;
use JsonSerializable;

class ExtraDataSupporterTag extends ExtraDataBase implements JsonSerializable
{
    const MAX_MESSAGE_LENGTH = 100;
    const TYPE = Product::SUPPORTER_TAG_NAME;

    public int $duration;
    public bool $hidden;
    public ?string $message;
    public int $targetId;
    public string $username;

    public static function fromOrderItemParams(array $orderItemParams, User $user)
    {
        $params = get_params($orderItemParams, 'extra_data', [
            'message',
            'target_id:int',
        ], ['null_missing' => true]);

        $targetId = $params['target_id'];
        // Allow restricted users if it's themselves.
        if ($targetId === $user->getKey()) {
            $params['message'] = null;
            $params['username'] = $user->username;
        } else {
            $user = User::default()->where('user_id', $targetId)->firstOrFail();
            $params['username'] = $user->username;

            // fun
            if ($params['message'] !== null) {
                $params['message'] = unzalgo(trim(str_replace("\r\n", "\n", $params['message'])));
                if (mb_strlen($params['message']) > static::MAX_MESSAGE_LENGTH) {
                    throw new InvariantException('message is too long');
                }

                $params['message'] = presence($params['message']);
            }
        }

        $params['duration'] = SupporterTag::getDuration($orderItemParams['cost']);

        return new static($params);
    }

    public function __construct(array $data)
    {
        $this->duration = get_int($data['duration']);
        $this->hidden = $data['hidden'] ?? false;
        $this->message = $data['message'] ?? null;
        $this->targetId = get_int($data['target_id']);
        $this->username = $data['username'];
    }

    public function jsonSerialize(): array
    {
        return array_merge(parent::jsonSerialize(), [
            'duration' => $this->duration,
            'hidden' => $this->hidden,
            'message' => $this->message,
            'target_id' => $this->targetId,
            'username' => $this->username,
        ]);
    }
}
