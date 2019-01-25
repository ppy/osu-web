<?php

namespace Tests\Browser;

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
            self::$scaffolding['user'] = factory(\App\Models\User::class)->create();

            // factories for /beatmapsets/*
            self::$scaffolding['beatmap_mirror'] = factory(\App\Models\BeatmapMirror::class)->create();
            self::$scaffolding['beatmapset'] = factory(\App\Models\Beatmapset::class)->create([
                'discussion_enabled' => true,
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
            self::$scaffolding['order'] = factory(\App\Models\Store\Order::class, 'paid')->create([
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

            // fake object for gamemode
            self::$scaffolding['mode'] = new class() {
                public function getKey()
                {
                    return 'osu';
                }
                public function forceDelete()
                {
                    return true;
                }
            };
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

        $nukingOrder = array_reverse(self::$scaffolding);

        foreach ($nukingOrder as $name => $scaffold) {
            $this->output("TEARDOWN: ".get_class($scaffold)."\n");

            if ($name === 'order') {
                // we need to perform custom deletion for orders to bypass immutability protections
                DB::connection('mysql-store')->delete('delete from orders where order_id = ?', [$scaffold->getKey()]);
            } else {
                $scaffold->forceDelete();
            }
        }
    }

    public function output($text)
    {
        // TODO: determine if we want to keep this output?
        echo($text);
    }

    public function testPageLoadCheck()
    {
        $scaffolding = self::$scaffolding;
        $bypass = [
            '_dusk/',
            '_lio',
            'api/',
            'oauth/',
        ];

        $verification = [
            'home/account/edit',
            'store/orders',
            'payments/paypal/approved',
            'payments/paypal/declined',
            'payments/paypal/completed',
            'payments/xsolla/completed',
            'payments/centili/callback',
            'payments/centili/completed',
            'payments/centili/failed',
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
            foreach ($paramNames as $paramName) {
                $this->output("    ".$paramName.' => ');
                if (isset($scaffolding[$paramName])) {
                    $params[$paramName] = $scaffolding[$paramName]->getKey();
                    $this->output($scaffolding[$paramName]->getKey()."\n");
                } else {
                    $this->output("\e[30;1m¯\_(ツ)_/¯\e[0m\n");
                }
            }
            $route->parameters = $params;

            $this->browse(function (Browser $browser) use ($route, $params, $scaffolding, $verification) {
                try {
                    $url = str_replace(config('app.url'), '', route($route->getName(), $params));
                    $browser
                        ->loginAs(self::$scaffolding['user'])
                        ->visit($url);

                    $browser
                        ->assertDontSee('Oh no! Something broke! ;_;')
                        ->assertDontSee('Page Missing');

                    // TODO: only assert on routes that aren't expected to trigger account verification
                    if (in_array($route->uri, $verification)) {
                        // $browser->doVerificationThingy();
                    } else {
                        $browser->assertDontSee('Account Verification');
                    }

                    // ->assertSourceMissing("<script type=\"text/javascript\">alert('Found the following N+1 queries in this request:");
                    $this->passed++;
                    $this->output("\e[0;32m    ✓\e[0m");
                } catch (\Exception $err) {
                    $this->failed++;
                    $this->output('  '.$err->getMessage()."\n");
                    $this->output("\e[1;37;41m\e[2K    x\e[0m");
                    $browser->driver->takeScreenshot('ss/'.$route->getName().'@2x.png');
                    // throw $err;
                }
            });
        }

        $this->output("\n\n{$this->passed}/".($this->passed+$this->failed)." passed (".round(($this->passed / ($this->passed+$this->failed))*100, 2)."%) [{$this->skipped} skipped]\n\n");
    }
}
