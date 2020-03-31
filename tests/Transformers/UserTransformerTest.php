<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Transformers;

use App\Models\User;
use App\Transformers\UserTransformer;
use Laravel\Passport\Passport;
use Tests\TestCase;

class UserTransformerTest extends TestCase
{
    /**
     * @dataProvider propertyPermissionsDataProvider
     */
    public function testPropertyIsNotVisibleWithOAuth(string $property)
    {
        $viewer = $this->createUserWithGroup([]);

        $this->actAsScopedUser($viewer);

        $json = json_item($viewer, 'User', [$property]);
        $this->assertArrayNotHasKey($property, $json);
    }

    /**
     * @dataProvider propertyPermissionsDataProvider
     */
    public function testPropertyIsVisibleWithoutOAuth(string $property)
    {
        $viewer = $this->createUserWithGroup([]);

        $this->actAsUser($viewer);

        $json = json_item($viewer, 'User', [$property]);
        $this->assertArrayHasKey($property, $json);
    }

    public function propertyPermissionsDataProvider()
    {
        $data = [];
        $transformer = new UserTransformer;
        foreach ($transformer->getPermissions() as $property => $permission) {
            if ($permission === 'IsNotOAuth') {
                $data[] = [$property];
            }
        }

        return $data;
    }
}
