<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Browser;

use App\Models\Artist;
use App\Models\ArtistTrack;
use App\Models\Beatmap;
use App\Models\BeatmapDiscussion;
use App\Models\BeatmapDiscussionPost;
use App\Models\BeatmapMirror;
use App\Models\BeatmapPack;
use App\Models\Beatmapset;
use App\Models\Build;
use App\Models\Changelog;
use App\Models\Chat\Channel;
use App\Models\Chat\UserChannel;
use App\Models\Comment;
use App\Models\Contest;
use App\Models\Count;
use App\Models\Country;
use App\Models\Forum\AuthOption;
use App\Models\Forum\Authorize;
use App\Models\Forum\Forum;
use App\Models\Forum\Post;
use App\Models\Forum\Topic;
use App\Models\Forum\TopicTrack;
use App\Models\Genre;
use App\Models\Group;
use App\Models\Language;
use App\Models\LegacyMatch;
use App\Models\LoginAttempt;
use App\Models\Multiplayer\Room;
use App\Models\NewsPost;
use App\Models\Notification;
use App\Models\Score;
use App\Models\Store;
use App\Models\Tournament;
use App\Models\UpdateStream;
use App\Models\User;
use App\Models\UserGroup;
use App\Models\UserGroupEvent;
use App\Models\UserNotification;
use App\Models\UserProfileCustomization;
use App\Models\UserStatistics;
use Exception;
use Illuminate\Routing\Route as LaravelRoute;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class SanityTest extends DuskTestCase
{
    protected static $scaffolding; // static so we only set up the scaffolding once

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        static::createScaffolding();
    }

    public static function tearDownAfterClass(): void
    {
        static::cleanup();

        parent::tearDownAfterClass();
    }

    private static function cleanup()
    {
        if (!isset(self::$scaffolding)) {
            return;
        }

        (new static())->createApplication();

        // Tear down in reverse-order so that dependants get destroyed before their dependencies.
        $nukingOrder = array_reverse(self::$scaffolding);

        foreach ($nukingOrder as $name => $scaffold) {
            static::output("TEARDOWN: $name (".get_class($scaffold).")\n");

            if ($name === 'order' || $name === 'invoice') {
                // we need to perform custom deletion for orders to bypass their immutability protections
                Store\Order::withTrashed()->forceDelete();
            } else {
                $scaffold->forceDelete();
            }
        }

        // Clean up extra things that get created (i.e. as side-effects, etc)
        Beatmap::truncate();
        Beatmapset::truncate();
        Channel::truncate();
        Count::truncate();
        AuthOption::truncate();
        Authorize::truncate();
        TopicTrack::truncate();
        Genre::truncate();
        Group::truncate();
        Language::truncate();
        LoginAttempt::truncate();
        NewsPost::truncate();
        Notification::truncate();
        User::truncate();
        UserGroup::truncate();
        UserGroupEvent::truncate();
        UserNotification::truncate();
        UserProfileCustomization::truncate();
        UserStatistics\Osu::truncate();

        app('groups')->resetCache();
    }

    private static function createScaffolding()
    {
        if (isset(self::$scaffolding)) {
            return;
        }

        (new static())->createApplication();
        self::$scaffolding['country'] = Country::first() ?? Country::factory()->create();
        // user to login as and to use for requests
        self::$scaffolding['user'] = User::factory()->create([
            'country_acronym' => self::$scaffolding['country']->acronym,
        ]);

        // factories for /beatmapsets/*
        self::$scaffolding['beatmap_mirror'] = factory(BeatmapMirror::class)->create();
        self::$scaffolding['genre'] = Genre::factory()->create();
        self::$scaffolding['language'] = Language::factory()->create();
        self::$scaffolding['beatmapset'] = Beatmapset::factory()->create([
            'genre_id' => self::$scaffolding['genre'],
            'language_id' => self::$scaffolding['language'],
            'user_id' => self::$scaffolding['user'],
        ]);
        self::$scaffolding['beatmap'] = Beatmap::factory()->create([
            'beatmapset_id' => self::$scaffolding['beatmapset'],
        ]);
        self::$scaffolding['beatmap_discussion'] = BeatmapDiscussion::factory()->create([
            'beatmapset_id' => self::$scaffolding['beatmapset'],
            'beatmap_id' => self::$scaffolding['beatmap'],
            'user_id' => self::$scaffolding['user'],
        ]);
        self::$scaffolding['beatmap_discussion_post'] = BeatmapDiscussionPost::factory()->timeline()->create([
            'beatmap_discussion_id' => self::$scaffolding['beatmap_discussion'],
            'user_id' => self::$scaffolding['user'],
        ]);
        self::$scaffolding['beatmap_discussion_reply'] = BeatmapDiscussionPost::factory()->create([
            'beatmap_discussion_id' => self::$scaffolding['beatmap_discussion'],
            'user_id' => self::$scaffolding['user'],
        ]);
        self::$scaffolding['pack'] = BeatmapPack::factory()->create();

        // factories for /community/contests/*
        self::$scaffolding['contest'] = factory(Contest::class)->states('entry')->create();

        // factories for /community/tournaments/*
        self::$scaffolding['tournament'] = factory(Tournament::class)->create();

        // factories for /beatmaps/artists/*
        self::$scaffolding['artist'] = factory(Artist::class)->create();
        self::$scaffolding['track'] = ArtistTrack::factory()->create([
            'artist_id' => self::$scaffolding['artist']->getKey(),
        ]);

        // factories for /store/*
        self::$scaffolding['product'] = factory(Store\Product::class)->states('master_tshirt')->create();
        self::$scaffolding['order'] = factory(Store\Order::class)->states('checkout')->create([
            'user_id' => self::$scaffolding['user']->getKey(),
        ]);
        self::$scaffolding['checkout'] = new ScaffoldDummy(self::$scaffolding['order']->getKey());
        self::$scaffolding['invoice'] = factory(Store\Order::class)->states('paid')->create([
            'user_id' => self::$scaffolding['user']->getKey(),
        ]);

        // factories for /community/forums/*
        self::$scaffolding['forum_parent'] = Forum::factory()->closed()->create();
        self::$scaffolding['forum'] = Forum::factory()->create([
            'parent_id' => self::$scaffolding['forum_parent'],
        ]);
        // satisfy group permissions required for posting in forum
        self::$scaffolding['_group'] = app('groups')->byIdentifier('default');
        self::$scaffolding['_forum_acl_post'] = Authorize::factory()->post()->create([
            'forum_id' => self::$scaffolding['forum'],
            'group_id' => self::$scaffolding['_group'],
        ]);
        self::$scaffolding['_forum_acl_reply'] = Authorize::factory()->reply()->create([
            'forum_id' => self::$scaffolding['forum'],
            'group_id' => self::$scaffolding['_group'],
        ]);
        self::$scaffolding['_user_group'] = UserGroup::first();

        // satisfy minimum playcount for forum posting
        self::$scaffolding['user']->statisticsOsu()->save(factory(UserStatistics\Osu::class)->make(['playcount' => config('osu.forum.minimum_plays')]));

        self::$scaffolding['topic'] = Topic::factory()->create([
            'forum_id' => self::$scaffolding['forum'],
            'topic_poster' => self::$scaffolding['user'],
        ]);
        self::$scaffolding['post'] = Post::factory()->create([
            'poster_id' => self::$scaffolding['user'],
            'topic_id' => self::$scaffolding['topic'],
        ]);

        // factories for /community/chat/*
        self::$scaffolding['channel'] = Channel::factory()->type('public')->create();
        self::$scaffolding['user_channel'] = UserChannel::factory()->create([
            'channel_id' => self::$scaffolding['channel']->getKey(),
            'user_id' => self::$scaffolding['user']->getKey(),
        ]);

        // dummy for game mode param
        self::$scaffolding['mode'] = new ScaffoldDummy('osu');

        // factory for /home/changelog/*
        self::$scaffolding['stream'] = factory(UpdateStream::class)->create();
        self::$scaffolding['changelog'] = factory(Changelog::class)->create([
            'stream_id' => self::$scaffolding['stream']->stream_id,
        ]);
        self::$scaffolding['build'] = Build::factory()->create([
            'stream_id' => self::$scaffolding['stream']->stream_id,
        ]);

        // factory for /g/*
        self::$scaffolding['group'] = factory(Group::class)->create();

        // factory for comments
        self::$scaffolding['comment'] = Comment::factory()->create([
            'commentable_id' => self::$scaffolding['build'],
            'commentable_type' => 'build',
            'user_id' => self::$scaffolding['user'],
        ]);

        // factory for matches
        self::$scaffolding['match'] = factory(LegacyMatch\LegacyMatch::class)->create();
        self::$scaffolding['event'] = factory(LegacyMatch\Event::class)->states('join')->create([
            'match_id' => self::$scaffolding['match']->getKey(),
        ]);

        // dummy for wiki page
        self::$scaffolding['page'] = new ScaffoldDummy('Welcome');

        // dummy for news
        self::$scaffolding['news'] = new ScaffoldDummy('2014-06-21-meet-yuzu');

        // score factory
        self::$scaffolding['score'] = Score\Best\Osu::factory()->withReplay()->create();

        self::$scaffolding['room'] = factory(Room::class)->create(['category' => 'spotlight']);

        app('groups')->resetCache();
    }

    private static function filterLog(array $log)
    {
        $appUrl = config('app.url');
        $return = [];

        foreach ($log as $line) {
            if ($line['source'] === 'network') {
                $matches = [];
                $count = preg_match_all('/^([^ ]+) - Failed to load resource: the server responded with a status of ([0-9]{3}) \(([^\)]*)\)$/i', $line['message'], $matches);

                if ($count !== false && $count > 0) {
                    $returnCode = get_int($matches[2][0]);
                    $url = $matches[1][0];

                    // ignore missing non-critical assets
                    if (
                        ($returnCode === 403 || $returnCode === 404) && starts_with($url, ['https://assets.ppy.sh', 'https://i.ppy.sh']) ||
                        ($returnCode < 500 && starts_with($url, $appUrl))
                    ) {
                        continue;
                    }
                }
            }

            $return[] = $line;
        }

        return $return;
    }

    private static function getVerificationCode()
    {
        $log = file_get_contents('storage/logs/laravel.log');
        $matches = [];
        $count = preg_match_all('/Your verification code is: ([0-9a-f]{8})/im', $log, $matches);

        if ($count > 0) {
            return $matches[1][count($matches[1]) - 1];
        }
    }

    private static function output($text)
    {
        // apparently there's no phpunit api to do this...
        if (in_array('--verbose', $_SERVER['argv'], true)) {
            echo $text;
        }
    }

    public function routesDataProvider()
    {
        static $bypass = [
            '__clockwork',
            '_dusk/',
            '_lio',
            'api/',
            'clockwork',
            'oauth/',
            'payments/',
        ];
        static $types = ['user', 'guest'];

        $this->refreshApplication();
        $data = [];

        foreach (app()->routes->get('GET') as $uri => $route) {
            if (starts_with($uri, $bypass)) {
                continue;
            }

            $routeName = $route->getName() ?? $uri;
            foreach ($types as $type) {
                $data[] = ["{$routeName}:{$type}", $type, $uri];
            }
        }

        return $data;
    }

    /**
     * @dataProvider routesDataProvider
     */
    public function testPageLoadCheck($testName, $type, $uri)
    {
        $route = app()->routes->get('GET')[$uri];

        static::output("\n  [{$type}] /{$route->uri} (".(presence($route->getName()) ?? '???').')');

        if ($route->getName() === null) {
            $this->markTestSkipped("Route name missing ({$route->uri})");
        }

        $url = $this->bindParams($route);

        // TODO: add additional logic for certain routes to re-run tests per game mode, per user score type, etc
        $this->browse(function (Browser $browser) use ($route, $type, $url) {
            static::resetSession($browser);

            try {
                if ($type === 'user') {
                    $browser->loginAs(self::$scaffolding['user']);
                }
                $browser->visit($url);

                // $browser->driver->takeScreenshot('ss/'.$route->getName().'.png');

                if ($type === 'user') {
                    $this->checkAdminPermission($browser, $route);
                    $this->checkVerification($browser, $route);
                }
                $this->assertGeneralValidation($type, $browser, $route);
            } catch (Exception $err) {
                $this->captureFailedTest($type, $err, $browser, $route);

                throw $err;
            }
        });
    }

    private function assertGeneralValidation(string $type, Browser $browser, LaravelRoute $route)
    {
        $browser
            ->assertDontSee('Oh no! Something broke! ;_;')
            ->assertDontSee('Sorry, the page you are looking for could not be found');

        $this->checkJavascriptErrors($browser, $route);

        static::output("\e[0;32m    ✓\e[0m\n");
    }

    private function bindParams(LaravelRoute $route)
    {
        $paramOverrides = [
            'beatmapsets.discussions.show' => [
                'discussion' => static::$scaffolding['beatmap_discussion']->getKey(),
            ],
            'forum.topics.create' => [
                'forum_id' => self::$scaffolding['forum']->getKey(),
            ],
            'users.beatmapsets' => [
                'type' => 'favourite',
                // 'type' => [
                //     'favourite',
                //     'graveyard',
                //     'loved',
                //     'most_played',
                //     'ranked',
                //     'pending',
                // ],
            ],
            'users.multiplayer.index' => [
                'typeGroup' => 'playlists',
            ],
            'users.scores' => [
                'type' => 'best',
                // 'type' => [
                //     'best',
                //     'firsts',
                //     'recent',
                // ],
            ],
            'changelog.build' => [
                'stream' => self::$scaffolding['stream']->name,
                'build' => self::$scaffolding['build']->version,
            ],
            'changelog.show' => [
                'changelog' => self::$scaffolding['build']->version,
            ],
            'legal' => [
                'locale' => 'en',
                'path' => 'Terms',
            ],
            'wiki.image' => [
                'path' => 'shared/mode/osu.png',
            ],
            'wiki.sitemap' => [
                'locale' => 'en',
            ],
        ];

        $params = [];
        $paramNames = $route->parameterNames();
        static::output("\n");

        // Go through each parameter referenced in the route and either use the value from $paramOverrides (if present) or use the scaffolding prepared in setUp()
        foreach ($paramNames as $paramName) {
            static::output("    {$paramName} => ");
            if (isset($paramOverrides[$route->getName()]) && isset($paramOverrides[$route->getName()][$paramName])) {
                $params[$paramName] = $paramOverrides[$route->getName()][$paramName];
                static::output($params[$paramName]." \e[30;1m(override)\e[0m\n");
            } else {
                if (isset(self::$scaffolding[$paramName])) {
                    $params[$paramName] = self::$scaffolding[$paramName]->getKey();
                    static::output($params[$paramName]."\n");
                } else {
                    static::output("\e[30;1m¯\_(ツ)_/¯\e[0m\n");
                }
            }
        }

        if (isset($paramOverrides[$route->getName()])) {
            foreach ($paramOverrides[$route->getName()] as $paramName => $paramValue) {
                if (!in_array($paramName, $paramNames, true)) {
                    $params[$paramName] = $paramValue;
                    static::output("    {$paramName} => {$paramValue} \e[30;1m(extra param from override)\e[0m\n");
                }
            }
        }

        $url = str_replace(config('app.url'), '', route($route->getName(), $params));

        return $url;
    }

    private function captureFailedTest(string $type, Exception $err, Browser $browser, LaravelRoute $route): void
    {
        $filename = "tests/Browser/screenshots/fail-{$route->getName()}-{$type}.png";
        $browser->driver->takeScreenshot($filename);

        static::output('  '.$err->getMessage()."\n");
        static::output("  screenshot saved to: {$filename}\n");
        static::output("\e[1;37;41m\e[2K    x ({$type})\e[0m\n");
    }

    private function checkAdminPermission(Browser $browser, LaravelRoute $route)
    {
        $adminRestricted = ['chat.users.index', 'forum.topics.logs.index'];

        if (starts_with($route->uri, 'admin') || in_array($route->getName(), $adminRestricted, true)) {
            // TODO: retry and check page as admin? (will affect subsequent tests though, so figure out how to deal with that..)
            $browser->assertSee("You shouldn't be here.");
        } else {
            $browser->assertDontSee("You shouldn't be here.");
        }
    }

    private function checkJavascriptErrors(Browser $browser, LaravelRoute $route)
    {
        // Note: if you call getLog more than once a request, the subsequent calls return an empty array.
        $rawLog = $browser->driver->manage()->getLog('browser');
        $logLines = collect(self::filterLog($rawLog));

        if ($logLines->isNotEmpty()) {
            $error = implode(' | ', $logLines->pluck('message')->toArray());

            throw new Exception("JavaScript ERROR: {$error}");
        }
    }

    private function checkVerification(Browser $browser, LaravelRoute $route)
    {
        $verificationExpected = [
            'account.edit',
            'chat.index',
            'client-verifications.create',
            'messages.users.show',
            'store.checkout.show',
            'store.invoice.show',
            'store.orders.index',
        ];

        if (in_array($route->getName(), $verificationExpected, true)) {
            $browser->assertSee('Account Verification');

            $verificationCode = self::getVerificationCode();

            $browser
                ->type('.user-verification__key', $verificationCode)
                ->waitUntilMissing('.user-verification')
                ->pause(2000) // allows time for dialog hiding transition
                ->assertDontSee('Account Verification');
        } else {
            $browser->assertDontSee('Account Verification');
        }
    }
}
