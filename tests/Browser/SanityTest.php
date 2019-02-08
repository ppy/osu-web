<?php

namespace Tests\Browser;

use App\Models\Country;
use DB;
use Laravel\Dusk\Browser;
use Route;
use Tests\DuskTestCase;

class SanityTest extends DuskTestCase
{
    protected static $scaffolding;

    protected $passed = 0;
    protected $failed = 0;
    protected $skipped = 0;

    public function setUp()
    {
        parent::setUp();

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

            self::$scaffolding['topic'] = factory(\App\Models\Forum\Topic::class)->create([
                'forum_id' => self::$scaffolding['forum']->getKey(),
            ]);

            self::$scaffolding['post'] = factory(\App\Models\Forum\Post::class)->create([
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

        $this->beforeApplicationDestroyed(function () {
            $this->cleanup();
        });
    }

    public function cleanup()
    {
        if (!isset(self::$scaffolding)) {
            return;
        }

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
            echo($text);
        }
    }

    public function testPageLoadCheck()
    {
        $scaffolding = self::$scaffolding;
        $bypass = [
            '_dusk/',
            '_lio',
            'api/',
            'oauth/',
            'payments/',
        ];

        $verificationExpected = [
            'account.edit',
            'store.checkout.show',
            'store.invoice.show',
            'store.orders.index',
        ];

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

        foreach (Route::getRoutes()->get('GET') as $route) {
            $this->output("\n  /{$route->uri} (".(presence($route->getName()) ?? '???').')');

            if (!present($route->getName())) {
                $this->output(" \e[30;1m[SKIPPED]\e[0m");
                $this->skipped++;
                continue;
            }

            foreach ($bypass as $prefix) {
                if (starts_with($route->uri, $prefix)) {
                    $this->output(" \e[30;1m[SKIPPED]\e[0m");
                    $this->skipped++;
                    continue 2;
                }
            }

            $params = [];
            $paramNames = $route->parameterNames();
            $this->output("\n");

            // This goes through each parameter the route expects and uses the value either from $paramOverrides if present or from the scaffolding in setUp() to map params to objects
            foreach ($paramNames as $paramName) {
                $this->output("    {$paramName} => ");
                if (isset($paramOverrides[$route->getName()]) && isset($paramOverrides[$route->getName()][$paramName])) {
                    $params[$paramName] = $paramOverrides[$route->getName()][$paramName];
                    $this->output($paramOverrides[$route->getName()][$paramName]." \e[30;1m(override)\e[0m\n");
                } else {
                    if (isset($scaffolding[$paramName])) {
                        $params[$paramName] = $scaffolding[$paramName]->getKey();
                        $this->output($scaffolding[$paramName]->getKey()."\n");
                    } else {
                        $this->output("\e[30;1m¯\_(ツ)_/¯\e[0m\n");
                    }
                }
            }

            if (isset($paramOverrides[$route->getName()])) {
                foreach ($paramOverrides[$route->getName()] as $paramName => $paramValue) {
                    if (!in_array($paramName, $paramNames)) {
                        $params[$paramName] = $paramValue;
                        $this->output("    {$paramName} => {$paramValue} \e[30;1m(additional override)\e[0m\n");
                    }
                }
            }
            $route->parameters = $params;

            // TODO: add additional logic for certain routes to re-run tests per game mode, per user score type, etc

            $this->browse(function (Browser $browser) use ($route, $params, $scaffolding, $verificationExpected) {
                try {
                    $url = str_replace(config('app.url'), '', route($route->getName(), $params));
                    $browser
                        ->loginAs(self::$scaffolding['user'])
                        ->visit($url);

                    // $browser->driver->takeScreenshot('ss/'.$route->getName().'.png');

                    $browser
                        ->assertDontSee('Oh no! Something broke! ;_;')
                        ->assertDontSee('Sorry, the page you are looking for could not be found');

                    if (in_array($route->getName(), $verificationExpected)) {
                        // TODO: perform verification and check stuff didn't explode
                        $browser->assertSee('Account Verification');
                    } else {
                        $browser->assertDontSee('Account Verification');
                    }

                    $this->passed++;
                    $this->output("\e[0;32m    ✓\e[0m");
                } catch (\Exception $err) {
                    $filename = 'fail-'.$route->getName().'.png';
                    $browser->driver->takeScreenshot($filename);

                    $this->failed++;
                    $this->output('  '.$err->getMessage()."\n");
                    $this->output("  screenshot saved to: {$filename}\n");
                    $this->output("\e[1;37;41m\e[2K    x\e[0m");

                    throw $err;
                }
            });
        }

        $this->output("\n\n{$this->passed}/".($this->passed+$this->failed)." passed (".round(($this->passed / ($this->passed+$this->failed))*100, 2)."%) [{$this->skipped} skipped]\n\n");
    }
}
