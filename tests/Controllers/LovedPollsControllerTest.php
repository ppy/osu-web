<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Controllers;

use App\Models\Beatmap;
use App\Models\Beatmapset;
use App\Models\Forum\Topic;
use App\Models\LovedPoll;
use App\Models\OAuth\Client;
use App\Models\User;
use Closure;
use Tests\TestCase;

class LovedPollsControllerTest extends TestCase
{
    public function testDestroy(): void
    {
        $lovedPoll = LovedPoll::factory()->create();

        $this->actWithLovedClientCredentials();
        $this
            ->delete(route('api.loved-polls.destroy', $lovedPoll->topic_id))
            ->assertNoContent();

        $this->assertModelMissing($lovedPoll);
    }

    public function testRequireLovedScopeExplicitly(): void
    {
        $this->actAsScopedUser(User::factory()->create());
        $this
            ->delete(route('api.loved-polls.destroy', 1))
            ->assertForbidden();
        $this
            ->post(route('api.loved-polls.store'))
            ->assertForbidden();
    }

    public function testStore(): void
    {
        $lovedPoll = LovedPoll::factory()->make();

        $this->actWithLovedClientCredentials();
        $this
            ->post(route('api.loved-polls.store'), $this->getStoreParameters($lovedPoll))
            ->assertNoContent();

        $this->assertModelExists($lovedPoll);
    }

    /**
     * @dataProvider storeInvalidDataProvider
     */
    public function testStoreInvalid(Closure $mutator): void
    {
        $lovedPoll = LovedPoll::factory()->make();
        $mutator($lovedPoll);

        $this->actWithLovedClientCredentials();
        $this
            ->post(route('api.loved-polls.store'), $this->getStoreParameters($lovedPoll))
            ->assertUnprocessable();

        $this->assertModelMissing($lovedPoll);
    }

    /**
     * @dataProvider storeMissingParameterDataProvider
     */
    public function testStoreMissingParameter(string $key): void
    {
        $lovedPoll = LovedPoll::factory()->make();
        $parameters = $this->getStoreParameters($lovedPoll);
        unset($parameters[$key]);

        $this->actWithLovedClientCredentials();
        $this
            ->post(route('api.loved-polls.store'), $parameters)
            ->assertUnprocessable();

        $this->assertModelMissing($lovedPoll);
    }

    public function storeInvalidDataProvider(): array
    {
        return [
            'Beatmap does not exist' => [
                fn (LovedPoll $poll) => $poll->beatmapset_id = Beatmapset::max('beatmapset_id') + 1,
            ],
            'Excluded beatmaps not in beatmapset' => [
                fn (LovedPoll $poll) => $poll->excluded_beatmap_ids = [Beatmap::max('beatmap_id') + 1],
            ],
            'Ruleset not in beatmapset' => [
                fn (LovedPoll $poll) => $poll->ruleset_id =
                    $poll->beatmapset->beatmaps()->value('playmode') === 0 ? 1 : 0,
            ],
            'Topic does not exist' => [
                fn (LovedPoll $poll) => $poll->topic_id = Topic::max('topic_id') + 1,
            ],
            'Missing poll end time' => [
                fn (LovedPoll $poll) => $poll->topic()->update(['poll_length' => 0]),
            ],
            'Poll option count not 2' => [
                fn (LovedPoll $poll) => $poll->topic->pollOptions()->limit(1)->delete(),
            ],
            'Poll option text not "Yes" and "No"' => [
                fn (LovedPoll $poll) => $poll->topic->pollOptions()->update(['poll_option_text' => 'invalid']),
            ],
            'First post text missing marker' => [
                fn (LovedPoll $poll) => $poll->topic->firstPost()->update(['post_text' => 'invalid']),
            ],
        ];
    }

    public function storeMissingParameterDataProvider(): array
    {
        return [
            ['beatmapset_id'],
            ['excluded_beatmap_ids'],
            ['pass_threshold'],
            ['ruleset'],
            ['topic_id'],
        ];
    }

    private function actWithLovedClientCredentials(): void
    {
        $client = Client::factory()->create();
        config()->set('osu.loved.oauth_client_id', $client->getKey());

        $this->actAsScopedUser(null, ['loved'], $client);
    }

    private function getStoreParameters(LovedPoll $lovedPoll): array
    {
        static $keys = [
            'beatmapset_id',
            'description_author_id',
            'excluded_beatmap_ids',
            'pass_threshold',
            'ruleset',
            'topic_id',
        ];

        $parameters = [];

        foreach ($keys as $key) {
            $parameters[$key] = $lovedPoll->$key;
        }

        return $parameters;
    }
}
