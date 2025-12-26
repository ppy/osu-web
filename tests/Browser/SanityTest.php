<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Browser;

use App\Libraries\DailyChallengeDateHelper;
use App\Libraries\Session;
use App\Libraries\SessionVerification;
use App\Models\Artist;
use App\Models\ArtistTrack;
use App\Models\Beatmap;
use App\Models\BeatmapDiscussion;
use App\Models\BeatmapDiscussionPost;
use App\Models\BeatmapMirror;
use App\Models\BeatmapPack;
use App\Models\Beatmapset;
use App\Models\BeatmapsetFile;
use App\Models\BeatmapsetVersion;
use App\Models\BeatmapsetVersionFile;
use App\Models\Build;
use App\Models\Changelog;
use App\Models\Chat\Channel;
use App\Models\Chat\UserChannel;
use App\Models\Comment;
use App\Models\Contest;
use App\Models\ContestEntry;
use App\Models\ContestJudge;
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
use App\Models\Multiplayer\PlaylistItem;
use App\Models\Multiplayer\Room;
use App\Models\NewsPost;
use App\Models\Notification;
use App\Models\Score;
use App\Models\Screenshot;
use App\Models\Season;
use App\Models\Store;
use App\Models\Team;
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

        static::createApp();

        // Tear down in reverse-order so that dependants get destroyed before their dependencies.
        $nukingOrder = array_reverse(self::$scaffolding);

        foreach ($nukingOrder as $name => $scaffold) {
            static::echo("TEARDOWN: $name (".get_class($scaffold).")\n");

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
        BeatmapsetFile::truncate();
        BeatmapsetVersion::truncate();
        BeatmapsetVersionFile::truncate();
        Channel::truncate();
        Count::truncate();
        AuthOption::truncate();
        Authorize::truncate();
        TopicTrack::truncate();
        Genre::truncate();
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
    }

    private static function createScaffolding()
    {
        if (isset(self::$scaffolding)) {
            return;
        }

        static::createApp();
        self::$scaffolding['country'] = Country::first() ?? Country::factory()->create();
        // user to login as and to use for requests
        self::$scaffolding['user'] = User::factory()->create([
            'country_acronym' => self::$scaffolding['country']->acronym,
        ]);

        // factories for /beatmapsets/*
        self::$scaffolding['beatmap_mirror'] = BeatmapMirror::factory()->create();
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
        $beatmapsetVersion = BeatmapsetVersion::factory()->create([
            'beatmapset_id' => self::$scaffolding['beatmapset'],
        ]);
        self::$scaffolding['beatmapset_version_file'] = BeatmapsetVersionFile::factory()->create([
            'version_id' => $beatmapsetVersion,
        ]);
        self::$scaffolding['pack'] = BeatmapPack::factory()->create();

        // factories for /community/contests/*
        self::$scaffolding['contest'] = Contest::factory()->voting()->judged()->create();

        // user needs to be a judge in order to access contest judge panel
        ContestJudge::factory()->create([
            'contest_id' => self::$scaffolding['contest']->getKey(),
            'user_id' => self::$scaffolding['user']->getKey(),
        ]);

        self::$scaffolding['contest_entry'] = ContestEntry::factory()->create([
            // need to use separate contest for judge results route since it has to be completed
            'contest_id' => Contest::factory()->completed()->judged()->create()->getKey(),
        ]);

        // factories for /community/tournaments/*
        self::$scaffolding['tournament'] = Tournament::factory()->create();

        // factories for /beatmaps/artists/*
        self::$scaffolding['artist'] = Artist::factory()->create();
        self::$scaffolding['track'] = ArtistTrack::factory()->create([
            'artist_id' => self::$scaffolding['artist']->getKey(),
        ]);

        // factories for /store/*
        self::$scaffolding['product'] = Store\Product::factory()->masterTshirt()->create();
        self::$scaffolding['order'] = Store\Order::factory()->paymentApproved()->create([
            'user_id' => self::$scaffolding['user'],
        ]);
        self::$scaffolding['checkout'] = new ScaffoldDummy(self::$scaffolding['order']->getKey());
        self::$scaffolding['invoice'] = Store\Order::factory()->paid()->create([
            'user_id' => self::$scaffolding['user'],
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
        UserStatistics\Osu::factory()->create([
            'playcount' => $GLOBALS['cfg']['osu']['forum']['minimum_plays'],
            'user_id' => self::$scaffolding['user'],
        ]);

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

        // factory for /seasons/*
        self::$scaffolding['season'] = Season::factory()->create();

        // factory for /home/changelog/*
        self::$scaffolding['stream'] = UpdateStream::factory()->create();
        self::$scaffolding['changelog'] = Changelog::factory()->create([
            'stream_id' => self::$scaffolding['stream']->stream_id,
        ]);
        self::$scaffolding['build'] = Build::factory()->create([
            'stream_id' => self::$scaffolding['stream']->stream_id,
        ]);

        // factory for /g/*
        self::$scaffolding['group'] = Group::first();

        // factory for comments
        self::$scaffolding['comment'] = Comment::factory()->create([
            'commentable_id' => self::$scaffolding['build'],
            'commentable_type' => 'build',
            'user_id' => self::$scaffolding['user'],
        ]);

        // factory for matches
        self::$scaffolding['match'] = LegacyMatch\LegacyMatch::factory()->create();
        self::$scaffolding['event'] = LegacyMatch\Event::factory()->join()->create([
            'match_id' => self::$scaffolding['match']->getKey(),
        ]);

        // dummy for wiki page
        self::$scaffolding['page'] = new ScaffoldDummy('Welcome');

        // dummy for news
        self::$scaffolding['news'] = new ScaffoldDummy('2014-06-21-meet-yuzu');

        // score factory
        self::$scaffolding['score'] = Score\Best\Osu::factory()->withReplay()->create();

        self::$scaffolding['room'] = Room::factory()->create(['category' => 'spotlight']);

        self::$scaffolding['daily_challenge_room'] = Room::factory()->create(['category' => 'daily_challenge']);
        PlaylistItem::factory()->create(['room_id' => self::$scaffolding['daily_challenge_room']]);

        self::$scaffolding['team'] = Team::factory()->create(['leader_id' => self::$scaffolding['user']]);

        self::$scaffolding['screenshot'] = Screenshot::factory()->create(['user_id' => self::$scaffolding['user']]);
    }

    private static function echo($text): void
    {
        // apparently there's no phpunit api to do this...
        if (in_array('--verbose', $_SERVER['argv'], true)) {
            echo $text;
        }
    }

    private static function filterLog(array $log)
    {
        $appUrl = $GLOBALS['cfg']['app']['url'];
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
            } elseif ($line['message'] === "security - Error with Permissions-Policy header: Unrecognized feature: 'ch-ua-form-factor'.") {
                // we don't use ch-ua-* crap and this error is thrown by youtube.com as of 2023-05-16
                continue;
            } elseif ($line['message'] === "security - Error with Permissions-Policy header: Unrecognized feature: 'ch-ua-form-factors'.") {
                // same as above but 2024-08-06
                continue;
            } elseif (str_ends_with($line['message'], ' Third-party cookie will be blocked. Learn more in the Issues tab.')) {
                // thanks, youtube
                continue;
            }

            $return[] = $line;
        }

        return $return;
    }

    private static function getVerificationCode(Browser $browser): string
    {
        $sessionId = $browser->cookie($GLOBALS['cfg']['session']['cookie'])
            ?? throw new \Exception('failed locating session cookie');

        $session = Session\Store::findOrNew($sessionId);

        return SessionVerification\MailState::fromSession($session)->key;
    }

    public static function routesDataProvider()
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

        static::createApp();
        $data = [];

        foreach (app()->routes->get('GET') as $uri => $route) {
            if (starts_with($uri, $bypass)) {
                continue;
            }

            $routeName = $route->getName() ?? $uri;
            foreach ($types as $type) {
                $data["{$routeName}:{$type}"] = [$type, $uri];
            }
        }

        return $data;
    }

    /**
     * @dataProvider routesDataProvider
     */
    public function testPageLoadCheck($type, $uri)
    {
        $route = app()->routes->get('GET')[$uri];

        static::echo("\n  [{$type}] /{$route->uri} (".(presence($route->getName()) ?? '???').')');

        if ($route->getName() === null) {
            $this->markTestSkipped("Route name missing ({$route->uri})");
        }

        $url = $this->bindParams($route);

        // TODO: add additional logic for certain routes to re-run tests per game mode, per user score type, etc
        $this->browse(function (Browser $browser) use ($route, $type, $url) {
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

        static::echo("\e[0;32m    ✓\e[0m\n");
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
            'daily-challenge.show' => [
                'daily_challenge' => DailyChallengeDateHelper::roomId(self::$scaffolding['daily_challenge_room']),
            ],
            'scores.download-legacy' => [
                'rulesetOrScore' => static::$scaffolding['score']->getMode(),
                'score' => static::$scaffolding['score']->getKey(),
            ],
            'scores.show' => [
                'rulesetOrScore' => static::$scaffolding['score']->getMode(),
                'score' => static::$scaffolding['score']->getKey(),
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
            'screenshots.show' => [
                'hash' => Screenshot::urlHash(self::$scaffolding['screenshot']->getKey()),
            ],
        ];

        $params = [];
        $paramNames = $route->parameterNames();
        static::echo("\n");

        // Go through each parameter referenced in the route and either use the value from $paramOverrides (if present) or use the scaffolding prepared in setUp()
        foreach ($paramNames as $paramName) {
            static::echo("    {$paramName} => ");
            if (isset($paramOverrides[$route->getName()]) && isset($paramOverrides[$route->getName()][$paramName])) {
                $params[$paramName] = $paramOverrides[$route->getName()][$paramName];
                static::echo($params[$paramName]." \e[30;1m(override)\e[0m\n");
            } else {
                if (isset(self::$scaffolding[$paramName])) {
                    $params[$paramName] = self::$scaffolding[$paramName]->getRouteKey();
                    static::echo($params[$paramName]."\n");
                } else {
                    static::echo("\e[30;1m¯\_(ツ)_/¯\e[0m\n");
                }
            }
        }

        if (isset($paramOverrides[$route->getName()])) {
            foreach ($paramOverrides[$route->getName()] as $paramName => $paramValue) {
                if (!in_array($paramName, $paramNames, true)) {
                    $params[$paramName] = $paramValue;
                    static::echo("    {$paramName} => {$paramValue} \e[30;1m(extra param from override)\e[0m\n");
                }
            }
        }

        $url = str_replace($GLOBALS['cfg']['app']['url'], '', route($route->getName(), $params));

        return $url;
    }

    private function captureFailedTest(string $type, Exception $err, Browser $browser, LaravelRoute $route): void
    {
        $filename = "tests/Browser/screenshots/fail-{$route->getName()}-{$type}.png";
        $browser->driver->takeScreenshot($filename);

        static::echo('  '.$err->getMessage()."\n");
        static::echo("  screenshot saved to: {$filename}\n");
        static::echo("\e[1;37;41m\e[2K    x ({$type})\e[0m\n");
    }

    private function checkAdminPermission(Browser $browser, LaravelRoute $route)
    {
        $adminRestricted = ['forum.topics.logs.index', 'user-cover-presets.index'];

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
            'account.github-users.callback',
            'account.github-users.create',
            'authenticator-app.create',
            'authenticator-app.edit',
            'chat.index',
            'client-verifications.create',
            'messages.users.show',
            'store.checkout.show',
            'store.invoice.show',
            'store.orders.index',
        ];

        if (in_array($route->getName(), $verificationExpected, true)) {
            $browser->assertSee('Account Verification');

            $verificationCode = static::getVerificationCode($browser);

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
