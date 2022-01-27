<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests;

use App\Http\Middleware\AuthApi;
use App\Libraries\BroadcastsPendingForTests;
use App\Models\Beatmapset;
use App\Models\Group;
use App\Models\OAuth\Client;
use App\Models\User;
use DMS\PHPUnitExtensions\ArraySubset\ArraySubsetAsserts;
use Firebase\JWT\JWT;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Testing\Fakes\MailFake;
use Laravel\Passport\Passport;
use Laravel\Passport\Token;
use League\OAuth2\Server\ResourceServer;
use Mockery;
use Queue;
use ReflectionMethod;
use ReflectionProperty;

class TestCase extends BaseTestCase
{
    use ArraySubsetAsserts, CreatesApplication, DatabaseTransactions;

    protected $connectionsToTransact = [
        'mysql',
        'mysql-chat',
        'mysql-mp',
        'mysql-store',
        'mysql-updates',
    ];

    public function regularOAuthScopesDataProvider()
    {
        $data = [];

        foreach (Passport::scopes()->pluck('id') as $scope) {
            // just skip over any scopes that require special conditions for now.
            if (in_array($scope, ['chat.write', 'delegate'], true)) {
                continue;
            }

            $data[] = [$scope];
        }

        return $data;
    }

    protected function setUp(): void
    {
        parent::setUp();

        // change config setting because we need more than 1 for the tests.
        config()->set('osu.oauth.max_user_clients', 100);

        // Force connections to reset even if transactional tests were not used.
        // Should fix tests going wonky when different queue drivers are used, or anything that
        // breaks assumptions of object destructor timing.
        $database = $this->app->make('db');
        $this->beforeApplicationDestroyed(function () use ($database) {
            foreach (array_keys(config('database.connections')) as $name) {
                $connection = $database->connection($name);

                $connection->rollBack();
                $connection->disconnect();
            }
        });

        app(BroadcastsPendingForTests::class)->reset();
    }

    /**
     * Act as a User with OAuth scope permissions.
     * This is for tests that will run the request middleware stack.
     *
     * @param User|null $user User to act as, or null for guest.
     * @param array|null $scopes OAuth token scopes.
     * @param string $driver Auth driver to use.
     * @return void
     */
    protected function actAsScopedUser(?User $user, ?array $scopes = ['*'], ?Client $client = null, $driver = null)
    {
        $client ??= Client::factory()->create();

        // create valid token
        $token = $this->createToken($user, $scopes, $client);

        // mock the minimal number of things.
        // this skips the need to form a request with all the headers.
        $mock = Mockery::mock(ResourceServer::class);
        $mock->shouldReceive('validateAuthenticatedRequest')
            ->andReturnUsing(function ($request) use ($token) {
                return $request->withAttribute('oauth_client_id', $token->client->id)
                    ->withAttribute('oauth_access_token_id', $token->id)
                    ->withAttribute('oauth_user_id', $token->user_id);
            });

        app()->instance(ResourceServer::class, $mock);
        $this->withHeader('Authorization', 'Bearer tests_using_this_do_not_verify_this_header_because_of_the_mock');

        $this->actAsUserWithToken($token, $driver);
    }

    protected function actAsUser(?User $user, ?bool $verified = null, $driver = null)
    {
        if ($user === null) {
            return;
        }

        $this->be($user, $driver);

        if ($verified !== null) {
            $this->withSession(['verified' => $verified]);
        }
    }

    /**
     * This is for tests that will skip the request middleware stack.
     *
     * @param Token $token OAuth token.
     * @param string $driver Auth driver to use.
     * @return void
     */
    protected function actAsUserWithToken(Token $token, $driver = null)
    {
        $guard = app('auth')->guard($driver);
        $user = $token->getResourceOwner();

        if ($user !== null) {
            // guard doesn't accept null user.
            $guard->setUser($user);
            $user->withAccessToken($token);
        }

        // This is for test that do not make actual requests;
        // tests that make requests will override this value with a new one
        // and the token gets resolved in middleware.
        request()->attributes->set(AuthApi::REQUEST_OAUTH_TOKEN_KEY, $token);

        app('auth')->shouldUse($driver);
    }

    protected function actingAsVerified($user)
    {
        $this->actAsUser($user, true);

        return $this;
    }

    // FIXME: figure out how to generate the encrypted token without doing it
    //        manually here. Or alternatively some other way to authenticate
    //        with token.
    protected function actingWithToken($token)
    {
        static $privateKey;

        if ($privateKey === null) {
            $privateKey = file_get_contents(Passport::keyPath('oauth-private.key'));
        }

        $encryptedToken = JWT::encode([
            'aud' => $token->client_id,
            'exp' => $token->expires_at->timestamp,
            'iat' => $token->created_at->timestamp, // issued at
            'jti' => $token->getKey(),
            'nbf' => $token->created_at->timestamp, // valid after
            'sub' => $token->user_id,
            'scopes' => $token->scopes,
        ], $privateKey, 'RS256');

        return $this->withHeaders([
            'Authorization' => "Bearer {$encryptedToken}",
        ]);
    }

    protected function createAllowedScopesDataProvider(array $allowedScopes)
    {
        $data = Passport::scopes()->pluck('id')->map(function ($scope) use ($allowedScopes) {
            return [[$scope], in_array($scope, $allowedScopes, true)];
        })->all();

        // scopeless tokens should fail in general.
        $data[] = [[], false];

        return $data;
    }

    protected function clearMailFake()
    {
        $mailer = app('mailer');
        if ($mailer instanceof MailFake) {
            $this->invokeSetProperty($mailer, 'mailables', []);
            $this->invokeSetProperty($mailer, 'queuedMailables', []);
        }
    }

    /**
     * Creates an OAuth token for the specified authorizing user.
     *
     * @param User|null $user The user that authorized the token.
     * @param array|null $scopes scopes granted
     * @param Client|null $client The client the token belongs to.
     * @return Token
     */
    protected function createToken(?User $user, ?array $scopes = null, ?Client $client = null)
    {
        $client ??= Client::factory()->create();

        $token = $client->tokens()->create([
            'expires_at' => now()->addDays(1),
            'id' => uniqid(),
            'revoked' => false,
            'scopes' => $scopes,
            'user_id' => optional($user)->getKey(),
        ]);

        return $token;
    }

    protected function fileList($path, $suffix)
    {
        return array_map(function ($file) use ($path, $suffix) {
            return [basename($file, $suffix), $path];
        }, glob("{$path}/*{$suffix}"));
    }

    protected function getGroupWithPlaymodes(string $identifier): Group
    {
        $group = app('groups')->byIdentifier($identifier);

        if (!$group->has_playmodes) {
            $group->update(['has_playmodes' => true]);

            // TODO: This shouldn't have to be called here, since it's already
            // called by `Group::afterCommit`, but `Group::afterCommit` isn't
            // running in tests when creating/saving `Group`s.
            app('groups')->resetCache();
        }

        return $group;
    }

    protected function makeBeatmapsetDiscussionPostParams(Beatmapset $beatmapset, string $messageType)
    {
        return [
            'beatmapset_id' => $beatmapset->getKey(),
            'beatmap_discussion' => [
                'message_type' => $messageType,
            ],
            'beatmap_discussion_post' => [
                'message' => 'Hello',
            ],
        ];
    }

    protected function invokeMethod($obj, string $name, array $params = [])
    {
        $method = new ReflectionMethod($obj, $name);
        $method->setAccessible(true);

        return $method->invokeArgs($obj, $params);
    }

    protected function invokeProperty($obj, string $name)
    {
        $property = new ReflectionProperty($obj, $name);
        $property->setAccessible(true);

        return $property->getValue($obj);
    }

    protected function invokeSetProperty($obj, string $name, $value)
    {
        $property = new ReflectionProperty($obj, $name);
        $property->setAccessible(true);

        $property->setValue($obj, $value);
    }

    protected function normalizeHTML($html)
    {
        return str_replace('<br />', "<br />\n", str_replace("\n", '', preg_replace('/>\s*</s', '><', trim($html))));
    }

    protected function runFakeQueue()
    {
        collect(Queue::pushedJobs())->flatten(1)->each(function ($job) {
            $job['job']->handle();
        });

        // clear queue jobs after running
        // FIXME: this won't work if a job queues another job and you want to run that job.
        $this->invokeSetProperty(app('queue'), 'jobs', []);
    }

    protected function withInterOpHeader($url)
    {
        return $this->withHeaders([
            'X-LIO-Signature' => hash_hmac('sha1', $url, config('osu.legacy.shared_interop_secret')),
        ]);
    }
}
