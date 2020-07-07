<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests;

use App\Http\Middleware\AuthApi;
use App\Models\OAuth\Client;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\Passport\Token;
use League\OAuth2\Server\ResourceServer;
use Mockery;
use Queue;
use ReflectionMethod;
use ReflectionProperty;

class TestCase extends BaseTestCase
{
    use CreatesApplication, DatabaseTransactions;

    protected $connectionsToTransact = [
        'mysql',
        'mysql-chat',
        'mysql-mp',
        'mysql-store',
        'mysql-updates',
    ];

    protected $baseUrl = 'http://localhost';

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
    protected function actAsScopedUser(?User $user, ?array $scopes = ['*'], $driver = null)
    {
        // create valid token
        $client = factory(Client::class)->create();
        $token = $client->tokens()->create([
            'expires_at' => now()->addDays(1),
            'id' => uniqid(),
            'revoked' => false,
            'scopes' => $scopes,
            'user_id' => optional($user)->getKey(),
        ]);

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
        $user = $token->user;

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

    protected function createUserWithGroup($groupIdentifier, array $attributes = []): ?User
    {
        if ($groupIdentifier === null) {
            return null;
        }

        return factory(User::class)->states($groupIdentifier)->create($attributes);
    }

    protected function fileList($path, $suffix)
    {
        return array_map(function ($file) use ($path, $suffix) {
            return [basename($file, $suffix), $path];
        }, glob("{$path}/*{$suffix}"));
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

    protected function normalizeHTML($html)
    {
        return str_replace('<br />', "<br />\n", str_replace("\n", '', preg_replace("/>\s*</s", '><', trim($html))));
    }

    protected function runFakeQueue()
    {
        collect(Queue::pushedJobs())->flatten(1)->each(function ($job) {
            $job['job']->handle();
        });
    }
}
