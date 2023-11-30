<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Middleware;

use App\Http\Middleware\RequestCost;
use App\Models\OAuth\Token;
use App\Models\User;
use Closure;
use LaravelRedis;
use Route;
use Tests\TestCase;

class ThrottleRequestsTest extends TestCase
{
    const LIMIT = 60;

    protected Token $token;

    /**
     * @dataProvider throttleDataProvider
     */
    public function testThrottle(array $middlewares, int $remaining, ?Closure $action = null)
    {
        $action ??= (fn () => []);

        Route::get('api/test-throttle', $action)->middleware(['api', 'require-scopes'])->middleware($middlewares);

        $this->getJson('api/test-throttle')
            ->assertHeader('X-Ratelimit-Limit', static::LIMIT)
            ->assertHeader('X-Ratelimit-Remaining', $remaining);
    }

    public function testThrottleMultipleRequests()
    {
        Route::get('api/test-throttle', fn () => [])->middleware(['api', 'require-scopes'])->middleware('throttle:60,10');

        $this->getJson('api/test-throttle');
        $this->getJson('api/test-throttle')
            ->assertHeader('X-Ratelimit-Limit', static::LIMIT)
            ->assertHeader('X-Ratelimit-Remaining', 58);
    }

    public static function throttleDataProvider()
    {
        return [
            'throttle' => [['throttle:60,10'], 59],
            'request-cost specified' => [['request-cost:5', 'throttle:60,10'], 55],
            'request-cost after throttle order does not matter' => [['throttle:60,10', 'request-cost:5'], 55],
            'setCost' => [['throttle:60,10'], 58, fn () => RequestCost::setCost(2)],
            'setCost overrides default' => [['throttle:60,10', 'request-cost:5'], 58, fn () => RequestCost::setCost(2)],
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();

        // Using token so we can get the key name and remove the keys from redis on cleanup.
        $this->token = $this->createToken(User::factory()->create(), ['*']);
        $this->actingWithToken($this->token);
    }

    protected function tearDown(): void
    {
        if (config('cache.default') === 'redis') {
            $key = config('cache.prefix').':'.sha1($this->token->getKey());
            LaravelRedis::del($key);
            LaravelRedis::del("{$key}:timer");
        }

        parent::tearDown();
    }
}
