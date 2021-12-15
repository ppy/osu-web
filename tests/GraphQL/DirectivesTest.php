<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\GraphQL;

use App\Models\User;
use GraphQL\Validator\Rules\QueryComplexity;
use Nuwave\Lighthouse\Testing\MakesGraphQLRequests;
use Nuwave\Lighthouse\Testing\MocksResolvers;
use Nuwave\Lighthouse\Testing\UsesTestSchema;
use Tests\TestCase;

class DirectivesTest extends TestCase
{
    use MakesGraphQLRequests;
    use MocksResolvers;
    use UsesTestSchema;

    protected $viewer;

    protected function setUp(): void
    {
        parent::setUp();
        config()->set('lighthouse.cache.enable', false);
        $this->setUpTestSchema();
        $this->viewer = User::factory()->create();
    }

    public function testCostDirective(): void
    {
        config()->set('lighthouse.security.max_query_complexity', 1);

        $this->schema = /** @lang GraphQL */ '
        enum Animal {
            dog
            cat
        }
        type Object {
            str2: String
            enum: Animal
        }
        type Query {
            str1: String @cost(complexity: 5)
            obj: Object
        }
        ';

        $this->graphQL(/** @lang GraphQL */ '
        {
            str1
        }
        ')->assertGraphQLErrorMessage(QueryComplexity::maxQueryComplexityErrorMessage(1, 5));

        $this->graphQL(/** @lang GraphQL */ '
        {
            obj {
                str2
                enum
            }
        }
        ')->assertGraphQLErrorMessage(QueryComplexity::maxQueryComplexityErrorMessage(1, 4));
    }

    public function testOauthDirective(): void
    {
        $this->mockResolver('bar');
        $this->schema = /** @lang GraphQL */ '
        type Query {
            foo: String @oauth @mock
        }
        ';

        // Test without auth
        $this->graphQL(/** @lang GraphQL */ '
        {
            foo
        }
        ')
            ->assertJsonCount(1, 'errors')
            ->assertJsonPath('errors.0.extensions.code', 'AUTH_UNAUTHENTICATED');

        // Test with auth
        $this->actAsScopedUser($this->viewer);
        $this->graphQL(/** @lang GraphQL */ '
        {
            foo
        }
        ')->assertJsonPath('data.foo', 'bar');
    }

    public function testRestrictScopes(): void
    {
        $this->mockResolver('bar');
        $this->schema = /** @lang GraphQL */ '
        type Query {
            foo: String! @restrict(scopes: ["fakeScope1", "fakeScope2"]) @mock
        }
        ';

        // Test without scope
        $this->actAsScopedUser($this->viewer, ['fakeFakeScope']);
        $this->graphQL(/** @lang GraphQL */ '
        {
            foo
        }
        ')
            ->assertJsonCount(1, 'errors')
            ->assertJsonPath('errors.0.extensions.code', 'AUTH_MISSING_SCOPES')
            ->assertJsonPath('errors.0.extensions.missingScopes', ['fakeScope1', 'fakeScope2']);

        // Test with one scope
        $this->actAsScopedUser($this->viewer, ['fakeScope1']);
        $this->graphQL(/** @lang GraphQL */ '
        {
            foo
        }
        ')
            ->assertJsonCount(1, 'errors')
            ->assertJsonPath('errors.0.extensions.code', 'AUTH_MISSING_SCOPES')
            ->assertJsonPath('errors.0.extensions.missingScopes', ['fakeScope2']);

        // Test with both scopes
        $this->actAsScopedUser($this->viewer, ['fakeScope1', 'fakeScope2']);
        $this->graphQL(/** @lang GraphQL */ '
        {
            foo
        }
        ')->assertJsonPath('data.foo', 'bar');
    }

    public function testRestrictUser(): void
    {
        $user = User::factory()->create();
        $this->mockResolver($user);
        $this->schema = /** @lang GraphQL */ '
        type User {
            user_id: Int! @restrict(isCurrentUser: true)
        }
        type Query {
            user: User! @mock
        }
        ';

        // Test as non-user
        $this->actAsScopedUser($this->viewer);
        $this->graphQL(/** @lang GraphQL */ '
        {
            user {
                user_id
            }
        }
        ')
            ->assertJsonCount(1, 'errors')
            ->assertJsonPath('errors.0.extensions.code', 'AUTH_UNAUTHORIZED');

        // Test as user
        $this->actAsScopedUser($user);
        $this->graphQL(/** @lang GraphQL */ '
        {
            user {
                user_id
            }
        }
        ')->assertJsonPath('data.user.user_id', $user->user_id);
    }

    public function testRestrictSupporterRequirement(): void
    {
        $userNoSupporter = User::factory()->create();
        $userWithSupporter = User::factory()->create([ 'osu_subscriber' => true ]);

        $this->mockResolver('bar');
        $this->schema = /** @lang GraphQL */ '
        type Query {
            foo: String! @restrict(requiresSupporter: true) @mock
        }
        ';

        // Test as user with no supporter
        $this->actAsScopedUser($userNoSupporter);
        $this->graphQL(/** @lang GraphQL */ '
        {
            foo
        }
        ')
            ->assertJsonCount(1, 'errors')
            ->assertJsonPath('errors.0.extensions.code', 'AUTH_SUPPORTER_REQUIRED');

        // Test as user with supporter
        $this->actAsScopedUser($userWithSupporter);
        $this->graphQL(/** @lang GraphQL */ '
        {
            foo
        }
        ')->assertJsonPath('data.foo', 'bar');
    }
}
