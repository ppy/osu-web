<?php

namespace Tests\Browser;

use App\Models\Country;
use DB;
use Route;
use Tests\Browser;
use Tests\DuskTestCase;

class SanityTest extends DuskTestCase
{
    protected static $scaffolding; // static so we only set up the scaffolding once

    protected $passed = 0;
    protected $failed = 0;
    protected $skipped = 0;

    public function setUp()
    {
        parent::setUp();

        $this->createScaffolding();

        $this->beforeApplicationDestroyed(function () {
            // We do this here while we can still access laravel,
            // tearDown/tearDownAfterClass runs after laravel is torn down
            $this->cleanup();
        });
    }

    public function createScaffolding()
    {
        if (!isset(self::$scaffolding)) {
            self::$scaffolding['country'] = Country::first() ?? factory(\App\Models\Country::class)->create();
            // user to login as and to use for requests
            self::$scaffolding['user'] = factory(\App\Models\User::class)->create([
                'country_acronym' => self::$scaffolding['country']->acronym,
            ]);

            // factories for /beatmapsets/*
            self::$scaffolding['beatmap_mirror'] = factory(\App\Models\BeatmapMirror::class)->create();
            self::$scaffolding['genre'] = factory(\App\Models\Genre::class)->create();
            self::$scaffolding['language'] = factory(\App\Models\Language::class)->create();
            self::$scaffolding['beatmapset'] = factory(\App\Models\Beatmapset::class)->create([
                'discussion_enabled' => true,
                'genre_id' => self::$scaffolding['genre']->genre_id,
                'language_id' => self::$scaffolding['language']->language_id,
                'user_id' => self::$scaffolding['user']->getKey(),
            ]);
            self::$scaffolding['beatmap'] = factory(\App\Models\Beatmap::class)->create([
                'beatmapset_id' => self::$scaffolding['beatmapset']->getKey(),
            ]);
            self::$scaffolding['beatmap_discussion'] = factory(\App\Models\BeatmapDiscussion::class)->create([
                'beatmapset_id' => self::$scaffolding['beatmapset']->getKey(),
                'beatmap_id' => self::$scaffolding['beatmap']->getKey(),
            ]);
            self::$scaffolding['pack'] = factory(\App\Models\BeatmapPack::class)->create();

            // factories for /community/contests/*
            self::$scaffolding['contest'] = factory(\App\Models\Contest::class)->states('entry')->create();

            // factories for /community/tournaments/*
            self::$scaffolding['tournament'] = factory(\App\Models\Tournament::class)->create();

            // factories for /beatmaps/artists/*
            self::$scaffolding['artist'] = factory(\App\Models\Artist::class)->create();

            // factories for /store/*
            self::$scaffolding['product'] = factory(\App\Models\Store\Product::class, 'master_tshirt')->create();
            self::$scaffolding['order'] = factory(\App\Models\Store\Order::class)->states('checkout')->create([
                'user_id' => self::$scaffolding['user']->getKey(),
            ]);
            self::$scaffolding['checkout'] = new ScaffoldDummy(self::$scaffolding['order']->getKey());
            self::$scaffolding['invoice'] = factory(\App\Models\Store\Order::class, 'paid')->create([
                'user_id' => self::$scaffolding['user']->getKey(),
            ]);

            // factories for /community/forums/*
            self::$scaffolding['forum_parent'] = factory(\App\Models\Forum\Forum::class, 'parent')->create();
            self::$scaffolding['forum'] = factory(\App\Models\Forum\Forum::class, 'child')->create([
                'parent_id' => self::$scaffolding['forum_parent']->getKey(),
            ]);
            // satisfy group permissions required for posting in forum
            self::$scaffolding['_group'] = factory(\App\Models\Group::class)->create();
            self::$scaffolding['_forum_acl_post'] = factory(\App\Models\Forum\Authorize::class, 'post')->create([
                'forum_id' => self::$scaffolding['forum']->getKey(),
                'group_id' => self::$scaffolding['_group']->getKey(),
            ]);
            self::$scaffolding['_forum_acl_reply'] = factory(\App\Models\Forum\Authorize::class, 'reply')->create([
                'forum_id' => self::$scaffolding['forum']->getKey(),
                'group_id' => self::$scaffolding['_group']->getKey(),
            ]);
            self::$scaffolding['_user_group'] = factory(\App\Models\UserGroup::class)->create([
                'user_id' => self::$scaffolding['user']->getKey(),
                'group_id' => self::$scaffolding['_group']->getKey(),
            ]);
            // satisfy minimum playcount for forum posting
            self::$scaffolding['user']->monthlyPlaycounts()->save(factory(\App\Models\UserMonthlyPlaycount::class)->make());

            self::$scaffolding['topic'] = factory(\App\Models\Forum\Topic::class)->create([
                'topic_poster' => self::$scaffolding['user']->getKey(),
                'topic_first_poster_name' => self::$scaffolding['user']->username,
                'topic_last_poster_id' => self::$scaffolding['user']->getKey(),
                'topic_last_poster_name' => self::$scaffolding['user']->username,
                'forum_id' => self::$scaffolding['forum']->getKey(),
            ]);

            self::$scaffolding['post'] = factory(\App\Models\Forum\Post::class)->create([
                'poster_id' => self::$scaffolding['user']->getKey(),
                'post_username' => self::$scaffolding['user']->username,
                'forum_id' => self::$scaffolding['forum']->getKey(),
                'topic_id' => self::$scaffolding['topic']->getKey(),
            ]);

            // factories for /community/chat/*
            self::$scaffolding['channel'] = factory(\App\Models\Chat\Channel::class)->states('public')->create();
            self::$scaffolding['user_channel'] = factory(\App\Models\Chat\UserChannel::class)->create([
                'channel_id' => self::$scaffolding['channel']->getKey(),
                'user_id' => self::$scaffolding['user']->getKey(),
            ]);

            // dummy for game mode param
            self::$scaffolding['mode'] = new ScaffoldDummy('osu');

            // factory for /home/changelog/*
            self::$scaffolding['stream'] = factory(\App\Models\UpdateStream::class)->create();
            self::$scaffolding['changelog'] = factory(\App\Models\Changelog::class)->create([
                'stream_id' => self::$scaffolding['stream']->stream_id,
            ]);
            self::$scaffolding['build'] = factory(\App\Models\Build::class)->create([
                'stream_id' => self::$scaffolding['stream']->stream_id,
            ]);

            // factory for /g/*
            self::$scaffolding['group'] = factory(\App\Models\Group::class)->create();

            // factory for comments
            self::$scaffolding['comment'] = factory(\App\Models\Comment::class)->create([
                'user_id' => self::$scaffolding['user']->user_id,
                'commentable_id' => self::$scaffolding['build'],
            ]);

            // factory for matches
            self::$scaffolding['match'] = factory(\App\Models\Multiplayer\Match::class)->create();
            self::$scaffolding['event'] = factory(\App\Models\Multiplayer\Event::class)->states('join')->create([
                'match_id' => self::$scaffolding['match']->getKey(),
            ]);

            // dummy for wiki page
            self::$scaffolding['page'] = new ScaffoldDummy('Welcome');

            // dummy for news
            self::$scaffolding['news'] = new ScaffoldDummy('2014-06-21-meet-yuzu');

            // score factory
            self::$scaffolding['score'] = factory(\App\Models\Score\Best\Osu::class)->states('with_replay')->create();
            // TODO: move this into ScoreBestFactory when Laravel is upgraded to 5.6+ and we can use afterCreatingState
            self::$scaffolding['score']->replayFile()->disk()->put(self::$scaffolding['score']->getKey(), 'this-is-totally-a-legit-replay');
        }
    }

    public function cleanup()
    {
        if (!isset(self::$scaffolding)) {
            return;
        }

        // Clean up extra things that get created (i.e. as side-effects, etc)
        if (isset(self::$scaffolding['user'])) {
            self::$scaffolding['user']->userProfileCustomization()->forceDelete();
        }

        // Tear down in reverse-order so that dependants get destroyed before their dependencies.
        $nukingOrder = array_reverse(self::$scaffolding);

        foreach ($nukingOrder as $name => $scaffold) {
            $this->output("TEARDOWN: $name (".get_class($scaffold).")\n");

            if ($name === 'order' || $name === 'invoice') {
                // we need to perform custom deletion for orders to bypass their immutability protections
                DB::connection('mysql-store')->delete('delete from orders where order_id = ?', [$scaffold->getKey()]);
            } else {
                $scaffold->forceDelete();
            }
        }
    }

    public function output($text)
    {
        // apparently there's no phpunit api to do this...
        if (in_array('--verbose', $_SERVER['argv'], true)) {
            echo $text;
        }
    }

    public function testPageLoadCheck()
    {
        $bypass = [
            '_dusk/',
            '_lio',
            'api/',
            'oauth/',
            'payments/',
        ];

        $this->testFailed = null;

        foreach (Route::getRoutes()->get('GET') as $route) {
            $this->output("\n  /{$route->uri} (".(presence($route->getName()) ?? '???').')');

            if (!present($route->getName()) || starts_with($route->uri, $bypass)) {
                $this->output(" \e[30;1m[SKIPPED]\e[0m");
                $this->skipped++;
                continue;
            }

            // TODO: add additional logic for certain routes to re-run tests per game mode, per user score type, etc
            $this->browse(function (Browser $browser) use ($route) {
                try {
                    $url = $this->bindParams($browser, $route);

                    $browser
                        ->loginAs(self::$scaffolding['user'])
                        ->visit($url);

                    // $browser->driver->takeScreenshot('ss/'.$route->getName().'.png');

                    $this->checkAdminPermission($browser, $route);
                    $this->checkVerification($browser, $route);

                    $browser
                        ->assertDontSee('Oh no! Something broke! ;_;')
                        ->assertDontSee('Sorry, the page you are looking for could not be found');

                    $this->checkJavascriptErrors($browser, $route);

                    $this->passed++;
                    $this->output("\e[0;32m    ✓\e[0m\n");
                } catch (\Exception $err) {
                    $filename = 'tests/Browser/screenshots/fail-'.$route->getName().'.png';
                    $browser->driver->takeScreenshot($filename);

                    $this->failed++;
                    $this->output('  '.$err->getMessage()."\n");
                    $this->output("  screenshot saved to: {$filename}\n");
                    $this->output("\e[1;37;41m\e[2K    x\e[0m\n");

                    // save exception for later and let tests continue running
                    $this->testFailed = $err;
                }
            });
        }

        $this->output("\n\n{$this->passed}/".($this->passed + $this->failed).' passed ('.round(($this->passed / ($this->passed + $this->failed)) * 100, 2)."%) [{$this->skipped} skipped]\n\n");

        if ($this->testFailed !== null) {
            // triggered delayed test failure
            $this->fail($this->testFailed);
        }
    }

    public function bindParams(Browser $browser, \Illuminate\Routing\Route $route)
    {
        $paramOverrides = [
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
                //     'ranked_and_approved',
                //     'unranked',
                // ],
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
                'page' => 'terms',
            ],
        ];

        $params = [];
        $paramNames = $route->parameterNames();
        $this->output("\n");

        // Go through each parameter referenced in the route and either use the value from $paramOverrides (if present) or use the scaffolding prepared in setUp()
        foreach ($paramNames as $paramName) {
            $this->output("    {$paramName} => ");
            if (isset($paramOverrides[$route->getName()]) && isset($paramOverrides[$route->getName()][$paramName])) {
                $params[$paramName] = $paramOverrides[$route->getName()][$paramName];
                $this->output($params[$paramName]." \e[30;1m(override)\e[0m\n");
            } else {
                if (isset(self::$scaffolding[$paramName])) {
                    $params[$paramName] = self::$scaffolding[$paramName]->getKey();
                    $this->output($params[$paramName]."\n");
                } else {
                    $this->output("\e[30;1m¯\_(ツ)_/¯\e[0m\n");
                }
            }
        }

        if (isset($paramOverrides[$route->getName()])) {
            foreach ($paramOverrides[$route->getName()] as $paramName => $paramValue) {
                if (!in_array($paramName, $paramNames, true)) {
                    $params[$paramName] = $paramValue;
                    $this->output("    {$paramName} => {$paramValue} \e[30;1m(extra param from override)\e[0m\n");
                }
            }
        }

        $url = str_replace(config('app.url'), '', route($route->getName(), $params));

        return $url;
    }

    public function checkAdminPermission(Browser $browser, \Illuminate\Routing\Route $route)
    {
        $adminRestricted = [
            'comments.index',
            'comments.show',
        ];

        if (starts_with($route->uri, 'admin') || in_array($route->getName(), $adminRestricted, true)) {
            // TODO: retry and check page as admin? (will affect subsequent tests though, so figure out how to deal with that..)
            $browser->assertSee("You shouldn't be here.");
        } else {
            $browser->assertDontSee("You shouldn't be here.");
        }
    }

    public function checkJavascriptErrors(Browser $browser, \Illuminate\Routing\Route $route)
    {
        // Note: if you call getLog more than once a request, the subsequent calls return an empty array.
        $rawLog = $browser->driver->manage()->getLog('browser');
        $logLines = collect(self::filterLog($rawLog));

        if ($logLines->contains('source', 'javascript')) {
            $error = implode(' | ', $logLines->where('source', 'javascript')->pluck('message')->toArray());

            throw new \Exception("JavaScript ERROR: {$error}");
        }
    }

    public function checkVerification(Browser $browser, \Illuminate\Routing\Route $route)
    {
        $verificationExpected = [
            'account.edit',
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

    public static function filterLog(array $log)
    {
        $return = [];

        foreach ($log as $line) {
            if ($line['source'] === 'network') {
                $matches = [];
                $count = preg_match_all("/^([^ ]+) - Failed to load resource: the server responded with a status of ([0-9]{3}) \(([^\)]*)\)$/i", $line['message'], $matches);
                $returnCode = get_int(optional($matches[2])[0]);
                $url = optional($matches[1])[0];

                // ignore missing non-critical assets
                if (
                    ($returnCode === 404 && starts_with($url, 'https://assets.ppy.sh')) ||
                    ($returnCode === 403 && starts_with($url, 'https://i.ppy.sh'))
                ) {
                    continue;
                }

                $return[] = [
                    'url' => $url,
                    'status' => $returnCode,
                    'message' => optional($matches[3])[0],
                    'source' => 'network',
                    'raw' => $line['message'],
                ];
            } else {
                $return[] = $line;
            }
        }

        return $return;
    }

    public static function getVerificationCode()
    {
        $log = file_get_contents('storage/logs/laravel.log');
        $matches = [];
        $count = preg_match_all('/Your verification code is: ([0-9a-f]{8})/im', $log, $matches);

        if ($count > 0) {
            return $matches[1][count($matches[1]) - 1];
        }
    }
}
