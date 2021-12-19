<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\GraphQL;

use App\Models\Beatmap;
use App\Models\Changelog;
use App\Models\Group;
use App\Models\NewsPost;
use App\Models\User;
use GraphQL\Type\Introspection;
use Nuwave\Lighthouse\Testing\ClearsSchemaCache;
use Nuwave\Lighthouse\Testing\MakesGraphQLRequests;
use Tests\TestCase;

class SchemaTest extends TestCase
{
    use ClearsSchemaCache;
    use MakesGraphQLRequests;

    /** @var \App\Models\User $viewer */
    protected $viewer;

    protected function graphQLEndpointUrl(): string
    {
        return route('graphql.api');
    }

    protected function setUp(): void
    {
        parent::setUp();
        config()->set('lighthouse.cache.enable', false);
        $this->bootClearsSchemaCache();
        $this->introspect();
        $this->viewer = User::factory()->create();
    }

    /** @return string[] */
    protected function getLeafsFromType(string $type): array
    {
        Introspection::getIntrospectionQuery();
        $types = $this->introspectType($type);
        $fields = $types['fields'];
        $result = [];
        foreach ($fields as $field) {
            $type = $field['type'];
            while (true) {
                switch ($type['kind']) {
                    case 'NON_NULL':
                    case 'LIST':
                        $type = $type['ofType'];
                        break 1;
                    case 'SCALAR':
                    case 'ENUM':
                        $result[] = $field['name'];
                        break 2;
                    default:
                        break 2;
                }
            }
        }

        return $result;
    }

    public function testQueryBeatmap(): void
    {
        $this->actAsScopedUser($this->viewer);
        /** @var \App\Models\Beatmap $beatmap */
        $beatmap = Beatmap::factory()->create();

        $fields = $this->getLeafsFromType('Beatmap');

        $this->graphQL(/** @lang GraphQL */ '
        query ($id: Int!) {
            beatmap(id: $id) {
                '.implode(' ', $fields).'
            }
        }
        ', [
            'id' => $beatmap->beatmap_id,
        ])->assertJsonPath('data.beatmap.id', $beatmap->beatmap_id);
    }

    public function testQueryUser(): void
    {
        $this->actAsScopedUser($this->viewer);
        /** @var \App\Models\User $user */
        $user = User::factory()->create();

        $fields = $this->getLeafsFromType('User');

        $this->graphQL(/** @lang GraphQL */ '
        query ($id: Int!) {
            user(id: $id) {'.implode(' ', $fields).'}
        }
        ', [
            'id' => $user->user_id,
        ])->assertJsonPath('data.user.id', $user->user_id);
    }

    public function testQueryMe(): void
    {
        $this->actAsScopedUser($this->viewer);
        $this->graphQL(/** @lang GraphQL */ '
        query {
            me {
                id
            }
        }
        ')->assertJsonPath('data.me.id', $this->viewer->user_id);
    }

    public function testQueryGroup(): void
    {
        /** @var \App\Models\Group $group */
        $group = factory(Group::class)->create();

        $fields = $this->getLeafsFromType('Group');

        $this->actAsScopedUser($this->viewer);
        $this->graphQL(/** @lang GraphQL */ '
        query ($id: Int!) {
            group(id: $id) {'.implode(' ', $fields).'}
        }
        ', [
            'id' => $group->group_id,
        ])->assertJsonPath('data.group.id', $group->group_id);
    }

    public function testQueryChangelog(): void
    {
        /** @var \App\Models\Changelog $changelog */
        $changelog = factory(Changelog::class)->create();

        $fields = $this->getLeafsFromType('Changelog');

        $this->graphQL(/** @lang GraphQL */ '
        query ($id: Int!) {
            changelog(id: $id) {'.implode(' ', $fields).'}
        }
        ', [
            'id' => $changelog->changelog_id,
        ])->assertJsonPath('data.changelog.id', $changelog->changelog_id);
    }

    public function testQueryNewsPost(): void
    {
        /** @var \App\Models\NewsPost $post */
        $post = NewsPost::factory()->create();

        $fields = $this->getLeafsFromType('NewsPost');

        $this->graphQL(/** @lang GraphQL */ '
        query ($id: Int!) {
            newsPost(id: $id) {'.implode(' ', $fields).'}
        }
        ', [
            'id' => $post->id,
        ])->assertJsonPath('data.newsPost.id', $post->id);
    }
}
