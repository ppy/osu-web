<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Middleware;

use App\Http\Middleware\RequestCost;
use Closure;
use Route;
use Tests\TestCase;

class ThrottleRequestsTest extends TestCase
{
    const LIMIT = 60;

    /**
     * @dataProvider throttleDataProvider
     */
    public function testThrottle(array $middlewares, int $remaining, ?Closure $action = null)
    {
        Route::get('test-throttle', $action)->middleware($middlewares);

        $this->get('test-throttle')
            ->assertHeader('X-Ratelimit-Limit', static::LIMIT)
            ->assertHeader('X-Ratelimit-Remaining', $remaining);
    }

    public function testThrottleMultipleRequests()
    {
        Route::get('test-throttle')->middleware('throttle:60,10');

        $this->get('test-throttle');
        $this->get('test-throttle')
            ->assertHeader('X-Ratelimit-Limit', static::LIMIT)
            ->assertHeader('X-Ratelimit-Remaining', 58);
    }


    public function throttleDataProvider()
    {
        return [
            'throttle' => [['throttle:60,10'], 59],
            'request-cost specified' => [['request-cost:5', 'throttle:60,10'], 55],
            'request-cost runs before throttle' => [['throttle:60,10', 'request-cost:5'], 55],
            'setCost' => [['throttle:60,10'], 58, fn () => RequestCost::setCost(2)],
            'setCost overrides default' => [['throttle:60,10', 'request-cost:5'], 58, fn () => RequestCost::setCost(2)],
        ];
    }
}
