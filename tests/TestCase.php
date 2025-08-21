<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests;

use App\Events\NewPrivateNotificationEvent;
use App\Http\Middleware\AuthApi;
use App\Jobs\Notifications\BroadcastNotificationBase;
use App\Libraries\OAuth\EncodeToken;
use App\Libraries\Search\ScoreSearch;
use App\Libraries\Session\Store as SessionStore;
use App\Models\Beatmapset;
use App\Models\Build;
use App\Models\Multiplayer\PlaylistItem;
use App\Models\Multiplayer\ScoreLink;
use App\Models\OAuth\Client;
use App\Models\OAuth\Token;
use App\Models\ScoreToken;
use App\Models\User;
use Artisan;
use Carbon\CarbonInterface;
use DMS\PHPUnitExtensions\ArraySubset\ArraySubsetAsserts;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Collection;
use Illuminate\Support\Testing\Fakes\MailFake;
use Laravel\Passport\Passport;
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

    protected array $expectedCountsCallbacks = [];

    public static function regularOAuthScopesDataProvider()
    {
        // just skip over any scopes that require special conditions for now.
        return static::allPassportScopeIds()
            ->diff(['chat.read', ...Token::SCOPES_REQUIRE_DELEGATION])
            ->map(fn ($scope) => [$scope]);
    }

    public static function withDbAccess(callable $callback): void
    {
        $db = static::createApp()->make('db');

        $callback();

        static::resetAppDb($db);
    }

    protected static function createClientToken(Build $build, ?int $clientTime = null): string
    {
        $data = strtoupper(bin2hex($build->hash).bin2hex(pack('V', $clientTime ?? time())));
        $expected = hash_hmac('sha1', $data, '');

        return strtoupper(bin2hex(random_bytes(40)).$data.$expected.'00');
    }

    protected static function fileList($path, $suffix)
    {
        return array_map(
            fn ($file) => [basename($file, $suffix), $path],
            glob("{$path}/*{$suffix}"),
        );
    }

    protected static function chatScopes(): Collection
    {
        return static::allPassportScopeIds()->filter(fn ($scope) => str_starts_with($scope, 'chat.'));
    }

    protected static function allPassportScopeIds(): Collection
    {
        return Passport::scopes()->pluck('id');
    }

    protected static function reindexScores()
    {
        $search = new ScoreSearch();
        $search->deleteAll();
        $search->refresh();
        Artisan::call('es:index-scores:queue', [
            '--all' => true,
            '--no-interaction' => true,
        ]);
        $search->indexWait();
    }

    protected static function resetAppDb(DatabaseManager $database): void
    {
        foreach (array_keys($GLOBALS['cfg']['database']['connections']) as $name) {
            $connection = $database->connection($name);

            $connection->rollBack();
            $connection->disconnect();
        }
    }

    protected static function roomAddPlay(User $user, PlaylistItem $playlistItem, array $scoreParams): ScoreLink
    {
        return $playlistItem->room->completePlay(
            static::roomStartPlay($user, $playlistItem),
            [
                'accuracy' => 0.5,
                'beatmap_id' => $playlistItem->beatmap_id,
                'ended_at' => json_time(new \DateTime()),
                'max_combo' => 1,
                'ruleset_id' => $playlistItem->ruleset_id,
                'statistics' => ['good' => 1],
                'total_score' => 10,
                'user_id' => $user->getKey(),
                ...$scoreParams,
            ],
        );
    }

    protected static function roomStartPlay(User $user, PlaylistItem $playlistItem): ScoreToken
    {
        return $playlistItem->room->startPlay($user, $playlistItem, [
            'beatmap_hash' => $playlistItem->beatmap->checksum,
            'beatmap_id' => $playlistItem->beatmap_id,
            'build_id' => 0,
            'ruleset_id' => $playlistItem->ruleset_id,
        ]);
    }

    protected function setUp(): void
    {
        $this->beforeApplicationDestroyed(fn () => $this->runExpectedCountsCallbacks());

        parent::setUp();

        // change config setting because we need more than 1 for the tests.
        config_set('osu.oauth.max_user_clients', 100);

        // Disable caching for the BeatmapTagsController and TagsController tests
        // because otherwise multiple run of the tests may use stale cache data.
        config_set('osu.tags.beatmap_tags_cache_duration', 0);
        config_set('osu.tags.tags_cache_duration', 0);

        // Force connections to reset even if transactional tests were not used.
        // Should fix tests going wonky when different queue drivers are used, or anything that
        // breaks assumptions of object destructor timing.
        $db = $this->app->make('db');
        $this->beforeApplicationDestroyed(fn () => static::resetAppDb($db));
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $this->expectedCountsCallbacks = [];
    }

    /**
     * Act as a User with OAuth scope permissions.
     */
    protected function actAsScopedUser(?User $user, ?array $scopes = ['*'], ?Client $client = null): static
    {
        return $this->actingWithToken($this->createToken(
            $user,
            $scopes,
            $client ?? Client::factory()->create(),
        ));
    }

    protected function actAsUser(?User $user, bool $verified = false, $driver = null): static
    {
        if ($user !== null) {
            $this->be($user, $driver)->withSession(['verified' => $verified]);
        }

        return $this;
    }

    /**
     * This is for tests that will skip the request middleware stack.
     */
    protected function actAsUserWithToken(Token $token, ?string $driver = null): static
    {
        $guard = app('auth')->guard($driver);
        $user = $token->getResourceOwner();

        if ($user === null) {
            $guard->logout();
        } else {
            $guard->setUser($user);
            $user->withAccessToken($token);
        }

        // This is for test that do not make actual requests;
        // tests that make requests will override this value with a new one
        // and the token gets resolved in middleware.
        request()->attributes->set(AuthApi::REQUEST_OAUTH_TOKEN_KEY, $token);

        app('auth')->shouldUse($driver);

        return $this;
    }

    protected function actingAsVerified($user): static
    {
        return $this->actAsUser($user, true);
    }

    protected function actingWithToken($token): static
    {
        return $this->actAsUserWithToken($token)
            ->withToken(EncodeToken::encodeAccessToken($token));
    }

    protected function assertEqualsUpToOneSecond(CarbonInterface $expected, CarbonInterface $actual): void
    {
        $this->assertTrue($expected->diffInSeconds($actual, true) < 2);
    }

    protected function createVerifiedSession($user): SessionStore
    {
        $ret = SessionStore::findOrNew();
        $ret->put(\Auth::getName(), $user->getKey());
        $ret->put('verified', true);
        $ret->migrate(false);
        $ret->save();

        return $ret;
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
        return ($client ?? Client::factory()->create())->tokens()->create([
            'expires_at' => now()->addDays(1),
            'id' => uniqid(),
            'revoked' => false,
            'scopes' => $scopes,
            'user_id' => $user?->getKey(),
            'verified' => true,
        ]);
    }

    protected function expectCountChange(callable $callback, int $change, string $message = '')
    {
        $traceEntry = debug_backtrace(0, 1)[0];
        if ($message !== '') {
            $message .= "\n";
        }
        $message .= "{$traceEntry['file']}:{$traceEntry['line']}";

        $this->expectedCountsCallbacks[] = [
            'callback' => $callback,
            'expected' => $callback() + $change,
            'message' => $message,
        ];
    }

    protected function expectExceptionCallable(callable $callable, ?string $exceptionClass, ?string $exceptionMessage = null)
    {
        try {
            $callable();
        } catch (\Throwable $e) {
            $this->assertSame($exceptionClass, $e::class, "{$e->getFile()}:{$e->getLine()}");

            if ($exceptionMessage !== null) {
                $this->assertSame($exceptionMessage, $e->getMessage());
            }

            return;
        }

        // trigger fail if expecting exception but doesn't fail.
        if ($exceptionClass !== null) {
            static::fail("Did not throw expected {$exceptionClass}");
        }
    }

    protected function inReceivers(Model $model, NewPrivateNotificationEvent|BroadcastNotificationBase $obj): bool
    {
        return in_array($model->getKey(), $obj->getReceiverIds(), true);
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

    protected function withInterOpHeader($url, ?callable $callback = null)
    {
        if ($callback === null) {
            $timestampedUrl = $url;
        } else {
            $connector = strpos($url, '?') === false ? '?' : '&';
            $timestampedUrl = $url.$connector.'timestamp='.time();
        }

        $this->withHeaders([
            'X-LIO-Signature' => hash_hmac('sha1', $timestampedUrl, $GLOBALS['cfg']['osu']['legacy']['shared_interop_secret']),
        ]);

        return $callback === null ? $this : $callback($timestampedUrl);
    }

    protected function withPersistentSession(SessionStore $session): static
    {
        $session->save();

        return $this->withCookies([
            $session->getName() => $session->getId(),
        ]);
    }

    private function runExpectedCountsCallbacks()
    {
        foreach ($this->expectedCountsCallbacks as $expectedCount) {
            $after = $expectedCount['callback']();
            $this->assertSame($expectedCount['expected'], $after, $expectedCount['message']);
        }
    }
}
