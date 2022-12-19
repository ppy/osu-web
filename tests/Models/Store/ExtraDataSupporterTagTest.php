<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Models\Store;

use App\Models\Store\ExtraDataSupporterTag;
use App\Models\User;
use Tests\TestCase;

class ExtraDataSupporterTagTest extends TestCase
{
    // This test is because \r\n counts as 1 character for textarea's maxlength
    // but 2 characters for mb_strlen
    public function testMessageHasNewlinesConverted()
    {
        $user = User::factory()->create();
        $target = User::factory()->create();
        $params = [
            'cost' => 4,
            'extra_data' => [
                'target_id' => $target->getKey(),
                'message' => "\r\n\r\nthis\r\nis\r\na\r\nmessage\r\n",
            ],
        ];

        $extraData = ExtraDataSupporterTag::fromOrderItemParams($params, $user);

        $this->assertSame("this\nis\na\nmessage", $extraData->message);
    }

    public function testMessageToSelfAlwaysEmpty()
    {
        $user = User::factory()->create();
        $params = [
            'cost' => 4,
            'extra_data' => [
                'target_id' => $user->getKey(),
                'message' => 'test',
            ],
        ];

        $extraData = ExtraDataSupporterTag::fromOrderItemParams($params, $user);

        $this->assertNull($extraData->message);
    }
}
