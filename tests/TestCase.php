<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace Tests;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\Passport\Token;
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

    protected function actAsScopedUser($user, array $scopes = ['*'], $guard = 'api')
    {
        app('auth')->guard($guard)->setUser($user);

        app('auth')->shouldUse($guard);

        $token = Token::unguarded(function () use ($scopes, $user) {
            return new Token([
                'scopes' => $scopes,
                'user_id' => $user->user_id,
            ]);
        });

        $user->withAccessToken($token);
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
        return str_replace("\n", '', preg_replace("/>\s*</s", '><', trim($html)));
    }
}
